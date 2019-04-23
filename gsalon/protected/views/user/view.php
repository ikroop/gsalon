<?php
$this->breadcrumbs=array(
	'用户'=>array('index'),
	$model->id,
);

$this->menu=array(
	 array('label'=>'用户列表', 'url'=>array('index')),
/* 	array('label'=>'Create User', 'url'=>array('create')), 
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),  */
); 

if(Yii::app()->user->checkAccess('admin'))
{
	$this->menu[] = array('label'=>'创建用户',
			'url'=>array('create'));
}
if(Yii::app()->user->checkAccess('admin'))
{
	$this->menu[] = array('label'=>'更新用户',
			'url'=>array('update', 'id'=>$model->id));
}
if(Yii::app()->user->checkAccess('admin'))
{
	$this->menu[] = array('label'=>'删除用户',
			'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'));
}
if(Yii::app()->user->checkAccess('admin'))
{
	$this->menu[] = array('label'=>'管理用户',
			'url'=>array('admin'));
}


?>



<h1>显示用户 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'username',
		'password',
		'last_login_time',
		'create_time',
		'create_user_id',
		'update_time',
		/* 'update_user_id', */
	),
)); ?>
