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

    // 获取用户信息和商品信息
    $user_id = getSession('id', 'shop');
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity'] ?? 1); // 默认兑换1件

    // 获取用户数据
    $sql = "SELECT id, username, jf, uid FROM {$prefix}user WHERE id = '$user_id'";
    $user = queryOne($sql);
    if (!$user) {
        throw new Exception('用户不存在');
    }

    // 获取商品数据
    $sql = "SELECT id, name, price, stock, jf FROM {$prefix}jfdh WHERE id = '$product_id'";
    $product = queryOne($sql);
    if (!$product) {
        throw new Exception('商品不存在');
    }

    // 检查库存
    if ($product['stock'] < $quantity) {
        throw new Exception('库存不足');
    }
    // 计算所需奶油值
    $required_jf = $product['jf'] * $quantity;

    // 检查用户奶油值是否足够
    if ($user['jf'] < $required_jf) {
        throw new Exception('奶油值不足，无法兑换');
    }


    // 扣除用户奶油值
    $new_jf = $user['jf'] - $required_jf;
    $sql = "UPDATE {$prefix}user SET jf = '$new_jf' WHERE id = '$user_id'";
    if (!execute($sql)) {
        throw new Exception('奶油值扣除失败');
    }

    // 减少商品库存
    $new_stock = $product['stock'] - $quantity;
    $sql = "UPDATE {$prefix}jfdh SET stock = '$new_stock' WHERE id = '$product_id'";
    if (!execute($sql)) {
        throw new Exception('库存更新失败');
    }

    // 记录兑换记录
    $created_at = date('Y-m-d H:i:s');
    $sql = "INSERT INTO {$prefix}jfdh_jl (name, uid, pid, num, created_at,total_jf)
            VALUES ('{$user['username']}', '{$user['uid']}', '$product_id', '$quantity', '$created_at','$required_jf')";
    if (!execute($sql)) {
        throw new Exception('兑换记录保存失败');
    }


    $response['msg'] = '兑换成功';
    $response['new_jf'] = $new_jf;
    $response['new_stock'] = $new_stock;

} catch (Exception $e) {
    $response['code'] = 400;
    $response['msg'] = $e->getMessage();
}

echo json_encode($response);
?>