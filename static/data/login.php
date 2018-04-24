<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
require('init.php');
//登录
$input = file_get_contents("php://input");

$input = json_decode($input);
$mobile = $input->{'mobile'};
$pwd = $input->{'pwd'};

$sql1 = "SELECT * FROM t_user WHERE mobile='$mobile'";

$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);


$res = [];
if($row1 != null){
    $sql2 = "SELECT * FROM t_user WHERE mobile='$mobile' AND pwd='$pwd'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
    if($row2 != null){
        $res['status'] = 1;
        $res['info'] = '登录成功';
        $res['data'] = $row2;
    }else{
        $res['status'] = 0;
        $res['info'] = '密码错误';
        $res['data'] = '';
    }
}else{
    $res['status'] = 0;
    $res['info'] = '该用户没有注册';
    $res['data'] = '';
}

echo json_encode($res);