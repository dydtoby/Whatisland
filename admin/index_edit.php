<?php
require '../db.func.php';
require '../tools.func.php';
require 'auth.php';

// 1. 接收id
$id = intval($_GET['id']);
if (empty($id)) {
    header('location: index.php');
    exit;
}

// 2. 根据id查询管理员
$prefix = getDBPrefix();
$sql = "SELECT id, adminuser, created_at, login_at, login_ip 
        FROM {$prefix}admin WHERE id = '$id'";
$current_admin = queryOne($sql);

if (empty($current_admin)) {
    header('location: index.php');
    exit;
}

// 3. 判断是否为post提交
if (!empty($_POST['adminuser'])) {
    // 4. 接收post数据
    $adminuser = htmlentities($_POST['adminuser']);
    $adminpass = trim($_POST['adminpass']);
    $confirmpass = trim($_POST['confirmpass']);
    
    // 验证用户名
    // if (strlen($adminuser) < 3) {
    //     setInfo('用户名必须至少3位字符');
    // } elseif (preg_match('/^[0-9]+$/', $adminuser)) {
    //     setInfo('用户名不能是纯数字');
    // } elseif (!preg_match('/^[a-zA-Z]/', $adminuser)) {
    //     setInfo('用户名必须以字母开头');
    // }
    // // 如果有密码修改，验证密码强度
    // elseif (!empty($adminpass) && strlen($adminpass) < 8) {
    //     setInfo('密码必须至少8位');
    // } elseif (!empty($adminpass) && !preg_match('/[A-Z]/', $adminpass)) {
    //     setInfo('密码必须包含至少一个大写字母');
    // } elseif (!empty($adminpass) && !preg_match('/[a-z]/', $adminpass)) {
    //     setInfo('密码必须包含至少一个小写字母');
    // } elseif (!empty($adminpass) && !preg_match('/[0-9]/', $adminpass)) {
    //     setInfo('密码必须包含至少一个数字');
    // } elseif (!empty($adminpass) && !preg_match('/[^a-zA-Z0-9]/', $adminpass)) {
    //     setInfo('密码必须包含至少一个特殊字符');
    // }
    // // 验证两次密码是否一致
    // elseif (!empty($adminpass) && $adminpass != $confirmpass) {
    if (!empty($adminpass) && $adminpass != $confirmpass) {
        setInfo('两次密码输入不一致');
    } else {
        // 检查用户名是否已被其他人使用
        $sql = "SELECT id FROM {$prefix}admin WHERE adminuser = '$adminuser' AND id != '$id'";
        $res = queryOne($sql);
        if ($res) {
            setInfo('该用户名已被使用，请换一个');
        } else {
            // 构建更新SQL
            $updateFields = ["adminuser = '$adminuser'"];
            
            // 如果有密码修改，更新密码
            if (!empty($adminpass)) {
                $adminpass = hash('sha256', $adminpass);
                $updateFields[] = "adminpass = '$adminpass'";
            }
            
            $sql = "UPDATE {$prefix}admin SET " . implode(', ', $updateFields) . " WHERE id = '$id'";
            
            if (execute($sql)) {
                // 更新成功后重新查询当前管理员信息
                $current_admin = queryOne("SELECT * FROM {$prefix}admin WHERE id = '$id'");
                setInfo('更新成功');
            } else {
                setInfo('更新失败');
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
                <h4 class="card-title">编辑管理员</h4>
                <p class="card-category">编辑管理员信息</p>
            </div>
            <div class="card-body">
                <p style="color:#c00"><?php if (hasInfo()) echo getInfo(); ?></p>
                <form action="index_edit.php?id=<?php echo $id; ?>" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">用户名</label>
                                <input type="text" name="adminuser" value="<?php echo $current_admin['adminuser']; ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">创建时间</label>
                                <input type="text" value="<?php echo $current_admin['created_at']; ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">最后登录时间</label>
                                <input type="text" value="<?php echo $current_admin['login_at']; ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">最后登录IP</label>
                                <input type="text" value="<?php echo long2ip($current_admin['login_ip']); ?>" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">新密码（留空则不修改）</label>
                                <input type="password" name="adminpass" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">确认新密码</label>
                                <input type="password" name="confirmpass" class="form-control">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">更新信息</button>
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