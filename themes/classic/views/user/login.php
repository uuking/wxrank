<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	// Yii::t('common','User')=>array('/user'),
	Yii::t('common','Login'),
);
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array('id'=>'login-form')); ?>

	<div class="row">
		<?php echo $form->labelEx($loginForm,'username'); ?>
		<?php echo $form->textField($loginForm,'username'); ?>
		<?php echo $form->error($loginForm,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($loginForm,'password'); ?>
		<?php echo $form->passwordField($loginForm,'password'); ?>
		<?php echo $form->error($loginForm,'password'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($loginForm,'rememberMe'); ?>
		<?php echo $form->label($loginForm,'rememberMe'); ?>
		<?php echo $form->error($loginForm,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
