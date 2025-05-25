<?php
require '../tools.func.php';
require '../db.func.php';

// 1. 接收商品 id
$product_id = intval($_GET['product_id']);
// 2. 接收数量
$quantity = intval($_GET['quantity']);

if (empty($product_id) || empty($quantity)) {
    header('location: login.php');
    exit;
}

$prefix = getDBPrefix();
// $sql = "SELECT id, name, price, code, description,images
//             FROM {$prefix}product WHERE id = '$product_id'";
$sql = "SELECT id, name, price,images
            FROM {$prefix}product WHERE id = '$product_id'";
$product = queryOne($sql);

// 3. 判断当前用户是否已经登录
if (!empty(getSession('username', 'shop'))) {
    // 如果已经登录，将购物车数据存入到 数据表（
    // id,
    // products[
    //  2 => [quantity => 4, product => [id => ,price =>,]],
    //  3 => [quantity => 2, product => []],
    //  4 =>
    //  ],
    // price, quantity, uid）
    $uid = getSession('id', 'shop');

    $sql = "SELECT id,products,price,quantity,uid 
            FROM {$prefix}cart WHERE uid = '$uid'";
    $cart = queryOne($sql);
    if (!empty($cart)) {
        // 更新记录
        $products = json_decode($cart['products'], true);
        if (array_key_exists($product_id, $products)) {
            $products[$product_id]['quantity'] += $quantity;
        } else {
            $products[$product_id] = ['quantity' => $quantity, 'product' => $product];
        }
        $products = addslashes(json_encode($products));
        $cart_price = $cart['price'] + $quantity * $product['price'];
        $cart_quantity = $cart['quantity'] + $quantity;
        $sql = "UPDATE {$prefix}cart 
                SET products = '$products', price = '$cart_price', quantity = '$cart_quantity'
                WHERE id = '{$cart['id']}'";
        execute($sql);
    } else {
        // 生成 products, price, quantity, uid, created_at
        $products[$product_id] = ['quantity' => $quantity, 'product' => $product];
        $price = $product['price'] * $quantity;
        $created_at = date('Y-m-d H:i:s');
        // 添加新的数据
        $products = addslashes(json_encode($products)); // \' \"
        $sql = "INSERT INTO {$prefix}cart(products, price, quantity, uid, created_at)
                VALUES('$products', '$price', '$quantity', '$uid', '$created_at')";
        execute($sql);
    }
    header('location: cart.php');

    // json [{2: {quantity: 4, product: {id: , price: }}}, {}]
} else {
    // 如果没有登录，将购物车数据存入到 session
    $cart = getSession('cart', 'shop');
    if (!empty($cart)) {
        // 更新session
        // 判断当前购物车当中是否拥有当前商品
        if (array_key_exists($product_id, $cart['products'])) {
            // 如果有，更新当前商品的数量，购物车总价，总数量
            $cart['products'][$product_id]['quantity'] += $quantity;
        } else {
            // 如果没有，新加入一个商品信息到购物车当中，更新购物车总价，总数量
            $cart['products'][$product_id] = ['quantity' => $quantity, 'product' => $product];
        }
        $cart['price'] += $quantity * $product['price'];
        $cart['quantity'] += $quantity;
        setSession('cart', $cart, 'shop');
    } else {
        // 写入session
        $products = [
            $product_id => [
                'quantity' => $quantity,
                'product' => $product
            ]
        ];
        $cart_data = [
            'products' => $products,
            'price' => $quantity * $product['price'],
            'quantity' => $quantity
        ];
        setSession('cart', $cart_data, 'shop');
    }
    header('location: login.php');
}

