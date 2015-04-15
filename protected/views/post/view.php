<style>
	.rich_media_content img{
		max-width: 100%;
		max-height: 100%;
	}
</style>
<?php
/* @var $this PostController */
/* @var $model Article */

$this->breadcrumbs=array(
	Yii::t('common','Post')=>array('index'),
	// $model->id,
);

$this->menu=array(
	array('label'=>'List Article', 'url'=>array('index')),
	array('label'=>'Create Article', 'url'=>array('create')),
	array('label'=>'Update Article', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Article', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Article', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->article_title; ?></h1>
<p><?php echo '标签：'.CHtml::encode($model->gzhinfo->term->term_name). ' 公众号：'.CHtml::encode($model->gzhinfo->gzh_name).' 日期：'.Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss',$model->article_ctime); ?></p>
<?php echo $model->article_content; ?>
