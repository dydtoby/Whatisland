<?php
require '../tools.func.php';
require '../db.func.php';
header('Content-Type: application/json');
$prefix = getDBPrefix();
$response = ['code' => 200, 'msg' => ''];

try {
    // 验证登录
    $uid = getSession('id', 'shop');
    
    // 获取GET参数
    // $newPass = addslashes(trim($_GET['newPass'] ?? ''));
    $newPass =trim($_GET['newPass']);
    // uid
    if ( empty($newPass)) {
        throw new Exception('密码参数不能为空');
    }
    
    
    // 密码复杂度验证Password Complexity Verification
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $newPass)) {
        throw new Exception('密码需包含大小写字母、数字和特殊字符，至少8位');
    }
    
    // 更新密码Update Password
    $newHash = hash('sha256', $newPass);
    $sql = "UPDATE {$prefix}user SET password = '$newHash' WHERE id = $uid";
    $exec = execute($sql);
    
    if ($exec) {
        $response['msg'] = '密码修改成功';
    } else {
        throw new Exception('密码更新失败');
    }

} catch (Exception $e) {
    $response['code'] = 400;
    $response['msg'] = $e->getMessage();
}

echo json_encode($response);
?>