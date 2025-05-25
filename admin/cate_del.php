<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';

$prefix = getDBPrefix();
$id = intval($_GET['id']);

// 执行删除
$sql = "DELETE FROM {$prefix}message_cate WHERE id = '$id'";
if (execute($sql)) {
    setInfo('删除成功');
} else {
    setInfo('删除失败');
}

header('Location: cate_list.php');
exit;
?>