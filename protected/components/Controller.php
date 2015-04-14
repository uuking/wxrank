<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public $_setting = array();

	/**
	 * 简化获取变量操作
	 * @var $_config
	 * @var $_request
	 */
	
	protected	$_yii = '';
	protected  	$_request = '';	
	protected  	$_theme = '';
	protected  	$_baseUrl = '';
	protected  	$_basePath = ''; //应用程序目录
	protected  	$_webRoot = '';  //网站根目录
	protected  	$_extPath = '';  //网站扩展目录
	protected  	$_widgetPath = ''; //widget目录
	protected  	$_fonts = '';    //字体目录	
	public     	$_static_public = ''; //公共资源目录	
	public 		$_data = '';
	protected  	$_adminGroupID = 10; //系统管理员用户组ID
	public  	$_type_ids = array(); //内容模型id	
	public  	$_content_models = array(); //内容模型对象
	protected  	$_cmsVersion = 'yiifcms1.4.1';
	protected  	$_cmsRelease = '20141222';

	public function init ()
	{						
		$this->_yii = Yii::app();
		$this->_request = Yii::app()->request;				
		$this->_baseUrl = Yii::app()->baseUrl;
		$this->_basePath = Yii::app()->basePath;		
		$this->_webRoot = WWWPATH;
		$this->_extPath = $this->_webRoot.'/protected/extensions';
		$this->_widgetPath = $this->_webRoot.'/protected/widget';
		$this->_fonts = $this->_webRoot.'/public';
		$this->_data = $this->_webRoot.'/protected/data/';		
		$this->_static_public = $this->_baseUrl.'/public';

		//后台全局设置
		$settings = Config::model()->findAll();
		foreach ($settings as $key => $row) {
			$this->_setting[$row['config_name']] = $row['config_value'];
		}
	}

	/**
	 * 页面提示信息
	 * @param string $action
	 * @param string $content
	 * @param string $redirect
	 * @param number $timeout
	 * @param string $stop
	 */
	public function message( $action = 'success', $content = '', $redirect = 'javascript:history.back(-1);', $timeout = 4 , $stop=false) {
	
		switch ( $action ) {
			case 'success':
				$titler = '操作完成';
				$class = 'message_success';
				$images = 'message_success.png';
				break;
			case 'error':
				$titler = '操作未完成';
				$class = 'message_error';
				$images = 'message_error.png';
				break;
			case 'errorBack':
				$titler = '操作未完成';
				$class = 'message_error';
				$images = 'message_error.png';
				break;
			case 'redirect':
				header( "Location:$redirect" );
				break;
			case 'script':
				if ( empty( $redirect ) ) {
					exit( '<script type="text/javascript">alert("' . $content . '");window.history.back(-1)</script>' );
				} else {
					exit( '<script type="text/javascript">alert("' . $content . '");window.location=" ' . $redirect . '   "</script>' );
				}
				break;
		}
	
		// 信息头部
		$header = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>操作提示    -  '.$this->_setting["seo_title"].'</title>
<style type="text/css">
body{font:12px/1.7 "\5b8b\4f53",Tahoma;}
html,body,div,p,a,h3{margin:0;padding:0;}
.tips_wrap{ background:#F7FBFE;border:1px solid #DEEDF6;width:780px;padding:50px;margin:50px auto 0;}
.tips_inner{zoom:1;}
.tips_inner:after{visibility:hidden;display:block;font-size:0;content:" ";clear:both;height:0;}
.tips_inner .tips_img{width:80px;float:left;}
.tips_info{float:left;line-height:35px;width:650px}
.tips_info h3{font-weight:bold;color:#1A90C1;font-size:16px;}
.tips_info p{font-size:14px;color:#999;}
.tips_info p.message_error{font-weight:bold;color:#F00;font-size:16px; line-height:22px}
.tips_info p.message_success{font-weight:bold;color:#1a90c1;font-size:16px; line-height:22px}
.tips_info p.return{font-size:12px}
.tips_info .time{color:#f00; font-size:14px; font-weight:bold}
.tips_info p a{color:#1A90C1;text-decoration:none;}
</style>
</head>
	
<body>';
		// 信息底部
		$footer = '</body></html>';	    
		$body = '<script type="text/javascript">
        function delayURL(url) {
        var delay = document.getElementById("time").innerHTML;
        //alert(delay);
        if(delay > 0){
	        delay--;
	        document.getElementById("time").innerHTML = delay;
			setTimeout("delayURL(\'" + url + "\')", 1000);
	    } else {	
	    	window.location.href = url;
	    }
    
    }
    </script><div class="tips_wrap">
    <div class="tips_inner">
        <div class="tips_img">
            <img src="' . $this->_static_public.'/images/' . $images . '"/>
        </div>
        <div class="tips_info">
	
            <p class="' . $class . '">' . $content . '</p>
            <p class="return">系统自动跳转在  <span class="time" id="time">' . $timeout . ' </span>  秒后，如果不想等待，<a href="' . $redirect . '">点击这里跳转</a></p>
        </div>
    </div>
</div><script type="text/javascript">
    delayURL("' . $redirect . '");
    </script>';
		
	    $body2 = '<div class="tips_wrap">
    <div class="tips_inner">
        <div class="tips_img">
            <img src="' . $this->_static_public.'/images/' . $images . '"/>
        </div>
        <div class="tips_info">
	
            <p class="' . $class . '">' . $content . '</p>    
            		<p class="return"><a href="' . $redirect . '">点击这里返回</a></p>        
        </div>
    </div>
</div>';
	    if(!$stop){
			exit( $header . $body . $footer );
	    }else{
	    	exit( $header . $body2 . $footer );
	    }
	}
}