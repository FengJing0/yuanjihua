<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
require('init.php');

$input = file_get_contents("php://input");
$input = json_decode($input);

settype($input, 'array');
extract($input);
switch($type){
    case 'zan':
        $table='t_zan';
        $attr = 'zan_id';
        $num = 'like_num';
        $info = '点赞';
        break;
    case 'coll':
        $table='t_coll';
        $attr = 'coll_id';
        $num = 'coll_num';
        $info = '收藏';
        break;
}



$res = [];

$sql = "SELECT $attr FROM $table WHERE topic_id=$topic_id AND user_id=$user_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);

if($row == null){
    $sql = "INSERT INTO $table VALUES (null,$topic_id, $user_id)";
    $result = mysqli_query($conn, $sql);
    $sql1 = "UPDATE t_topic SET $num=$num+1 WHERE topic_id=$topic_id";
    $result1 = mysqli_query($conn, $sql1);
    $size = mysqli_affected_rows($conn);
    if($result == true && $size > 0){
        $res['status'] = 1;
        $res['info'] = $info."成功";
        $res['data'] = '';
    }else{
        $res['status'] = 0;
        $res['info'] = $info."失败";
        $res['data'] = '';
    }
}else{
    $sql = "DELETE FROM $table WHERE topic_id=$topic_id AND user_id=$user_id";
    $result = mysqli_query($conn, $sql);
    $sql1 = "UPDATE t_topic SET $num=$num-1 WHERE topic_id=$topic_id";
    $result1 = mysqli_query($conn, $sql1);
    $size = mysqli_affected_rows($conn);
    if($result == true && $size > 0){
        $res['status'] = 1;
        $res['info'] = "取消".$info."成功";
        $res['data'] = '';
    }else{
        $res['status'] = 0;
        $res['info'] = "取消".$info."失败";
        $res['data'] = '';
    }
}






echo json_encode($res);
