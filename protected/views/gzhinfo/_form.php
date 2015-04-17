<?php
/* @var $this GzhinfoController */
/* @var $model Gzhinfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gzhinfo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'gzh_tid'); ?>
		<?php echo $form->textField($model,'gzh_tid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'gzh_tid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gzh_name'); ?>
		<?php echo $form->textField($model,'gzh_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'gzh_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gzh_number'); ?>
		<?php echo $form->textField($model,'gzh_number',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'gzh_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gzh_headimg'); ?>
		<?php echo $form->textField($model,'gzh_headimg',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'gzh_headimg'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gzh_codeimg'); ?>
		<?php echo $form->textField($model,'gzh_codeimg',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'gzh_codeimg'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gzh_creatid'); ?>
		<?php echo $form->textField($model,'gzh_creatid'); ?>
		<?php echo $form->error($model,'gzh_creatid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gzh_ctime'); ?>
		<?php echo $form->textField($model,'gzh_ctime'); ?>
		<?php echo $form->error($model,'gzh_ctime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gzh_openid'); ?>
		<?php echo $form->textField($model,'gzh_openid',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'gzh_openid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gzh_order'); ?>
		<?php echo $form->textField($model,'gzh_order'); ?>
		<?php echo $form->error($model,'gzh_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ghz_descript'); ?>
		<?php echo $form->textField($model,'ghz_descript',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'ghz_descript'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gzh_certified_text'); ?>
		<?php echo $form->textField($model,'gzh_certified_text',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'gzh_certified_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gzh_appid'); ?>
		<?php echo $form->textField($model,'gzh_appid',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'gzh_appid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gzh_appsecret'); ?>
		<?php echo $form->textField($model,'gzh_appsecret',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'gzh_appsecret'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->