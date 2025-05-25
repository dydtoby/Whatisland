<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';
$current_user = getSession('admin');

//1.判断是否为post提交
if (!empty($_POST['adminpass'])) {
  //2.验证新密码和确认密码是否一致
	$adminpass = md5(htmlentities($_POST['adminpass']));
	$newpass = htmlentities($_POST['newpass']);
	$confirmpass = htmlentities($_POST['confirmpass']);
	if ($newpass != $confirmpass) {
		setInfo('两次密码输入不一致');
	} else {
    //3.验证旧密码是否正确 （查询数据库 用id，adminpass）
    $prefix = getDBPrefix();
    $sql = "SELECT id FROM {$prefix}admin 
				WHERE id = '{$current_user['id']}' 
				AND adminpass = '$adminpass'
				";
    $res = queryOne($sql);
    //4.更新数据表 imooc_admin adminpass
    if ($res) {
      $pass = md5($newpass);
      $sql = "UPDATE {$prefix}admin 
				SET adminpass = '$pass'
				WHERE id = '{$current_user['id']}'";
      if (execute($sql)) {
          setInfo('修改密码成功');
      } else {
          setInfo('修改密码失败');
      }
    } else {
        setInfo('旧密码不正确！');
    }
	}

	//5.显示结果到页面
}



require 'header.php';
?>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header card-header-primary">
				<h4 class="card-title">修改密码</h4>
				<p class="card-category">修改当前管理员密码</p>
			</div>
			<div class="card-body">
			<p style="color:#c00";><?php if (hasInfo()) echo getInfo(); ?></p>
				<form action="admin_edit.php" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="bmd-label-floating">用户名</label>
								<input type="text" disabled name="adminuser" value="<?php echo $current_user['adminuser']; ?>" class="form-control">
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="bmd-label-floating">旧密码</label>
								<input type="password" name="adminpass" class="form-control">
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="bmd-label-floating">新密码</label>
								<input type="password" name="newpass" class="form-control">
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="bmd-label-floating">确认密码</label>
								<input type="password" name="confirmpass" class="form-control">
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-primary pull-right">修改</button>
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
	</div>

</div>
<?php
require 'footer.php';
?>
