<?php
/* @var $this GzhinfoController */
/* @var $model Gzhinfo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gzh_tid'); ?>
		<?php echo $form->textField($model,'gzh_tid',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gzh_name'); ?>
		<?php echo $form->textField($model,'gzh_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gzh_number'); ?>
		<?php echo $form->textField($model,'gzh_number',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gzh_headimg'); ?>
		<?php echo $form->textField($model,'gzh_headimg',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gzh_codeimg'); ?>
		<?php echo $form->textField($model,'gzh_codeimg',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gzh_creatid'); ?>
		<?php echo $form->textField($model,'gzh_creatid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gzh_ctime'); ?>
		<?php echo $form->textField($model,'gzh_ctime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gzh_openid'); ?>
		<?php echo $form->textField($model,'gzh_openid',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gzh_order'); ?>
		<?php echo $form->textField($model,'gzh_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ghz_descript'); ?>
		<?php echo $form->textField($model,'ghz_descript',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gzh_certified_text'); ?>
		<?php echo $form->textField($model,'gzh_certified_text',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gzh_appid'); ?>
		<?php echo $form->textField($model,'gzh_appid',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gzh_appsecret'); ?>
		<?php echo $form->textField($model,'gzh_appsecret',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->