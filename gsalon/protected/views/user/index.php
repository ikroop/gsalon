<?php
$this->breadcrumbs=array(
	'用户',
);

$this->menu=array(
		array('label'=>'用户列表', 'url'=>array('index')),
	array('label'=>'创建用户', 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess("admin")),
	/* array('label'=>'Manage User', 'url'=>array('admin')), */
	array('label'=>'管理用户', 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess("admin")),
		);
?>

<h1>用户</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
