<?php
require '../tools.func.php';
require '../db.func.php';
require 'auth.php';

// 1. 获取当前用户的购物车数据
$uid = getSession('id', 'shop');
$prefix = getDBPrefix();
$sql = "SELECT id, price, quantity, products, uid
        FROM {$prefix}cart WHERE uid = '$uid'";
$cart = queryOne($sql);

if (empty($cart)) {
    header('location: cart.php');
    exit;
}

// 解析商品数据
$products = json_decode($cart['products'], true);

// 2. 验证收货信息
$name = htmlspecialchars(trim($_POST['name'] ?? ''));
$phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
$address = htmlspecialchars(trim($_POST['address'] ?? ''));

// if (empty($name) || empty($phone) || empty($address)) {
//     setInfo('请填写完整的收货信息');
//     header('location: cart.php');
//     exit;
// }

// if (!preg_match('/^1[3-9]\d{9}$/', $phone)) {
//     setInfo('请输入有效的手机号码');
//     header('location: cart.php');
//     exit;
// }

// 3. 检查并更新库存
foreach ($products as $pid => $item) {
    $quantity = $item['quantity'];
    $pid = intval($pid);
    
    // 先查询当前库存
    $sql = "SELECT stock FROM {$prefix}product WHERE id = $pid";
    $product = queryOne($sql);
    
    if (!$product || $product['stock'] < $quantity) {
        // setInfo("商品【{$item['product']['name']}】库存不足");
        // header('location: cart.php');
        // exit;
        echo "<script>alert('商品【{$item['product']['name']}】库存不足');location.href='cart.php';</script>";
        exit;
    }

    // 直接进行库存扣减
    $sql = "UPDATE {$prefix}product 
           SET stock = stock - $quantity 
           WHERE id = $pid";
    
    if (!execute($sql)) {
        // setInfo("库存更新失败");
        // header('location: cart.php');
        echo "<script>alert('库存更新失败');location.href='cart.php';</script>";
        exit;
    }
}

// 4. 创建订单
$price = $cart['price'];
$quantity = $cart['quantity'];
$products_json = $cart['products'];
$cid = $cart['id'];
$created_at = date('Y-m-d H:i:s');

$sql = "INSERT INTO {$prefix}order(price, quantity, products, created_at, uid, name, phone, address)
        VALUES('$price', '$quantity', '$products_json', '$created_at', '$uid', '$name', '$phone', '$address')";

if (!execute($sql)) {
    // setInfo('订单创建失败');
    // header('location: cart.php');
    echo "<script>alert('订单创建失败');location.href='cart.php';</script>";
    exit;
}

// 5. 删除购物车
$sql = "DELETE FROM {$prefix}cart WHERE id = '$cid'";
if (!execute($sql)) {
    // setInfo('购物车删除失败');
    // header('location: cart.php');
    echo "<script>alert('购物车删除失败');location.href='cart.php';</script>";
    exit;
}

// 清除session购物车
setSession('cart', null, 'shop');
setInfo('下单成功');
header('location: order_status.php');
?>