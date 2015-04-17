<?php
/* @var $this GzhinfoController */
/* @var $model Gzhinfo */

$this->breadcrumbs=array(
	'Gzhinfos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Gzhinfo', 'url'=>array('index')),
	array('label'=>'Create Gzhinfo', 'url'=>array('create')),
	array('label'=>'View Gzhinfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Gzhinfo', 'url'=>array('admin')),
);
?>

<h1>Update Gzhinfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>