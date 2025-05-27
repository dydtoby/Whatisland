<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$prefix = getDBPrefix();

// 第一步：只查订单和用户信息，不处理 products 细节
$sql = "SELECT 
            o.id AS 订单ID,
            o.uid,
            o.name AS 收货人,
            o.phone AS 联系电话,
            o.address AS 收货地址,
            o.price AS 订单金额,
            o.quantity AS 商品总数,
            o.products,
            o.created_at AS 下单时间,
            u.username AS 用户名
        FROM {$prefix}order o
        LEFT JOIN {$prefix}user u ON o.uid = u.id
        ORDER BY o.created_at DESC";

$orders = query($sql);

// 第二步：解析每条订单的 products 字段
$grouped_orders = [];

foreach ($orders as $order) {
    $orderId = $order['订单ID'];
    if (!isset($grouped_orders[$orderId])) {
        $grouped_orders[$orderId] = [
            '基本信息' => [
                '订单ID' => $orderId,
                '用户名' => $order['用户名'],
                '收货人' => $order['收货人'],
                '联系电话' => $order['联系电话'],
                '收货地址' => $order['收货地址'],
                '订单金额' => $order['订单金额'],
                '商品总数' => $order['商品总数'],
                '下单时间' => $order['下单时间']
            ],
            '商品明细' => []
        ];
    }

    // 解码 JSON 产品数据
    $products = json_decode($order['products'], true);
    if (!is_array($products)) continue;

    foreach ($products as $item) {
        $pid = $item['product']['id'] ?? null;
        $price = $item['product']['price'] ?? 0;
        $qty = $item['quantity'] ?? 0;

        if (!$pid) continue;

        // 查询商品名称（可缓存优化）
        $product = query("SELECT name FROM {$prefix}product WHERE id = ?", [$pid]);
        $pname = $product[0]['name'] ?? '[已下架]';

        $subtotal = number_format($price * $qty, 2);

        $grouped_orders[$orderId]['商品明细'][] = [
            '商品ID' => $pid,
            '商品名称' => $pname,
            '单价' => number_format($price, 2),
            '数量' => $qty,
            '小计' => $subtotal
        ];
    }
}

// 第三步：导出为 Excel（HTML 格式）
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename=订单详情_'.date('YmdHis').'.xls');
echo "\xEF\xBB\xBF"; // 防止乱码

echo '<table border="1">';
echo '<tr>
        <th>订单ID</th>
        <th>用户名</th>
        <th>收货人</th>
        <th>联系电话</th>
        <th>收货地址</th>
        <th>订单总额</th>
        <th>商品总数</th>
        <th>商品明细（含小计）</th>
        <th>下单时间</th>
      </tr>';

foreach ($grouped_orders as $order) {
    $products_html = array_map(function($item) {
        return "{$item['商品名称']}<br>
                单价：￥{$item['单价']} × 数量：{$item['数量']}<br>
                小计：￥{$item['小计']}";
    }, $order['商品明细']);

    echo '<tr>';
    echo '<td>'.$order['基本信息']['订单ID'].'</td>';
    echo '<td>'.htmlspecialchars($order['基本信息']['用户名']).'</td>';
    echo '<td>'.htmlspecialchars($order['基本信息']['收货人']).'</td>';
    echo '<td>'.$order['基本信息']['联系电话'].'</td>';
    echo '<td style="width:300px;">'.htmlspecialchars($order['基本信息']['收货地址']).'</td>';
    echo '<td>￥'.number_format($order['基本信息']['订单金额'], 2).'</td>';
    echo '<td>'.$order['基本信息']['商品总数'].'</td>';
    echo '<td style="white-space:normal;">'.implode("<hr style='margin:5px 0'>", $products_html).'</td>';
    echo '<td>'.$order['基本信息']['下单时间'].'</td>';
    echo '</tr>';
}

echo '</table>';
exit;
