<?php
require '../tools.func.php';
require '../db.func.php';
ob_start();
header('Content-Type: application/json');
$prefix = getDBPrefix();
$response = ['code' => 200, 'msg' => ''];

try {
    $file_id = intval($_GET['id']);
    $user_id = getSession('id', 'shop');

    // 获取文件信息和用户奶油值
    $sql = "SELECT w.files, w.name, u.jf 
            FROM {$prefix}wp w
            JOIN {$prefix}user u ON w.userid = u.id
            WHERE w.id = '$file_id' AND w.userid = '$user_id'";
    $data = queryOne($sql);

    if (!$data) {
        throw new Exception('文件不存在或无权访问');
    }

    if ($data['jf'] < 10) {
        throw new Exception('奶油值不足，无法下载（需要10奶油值）');
    }

    $filepath = '../uploads/' . $data['files'];
    if (!file_exists($filepath)) {
        throw new Exception('文件不存在');
    }

    // beginTransaction();

    // 扣除奶油值
    $sql = "UPDATE {$prefix}user SET jf = jf - 10 WHERE id = '$user_id'";
    if (!execute($sql)) {
        throw new Exception('奶油值扣除失败');
    }

    // 记录日志
    // $created_at = date('Y-m-d H:i:s');
    // $sql = "INSERT INTO {$prefix}jf_log (userid, amount, type, description, created_at)
    //         VALUES ('$user_id', -10, 'download', '下载文件扣除奶油值', '$created_at')";
    // execute($sql);

    // commit();

    // 准备文件下载
    ob_end_clean();
    header_remove();
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $data['name'] . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    readfile($filepath);
    exit;

} catch (Exception $e) {
    // ob_end_clean();
    // if (inTransaction()) {
    //     rollback();
    // }
    $response['code'] = 400;
    $response['msg'] = $e->getMessage();
    echo json_encode($response);
    exit;
}
?>