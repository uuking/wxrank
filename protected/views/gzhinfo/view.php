<?php
/* @var $this GzhinfoController */
/* @var $model Gzhinfo */

$this->breadcrumbs=array(
	'Gzhinfos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Gzhinfo', 'url'=>array('index')),
	array('label'=>'Create Gzhinfo', 'url'=>array('create')),
	array('label'=>'Update Gzhinfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Gzhinfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Gzhinfo', 'url'=>array('admin')),
);
?>

<h1>View Gzhinfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'gzh_tid',
		'gzh_name',
		'gzh_number',
		'gzh_headimg',
		'gzh_codeimg',
		'gzh_creatid',
		'gzh_ctime',
		'gzh_openid',
		'gzh_order',
		'ghz_descript',
		'gzh_certified_text',
		'gzh_appid',
		'gzh_appsecret',
	),
)); ?>
