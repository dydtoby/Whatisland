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

    // 验证用户登录
    $user_id = getSession('id', 'shop');
    if (empty($user_id)) {
        throw new Exception('请先登录');
    }

    // 检查用户奶油值
    $user_sql = "SELECT jf FROM {$prefix}user WHERE id = '$user_id'";
    $user = queryOne($user_sql);
    if ($user['jf'] < 500) {
        throw new Exception('奶油值不足，需要500奶油值才能上传');
    }

 
    // 验证文件上传
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('文件上传失败');
    }

    $file = $_FILES['file'];
    
    // 文件大小限制 (5MB)
    $maxSize = 5 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        throw new Exception('文件大小不能超过5MB');
    }

    // 允许的文件类型
    $allowedTypes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'application/pdf',
        'application/msword',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'text/plain'
    ];
    
    if (!in_array($file['type'], $allowedTypes)) {
        throw new Exception('不支持的文件类型');
    }

    // 创建上传目录
    $uploadDir = '../uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // 生成唯一文件名
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $ext;
    $filepath = $uploadDir . $filename;

    // 移动上传文件
    if (!move_uploaded_file($file['tmp_name'], $filepath)) {
        throw new Exception('文件保存失败');
    }

    try {
        // 扣除奶油值
        $sql = "UPDATE {$prefix}user SET jf = jf - 500 WHERE id = '$user_id'";
        if (!execute($sql)) {
            throw new Exception('奶油值扣除失败');
        }

        // 记录到数据库
        $created_at = date('Y-m-d H:i:s');
        $sql = "INSERT INTO {$prefix}wp (userid, files, created_at, name)
                VALUES ('$user_id', '$filename', '$created_at', '{$file['name']}')";
        
        if (!execute($sql)) {
            throw new Exception('文件记录失败');
        }

    } catch (Exception $e) {
        // 删除已上传的文件
        if (isset($filepath) && file_exists($filepath)) {
            unlink($filepath);
        }
        throw $e;
    }

    $response['msg'] = '文件上传成功，已扣除500奶油值';
    $response['filepath'] = $filename;
    $response['new_jf'] = $user['jf'] - 500; // 返回新奶油值

} catch (Exception $e) {
    $response['code'] = 400;
    $response['msg'] = $e->getMessage();
}

echo json_encode($response);
?>