<?php
require '../tools.func.php';
require '../db.func.php';
require 'auth.php';

$prefix = getDBPrefix();
$cart_id = intval($_GET['cart_id']);

// 获取购物车数据
$sql = "SELECT * FROM {$prefix}cart WHERE id = '$cart_id'";
$cart = queryOne($sql);

if (!empty($cart)) {
    $sql = "DELETE FROM {$prefix}cart WHERE id = '$cart_id'";
    if (execute($sql)) {
        setInfo('删除购物车成功');
    } else {
        setInfo('删除购物车失败');
    }
}

header('location: carts.php');
?>