<?php
require '../db.func.php';
require '../tools.func.php';
require 'auth.php';

// 1. 接收id
$id = intval($_GET['id']);

// 2. 从数据库删除订单
$prefix = getDBPrefix();
$sql = "DELETE FROM {$prefix}order WHERE id = '$id'";

if (execute($sql)) {
    setInfo('订单删除成功');
} else {
    setInfo('订单删除失败');
}

// 3. 跳回订单列表页
header('location: orders.php');
exit;
?>