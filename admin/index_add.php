<?php
require '../tools.func.php';
require '../db.func.php';
require 'auth.php';

if (!empty($_POST['adminuser'])) {
    // 1. 接收post数据
    $adminuser = htmlentities($_POST['adminuser']);
    $adminpass = trim($_POST['adminpass']);
    $confirmpass = trim($_POST['confirmpass']);
    $created_at = date('Y-m-d H:i:s');
    $prefix = getDBPrefix();
    
    // 验证用户名
    // if (strlen($adminuser) < 3) {
    //     setInfo('用户名必须至少3位字符');
    // } elseif (preg_match('/^[0-9]+$/', $adminuser)) {
    //     setInfo('用户名不能是纯数字');
    // } elseif (!preg_match('/^[a-zA-Z]/', $adminuser)) {
    //     setInfo('用户名必须以字母开头');
    // }
    // // 验证密码强度
    // elseif (strlen($adminpass) < 8) {
    //     setInfo('密码必须至少8位');
    // } elseif (!preg_match('/[A-Z]/', $adminpass)) {
    //     setInfo('密码必须包含至少一个大写字母');
    // } elseif (!preg_match('/[a-z]/', $adminpass)) {
    //     setInfo('密码必须包含至少一个小写字母');
    // } elseif (!preg_match('/[0-9]/', $adminpass)) {
    //     setInfo('密码必须包含至少一个数字');
    // } elseif (!preg_match('/[^a-zA-Z0-9]/', $adminpass)) {
    //     setInfo('密码必须包含至少一个特殊字符');
    // }
    // 验证两次密码是否一致
    // elseif ($adminpass != $confirmpass) {
    if ($adminpass != $confirmpass) {
        setInfo('两次密码输入不一致');
    } else {
        // 检查用户名是否已存在
        $sql = "SELECT id FROM {$prefix}admin WHERE adminuser = '$adminuser'";
        $res = queryOne($sql);
        if ($res) {
            setInfo('该用户名已被使用，请换一个');
        } else {
            // 密码加密
            $adminpass = hash('sha256', $adminpass);
            
            // 插入数据
            $sql = "INSERT INTO {$prefix}admin(adminuser, adminpass, created_at)
                    VALUES('$adminuser', '$adminpass', '$created_at')";
            
            if (execute($sql)) {
                setInfo('添加成功');
                header('location: index.php');
                exit;
            } else {
                setInfo('添加失败');
            }
        }
    }
}

require 'header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">添加管理员</h4>
                <p class="card-category">添加一个新的管理员</p>
            </div>
            <div class="card-body">
                <p style="color:#c00"><?php if (hasInfo()) echo getInfo(); ?></p>
                <form action="index_add.php" method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">用户名</label>
                                <input type="text" name="adminuser" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">密码</label>
                                <input type="password" name="adminpass" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bmd-label-floating">确认密码</label>
                                <input type="password" name="confirmpass" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">添加管理员</button>
                    <a href="index.php" class="btn btn-default pull-right" style="margin-right: 10px;">返回</a>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require 'footer.php';
?>