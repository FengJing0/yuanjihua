<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
require('init.php');
//注册
$input = file_get_contents("php://input");

$input = json_decode($input);

function getUUID($name){
    $mt = microtime(true);
    $rn = mt_rand(1,1000000);
    return strtoupper(md5($name.$mt.$rn));
}


$mobile = $input->{'mobile'};
$pwd = $input->{'pwd'};
$sms_code = $input->{'sms_code'};
$nick_name =  '默认';
$avatar =  '179783529A347BEFB6665FCD26762E39.jpg';
$sex =  1;
$token = getUUID($mobile);
$select = mysqli_query($conn,"SELECT user_id FROM t_user WHERE mobile=$mobile");
$row = mysqli_fetch_assoc($select);
$res = [];
if($row == null){
    $sql = "INSERT INTO t_user VALUES (null,'$mobile','$pwd','$nick_name','$avatar',$sex,'$token')";
    $result = mysqli_query($conn,$sql);
    $id = mysqli_query($conn,"SELECT user_id FROM t_user WHERE token=$token");
    if ($result===true) {
        $res['status'] = 1;
        $res['info'] = '注册成功';
        $res['data']['id'] = $id;
        $res['data']['user_id'] = 'user'.$id;
        $res['data']['mobile'] = $mobile;
        $res['data']['nick_name'] = $nick_name;
        $res['data']['avatar'] = $avatar;
        $res['data']['sex'] = $sex;
        $res['data']['token'] = $token;
    }else{
        $res['status'] = 0;
        $res['info'] = '注册失败';
        $res['data'] = '';
    }
}else{
    $res['status'] = 0;
    $res['info'] = '用户名已注册';
    $res['data'] = '';
}

echo json_encode($res);
