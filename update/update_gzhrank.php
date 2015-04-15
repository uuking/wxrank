<?php
/**
 * 生成排行信息
 */
set_time_limit(0);
require_once 'conn.php';
$time = time();
$i=0;
$ptime=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
$ntime = $ptime + 86400;
$stime = strtotime(date("Ymd",strtotime('-6 day',$ptime)));
$type_sql = mysqli_query($connect,"select * from `wx_term` where term_parent=0;");
while($type_row = mysqli_fetch_array($type_sql)){
	$type[$i]['child_id']='';

	$type[$i]['id']=$type_row['id'];
	$type[$i]['term_name']=$type_row['term_name'];

	$type_sql2 = mysqli_query($connect,"select * from `wx_term` where term_parent={$type_row['id']};");
		while($type_row2 = mysqli_fetch_array($type_sql2)){
			$type[$i]['child_id']=$type_row2['id'].','.$type[$i]['child_id'];

	}
	$type[$i]['child_id']=substr_replace($type[$i]['child_id'],'',-1,1);

	$i++;
}

foreach ($type as $k => $v) {

	$maxsql = mysqli_query($connect,"select MAX(article_reads) as `maxreads`,MAX(article_suports) as `maxwzsuports` from `wx_article_update` where `article_ctime`>$ptime and `article_ctime`<$ntime and `article_uid` in (select `id` from `wx_gzhinfo` where `gzh_tid` in ({$v['child_id']})) ORDER BY `article_ctime` DESC LIMIT 100;");
	$maxread = mysqli_fetch_assoc($maxsql);
	$wz = mysqli_query($connect,"select c.`article_reads`,c.`article_suports`,c.`article_ctime`,c.article_id,c.article_uid from wx_article_update AS c  where `article_uid` in (select `id` from `wx_gzhinfo` where `gzh_tid` in ({$v['child_id']})) and c.article_ctime>$ptime and c.article_ctime<$ntime;");

	while($wz_row = mysqli_fetch_assoc($wz)){
		$pinsql = mysqli_query($connect,"select count(*) from wx_article_update where article_uid ={$wz_row['article_uid']} and article_ctime>$stime and article_ctime<$ntime group by from_unixtime(article_ctime,'%Y-%m-%d');");
		$pinci = mysqli_num_rows($pinsql);
		$totals = round($config['read_weight']*($wz_row['article_reads']/$maxread['maxreads'])*100+$config['suport_weight']*($wz_row['article_suports']/$maxread['maxwzsuports'])*100+$config['pinci_weight']*($pinci/7)*100);
		mysqli_query($connect,"UPDATE `wx_article_update` SET `pinci`='$pinci',`article_totals`='$totals' WHERE (`article_id`='{$wz_row['article_id']}');");
	}
}


foreach ($type as $k => $v) {

	$max_avg_read_sql = mysqli_query($connect,"select ROUND(avg(c.article_reads),0) as max_avg_r from wx_article_update AS c where `article_ctime`>$ptime and `article_ctime`<$ntime and `article_uid` in (select `id` from `wx_gzhinfo` where `gzh_tid` in ({$v['child_id']})) group by c.article_uid  order by max_avg_r desc limit 1;");
	$max_avg_read = mysqli_fetch_assoc($max_avg_read_sql);

	$max_avg_suports_sql = mysqli_query($connect,"select ROUND(avg(c.article_suports),0) as max_avg_s from wx_article_update AS c where `article_ctime`>$ptime and `article_ctime`<$ntime and `article_uid` in (select `id` from `wx_gzhinfo` where `gzh_tid` in ({$v['child_id']})) group by c.article_uid order by max_avg_s desc limit 1;");
	$max_avg_suports = mysqli_fetch_assoc($max_avg_suports_sql);

	$max_article_sql = mysqli_query($connect,"select count(c.article_id) as max_a from wx_article_update AS c where `article_ctime`>$ptime and `article_ctime`<$ntime and `article_uid` in (select `id` from `wx_gzhinfo` where `gzh_tid` in ({$v['child_id']})) group by c.article_uid order by max_a desc limit 1;");
	$max_article = mysqli_fetch_assoc($max_article_sql);

	$query = mysqli_query($connect,"select c.`article_id`,c.article_uid,sum(c.`article_reads`) as sum_r,sum(c.`article_suports`) as sum_s,count(c.article_id) as sum_a,ROUND(avg(c.article_reads),0) as avg_r,ROUND(avg(c.article_suports),0) as avg_s,ROUND(((avg(c.article_reads)/{$max_avg_read['max_avg_r']}*{$config['read_weight']}+avg(c.article_suports)/{$max_avg_suports['max_avg_s']}*{$config['suport_weight']}+count(c.article_id)/{$max_article['max_a']}*{$config['pinci_weight']})*100),0) as totals,c.article_ctime from wx_article_update AS c  where `article_ctime`>$ptime and `article_ctime`<$ntime and `article_uid` in (select `id` from `wx_gzhinfo` where `gzh_tid` in ({$v['child_id']})) group by c.article_uid order by totals desc, sum_r desc,sum_s desc;");
	
	$i=1;
	while($row=mysqli_fetch_array($query)){
		$countsql = mysqli_query($connect,"select count(*) as count_topnew from wx_article where article_uid ={$row['article_uid']} and article_ctime>=$ptime and article_ctime<$ntime and article_place=1;");
		$countreadsql = mysqli_query($connect,"select count(*) as count_topread from wx_article_update where article_uid ={$row['article_uid']} and article_ctime>=$ptime and article_ctime<$ntime and article_reads>=100000;");
		$count_topnew = mysqli_fetch_assoc($countsql);
		$count_topread = mysqli_fetch_assoc($countreadsql);

		mysqli_query($connect,"INSERT INTO `wx_gzh_rank` (`gzh_id`, `count_read`, `count_suport`, `count_article`, `totals`, `rank_time`, `rank_num`,`count_topnew`,`count_topread`) VALUES ({$row['article_uid']}, {$row['sum_r']}, {$row['sum_s']}, {$row['sum_a']}, {$row['totals']}, {$ptime}, {$i}, {$count_topnew['count_topnew']},{$count_topread['count_topread']});");
		die;
		$i++;
	}
}