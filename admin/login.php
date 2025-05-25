<?php
//1.连接数据库 （创建一个数据库，创建数据表 imooc_admin）
//id, adminuser, adminpass, created_at, login_at, login_ip
require '../db.func.php';
require '../tools.func.php';
// POST提交
if (!empty($_POST['adminuser']) && !empty($_POST['adminpass'])) {
    //2.查询用户名和密码是否正确 adminuser adminpass
    $prefix = getDBPrefix();
    $adminuser = htmlentities($_POST['adminuser']);
    $adminpass = htmlentities($_POST['adminpass']);
    
    // 先查询用户是否存在
    $sql = "SELECT id, adminuser, adminpass FROM {$prefix}admin 
            WHERE adminuser = '$adminuser'";
    $res = queryOne($sql);
    
    if ($res) {
        // 对用户输入的密码进行SHA-256加密
        $inputPasswordHash = hash('sha256', $adminpass);
        
        // 比较数据库中的密码哈希和用户输入的密码哈希
        if ($inputPasswordHash === $res['adminpass']) {
            //3.写入session
            setSession('admin',
                ['adminuser' => $adminuser, 'id' => $res['id']]
            );
            $login_at = date('Y-m-d H:i:s');
            $ip = $_SERVER['REMOTE_ADDR'] == '::1' ? '127.0.0.1' : $_SERVER['REMOTE_ADDR'];
            $login_ip = ip2long($ip);
            $sql = "UPDATE {$prefix}admin 
                    SET login_at = '$login_at', login_ip = '$login_ip' 
                    WHERE id = '{$res['id']}'";
            execute($sql);
            //4.跳转到index.php
            header('location: index.php');
            exit;
        } else {
            setInfo('用户名或者密码错误');
        }
    } else {
        setInfo('用户名或者密码错误');
    }
} else {
    setInfo('用户名或者密码不能为空');
}
?>
<!doctype html>
<html>

<head>
  <title>Cream广场</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
</head>

<body>
  <div class="wrapper ">
    <div>
      <div>
        <div class="container" style="width: 50%;margin-top: 250px;">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">登录</h4>
                    <p class="card-category">以管理员身份登录后台</p>
                  </div>
                  <div class="card-body"> 
                  <form action="login.php" method="post">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">用户名</label>
                            <input type="text" name="adminuser" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">密码</label>
                            <input type="password" name="adminpass" class="form-control">
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary pull-right">登录</button>
                      <div class="clearfix"></div>
                    </form>
                    <p style="color:#c00";><?php if (hasInfo()) echo getInfo(); ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
</body>

</html>