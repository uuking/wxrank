<?php
/* @var $this TermController */
/* @var $data Term */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('term_name')); ?>:</b>
	<?php echo CHtml::encode($data->term_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('term_parent')); ?>:</b>
	<?php echo CHtml::encode($data->term_parent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('term_order')); ?>:</b>
	<?php echo CHtml::encode($data->term_order); ?>
	<br />


</div>