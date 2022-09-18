<?php
error_reporting(0);
$usr = $_POST['usr'];
$cdk = $_POST['cdk'];
$usr = str_replace(array(' ','%'),'',$usr);
$cdk = str_replace(array(' ','%'),'',$cdk);
$cdk =='' && (die('Vui lòng nhập CDKEY'));
$usr =='' && (die('Vui lòng nhập số tài khoản'));
$mysql = mysqli_connect('127.0.0.1','root','123456','sango_local',3306) or die("Lỗi kết nối cơ sở dữ liệu");
$mysql->query('set names utf8');
$xx = mysqli_fetch_assoc($mysql->query("SELECT id,vip FROM login_account WHERE uname = '$usr' limit 1"));
$xx['id'] == '' && (die('Không có tài khoản như vậy'));
$xx['vip'] == 1 && (die('Tài khoản này đã được ủy quyền, không cần ủy quyền lại'));
$uid = $xx['id'];
$xxx = mysqli_fetch_assoc($mysql->query("SELECT * FROM user.cdk WHERE cdk = '$cdk' limit 1"));
$xxx['id'] == '' && (die('Không có thẻ ủy quyền như vậy'));
$xxx['status'] != 0 && (die('Thẻ ủy quyền này đã được sử dụng'));
if($mysql->query("UPDATE user.cdk SET status = 1 , uid = '$uid' WHERE cdk = '$cdk';")){
    $mysql->query("UPDATE login_account SET vip = 1 WHERE id = '$uid';");
    die('Ủy quyền tài khoản thành công');
}else{
	die('Cấp quyền không thành công. Vui lòng liên hệ với quản trị viên');
}
?>