<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
require('init.php');
//删除文章
$input = file_get_contents("php://input");
$input = json_decode($input);


settype($input, 'array');
extract($input);
$res = [];
if($topic_id == null || $user_id == null){
    $res['status'] = 0;
    $res['info'] = '删除失败';
    $res['data'] = '';
    exit(json_encode($res));
}
$sql = "DELETE FROM t_topic WHERE topic_id=$topic_id AND user_id=$user_id";
$result = mysqli_query($conn,$sql);
if($result === true ){
    $res['status'] = 1;
    $res['info'] = '删除成功';
    $res['data'] = '';
}else{
    $res['status'] = 0;
    $res['info'] = '删除失败';
    $res['data'] = '';
}
echo json_encode($res);
