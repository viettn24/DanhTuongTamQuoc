<?php
error_reporting(0);
$acc = $_POST['acc'];
$bao = $_POST['bao'];
$num = $_POST['num'];
$type = $_POST['type'];
$num == '' && ($num = '1');
$num > 10000000 && ($num = '10000000');
$acc == "" && (die('Tài khoản không được để trống'));
$mysql = mysqli_connect("127.0.0.1","root","123456","sango_local",3306) or die("Lỗi kết nối cơ sở dữ liệu");
$xx = mysqli_fetch_assoc($mysql->query("SELECT id,vip FROM login_account WHERE uname = '$acc' limit 1"));
$xx['id'] == "" && (die('Không có tài khoản như vậy'));
$xx['vip'] != 1 && (die('Không được phép'));
$uid = $xx['id'];
$oid = createOrderNo();
$url = "http://127.0.0.1:8081/chongchong_pay";
if($type==1){
	$ext = '1_2';
}elseif($type==2){
	$bao == "" && (die('Vui lòng chọn một sản phẩm'));
	if($bao==6){
		$ext = '1_0';
		$num = '6';
	}elseif($bao==30){
		$ext = '1_1';
		$num = '30';
	}
	
}else{
	die('Vui lòng chọn chức năng');
}
$sig = md5("ext={$ext}money={$num}orderId={$oid}userId={$uid}9c9e83fe236bdb3f0d4ba57014173efa");
$data = "orderId={$oid}&userId={$uid}&money={$num}&ext={$ext}&sign={$sig}";
$ret = postData($url, $data);
print_r("Nạp tiền thành công");


function postData($url, $data)  {  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, 'Content-Type: application/x-www-form-urlencoded');
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}


function createOrderNo(){
    $date = date('Ymd');
    return $date.substr(implode(NULL, array_map('ord', str_split(substr(uniqid(),
            7, 13), 1))), 0, 8);
}
?>