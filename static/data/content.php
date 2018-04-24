<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
require('init.php');
//文章详情
@$topic_id = $_REQUEST['topic_id'];
@$user_id = $_REQUEST['user_id'];

$res = [];
$sql1 = "UPDATE t_topic SET browser_num=browser_num+1 WHERE topic_id=$topic_id";
$result1 = mysqli_query($conn, $sql1);

$sql = "SELECT t.topic_id, t.title, t.modify_time, t.browser_num, t.content, t.md_content, t.type, t.tech_type, t.like_num,t.comment_num, t.user_id, u.nick_name FROM t_topic t, t_user u WHERE t.user_id=u.user_id AND t.topic_id=$topic_id";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if($user_id > 0){
    $sql2 = "SELECT zan_id FROM t_zan WHERE topic_id=$topic_id AND user_id=$user_id";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_row($result2);
    $res['iszan']= $row2 == null?false:true;

    $sql3 = "SELECT coll_id FROM t_coll WHERE topic_id=$topic_id AND user_id=$user_id";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_row($result3);
    $res['iscoll']= $row3 == null?false:true;
}



if($row != null && $result1 === true){
    $res['status'] = 1;
    $res['info'] = '查询成功';
    $res['data'] = $row;
}else{
    $res['status'] = 0;
    $res['info'] = '查询失败';
    $res['data'] = '';
}
echo json_encode($res);