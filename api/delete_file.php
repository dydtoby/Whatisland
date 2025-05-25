<?php
require '../tools.func.php';
require '../db.func.php';
header('Content-Type: application/json');
$prefix = getDBPrefix();
$response = ['code' => 200, 'msg' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('非法请求');
    }

    $file_id = intval($_GET['id']);
    $user_id = getSession('id', 'shop');

    // 开启事务
    // beginTransaction();

    // 1. 检查用户积分
    $sql = "SELECT jf FROM {$prefix}user WHERE id = $user_id";
    $user = queryOne($sql);
    
    if (!$user) {
        throw new Exception('用户不存在');
    }
    
    if ($user['jf'] < 5000) {
        throw new Exception('积分不足，删除需要5000积分');
    }

    // 2. 扣除积分
    $sql = "UPDATE {$prefix}user SET jf = jf - 500 WHERE id = $user_id";
    if (!execute($sql)) {
        throw new Exception('扣除积分失败');
    }

    // 3. 获取文件信息
    $sql = "SELECT files FROM {$prefix}wp 
            WHERE id = $file_id AND userid = $user_id";
    $file = queryOne($sql);

    if (!$file) {
        throw new Exception('文件不存在或无权访问');
    }

    // 4. 删除数据库记录
    $sql = "DELETE FROM {$prefix}wp WHERE id =$file_id";
    if (!execute($sql)) {
        throw new Exception('删除记录失败');
    }

    // 5. 删除物理文件
    $filepath = '../uploads/' . $file['files'];
    if (file_exists($filepath) && !unlink($filepath)) {
        throw new Exception('删除文件失败');
    }

    // 提交事务
    // commit();

    $response['msg'] = '文件删除成功，已扣除5000积分';
    $response['new_jf'] = $user['jf'] - 5000; // 返回最新积分

} catch (Exception $e) {
    // 回滚事务
    // rollback();
    $response['code'] = 400;
    $response['msg'] = $e->getMessage();
}

echo json_encode($response);
?>