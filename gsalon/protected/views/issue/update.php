<?php
$this->breadcrumbs=array(
	'Issues'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'更新交易',
);

$this->menu=array(
	array('label'=>'交易列表', 'url'=>array('index')),
	array('label'=>'创建交易', 'url'=>array('create')),
	array('label'=>'显示交易', 'url'=>array('view', 'id'=>$model->id)),
	/* array('label'=>'Manage Issue', 'url'=>array('admin')), */
);
?>

<h1>更新交易 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>