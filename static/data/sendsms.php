<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
//发送验证码
$input = file_get_contents("php://input");

$input = json_decode($input);
$mobile = $input->{'mobile'};

//echo $input;

//$input = $input->mobile;
//echo $input;
$sms = '';
for($i=0; $i<6; $i++){
  $num = mt_rand(0,9);
  settype($num,'string');
  $sms .= $num;
}


$res = [];
if($mobile === ''){
    $res['status'] = 0;
    $res['mobile'] = $mobile;
    $res['info'] = '请输入手机号';
    $res['data']['code'] = '';
}else{
    $res['status'] = 1;
    $res['mobile'] = $mobile;
    $res['info'] = '发送成功';
    $res['data']['code'] = $sms;
}



echo json_encode($res);
