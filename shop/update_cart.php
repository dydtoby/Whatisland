<?php
require '../tools.func.php';
require '../db.func.php';
require 'auth.php';

header('Content-Type: application/json');

$uid = getSession('id', 'shop');
$pid = intval($_POST['product_id']);
$quantity = intval($_POST['quantity']);

// 验证数量
if($quantity < 1) {
    echo json_encode(['success' => false, 'message' => '数量不能小于1']);
    exit;
}

// 获取当前购物车数据
$prefix = getDBPrefix();
$sql = "SELECT id, products, price, quantity FROM {$prefix}cart WHERE uid = '$uid'";
$cart = queryOne($sql);

if(empty($cart)) {
    echo json_encode(['success' => false, 'message' => '购物车不存在']);
    exit;
}

// 更新商品数量
$products = json_decode($cart['products'], true);
if(isset($products[$pid])) {
    // 保存原始数量用于回滚
    $original_quantity = $products[$pid]['quantity'];
    
    // 计算价格变化
    $price_change = ($quantity - $original_quantity) * $products[$pid]['product']['price'];
    
    // 更新数量
    $products[$pid]['quantity'] = $quantity;
    
    // 计算新总价
    $total_price = $cart['price'] + $price_change;
    $total_quantity = $cart['quantity'] + ($quantity - $original_quantity);
    
    // 更新数据库
    $update_sql = "UPDATE {$prefix}cart SET 
                  products = '" . addslashes(json_encode($products)) . "',
                  price = '$total_price',
                  quantity = '$total_quantity'
                  WHERE id = '{$cart['id']}'";
    
    if(execute($update_sql)) {
        echo json_encode([
            'success' => true, 
            'total_price' => number_format($total_price, 2),
            'original_quantity' => $original_quantity
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => '数据库更新失败',
            'original_quantity' => $original_quantity
        ]);
    }
} else {
    echo json_encode(['success' => false, 'message' => '商品不存在']);
}
?>