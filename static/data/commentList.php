<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
require('init.php');
//评论列表
@$topic_id = $_REQUEST['topic_id'] or die('请输入文章编号');


$sql = "SELECT c.user_id, c.date, c.comment, u.nick_name, u.avatar FROM t_comment c, t_user u WHERE c.user_id=u.user_id AND c.topic_id=$topic_id";

$result = mysqli_query($conn, $sql);

$res = [];

$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
if($rows != null){
    $res['status'] = 1;
    $res['info'] = '查询成功';
    $res['data'] = $rows;
}else{
    $res['status'] = 0;
    $res['info'] = '暂无评论';
    $res['data'] = '';
}

echo json_encode($res);