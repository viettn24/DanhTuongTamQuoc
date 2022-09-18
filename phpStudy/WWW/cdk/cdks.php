<?php
error_reporting(0);
$sqm = $_POST['sqm'];
$num = $_POST['num'];
include "config.php";
$zame = 'PAY_';
$sqm != $d_gmrz && (die("<script>alert('Mã ủy quyền sai');window.history.back(-1); </script>")); 
$num > 100 && (die("<script>alert('Có thể tạo tối đa 100 vật phẩm');window.history.back(-1); </script>")); 
$num == '' && ($num = 1);
$mysql = mysqli_connect($PZ['DB_HOST'],$PZ['DB_USER'],$PZ['DB_PWD'],$PZ['DB_NAME'],$PZ['DB_PORT']) or die("<script>alert('Kết nối cơ sở dữ liệu không thành công');window.history.back(-1); </script>");
for($i=1;$i<=$num;$i++){
	$cdk = cdkey('iguozicc');
	$txt .= $cdk."\n";
	if(!$mysql->query("INSERT INTO cdk (cdk) VALUES ('$cdk');")){die("<script>alert('Tạo không thành công, vui lòng kiểm tra xem kết nối cơ sở dữ liệu có bình thường không');window.history.back(-1); </script>");}
}
$ts = time().'.txt';
Header ( "Content-type: application/octet-stream" );
Header ( "Accept-Ranges: bytes" );
Header ( "Content-Disposition: attachment; filename=".$zame.$ts);
die($txt);

function cdkey($namespace = null) {  
    static $guid = '';  
    $uid = uniqid ( "", true );  
    $data = $namespace;  
    $data .= $_SERVER ['REQUEST_TIME']; 
    $data .= $_SERVER ['HTTP_USER_AGENT'];
    $data .= $_SERVER ['SERVER_ADDR'];
    $data .= $_SERVER ['SERVER_PORT'];
    $data .= $_SERVER ['REMOTE_ADDR'];
    $data .= $_SERVER ['REMOTE_PORT'];
    $hash = strtoupper (substr(md5($uid.$data), 8, 16));
    $guid = substr ( $hash, 0, 4 ) . '-' . substr ( $hash, 4, 4 ) . '-' . substr ( $hash, 8, 4 ) . '-' . substr ( $hash, 12, 4 );  
    return $guid;  
} 
?>