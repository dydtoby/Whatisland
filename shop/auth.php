<?php
if (empty(getSession('username', 'shop'))) {
    echo "<script>alert('请先登录');location.href='login.php';</script>";
    exit;
}