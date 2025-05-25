<?php
require '../tools.func.php';
require '../db.func.php';
header('Content-Type: application/json');
ob_start(); // 开启输出缓冲

try {
    $prefix = getDBPrefix();
    $cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
    $where = $cid > 0 ? "WHERE m.cid = $cid" : "";
    $sql = "SELECT m.*, u.username, c.name as cate_name, c.col
            FROM {$prefix}message m
            LEFT JOIN {$prefix}user u ON m.uid = u.id
            LEFT JOIN {$prefix}message_cate c ON m.cid = c.id
            $where
            ORDER BY m.created_at DESC
            LIMIT 50";

    $messages = query($sql);
    if ($messages === false) {
        throw new Exception('数据库查询失败');
    }

    foreach ($messages as &$msg) {
        $msg['created_at'] = time_ago($msg['created_at']);
    }
    unset($msg);

    ob_end_clean(); // 清理缓冲区
    echo json_encode($messages);
} catch (Exception $e) {
    ob_end_clean();
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

// 时间格式化函数
function time_ago($datetime) {
    $time = strtotime($datetime);
    $diff = time() - $time;
    
    $units = [
        31536000 => '年',
        2592000 => '月',
        604800 => '周',
        86400 => '天',
        3600 => '小时',
        60 => '分钟',
        1 => '秒'
    ];

    foreach ($units as $sec => $unit) {
        if ($diff >= $sec) {
            $value = floor($diff / $sec);
            return $value . $unit . '前';
        }
    }
    return '刚刚';
}