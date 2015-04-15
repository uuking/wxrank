<?php
/* @var $this PostController */
/* @var $model Article */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_uid'); ?>
		<?php echo $form->textField($model,'article_uid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_title'); ?>
		<?php echo $form->textField($model,'article_title',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_content'); ?>
		<?php echo $form->textArea($model,'article_content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_headimg'); ?>
		<?php echo $form->textField($model,'article_headimg',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_description'); ?>
		<?php echo $form->textField($model,'article_description',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_ctime'); ?>
		<?php echo $form->textField($model,'article_ctime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_status'); ?>
		<?php echo $form->textField($model,'article_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_place'); ?>
		<?php echo $form->textField($model,'article_place'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->