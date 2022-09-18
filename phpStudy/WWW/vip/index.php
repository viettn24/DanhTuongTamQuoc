<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>3Q Tam Quốc LouLx</title>
<link href="https://cdn.staticfile.org/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.staticfile.org/bootstrap-select/1.13.10/css/bootstrap-select.min.css" rel="stylesheet">
<link href="images/main.css" rel="stylesheet">
<script type="text/javascript" src="https://cdn.staticfile.org/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.staticfile.org/bootbox.js/4.4.0/bootbox.min.js"></script>
<script type="text/javascript" src="https://cdn.staticfile.org/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.staticfile.org/bootstrap-select/1.13.10/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="https://cdn.staticfile.org/bootstrap-select/1.13.10/js/i18n/defaults-zh_CN.js"></script>
</head>
<body>
  <div class="intro" style="margin-top:100px;">
    <div style="color:#F00" class="validator-tips"><b>Danh Tướng Tam Quốc</b></div>
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-8 col-centered">
          <form method="post" id="register-form" autocomplete="off" action="#" class="nice-validator n-default" novalidate>
          	<div class="form-group"></div>
			<div class="form-group">
			<input type="text" class="form-control" id="acc" name="acc" placeholder="Nhập tài khoản trò chơi" autocomplete="off">
			</div>
            <div class="form-group">
              <select id="type" class="form-control" name="type"><option value="0">Chọn chức năng</option><option value="1">Nạp Tiền</option><option value="2">Thẻ</option></select>
            </div>
            <div class="form-group" id='xbao' style="display:none;">
			<select id='bao' class="form-control"><option value="6">Thẻ Tháng</option><option value="30">Thẻ Năm</option></select>
            </div>
            <div class="form-group" id='xnum' style="display:none;">
              <input type="text" class="form-control" onkeyup="value=value.replace(/^(0+)|[^\d]+/g,'')" id="num" name="num" placeholder="Nhập số tiền, nhận x10" autocomplete="off">
            </div>
            <div class="form-center-button">
			  <input class="btn btn-danger" name='reg' id="1" value="Gửi" type="button" onclick= "test(this)">
			</div><br>
            <div id="divMsg" class="validator-tips">LouLx Game</div>
          </form>
        </div>
      </div>
    </div>
  </div>
<script>
$('#type').change(function(){
var gn = $(this).children('option:selected').val();
if(gn == 2 ){
	document.getElementById('xbao').style.display = "";
	document.getElementById('xnum').style.display = "none";
}else if(gn == 1 ){
	document.getElementById('xbao').style.display = "none";
	document.getElementById('xnum').style.display = "";
}else{
	document.getElementById('xbao').style.display = "none";
	document.getElementById('xnum').style.display = "none";
}
});

function api(){
	$.ajaxSetup({contentType: "application/x-www-form-urlencoded; charset=utf-8"});
	$.post("api.php", {
		acc:$("#acc").val(),
		type:$("#type").val(),
		bao:$("#bao").val(),
		num:$("#num").val()
	},function(data){ 
            $('input[name=reg]').attr('id','1');  
            $('input[name=reg]').attr('value','Gửi');
            bootbox.alert({message:data,title:"Gợi ý"});
	});
 }
 
function test(obj){  
    var _status = obj.id;  
    if(_status != '1'){  
         $('input[name=reg]').attr('id','0'); 		 
         $('input[name=reg]').attr('value','Đang gửi...');
		 return false;  
    }else{  
         $('input[name=reg]').attr('id','0');  
         $('input[name=reg]').attr('value','Đang gửi...');
         api();   
    }    
};

document.onkeydown = function(event) {
	var target, code, tag;
	if (!event) {
		event = window.event; //针对ie浏览器
		target = event.srcElement;
		code = event.keyCode;
		if (code == 13) {
			tag = target.tagName;
			if (tag == "TEXTAREA") { return true; }
			else { return false; }
		}
	}else {
		target = event.target; //针对遵循w3c标准的浏览器，如Firefox
		code = event.keyCode;
		if (code == 13) {
			tag = target.tagName;
			if (tag == "INPUT") { return false; }
			else { return true; }
		}
	}
};

</script>
</body>
</html>