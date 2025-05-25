<?php
require '../tools.func.php';
require '../db.func.php';
require 'auth.php';

$prefix = getDBPrefix();
$cart_id = intval($_GET['cart_id']);
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;

// 获取购物车数据
$sql = "SELECT * FROM {$prefix}cart WHERE id = '$cart_id'";
$cart = queryOne($sql);

if (!empty($cart)) {
    if ($product_id) {
        // 删除单个商品
        $products = json_decode($cart['products'], true);
        if (isset($products[$product_id])) {
            // 计算要减少的价格和数量
            $price_reduce = $products[$product_id]['product']['price'] * $products[$product_id]['quantity'];
            $quantity_reduce = $products[$product_id]['quantity'];
            
            // 从数组中删除商品
            unset($products[$product_id]);
            
            // 更新购物车
            if (!empty($products)) {
                // 如果还有商品，更新购物车
                $new_price = $cart['price'] - $price_reduce;
                $new_quantity = $cart['quantity'] - $quantity_reduce;
                $products_json = addslashes(json_encode($products));
                
                $sql = "UPDATE {$prefix}cart 
                        SET products = '$products_json', 
                            price = '$new_price', 
                            quantity = '$new_quantity'
                        WHERE id = '$cart_id'";
            } else {
                // 如果没有商品了，删除整个购物车
                $sql = "DELETE FROM {$prefix}cart WHERE id = '$cart_id'";
            }
            
            if (execute($sql)) {
                setInfo('删除商品成功');
            } else {
                setInfo('删除商品失败');
            }
        }
    } else {
        // 删除整个购物车
        $sql = "DELETE FROM {$prefix}cart WHERE id = '$cart_id'";
        if (execute($sql)) {
            setInfo('删除购物车成功');
        } else {
            setInfo('删除购物车失败');
        }
    }
}

header('location: ' . ($product_id ? 'cart.php' : 'cart.php'));
?>