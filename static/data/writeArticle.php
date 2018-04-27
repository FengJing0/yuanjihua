<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
require('init.php');
//添加文章
$input = file_get_contents("php://input");
$input = json_decode($input);


settype($input, 'array');
extract($input);
$date = time();
$res = [];
if($title == null || $content == null || $md_content == null || $type == null || $tech_type == null){
    $res['status'] = 0;
    $res['info'] = '上传失败';
    $res['data'] = '';
    exit(json_encode($res));
}

if($isEdit === true){
    $arr = ['title'=>$title, 'content'=>$content, 'md_content'=>$md_content, 'type'=>$type, 'tech_type'=>$tech_type, 'modify_time'=>$date];
    $row = 0;
    foreach($arr as $key => $val){
        $sql = "UPDATE t_topic SET $key='$val' WHERE topic_id=$topic_id";
        $result = mysqli_query($conn, $sql);
        $res[]=$result;
        $size = mysqli_affected_rows($conn);
        $row += $size;
    }
}else{
    $sql = "INSERT INTO t_topic VALUES(null, '$title', '$content', '$md_content', $type, $tech_type, $date, 0, 0, 0, 0, $user_id)";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_affected_rows($conn);
}

//$sql1 = "SELECT"


if($result === true && $row > 0){
    $res['status'] = 1;
    $res['info'] = '上传成功';
    $res['data'] = '';
}else{
    $res['status'] = 0;
    $res['info'] = '上传失败';
    $res['data'] = '';
}
echo json_encode($res);