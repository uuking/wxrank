<?php
/* @var $this PostController */
/* @var $data Article */
?>
<style>
*{
	margin: 0px;
	padding: 0px;
}
.view ul{
	margin: 0px;
	padding: 0px;
	list-style-type: none;
}
.list .headimg{
	float: left;
}
.list .headimg img{
	width: 100px;
	height: 70px;
}
.list .atitle{
	font-size: 15px;
	font-weight: bold;
}
</style>
<div class="view">
	
	<ul class="list">
		<li class="headimg"><a href="<?php echo $this->createUrl('view',array('id'=>$data->id)); ?>" title="<?php echo CHtml::encode($data->article_title); ?>"><img src="<?php echo CHtml::encode($data->article_headimg); ?>" alt="<?php echo CHtml::encode($data->article_title); ?>"></a></li>
		<li class="atitle"><a href="<?php echo $this->createUrl('view',array('id'=>$data->id)); ?>" title="<?php echo CHtml::encode($data->article_title); ?>"><?php echo CHtml::encode($data->article_title); ?></a></li>
		<li><?php echo CHtml::encode($data->article_description); ?></li>
		<li><?php echo '标签：'.CHtml::encode($data->gzhinfo->term->term_name). ' 公众号：'.CHtml::encode($data->gzhinfo->gzh_name).' 日期：'.Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss',$data->article_ctime); ?></li>
		<li style="clear: both;"></li>
	</ul>
	

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('article_status')); ?>:</b>
	<?php echo CHtml::encode($data->article_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('article_place')); ?>:</b>
	<?php echo CHtml::encode($data->article_place); ?>
	<br />

	*/ ?>

</div>