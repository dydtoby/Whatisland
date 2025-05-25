<?php
require '../db.func.php';
require '../tools.func.php';
require 'auth.php';

$id = intval($_GET['id']);
$prefix = getDBPrefix();

// 禁止删除最后一个管理员
$sql = "SELECT COUNT(id) AS total FROM {$prefix}admin";
$count = queryOne($sql)['total'];
if ($count <= 1) {
    setInfo('至少需要保留一个管理员');
    header('location: index.php');
    exit;
}

$sql = "DELETE FROM {$prefix}admin WHERE id = '$id'";
if (execute($sql)) {
    setInfo('删除成功');
} else {
    setInfo('删除失败');
}
header('location: index.php');