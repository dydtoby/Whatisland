<?php
require '../tools.func.php';
require '../db.func.php';
header('Content-Type: application/json');
$prefix = getDBPrefix();
$cates = query("SELECT id,name,col FROM {$prefix}message_cate ORDER BY id DESC");
echo json_encode(['code' => 200, 'data' => $cates]);