<?php
require '../db.func.php';
require '../tools.func.php';
require 'auth.php';

// 1. 接收id
$id = intval($_GET['id']);
// 2. 从数据库当中删除对应的数据
$prefix = getDBPrefix();
$sql = "DELETE FROM {$prefix}product WHERE id = '$id'";
if (execute($sql)) {
    // setInfo('删除成功');
} else {
    // setInfo('删除失败');
}
// 3. 跳回到列表页
header('location: products.php');