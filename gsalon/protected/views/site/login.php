<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'登入',
);
?>

<h1>登入</h1>

<p>请填写以下表单信息用于登入:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">带有 <span class="required">*</span> 的项目为必填项。</p>

	<div class="row">
		<?php echo $form->labelEx($model,'用户名'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'密码'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			提示: 你可以使用 <tt>demo/demo</tt> 或者 <tt>admin/admin</tt>
		</p>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'记住我'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('提交'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
