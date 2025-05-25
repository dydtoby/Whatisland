<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';

$prefix = getDBPrefix();

// 增强SQL查询
$sql = "SELECT 
            o.id AS 订单ID,
            o.name AS 收货人,
            o.phone AS 联系电话,
            o.address AS 收货地址,
            o.price AS 订单金额,
            o.quantity AS 商品总数,
            o.created_at AS 下单时间,
            u.username AS 用户名,
            JSON_UNQUOTE(JSON_EXTRACT(jt.product, '$.product.id')) AS 商品ID,
            JSON_UNQUOTE(JSON_EXTRACT(jt.product, '$.product.price')) AS 商品单价,
            p.name AS 商品名称,
            JSON_UNQUOTE(JSON_EXTRACT(jt.product, '$.quantity')) AS 购买数量
        FROM {$prefix}order o
        LEFT JOIN {$prefix}user u ON o.uid = u.id
        JOIN JSON_TABLE(
            o.products,
            '$.*' COLUMNS (
                product JSON PATH '$'
            )
        ) AS jt
        LEFT JOIN {$prefix}product p 
            ON p.id = JSON_UNQUOTE(JSON_EXTRACT(jt.product, '$.product.id'))
        ORDER BY o.created_at DESC";

$orders = query($sql);

// 重组数据结构
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
    
    // 计算小计
    $subtotal = number_format($order['商品单价'] * $order['购买数量'], 2);
    
    $grouped_orders[$orderId]['商品明细'][] = [
        '商品ID' => $order['商品ID'],
        '商品名称' => $order['商品名称'] ?? '[已下架]',
        '单价' => number_format($order['商品单价'], 2),
        '数量' => $order['购买数量'],
        '小计' => $subtotal
    ];
}

// 设置HTTP头
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename=订单详情_'.date('YmdHis').'.xls');
echo "\xEF\xBB\xBF"; // BOM头

// 输出完整表格
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
    // 构建详细商品信息
    $products = array_map(function($item) {
        // return "{$item['商品名称']} (ID:{$item['商品ID']})<br>
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
    echo '<td style="white-space:normal;">'.implode("<hr style='margin:5px 0'>", $products).'</td>';
    echo '<td>'.$order['基本信息']['下单时间'].'</td>';
    echo '</tr>';
}

echo '</table>';
exit;