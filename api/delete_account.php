<?php
require '../tools.func.php';
require '../db.func.php';
header('Content-Type: application/json');
$prefix = getDBPrefix();
$response = ['code' => 200, 'msg' => ''];

try {
    $id = getSession('id', 'shop');
    $uidInp = addslashes(trim($_GET['uidInp'] ?? ''));
    $sql = "SELECT uid
    FROM {$prefix}user WHERE id = '$id'";
    $current_user = queryOne($sql);
    if ($current_user['uid']!==$uidInp ) {
        throw new Exception('用户验证失败');
    }

    // 删除用户
    $sql = "DELETE FROM {$prefix}user WHERE id = $id";
    if (!execute($sql)) {
        throw new Exception('账号删除失败');
    }

    // 清除会话
    $response['msg'] = '账号已注销';
    deleteSession('shop');

} catch (Exception $e) {
    $response['code'] = 400;
    $response['msg'] = $e->getMessage();
}

echo json_encode($response);
?>