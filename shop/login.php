<?php
session_start();
require '../tools.func.php';
require '../db.func.php';
// 判断当前是否为POST提交
if (!empty($_POST['username'])) {
    // 验证码检查
    if (empty($_POST['captcha']) || strtolower($_POST['captcha']) !== $_SESSION['captcha']) {
        setInfo('验证码错误|CAPTCHA error');
        header('Location: login.php');
        exit;
    }
    unset($_SESSION['captcha']);

    $action = htmlentities($_GET['action']);
    $prefix = getDBPrefix();
    $username = htmlentities($_POST['username']);
    $password = hash('sha256', $_POST['password']);
    $sql = "SELECT id, username 
            FROM {$prefix}user
            WHERE username = '$username' AND password = '$password'";
    $res = queryOne($sql);
    if ($res) {
        setSession('shop', ['username' => $username, 'id' => $res['id']]);
        header('location: index.php');
    } else {
        setInfo('用户名或者密码错误Wrong username or password');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录|Login</title>
    <link rel="stylesheet" href="./css/login.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    body {
        background-image: url('./images/banner1.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        /* background-position: center center; */
        height: 100vh;
        margin: 0;
    }
    .m_left a{color: #fcdde0;}
    .captcha-group {
        margin: 15px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .captcha-img {
        border: 1px solid #ddd;
        cursor: pointer;
    }
    .captcha-input {
        flex: 1;
        padding: 8px;
        border: 1px solid #ddd;
    }
    </style>
</head>
<body>
  <div class="mask"></div>
  <div class="main">
       <div class="m_left">
       <h1><a href="index.php">CREAM</a><p>登录|login</p></h1>
   </div>
 <div class="container">
        <h2>登录|login</h2>
        <form action="login.php" method="post" class="formCon">
            <div class="input-group">
                <label for="username">用户名<br>User ID</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password" class="pw">密码PW</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label>验证码<br>CAPTCHA</label>
                <div class="captcha-group">
                    <input type="text" name="captcha" class="captcha-input" 
                           placeholder="输入验证码Enter Captcha" required>
                    <img id="captcha-img" src="captcha.php" 
                         class="captcha-img" 
                         onclick="refreshCaptcha()" 
                         title="点击刷新验证码Click to fresh">
                </div>
            </div>
            <button type="submit">登录|login</button>
            
            <p style="text-align:center; color:#555;">
            <p>没有账号？<a href="register.php">立即注册</a><br>No account？<a href="register.php">Register Now</a></p>
            忘记密码请联系<br>Forgot your password?please contact<br>
            <a href="mailto:3190754144@qq.com">3190754144@qq.com</a>/QQ:<a href="tencent://AddContact/?fromId=45&fromSubId=1&subcmd=all&uin=3190754144&website=www.oicqzone.com">3190754144</a>
            </p>
            <p style="color:#c00;"><?php if (hasInfo()) echo getInfo(); ?></p>
        </form>
    </div>
  </div>
  <script>
    function refreshCaptcha() {
        document.getElementById('captcha-img').src = 'captcha.php?' + Date.now();
    }
  </script>
  <script>
</body>
</html>