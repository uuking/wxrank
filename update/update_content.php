<?php
set_time_limit(0);
require_once 'conn.php';
for(;;){
	$time = time();
	$sql=mysqli_query($connect,"SELECT `id`, `article_url`, `article_headimg` FROM `wx_article` as a LEFT JOIN `wx_article_update` AS au ON a.`id` = au.`article_id` WHERE `article_content`='0' ORDER BY a.`article_ctime` DESC LIMIT 1;");
	if($re_row = mysqli_fetch_array($sql)){
		$content = get_content($re_row['article_url'],$re_row['article_headimg']);
		if(isset($content['turl'])&&isset($content['content'])){
			mysqli_query($connect,"UPDATE wx_article SET `article_headimg`='{$content['turl']}',`article_content`='{$content['content']}' where id = {$re_row['id']}");
		}else{
			mysqli_query($connect,"delete from wx_article where id = {$re_row['id']}");
			mysqli_query($connect,"delete from wx_article_update where article_id = {$re_row['id']}");
		}
	sleep(1);
	}else{
		sleep(1);
		continue;
	}
}

function get_content($url,$touurl){
	$imgurl = '';
	require_once "Snoopy.class.php";
	$snoopy = new Snoopy;
	$snoopy->agent = "Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16"; //伪装浏览器
	$snoopy->fetch($url); //获取所有内容
	$content = $snoopy->results; //显示结果
	$start = strpos($content,"<div class=\"rich_media_content\"");
	$end = strpos($content,"<script type=\"text/javascript\">",$start+200);
	if($start & $end){
		$block = substr($content,$start,$end-$start);
		preg_match_all('/http:\/\/mmbiz.qpic.cn([^<]*)\"/si',$block,$data);
		if(!$data){preg_match_all('/http:\/\/mmsns.qpic.cn([^<]*)\"/si',$block,$data);}
		foreach ($data[0] as $key => $value) {
			$end_pos = stripos($value,"\"");
			$imgurl[] = substr($value, 0,$end_pos);
		}
		if($imgurl){
			foreach ($imgurl as $key => $value) {
				$filename = getFilename();
				$new_imgurl = getImage($value,$filename);
				$block = str_replace($value,$new_imgurl,$block);
			}
		}
		$block=str_replace("data-src","src",$block);
		$tname = getFilename();
		$turl = getImage($touurl,$tname);
		$contents['content']=addslashes($block);
		$contents['turl']=$turl;
		return $contents;
	}else{
		return '';
	}
	
}
function getImage($url,$filename=''){
	$ch=curl_init();
	$timeout=5;
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
	$img=curl_exec($ch);
	curl_close($ch);
	$fp2=@fopen($filename,'a');
	fwrite($fp2,$img);
	fclose($fp2);
	return $filename;
}
function getRandChar($length){
   $str = '';
   $strPol = "abcdefg";
   $max = strlen($strPol)-1;
   for($i=0;$i<$length;$i++){
    $str.=$strPol[rand(0,$max)];
   }
   return $str;
}
function getFilename(){
	$time = time();
	$year = date("Y",$time);
	$month = date("m",$time);
	$day = date("d",$time);
	$rand = getRandChar(2);
	$dir_name = "../media/image/web/".$year."/".$month."/".$day."/".$rand."/";
	if(!file_exists($dir_name)){
		mkdir($dir_name,0777,true);
	}
	return $dir_name.$rand.$time.".jpg";
}
?>