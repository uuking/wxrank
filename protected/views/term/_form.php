<?php
/* @var $this TermController */
/* @var $model Term */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'term-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'term_name'); ?>
		<?php echo $form->textField($model,'term_name',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'term_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'term_parent'); ?>
		<?php echo $form->textField($model,'term_parent'); ?>
		<?php echo $form->error($model,'term_parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'term_order'); ?>
		<?php echo $form->textField($model,'term_order'); ?>
		<?php echo $form->error($model,'term_order'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->