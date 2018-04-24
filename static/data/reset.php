<!---->
<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
require('init.php');
//重置密码
$input = file_get_contents("php://input");

$input = json_decode($input);
$mobile = $input->{'mobile'};
$pwd = $input->{'pwd'};
$pwd2 = $input->{'pwd2'};
$sms_code = $input->{'sms_code'};
$res = [];
if($pwd === $pwd2){
    $sql = "UPDATE t_user SET pwd='$pwd' WHERE mobile='$mobile'";
    $result = mysqli_query($conn, $sql);
    $size = mysqli_affected_rows($conn);
    if($result == true && $size > 0){
        $sql2 = "SELECT * FROM t_user WHERE mobile='$mobile'";
        $result2 = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($result2);
        $res['status'] = 1;
        $res['info'] = '修改成功';
        $res['data'] = $row;
    }else{
        $res['status'] = 0;
        $res['info'] = '修改失败';
        $res['data'] = '';
    }
}else{
    $res['status'] = 0;
    $res['info'] = '两次密码不统一';
    $res['data'] = '';
}

echo json_encode($res);
