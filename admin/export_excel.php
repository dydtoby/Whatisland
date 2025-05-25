<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';

// 获取数据库表前缀
$prefix = getDBPrefix();

// 构建带JOIN的SQL查询
$sql = "SELECT jl.*, jf.name as product_name 
        FROM {$prefix}jfdh_jl as jl
        LEFT JOIN {$prefix}jfdh as jf 
        ON jl.pid = jf.id
        ORDER BY jl.created_at DESC";

$data = query($sql);

// 设置HTTP头信息
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename=兑换记录_'.date('YmdHis').'.xls');
header('Pragma: no-cache');
header('Expires: 0');

// 输出BOM头解决中文乱码
echo "\xEF\xBB\xBF";

// 开始输出表格
echo '<table border="1">';
// 输出表头
echo '<tr>
        <th>兑换记录ID</th>
        <th>用户名</th>
        <th>用户ID</th>
        <th>兑换商品</th>
        <th>兑换份数</th>
        <th>消耗奶油值</th>
        <th>兑换时间</th>
      </tr>';

// 循环输出数据
foreach ($data as $row) {
    echo '<tr>';
    echo '<td>'.$row['id'].'</td>';
    echo '<td>'.$row['name'].'</td>';
    echo '<td>'.$row['uid'].'</td>';
    echo '<td>'.$row['product_name'].'</td>';
    echo '<td>'.$row['num'].'</td>';
    echo '<td>'.$row['total_jf'].'</td>';
    echo '<td>'.$row['created_at'].'</td>';
    echo '</tr>';
}

echo '</table>';
exit;