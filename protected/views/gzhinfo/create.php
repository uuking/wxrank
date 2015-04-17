<?php
/* @var $this GzhinfoController */
/* @var $model Gzhinfo */

$this->breadcrumbs=array(
	'Gzhinfos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Gzhinfo', 'url'=>array('index')),
	array('label'=>'Manage Gzhinfo', 'url'=>array('admin')),
);
?>

<h1>Create Gzhinfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>