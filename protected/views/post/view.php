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
<div class="ds-share" data-thread-key="<?php echo $model->id; ?>" data-title="<?php echo $model->article_title; ?>" data-images="http://wxrank.com/post/<?php echo $model->article_headimg; ?>" data-content="<?php echo $model->article_title; ?>" data-url="http://wxrank.com/post/<?php echo $model->id; ?>">
    <div class="ds-share-inline">
      <ul  class="ds-share-icons-">
      	
      	<li data-toggle="ds-share-icons-more"><a class="ds-more" href="javascript:void(0);">分享到：</a></li>
        <li><a class="ds-weibo" href="javascript:void(0);" data-service="weibo">微博</a></li>
        <li><a class="ds-qzone" href="javascript:void(0);" data-service="qzone">QQ空间</a></li>
        <li><a class="ds-qqt" href="javascript:void(0);" data-service="qqt">腾讯微博</a></li>
        <li><a class="ds-wechat" href="javascript:void(0);" data-service="wechat">微信</a></li>
      	
      </ul>
      <div class="ds-share-icons-more">
      </div>
    </div>
 </div>
<!-- 多说评论框 start -->
	<div class="ds-thread" data-thread-key="<?php echo $model->id; ?>" data-title="<?php echo $model->article_title; ?>" data-url="http://wxrank.com/post/<?php echo $model->id; ?>"></div>
<!-- 多说评论框 end -->
<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
<script type="text/javascript">
var duoshuoQuery = {short_name:"wxrank"};
	(function() {
		var ds = document.createElement('script');
		ds.type = 'text/javascript';ds.async = true;
		ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
		ds.charset = 'UTF-8';
		(document.getElementsByTagName('head')[0] 
		 || document.getElementsByTagName('body')[0]).appendChild(ds);
	})();
	</script>
<!-- 多说公共JS代码 end -->
