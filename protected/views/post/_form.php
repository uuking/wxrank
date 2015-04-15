<?php
/* @var $this PostController */
/* @var $model Article */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'article_uid'); ?>
		<?php echo $form->textField($model,'article_uid',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'article_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_title'); ?>
		<?php echo $form->textField($model,'article_title',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'article_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_content'); ?>
		<?php echo $form->textArea($model,'article_content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'article_content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_headimg'); ?>
		<?php echo $form->textField($model,'article_headimg',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'article_headimg'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_description'); ?>
		<?php echo $form->textField($model,'article_description',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'article_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_ctime'); ?>
		<?php echo $form->textField($model,'article_ctime'); ?>
		<?php echo $form->error($model,'article_ctime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_status'); ?>
		<?php echo $form->textField($model,'article_status'); ?>
		<?php echo $form->error($model,'article_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'article_place'); ?>
		<?php echo $form->textField($model,'article_place'); ?>
		<?php echo $form->error($model,'article_place'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->