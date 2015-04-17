<?php
/* @var $this GzhinfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gzhinfos',
);

$this->menu=array(
	array('label'=>'Create Gzhinfo', 'url'=>array('create')),
	array('label'=>'Manage Gzhinfo', 'url'=>array('admin')),
);
?>

<h1>Gzhinfos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
