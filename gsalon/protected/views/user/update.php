<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'更新',
);

$this->menu=array(
	array('label'=>'用户列表', 'url'=>array('index')),
	array('label'=>'创建用户', 'url'=>array('create')),
	array('label'=>'显示用户', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理用户', 'url'=>array('admin')),
);
?>

<h1>更新用户 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>