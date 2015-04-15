<?php
/**
 * 从新媒体排行网站获取公众号信息
 */
require_once 'conn.php';

$snoopy = new Snoopy;
$time = time();
$goup = array('资讯'=>array(30=>'时事',37=>'财富',49=>'生活',31=>'科技',56=>'创业',32=>'汽车',16=>'楼市',56=>'职场',63=>'教育',63=>'学术',34=>'政务',34=>'企业'),'生活'=>array(63=>'文化',50=>'健康',15=>'时尚',45=>'美食',49=>'乐活',46=>'旅行',22=>'幽默',57=>'情感',11=>'体娱',11=>'美体',41=>'珍奢',26=>'百科'));

foreach ($goup as $a => $b) {
	foreach ($goup[$a] as $c => $d) {
		$formvars["rank_name_group"] = $a;
		$formvars["rank_name"] = $d;
		$formvars["start"] = "2015-03-23";
		$formvars["end"] = "2015-03-29";
		$action = "http://www.newrank.cn/xdnphb/list/week/rank";//表单提交地址   
		$snoopy->submit($action,$formvars);//$formvars为提交的数组   
		$gzhlist_json = $snoopy->results; //获取表单提交后的 返回的结果   
		$gzhlist_arr = json_decode($gzhlist_json,true);
		foreach ($gzhlist_arr['value'] as $key => $value) {
			$formvars['account']=$value['account'];
			$action = "http://www.newrank.cn/xdnphb/data/getByAccount";
			$snoopy->submit($action,$formvars);
			$gzhinfo_json = $snoopy->results;
			$gzhinfo_arr = json_decode($gzhinfo_json,true);
			$gzhinfo_arr = $gzhinfo_arr['value']['user'];

			if(empty($gzhinfo_arr['index_url'])) $gzhinfo_arr['index_url']='';
			$gzh_openid_arr = explode('openid=', $gzhinfo_arr['index_url']);
			if(isset($gzh_openid_arr[1])) $gzh_openid = $gzh_openid_arr[1]; else $gzh_openid='';
			if(empty($gzhinfo_arr['head_image_url'])) $gzhinfo_arr['head_image_url']='';
			if(empty($gzhinfo_arr['code_image_url'])) $gzhinfo_arr['code_image_url']='';
			if(empty($gzhinfo_arr['description'])) $gzhinfo_arr['description']='';
			if(empty($gzhinfo_arr['certified_text'])) $gzhinfo_arr['certified_text']='';


			mysqli_query($connect,"INSERT INTO `wx_gzhinfo` (`gzh_tid`, `gzh_name`, `gzh_number`, `gzh_headimg`, `gzh_codeimg`, `gzh_creatid`, `gzh_ctime`, `gzh_openid`, `gzh_order`, `ghz_descript`, `gzh_certified_text`) VALUES ($c, '{$gzhinfo_arr['name']}', '{$gzhinfo_arr['account']}', '{$gzhinfo_arr['head_image_url']}', '{$gzhinfo_arr['code_image_url']}', 1, $time, '$gzh_openid', 0,'{$gzhinfo_arr['description']}','{$gzhinfo_arr['certified_text']}');");
			$last_inert_id = mysqli_insert_id($connect);
			
			mysqli_query($connect,"INSERT INTO `wx_gzh_update` (`gzh_id`, `biaoshi`, `next_time`, `error_num`, `status`, `start_time`) VALUES ($last_inert_id, '{$gzhinfo_arr['biz_info']}', $time, 0, 1,$time);");
		}
	}
}
?>