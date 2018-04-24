<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
require('init.php');
//文章列表
@$type = $_REQUEST['type'];
@$sort = $_REQUEST['sort'];
@$page=$_REQUEST['page'];
@$index =$_REQUEST['index'];
if($page==null)
    $page=1;
$num = ($page - 1) * 10;
//$input = file_get_contents("php://input");
//$input = json_decode($input);
//$type = $input -> {'type'};
$res = [];
$index = $index === 'true'?'type':'tech_type';

$types = $type == 0?"":" AND t.$index=$type";
$sort = $sort === 'new'?" ORDER BY t.modify_time DESC":" ORDER BY t.comment_num+t.like_num DESC, t.modify_time";
$page =  " LIMIT $num,10";

$sql = "SELECT t.topic_id, t.title, t.type, t.$index, t.modify_time, t.like_num,t.comment_num, t.user_id, u.nick_name FROM t_topic t, t_user u WHERE t.user_id=u.user_id".$types.$sort.$page;

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
if($row != null){
    $res['status'] = 1;
    $res['info'] = '查询成功';
    $res['data'] = $row;
}else{
    $res['status'] = 0;
    $res['info'] = '此类文章为空';
    $res['data'] = '';
}
$typePage = $type == 0?"":" WHERE $index=$type";

$sql1 = "SELECT count(topic_id) FROM t_topic".$typePage;
$result1 = mysqli_query($conn,$sql1);
$row1 = mysqli_fetch_row($result1);
$res['listCount'] = $row1;

echo json_encode($res);

