<?php
$this->breadcrumbs=array(
	'Issues'=>array('index'),
	'创建',
);

$this->menu=array(
	array('label'=>'交易列表', 'url'=>array('index')),
	/* array('label'=>'Manage Issue', 'url'=>array('admin')), */
);
?>

<h1>创建交易</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>