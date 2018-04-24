<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
require('init.php');
//我的文章列表
//$input = file_get_contents("php://input");
//
//$input = json_decode($input);
@$user_id = $_REQUEST['user_id'];
@$page=$_REQUEST['page'];
if($page==null)
    $page=1;
$num = ($page - 1) * 10;
$sql = "SELECT topic_id, title, modify_time, type, comment_num, browser_num FROM t_topic WHERE user_id=$user_id  LIMIT $num,10";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);


$sql = "SELECT count(topic_id) FROM t_topic WHERE user_id=$user_id";
$result = mysqli_query($conn, $sql);
$row2 = mysqli_fetch_row($result);
$res = [];
if($row != null){
    $res['status'] = 1;
    $res['info'] = '查询成功';
    $res['data'] = $row;
    $res['commentList'] = $row2;
}else{
    $res['status'] = 0;
    $res['info'] = '查询失败';
    $res['data'] = '';
}

echo json_encode($res);