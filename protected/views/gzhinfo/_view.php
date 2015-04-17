<?php
/* @var $this GzhinfoController */
/* @var $data Gzhinfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gzh_tid')); ?>:</b>
	<?php echo CHtml::encode($data->gzh_tid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gzh_name')); ?>:</b>
	<?php echo CHtml::encode($data->gzh_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gzh_number')); ?>:</b>
	<?php echo CHtml::encode($data->gzh_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gzh_headimg')); ?>:</b>
	<?php echo CHtml::encode($data->gzh_headimg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gzh_codeimg')); ?>:</b>
	<?php echo CHtml::encode($data->gzh_codeimg); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gzh_creatid')); ?>:</b>
	<?php echo CHtml::encode($data->gzh_creatid); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('gzh_ctime')); ?>:</b>
	<?php echo CHtml::encode($data->gzh_ctime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gzh_openid')); ?>:</b>
	<?php echo CHtml::encode($data->gzh_openid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gzh_order')); ?>:</b>
	<?php echo CHtml::encode($data->gzh_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ghz_descript')); ?>:</b>
	<?php echo CHtml::encode($data->ghz_descript); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gzh_certified_text')); ?>:</b>
	<?php echo CHtml::encode($data->gzh_certified_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gzh_appid')); ?>:</b>
	<?php echo CHtml::encode($data->gzh_appid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gzh_appsecret')); ?>:</b>
	<?php echo CHtml::encode($data->gzh_appsecret); ?>
	<br />

	*/ ?>

</div>