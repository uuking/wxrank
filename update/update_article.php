<?php
/**
 * 从公众号表获取文章信息
 */
set_time_limit(0);
require_once 'conn.php';
for(;;){
    /**
     * [get_config 获取配置参数]
     * @return [type] [配置数组]
     */
    $config_sql = mysqli_query($connect,"select * from wx_config;");
    while ($config_row = mysqli_fetch_assoc($config_sql)) {
        $config[$config_row['config_name']] = $config_row['config_value'];
    }

    $time = time();
    $sql = mysqli_query($connect,"SELECT * FROM `wx_gzh_update` WHERE `status`>0 AND `next_time`<=$time LIMIT 1;");
    if($row = mysqli_fetch_assoc($sql)){

        $last_sql = mysqli_query($connect,"SELECT * FROM `wx_article_update` WHERE `article_uid`='{$row['gzh_id']}' order by `article_ctime` DESC, `article_id` ASC LIMIT 1;");
        if($last_row = mysqli_fetch_assoc($last_sql)){
            $last_wzurl = $last_row['article_url'];
        }else{
            $last_wzurl = '';
        }
        $ntime = $time+$config['gzh_update_interval']*3600;
        $nntime = $time + 18000;
        if(!$row['biaoshi']){
            mysqli_query($connect,"UPDATE `wx_gzh_update` SET `next_time`='$nntime',`error_num`=error_num+1 WHERE `gzh_id`='{$row['gzh_id']}';");
            mysqli_query($connect,"INSERT INTO `wx_errorlog` (`error_content`,`time`,`from_id`,error_type) VALUES ('ID为{$row['gzh_id']}的公众号biz不存在',$time,{$row['gzh_id']},1);");
            continue;
        }elseif($time - $config['time']>7200 OR !$config['wxkey']){
            mysqli_query($connect,"INSERT INTO `wx_errorlog` (`error_content`,`time`) VALUES ('微信key无效',$time);");
            sleep(60);
            continue;
        }elseif($articles = list_article($row['biaoshi'],$config['wxkey'],$config['uin'])){

            foreach ($articles as $k => $v) {

                if($last_wzurl!=$v['content_url']){

                    mysqli_query($connect,"INSERT INTO `wx_article` (`article_uid`, `article_title`, `article_content`, `article_headimg`, `article_description`, `article_ctime`, `article_status`, `article_place`) VALUES ({$row['gzh_id']}, '{$v['title']}', '0', '{$v['cover']}', '{$v['digest']}', '{$v['datetime']}', 0, 1);");

                    $last_inert_sql = mysqli_query($connect,"select last_insert_id() as last_insert_id;");
                    $last_inert_id = mysqli_fetch_assoc($last_inert_sql);

                    mysqli_query($connect,"INSERT INTO `wx_article_update` (`article_id`, `article_uid`,`article_url`, `article_reads`, `article_suports`, `update_start`, `update_next`, `pinci`, `article_totals`, `article_ctime`) VALUES ({$last_inert_id['last_insert_id']}, {$row['gzh_id']}, '{$v['content_url']}', 0, 0, $time, $time, 0, 0, '{$v['datetime']}');");
                }else{
                    break;
                }
                if(isset($v['multi'])){
                    foreach ($v['multi'] as $ik => $iv) {

                        mysqli_query($connect,"INSERT INTO `wx_article` (`article_uid`, `article_title`, `article_content`, `article_headimg`, `article_description`, `article_ctime`, `article_status`, `article_place`) VALUES ({$row['gzh_id']}, '{$iv['title']}', '0', '{$iv['cover']}', '{$iv['digest']}', '{$iv['datetime']}', 0, $ik+2);");

                        $last_inert_sql = mysqli_query($connect,"select last_insert_id() as last_insert_id;");
                        $last_inert_id = mysqli_fetch_assoc($last_inert_sql);

                        mysqli_query($connect,"INSERT INTO `wx_article_update` (`article_id`, `article_uid`, `article_url`, `article_reads`, `article_suports`, `update_start`, `update_next`, `pinci`, `article_totals`, `article_ctime`) VALUES ({$last_inert_id['last_insert_id']}, {$row['gzh_id']}, '{$iv['content_url']}', 0, 0, $time, $time, 0, 0, '{$iv['datetime']}');");

                    }
                }
            }
            mysqli_query($connect,"UPDATE `wx_gzh_update` SET `next_time`='$ntime' WHERE `gzh_id`='{$row['gzh_id']}';");
        }else{
            mysqli_query($connect,"UPDATE `wx_gzh_update` SET `next_time`='$nntime', `error_num`=error_num+1 WHERE `gzh_id`='{$row['gzh_id']}';");
            mysqli_query($connect,"INSERT INTO `wx_errorlog` (`error_content`,`time`,`from_id`.`error_type`) VALUES ('ID为{$row['gzh_id']}的公众号获取文章失败',$time,{$row['gzh_id']},1);");
        }
        sleep(10);
    }else{
        sleep(30);
    }
}
function list_article($biaoshi,$key,$uin){
    $time = time();
    $articles = '';
    $test = '';
    $snoopy = new Snoopy;
    $url = "http://mp.weixin.qq.com/mp/getmasssendmsg?__biz={$biaoshi}&uin={$uin}&key={$key}&f=json&count=5&uin={$uin}&key={$key}&pass_ticket=5Yg%2FTg9aZDWjQW%2BfDLq2%2B4%2FLxXvSRmcI6YZ%2B5U2H9e%2Bhhug4AnL%2BXysWuwsrDPLq";
    $snoopy->fetch($url);
    $content_json = $snoopy->results;
    $content = json_decode($content_json);
    if(isset($content->general_msg_list)){

        $obj = json_decode($content->general_msg_list);
        foreach ($obj->list as $k => $v) {
            if(!isset($v->app_msg_ext_info->content_url)){continue;}
            $content_url = htmlspecialchars_decode($v->app_msg_ext_info->content_url);
            $articles[$k]['content_url'] = $content_url;
            $articles[$k]['title']=$v->app_msg_ext_info->title;
            $articles[$k]['digest']=$v->app_msg_ext_info->digest;
            $articles[$k]['cover']=$v->app_msg_ext_info->cover;
            $articles[$k]['datetime']=$v->comm_msg_info->datetime;
            if($v->app_msg_ext_info->multi_app_msg_item_list){
                foreach ($v->app_msg_ext_info->multi_app_msg_item_list as $ik => $iv) {
                    $multi_content_url = htmlspecialchars_decode($iv->content_url);
                    $articles[$k]['multi'][$ik]['content_url'] = $multi_content_url;
                    $articles[$k]['multi'][$ik]['datetime']=$v->comm_msg_info->datetime;
                    $articles[$k]['multi'][$ik]['title']=$iv->title;
                    $articles[$k]['multi'][$ik]['digest']=$iv->digest;
                    $articles[$k]['multi'][$ik]['cover']=$iv->cover;
                }
            }
        }
        return $articles;
    }else{
        return false;
    }
}
?>