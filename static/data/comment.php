<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
require('init.php');
//发布评论
$input = file_get_contents("php://input");
$input = json_decode($input);

settype($input, 'array');
extract($input);
$res = [];
if($topic_id == null || $user_id == null || $comment == null ){
    $res['status'] = 0;
    $res['info'] = '发布失败';
    $res['data'] = '';
    exit(json_encode($res));
}

$sql1 = "UPDATE t_topic SET comment_num=comment_num+1 WHERE topic_id=$topic_id";
$result1 = mysqli_query($conn, $sql1);

$date = time();
$sql = "INSERT INTO t_comment VALUES(null, $topic_id, $user_id, $date, '$comment')";
$result = mysqli_query($conn, $sql);

if($result === true && $result1 === true){
    $res['status'] = 1;
    $res['info'] = '发布成功';
    $res['data'] = '';
}else{
    $res['status'] = 0;
    $res['info'] = '发布失败';
    $res['data'] = '';
}
echo json_encode($res);
