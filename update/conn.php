<?php

	header("Content-Type:text/html;charset=utf-8");//设置全局编码
	require_once 'Snoopy.class.php';
	$connect = mysqli_connect("localhost", "root", "root") or die("链接数据库失败！");
	mysqli_select_db($connect,"wxrank" ) or die("选择数据库失败");
	mysqli_query($connect,"SET NAMES 'utf8'");
	
	/**
	 * [get_config 获取配置参数]
	 * @return [type] [配置数组]
	 */
	$config_sql = mysqli_query($connect,"select * from wx_config;");
	while ($config_row = mysqli_fetch_assoc($config_sql)) {
		$config[$config_row['config_name']] = $config_row['config_value'];
	}
	
	/**
	 * [p 打印函数]
	 * @param  [type] $arr [数组]
	 * @return [type]      [数组]
	 */
	function p($arr){
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
	}

	/**
	 * [unhtml 字符串转义]
	 * @param  [type] $arr [数组]
	 * @return [type]      [数组]
	 */
	function unhtml($arr){
		foreach ($arr as $key => $value) {
			$arr[$key]=trim(addslashes($value));
		}
		return $arr;
	}
	/**
	 * [getCanshu 获取url参数]
	 * @param  [type] $url [url地址]
	 * @return [type]      [返回参数数组]
	 */
	function getCanshu($url){
		$arr = parse_url($url);
	    $queryParts = explode('&', $arr['query']);
	    $params = array();
	    foreach ($queryParts as $param){
	        $item = explode('=', $param);
	        $params[$item[0]] = $item[1];
	    }
	    return $params;
	}
?>