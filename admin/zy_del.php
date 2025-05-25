<?php
require '../db.func.php';
require '../tools.func.php';
require 'auth.php';

$id = intval($_GET['id']);
$prefix = getDBPrefix();

// 先获取图片路径用于删除文件
$sql = "SELECT images FROM {$prefix}zy WHERE id = '$id'";
$zy = queryOne($sql);
if (!empty($zy['images']) && file_exists("../{$zy['images']}")) {
    unlink("../{$zy['images']}");
}

// 删除数据库记录
$sql = "DELETE FROM {$prefix}zy WHERE id = '$id'";
execute($sql);

header('location: zy.php');