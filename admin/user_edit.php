<?php
require '../db.func.php';
require '../tools.func.php';
require 'auth.php';
// 1. 接收id
$id = intval($_GET['id']);
if (empty($id)) {
	header('location: users.php');
}
// 2. 根据id查询用户
$prefix = getDBPrefix();
$sql = "SELECT id,username,age,email,phone,name,jf,uid
				FROM {$prefix}user WHERE id = '$id'";
$current_user = queryOne($sql);
if (empty($current_user)) {
  header('location: users.php');
}
// 3. 将查询出的用户的数据放入到表单当中
// 4. 判断是否为post提交
if (!empty($_POST['username'])) {
  // 5. 接收post数据
	// $name = htmlentities($_POST['name']);
	// $age = htmlentities($_POST['age']);
	// $email = htmlentities($_POST['email']);
	// $phone = htmlentities($_POST['phone']);
	$username = htmlentities($_POST['username']);
	$jf = htmlentities($_POST['jf']);
	$password = htmlentities($_POST['password']);
	$uid = htmlentities($_POST['uid']);
	// 验证用户名
    if (strlen($username) < 3) {
        setInfo('用户名必须至少3位字符');
    } elseif (preg_match('/^[0-9]+$/', $username)) {
        setInfo('用户名不能是纯数字');
    } elseif (!preg_match('/^[a-zA-Z]/', $username)) {
        setInfo('用户名必须以字母开头');
    }
    // 验证密码强度
    // elseif (strlen($password) < 8) {
    //     setInfo('密码必须至少8位');
    // } elseif (!preg_match('/[A-Z]/', $password)) {
    //     setInfo('密码必须包含至少一个大写字母');
    // } elseif (!preg_match('/[a-z]/', $password)) {
    //     setInfo('密码必须包含至少一个小写字母');
    // } elseif (!preg_match('/[0-9]/', $password)) {
    //     setInfo('密码必须包含至少一个数字');
    // } elseif (!preg_match('/[^a-zA-Z0-9]/', $password)) {
    //     setInfo('密码必须包含至少一个特殊字符');
    // }
    // 验证UID是否为纯数字且不重复
    elseif (!preg_match('/^[0-9]+$/', $uid)) {
        setInfo('UID必须为纯数字');
    } else {
        // 检查UID是否已存在
        $sql = "SELECT id FROM {$prefix}user WHERE uid = '$uid'";
		$res = queryOne($sql);
        if ($res&& $uid!==$current_user['uid']) {
            setInfo('该UID已被使用，请换一个');
        } else {
	// 6. 更新数据记录
	// $sql = "UPDATE {$prefix}user
	// 				SET username = '$username', uid = '$uid', jf = '$jf', password = '$password'
	// 				WHERE id = '$id'";
	$sql = "UPDATE {$prefix}user
	SET username = '$username', uid = '$uid', jf = '$jf'
	WHERE id = '$id'";
	if (execute($sql)) {
    $current_user = array_merge($current_user, $_POST);
		setInfo('更新成功');
	} else {
		setInfo('更新失败');
	}
}
	}
	// 7. 显示结果
}


require 'header.php';
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-primary">
				<h4 class="card-title">修改用户</h4>
				<p class="card-category">修改一个用户</p>
			</div>
			<div class="card-body">
			<p style="color:#c00";><?php if (hasInfo()) echo getInfo(); ?></p>
				<form action="user_edit.php?id=<?php echo $id; ?>" method="post">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">用户名</label>
								<input type="text" name="username" value="<?php echo $current_user['username']; ?>"  class="form-control">
							</div>
						</div>
						<div class="col-md-6" style="display:none;">
							<div class="form-group">
								<label class="bmd-label-floating">密码</label>
								<input type="password" name="password" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6" style="display:none;">
							<div class="form-group">
								<label class="bmd-label-floating">姓名</label>
								<input type="text" name="name" value="<?php echo $current_user['name']; ?>" class="form-control">
							</div>
						</div>
						<div class="col-md-6"  style="display:none;">
							<div class="form-group">
								<label class="bmd-label-floating">年龄</label>
								<input type="number" name="age" value="<?php echo $current_user['age']; ?>" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">奶油值</label>
								<input type="number" name="jf"  value="<?php echo $current_user['jf']; ?>" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="bmd-label-floating">uid</label>
								<input type="number" name="uid"  value="<?php echo $current_user['uid']; ?>" class="form-control">
							</div>
						</div>
					</div>
					<div class="row"  style="display:none;">
						<div class="col-md-12">
							<div class="form-group">
								<label class="bmd-label-floating">联系电话</label>
								<input type="text" name="phone" value="<?php echo $current_user['phone']; ?>" class="form-control">
							</div>
						</div>
					</div>
					<div class="row"  style="display:none;">
						<div class="col-md-12">
							<div class="form-group">
								<label class="bmd-label-floating">电子邮箱</label>
								<input type="email" name="email" value="<?php echo $current_user['email']; ?>" class="form-control">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary pull-right">更新信息</button>
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
	</div>

</div>
<?php
require 'footer.php';
?>