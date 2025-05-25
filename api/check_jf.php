<?php
require '../tools.func.php';
require '../db.func.php';
header('Content-Type: application/json');
$prefix = getDBPrefix();

$user_id = getSession('id', 'shop');
$sql = "SELECT jf FROM {$prefix}user WHERE id = '$user_id'";
$user = queryOne($sql);

echo json_encode(['jf' => $user['jf'] ?? 0]);
?>