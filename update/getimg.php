<?php
class common{
  function getImage($url,$type=0){
    $filename = $this->getFilename();
    if($type){
      $ch=curl_init();
      $timeout=50;
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
      $img=curl_exec($ch);
      curl_close($ch);
    }else{
      ob_start();
      readfile($url);
      $img=ob_get_contents();
      ob_end_clean();
    }
    $fp2=@fopen($filename,'a');
    fwrite($fp2,$img);
    fclose($fp2);
    return $filename;
  }
  function getFilename(){
    $time = time();
    $year = date("Y",$time);
    $month = date("m",$time);
    $day = date("d",$time);
    $rand = $this->getRandChar(2);
    $dir_name = "img/".$year."/".$month."/".$day."/";
    if(!file_exists($dir_name)){
      mkdir($dir_name,0777,true);
    }
    return $dir_name.$rand.$time.".jpg";
  }
  function getRandChar($length){
     $str = '';
     $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
     $max = strlen($strPol)-1;
     for($i=0;$i<$length;$i++){
      $str.=$strPol[rand(0,$max)];
     }
     return $str;
  }
}
?>