<?php
$this->breadcrumbs=array(
	'客户'=>array('index'),
	'创建',
);

$this->menu=array(
	array('label'=>'客户列表', 'url'=>array('index')),
	/* array('label'=>'Manage Project', 'url'=>array('admin')), */
);
?>

<h1>创建客户</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>