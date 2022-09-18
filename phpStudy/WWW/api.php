<?php 
header("Content-type: text/html; charset=utf8");
error_reporting(0);
date_default_timezone_set("PRC");
$conn = @mysql_connect("127.0.0.1","root","123456") or die ("接口异常,请联系管理员！");
@mysql_select_db("sango_local",$conn) or die ("接口异常,请联系管理员！");
mysql_query("set names UTF8"); 
$user=$_GET['user'];
$pass=$_GET['pass'];
$signweb3=$_GET['signweb3'];
if(empty($user)){
	echo '请输入用户名！';
	exit;
}
if(empty($user)){
	echo '请输入密码！';
	exit;
}
$sql="select * from login_account where uname='".$user."'";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);	
if($row['Id']){
	if($row['signweb3'] != $signweb3){
		echo $row['signweb3'];
		exit;		
	}
	echo 1;
	exit;
}else{
	$sql="insert into login_account (uname,pwd,signweb3) values ('".$user."','".md5($pass)."','".$signweb3."')";
	$res=mysql_query($sql);	
	if($res){
		echo 1;
		exit;
	}else{
		echo '用户名注册失败！';
		exit;		
	}
}
?>

