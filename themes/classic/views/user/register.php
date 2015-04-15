<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	// Yii::t('common','User')=>array('/user'),
	Yii::t('common','Register'),
);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-register-form',
	'enableAjaxValidation' => true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">带 <span class="required">*</span> 的为必填项.</p>

	<?php //echo $form->errorSummary($registerModel); ?>

	<div class="row">
		<?php echo $form->labelEx($registerModel,'username'); ?>
		<?php echo $form->textField($registerModel,'username'); ?>
		<?php echo $form->error($registerModel,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($registerModel,'password'); ?>
		<?php echo $form->passwordField($registerModel,'password'); ?>
		<?php echo $form->error($registerModel,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($registerModel,'email'); ?>
		<?php echo $form->textField($registerModel,'email'); ?>
		<?php echo $form->error($registerModel,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($registerModel,'nickname'); ?>
		<?php echo $form->textField($registerModel,'nickname'); ?>
		<?php echo $form->error($registerModel,'nickname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($registerModel,'verifyCode'); ?>
		<?php echo $form->textField($registerModel,'verifyCode'); ?>
		<?php $this->widget ( 'CCaptcha', array ('showRefreshButton' => true, 'clickableImage' => true, 'buttonType' => 'link', 'buttonLabel' => '换一张') );?>
		<?php echo $form->error($registerModel,'verifyCode'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('common','Register')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
