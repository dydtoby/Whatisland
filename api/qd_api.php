<?php
require '../tools.func.php';
require '../db.func.php';
header('Content-Type: application/json');
$prefix = getDBPrefix();
$response = ['code' => 200, 'msg' => ''];

try {
    // 验证请求方法
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('非法请求');
    }

    $user_id = getSession('id', 'shop');
    
    // 检查今天是否已经签到
    $today = date('Y-m-d');
    $sql = "SELECT id FROM {$prefix}qd 
            WHERE userid = '$user_id' 
            AND DATE(created_at) = '$today'";
    $signed = queryOne($sql);
    
    if ($signed) {
        throw new Exception('今天已经签到过了');
    }

    // 开始事务
    // beginTransaction();

    // 记录签到
    $created_at = date('Y-m-d H:i:s');
    $sql = "INSERT INTO {$prefix}qd (userid, jf, created_at) 
            VALUES ('$user_id', 5, '$created_at')";
    if (!execute($sql)) {
        throw new Exception('签到记录失败');
    }

    // 更新用户奶油值
    $sql = "UPDATE {$prefix}user SET jf = jf + 5 WHERE id = '$user_id'";
    if (!execute($sql)) {
        throw new Exception('奶油值更新失败');
    }

    // 提交事务
    // commit();

    $response['msg'] = '签到成功，获得5奶油值';
    $response['new_jf'] = queryOne("SELECT jf FROM {$prefix}user WHERE id = '$user_id'")['jf'];

} catch (Exception $e) {
    // 回滚事务
    // rollback();
    $response['code'] = 400;
    $response['msg'] = $e->getMessage();
}

echo json_encode($response);
?>