<?php
$this->breadcrumbs=array(
	'交易',
);


$this->menu=array(
		
		array('label'=>'创建交易', 'url'=>array('create'),'visible'=>Yii::app()->user->checkAccess("admin")),
    array('label'=>'管理交易', 'url'=>array('admin'),'visible'=>Yii::app()->user->checkAccess("admin")),
    
);

?>

<h1>交易</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
