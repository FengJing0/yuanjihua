<?php
header('Content-type: application/json;charset=utf-8;');
header('Access-Control-Allow-Origin:*');
// 响应类型
header('Access-Control-Allow-Methods:POST');
// 响应头设置
header('Access-Control-Allow-Headers:x-requested-with,content-type');
//上传头像
require('init.php');
function getUUID(){
    $mt = microtime(true);
    $rn = mt_rand(1,1000000);
    return strtoupper(md5($mt.$rn));
}
function getExt($fn){
    $arr = explode('.',$fn);
    return end($arr);
}

$id = $_REQUEST['id'];
//$upload = upload()?'保存成功':'保存失败';
$input = file_get_contents("php://input");


$file =  reset($_FILES);
$newName = getUUID().'.'.getExt($file['name']);
$tmpName = $file['tmp_name'];
$suc = move_uploaded_file($file['tmp_name'], 'upload/'.$newName);
$res = [];
if($suc){
    $sql = "UPDATE t_user SET avatar='$newName' WHERE user_id=$id";
    $result = mysqli_query($conn,$sql);
    if ($result){
        $res['status'] = 1;
        $res['info'] = '更新成功';
        $res['data'] = '';
    }else{
        $res['status'] = 0;
        $res['info'] = '更新失败';
        $res['data'] = '';
    }
}else{
    $res['status'] = 0;
    $res['info'] = '更新失败';
    $res['data'] = '';
}
echo json_encode($res);
