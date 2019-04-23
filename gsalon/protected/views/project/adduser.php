<?php
$this->pageTitle=Yii::app()->name.' - 添加用户到客户';
 $this->breadcrumbs=array($model->project->name=>array('view','id'=>$model->project->id),'添加用户'); 
 
/*  var_dump($model); */

$this->menu=array(array('label'=>'回到项目','url'=>array('view','id'=>$model->project->id)),);
?>

<h1>添加用户到<?php echo $model->project->name;?></h1>
<?php if(Yii::app()->user->hasFlash('success')):?>

<div class="successMessage">
<?php echo Yii::app()->user->getFlash('success');?>
</div>

<?php endif;?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm')?>

<p class="note"><span class="required">*</span> 为必填项</p>
<div class="row">
<?php $this->widget('CAutoComplete',array(
		'model'=>$model,
		'attribute'=>'username',
		'data'=>$usernames,
		'multiple'=>false,
		'htmlOptions'=>array('size'=>25),
		
));?>
&nbsp; <class="note"><span class="required">*</span>
<?php echo $form->error($model,'username'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'角色');?>
<?php echo $form->dropDownList($model,'role',Project::getUserRoleOptions());?>
<?php echo $form->error($model,'role');?>
</div>

<div class="row buttons">
<?php echo CHtml::submitButton('添加用户');?>
</div>

<?php $this->endWidget();?>
</div>