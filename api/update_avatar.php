<?php
require '../tools.func.php';
require '../db.func.php';
header('Content-Type: application/json');
$prefix = getDBPrefix();
$response = ['code' => 200, 'msg' => ''];

try {
    
    // 获取当前用户
    $uid = getSession('id', 'shop');
    
    // 接收GET参数
    $avatar = addslashes(trim($_GET['avatar'] ?? ''));
    
    // 参数验证
    if (empty($avatar)) {
        throw new Exception('头像参数不能为空');
    }
    
    // 更新数据库
    $sql = "UPDATE {$prefix}user SET images = '$avatar' WHERE id = $uid";
    $exec = execute($sql);
    
    if ($exec) {
        // 更新session中的头像
        $_SESSION['user']['images'] = $avatar;
        $response['msg'] = '头像更新成功';
        $response['data'] = ['avatar' => $avatar];
    } else {
        throw new Exception('头像更新失败');
    }
    
} catch (Exception $e) {
    $response['code'] = 400;
    $response['msg'] = $e->getMessage();
}

echo json_encode($response);
?>