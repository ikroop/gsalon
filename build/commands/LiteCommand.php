<?php
/**
 * LiteCommand class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2010 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * @version $Id$
 */

/**
 * LiteCommand generates yiilite.php by merging commonly used Yii class
 * files into a single one and removes all comments and trace statements.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id$
 * @package system.build
 * @since 1.0
 */
class LiteCommand extends CConsoleCommand
{
	public function getHelp()
	{
		return <<<EOD
USAGE
  build lite

DESCRIPTION
  This command generates yiilite.php by merging commonly used Yii class
  files into a single one and removes all comments and trace statements.

  You should not execute this command unless you change some framework
  file and need to update yii.php accordingly.

EOD;
	}

	/**
	 * Execute the action.
	 * @param array command line parameters specific for this command
	 */
	public function run($args)
	{
		$lastupdate=date('Y/m/d H:i:s');
		$comments="
/**
 * Yii bootstrap file.
 *
 * This file is automatically generated using 'build lite' command.
 * It is the result of merging commonly used Yii class files with
 * comments and trace statements removed away.
 *
 * By using this file instead of yii.php, an Yii application may
 * improve performance due to the reduction of PHP parsing time.
 * The performance improvement is especially obvious when PHP APC extension
 * is enabled.
 *
 * DO NOT modify this file manually.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2010 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 * @version \$Id: \$
 * @since 1.0
 */

";

		$content=$this->minifyYii(dirname(__FILE__).'/lite/index.php');
		$content="<?php\n".preg_replace('/^(\?>|<\?php)/mu','',$content)."\n?>";
		$content=$this->stripComments($content);
		$content=preg_replace('/^require(_once)?.*\s*;\s*$/mu','',$content);
		$content=preg_replace('/^\s*Yii::trace.*\s*;\s*$/mu','',$content);
//		$content=preg_replace('/^\s*Yii::(begin|end)Profile.*\s*;\s*$/mu','',$content);
		$content=$this->stripEmptyLines($content);
		$content=substr_replace($content,$comments,5,0);
		file_put_contents(YII_PATH.DIRECTORY_SEPARATOR.'yiilite.php',$content);
		echo "Done.\n";
	}

	protected function minifyYii($entryScript)
	{
		try
		{
			ob_start();
			$this->runRequest($entryScript);
			$_SERVER['REQUEST_URI']='/index.php';
			$this->runRequest($entryScript,array('r'=>'post'));
			ob_end_clean();
		}
		catch(CException $e)
		{
			echo $e;
			die();
		}
		$classes=array_merge(get_declared_classes(),get_declared_interfaces());
		$results=array();
		foreach($classes as $class)
		{
			$c=new ReflectionClass($class);
			if(strpos($c->getFileName(),YII_PATH)===0 && strpos($c->getFileName(),YII_PATH.DIRECTORY_SEPARATOR.'console')!==0)
				$results[$class]=$c->getFileName();
		}
		$results=$this->sortByInheritance($results);

		$content='';
		foreach($results as $fileName=>$class)
			$content.="\n".file_get_contents($fileName);

		return $content;
	}

	protected function sortByInheritance($classes)
	{
		$results=array();
		foreach($classes as $class=>$fileName)
			$this->processClass($class,$classes,$results);
		return $results;
	}

	protected function processClass($class,$classes,&$results)
	{
		$parentClass=get_parent_class($class);
		if($parentClass!==false && isset($classes[$parentClass]))
		{
			if(!isset($results[$classes[$parentClass]]))
				$this->processClass($parentClass,$classes,$results);
		}
		if(!isset($results[$classes[$class]]))
		{
			// some file may contain multiple classes
			// we only want to include when the primary one appears
			if($class[0]!=='C' || $class===substr(basename($classes[$class]),0,-4))
				$results[$classes[$class]]=$class;
		}
	}

	protected function runRequest($entryScript,$params=array())
	{
		restore_error_handler();
		restore_exception_handler();
		Yii::setApplication(null);
		Yii::setPathOfAlias('application',null);
		$_GET=$params;
		require($entryScript);
	}

	protected function stripComments($source)
	{
		$tokens = token_get_all($source);
		$output = '';
		foreach ($tokens as $token)
		{
			if (is_string($token))
			{
				// simple 1-character token
				$output .= $token;
			}
			else
			{
				// token array
				list($id, $text) = $token;
				switch ($id) {
					case T_DOC_COMMENT: // and this
						// no action on comments
						break;
					default:
						// anything else -> output "as is"
						$output .= $text;
						break;
				}
			}
		}
		return $output;
	}

	protected function stripEmptyLines($string)
	{
		$string = preg_replace("/[\r\n]+[\s\t]*[\r\n]+/", "\n", $string);
		$string = preg_replace("/^[\s\t]*[\r\n]+/", "", $string);
		return $string;
	}

	protected function unfoldFile($fileName)
	{
		static $unfoldedFiles=array();
		$pattern='^(Yii::import|require_once|include_once)\s*\(.*?[\'"]([^\*]*?)[\'"].*?\);';
		echo "adding $fileName...\n";
		$content=file_get_contents($fileName);
		while(preg_match("/$pattern/m",$content,$matches,PREG_OFFSET_CAPTURE))
		{
			$offset=$matches[0][1];
			$length=strlen($matches[0][0]);
			$type=$matches[1][0];
			$file=trim($matches[2][0],"'\"");
			if($type==='Yii::import')
			{
				// replace system with framework path and dot with directory separator
				$file=substr_replace(strtr($file,'.',DIRECTORY_SEPARATOR),YII_PATH,0,6).'.php';
			}
			else
			{
				$file=YII_PATH.$file;
			}
			if(($file=realpath($file))===false || !is_file($file))
				die('Unable to process file '.$fileName.' about '.$matches[0][0]);
			if(isset($unfoldedFiles[$file]))
			{
				$content=substr_replace($content,'',$offset,$length);
			}
			else
			{
				$unfoldedFiles[$file]=true;
				$content=substr_replace($content,$this->unfoldFile($file),$offset,$length);
			}
		}
		return $content;
	}
}