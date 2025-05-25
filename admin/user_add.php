<?php
require '../tools.func.php';
require '../db.func.php';
require 'auth.php';
if (!empty($_POST['username'])) {
    // 1. 接收post数据
    $username = htmlentities($_POST['username']);
    $password =trim($_POST['password']);
    $confirmpass =trim($_POST['confirmpass']);
    $name = htmlentities($_POST['name']);
    $age = htmlentities($_POST['age']);
    $email = htmlentities($_POST['email']);
    $phone = htmlentities($_POST['phone']);
    $jf = htmlentities($_POST['jf']);
    $uid = htmlentities($_POST['uid']);
    $created_at = date('Y-m-d H:i:s');
    $prefix = getDBPrefix();
    
    // 验证用户名
    if (strlen($username) < 3) {
        setInfo('用户名必须至少3位字符');
    } elseif (preg_match('/^[0-9]+$/', $username)) {
        setInfo('用户名不能是纯数字');
    } elseif (!preg_match('/^[a-zA-Z]/', $username)) {
        setInfo('用户名必须以字母开头');
    }
    // 验证密码强度
    elseif (strlen($password) < 8) {
        setInfo('密码必须至少8位');
    } elseif (!preg_match('/[A-Z]/', $password)) {
        setInfo('密码必须包含至少一个大写字母');
    } elseif (!preg_match('/[a-z]/', $password)) {
        setInfo('密码必须包含至少一个小写字母');
    } elseif (!preg_match('/[0-9]/', $password)) {
        setInfo('密码必须包含至少一个数字');
    } elseif (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        setInfo('密码必须包含至少一个特殊字符');
    }
    // 验证两次密码是否一致
    elseif ($password != $confirmpass) {
        setInfo('两次密码输入不一致');
    }
    // 验证UID是否为纯数字且不重复
    elseif (!preg_match('/^[0-9]+$/', $uid)) {
        setInfo('UID必须为纯数字');
    } else {
        // 检查UID是否已存在
        $sql = "SELECT id FROM {$prefix}user WHERE uid = '$uid'";
        $res = queryOne($sql);
        if ($res) {
            setInfo('该UID已被使用，请换一个');
        } else {
			// $password = md5($password);
			$password =hash('sha256', $password);
            // 3. 写sql语句
            // // $sql = "INSERT INTO {$prefix}user(username, password, age, name, email, phone, created_at,jf,uid)
			// //         VALUES('$username', '$password', '$age', '$name', '$email', '$phone', '$created_at','$jf','$uid')";
			$sql = "INSERT INTO {$prefix}user (username, password,  created_at,jf,uid)
					 VALUES('$username', '$password','$created_at','$jf','$uid')";
					//  echo $sql;
            // 4. 执行添加，如果成功，显示成功信息
            if (execute($sql)) {
                setInfo('添加成功');
                header('location: users.php');
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
				<h4 class="card-title">添加用户</h4>
				<p class="card-category">添加一个用户</p>
			</div>
			<div class="card-body">
			<p style="color:#c00";><?php if (hasInfo()) echo getInfo(); ?></p>
				<form action="user_add.php" method="post">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="bmd-label-floating">用户名</label>
								<input type="text" name="username" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="bmd-label-floating">密码</label>
								<input type="password" name="password" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="bmd-label-floating">确认密码</label>
								<input type="password" name="confirmpass" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="display:none;">
							<div class="form-group">
								<label class="bmd-label-floating">姓名</label>
								<input type="text" name="name" class="form-control">
							</div>
						</div>
						<div class="col-md-6"  style="display:none;">
							<div class="form-group">
								<label class="bmd-label-floating">年龄</label>
								<input type="number" name="age" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">奶油值</label>
								<input type="number" name="jf" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">uid</label>
								<input type="number" name="uid" class="form-control">
							</div>
						</div>
					</div>
					<div class="row" style="display:none;">
						<div class="col-md-12">
							<div class="form-group">
								<label class="bmd-label-floating">联系电话</label>
								<input type="text" name="phone" class="form-control">
							</div>
						</div>
					</div>
					<div class="row" style="display:none;">
						<div class="col-md-12">
							<div class="form-group">
								<label class="bmd-label-floating">电子邮箱</label>
								<input type="email" name="email" class="form-control">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary pull-right">添加用户</button>
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
	</div>

</div>
<?php
require 'footer.php';
?>
