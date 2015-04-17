<?php
/* @var $this TermController */
/* @var $model Term */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'term_name'); ?>
		<?php echo $form->textField($model,'term_name',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'term_parent'); ?>
		<?php echo $form->textField($model,'term_parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'term_order'); ?>
		<?php echo $form->textField($model,'term_order'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->