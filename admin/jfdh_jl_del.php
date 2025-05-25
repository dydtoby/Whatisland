<?php
require '../db.func.php';
require '../tools.func.php';
require 'auth.php';

$id = intval($_GET['id']);
$prefix = getDBPrefix();

// 执行删除操作
$sql = "DELETE FROM {$prefix}jfdh_jl WHERE id = '$id'";
if(execute($sql)){
    setInfo('删除兑换记录成功');
}else{
    setInfo('删除兑换记录失败');
}

header("location: jlOrder.php");
exit;