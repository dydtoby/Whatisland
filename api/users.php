<?php
require '../tools.func.php';
require '../db.func.php';

header('Content-Type: application/json');
$prefix = getDBPrefix();
$users = query("SELECT id,username FROM {$prefix}user ORDER BY id DESC");
echo json_encode(['code' => 200, 'data' => $users]);