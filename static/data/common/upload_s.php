<?php
header('content-type:text/html;charset=utf-8;');
function getUUID(){
    $mt = microtime(true);
    $rn = mt_rand(1,1000000);
    return strtoupper(md5($mt.$rn));
}

function getExt($fn){
    $arr = explode('.',$fn);
    return end($arr);
}


function move_file($arr){
    $dec = 'upload/'.getUUID().'.'.getExt($arr['name']);
    $suc = move_uploaded_file($arr['tmp_name'], $dec);
    return $suc;
}
function upload(){
    $var = reset($_FILES);
    $var = reset($var);
    if(is_string($var)){
        return move_file(reset($_FILES));
    }else{
        $newArr = [];
        foreach (reset($_FILES) as $key => $value){
            foreach ($value as $kk => $vv){
                $newArr[$kk][$key] = $vv;
            }
        }
        foreach ($newArr as $key => $val){
            $suc = move_file($val);
            if(!$suc){
                return false;
            }
        }
        return true;
    }
}

