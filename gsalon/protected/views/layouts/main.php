<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name);?></div>
	</div><!-- header -->

	<div id="mainmenu">
	
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'首页', 'url'=>array('/site/index')),
				/* array('label'=>'关于我们', 'url'=>array('/site/page', 'view'=>'about')), */ 
					
				array('label'=>'客户', 'url'=>array('project/index')),
				
			    
				
					/* array('label'=>'Users', 'url'=>array('user/index')), */
					/* array('label'=>'Upload', 'url'=>array('/upload/index')), */
				array('label'=>'用户', 'url'=>array('user/index'),'visible'=>Yii::app()->user->checkAccess("admin")),
			    /* array('label'=>'系统消息', 'url'=>array('admin/sysMessage/index')),  */
				array('label'=>'登入', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'登出 ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
		
	
	</div><!-- mainmenu -->

	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->

	<?php echo $content; ?>

	<div id="footer">
		版权所有 &copy; <?php echo date('Y'); ?> 耿艺瑄<br/>
		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>