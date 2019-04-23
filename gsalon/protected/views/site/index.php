<?php $this->pageTitle=Yii::app()->name; ?>

<h1>欢迎使用 <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php if(!Yii::app()->user->isGuest):?>
<p>
您的最后一次登入时间是  <?php echo date( ' F d, Y, g:i a',
Yii::app()->user->lastLoginTime ); ?>.
</p>

<?php /*  echo "<a href= '?r=project'>System Entrance</a>"; */?></b>
<?php endif;?>

<!--  
<p>Congratulations! You have successfully created your Yii application.</p>
<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>
<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>-->