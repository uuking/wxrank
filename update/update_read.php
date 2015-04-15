<?php
/**
 * 从公众号表获取文章信息
 */
set_time_limit(0);
for(;;){
	require_once 'conn.php';
	$time = time();
	$sql=mysqli_query($connect,"select * from wx_article_update where `update_status`=0 and `update_next`<=$time limit 1");
	if($re_row = mysqli_fetch_assoc($sql)){

		$canshu = getCanshu($re_row['article_url']);
		$biaoshi=isset($canshu['__biz'])?$canshu['__biz']."==":'';
    	$mid = isset($canshu['mid'])?$canshu['mid']:'';
    	$idx = isset($canshu['idx'])?$canshu['idx']:'';

		if($time - $config['time']>7200 OR !$config['wxkey']){
	    	mysqli_query($connect,"INSERT INTO `wx_errorlog` (`error_content`,`time`) VALUES ('微信key无效',$time);");
	        sleep(30);
	        continue;
    	}

        $ntime = $time+$config['article_update_interval']*3600;
		$wz = get_read($re_row['article_url'],$config['wxkey'],$config['uin'],$biaoshi,$mid,$idx);
		if(!$wz['read']==''){
			mysqli_query($connect,"UPDATE wx_article_update SET `article_reads`='{$wz['read']}',`article_suports`='{$wz['suport']}' where article_id = {$re_row['article_id']}");
		}else{

			mysqli_query($connect,"INSERT INTO `wx_errorlog` (`error_content`,`time`,`from_id`,`error_type`) VALUES ('获取文章ID为{$re_row['article_id']}的阅读数失败',$time,{$re_row['article_id']},2);");
		}
		mysqli_query($connect,"UPDATE `wx_article_update` SET `update_next`='$ntime' WHERE (`article_id`='{$re_row['article_id']}');");
		if($time-$re_row['article_ctime']>86400*$config['days']){
			mysqli_query($connect,"UPDATE `wx_article_update` SET `update_status`=1 WHERE (`article_id`='{$re_row['article_id']}');");
		}

	}else{
		sleep(30);
	}
}
function get_read($url='',$key,$uin,$biz,$mid,$idx){
$wzurl = "http://mp.weixin.qq.com/mp/getappmsgext?__biz={$biz}&mid={$mid}&idx={$idx}&scene=6&ct=".time()."&devicetype=webwx&version=&r=0.4338776197044584&uin={$uin}&key=$key&pass_ticket=U6ie6kCV0n1TP%2FL9lis4teiXmJlpOErTOOQfJDxiKuEyFJcSuc8ER1%2Bw55sMHXOe";

require_once "Snoopy.class.php";
$snoopy = new Snoopy;
$snoopy->agent = "Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16"; //伪装浏览器
$snoopy->fetch($wzurl); //获取所有内容
$content = $snoopy->results; //显示结果
$content_array = json_decode($content,true);

if(isset($content_array['appmsgstat']['read_num'])){
	$wz['read']=(int)$content_array['appmsgstat']['read_num'];
}else{
	$wz['read']='';
}
if(isset($content_array['appmsgstat']['like_num'])){
	$wz['suport'] = (int)$content_array['appmsgstat']['like_num'];
}else{
	$wz['suport']='';
}
return $wz;
}
?>