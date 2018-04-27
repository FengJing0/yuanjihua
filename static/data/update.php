<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
require('init.php');
//更新个人信息
$input = file_get_contents("php://input");

$input = json_decode($input);
$sex = $input->{'sex'};
$nick_name = $input->{'nick_name'};
$token = $input->{'token'};
$res = [];
if($sex == null || $nick_name == null || $token == null){
    $res['status'] = 0;
    $res['info'] = '更新失败';
    $res['data'] = '';
    exit(json_encode($res));
}

$sql1 = "UPDATE t_user SET nick_name='$nick_name' WHERE token='$token'";
$result1 = mysqli_query($conn, $sql1);
$size1 = mysqli_affected_rows($conn);
$sql2 = "UPDATE t_user SET sex=$sex WHERE token='$token'";
$result2 = mysqli_query($conn, $sql2);
$size2 = mysqli_affected_rows($conn);
$sql3 = "SELECT * FROM t_user WHERE token='$token'";
$result3 = mysqli_query($conn, $sql3);
$row = mysqli_fetch_all($result3, MYSQLI_ASSOC);

if(($result1 && $result2) == true){
    if( $size1+$size2 > 0){
        $res['status'] = 1;
        $res['info'] = '更新成功';
        $res['data'] = $row[0];
    }else{
        echo $size1,$size2,$result3;
    }
}else{
    $res['status'] = 0;
    $res['info'] = '更新失败';
    $res['data'] = '';
}

echo json_encode($res);
