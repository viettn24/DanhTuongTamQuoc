<?php 
header("Content-type: text/html; charset=utf8");
error_reporting(0);
ini_set("memory_limit","256M");
set_time_limit(0);
$txt1='1.json'; 
$logdir='data';
print_r("<pre>");
foreach (json_decode(file_get_contents($txt1),true) as $key => $value ){ 
		//print_r($key);
		$filename=$key.".json";
		$fp=fopen($logdir.'/'.$filename , 'w');
		fwrite($fp,json_encode($value,JSON_UNESCAPED_UNICODE));
		fclose($fp);
}

