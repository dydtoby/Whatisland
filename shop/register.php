<?php
session_start(); 
    require '../tools.func.php';
    require '../db.func.php';
    if (!empty($_POST['username'])) {
        if(empty($_POST['captcha']) || strtolower($_POST['captcha']) !== $_SESSION['captcha']) {
            setInfo('验证码错误CAPTCHA error');
            header('Location: register.php');
            exit;
        }
    
        unset($_SESSION['captcha']);
        $action = htmlentities($_GET['action']);
        $prefix = getDBPrefix();
        $password = hash('sha256', $_POST['password']);
        $rePassword = hash('sha256', $_POST['rePassword']);
        $uid = htmlentities($_POST['uid']);
        if($password===$rePassword){
            $username = htmlentities($_POST['username']);
            $sql = "SELECT username
                FROM {$prefix}user WHERE username = '$username'";
            $current_user = queryOne($sql);
            if (empty($current_user)) {
                $email = htmlentities($_POST['email']);
        
                $created_at = date('Y-m-d H:i:s');
                
                $checkUidSql = "SELECT uid FROM {$prefix}user WHERE uid = '$uid'";
                $existUid = queryOne($checkUidSql);
                if ($existUid) {
                    setInfo('该UID已被注册使用|This UID has been registered for use');
                    header('Location: register.php');
                    exit;
                }
                $sql = "INSERT INTO {$prefix}user (username, password, uid, created_at,images)
                VALUES('$username', '$password', '$uid', '$created_at','i3.png')";
                if (execute($sql)) {
                    setInfo('注册成功Success');
                    header('location: login.php');
                } else {
                    setInfo('注册失败Fail');
                }
            }
            else{
                setInfo('该用户已被注册|This user is already registered');
            }
        }
        else{
            setInfo('两次输入的密码不一致Not the same password');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册|register</title>
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
        background-size: cover; /* 使背景图片覆盖整个容器 */
        background-repeat: no-repeat; /* 防止背景图片重复 */
        /*background-position: center center; */
        height: 100vh; /* 使body高度为视口高度 */
        margin: 0; /* 去除body默认的外边距 */
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
<script>
    // 点击刷新验证码
    function refreshCaptcha() {
        document.getElementById('captcha-img').src = 'captcha.php?' + Date.now();
    }
    </script>
<body>
  <div class="mask"></div>
  <div class="main">
       <div class="m_left">
       <h1><a href="index.php">CREAM</a>
        <p>注册|register</p>
       </h1>
   </div>
 <div class="container">
        <h2>注册|register</h2>
        <form action="register.php" method="post" class="formCon"   onsubmit="return validateForm()">
            <div class="input-group">
                <label for="username">用户名User</label>
                <input type="text" id="username" name="username" required placeholder="请输入用户名Eenter user ID">
            </div>
            <div class="input-group">
                <label for="username">uid</label>
                <input type="text" id="uid" name="UID" required required placeholder="请输入b站UIDEnter bilibili.com's UID">
            </div>
            <div class="input-group">
                <label for="password" class="pw">密码pw</label>
                <input type="password" id="password" name="password" required required placeholder="至少包含一个数字，特殊符号，大写和小写字母">
            </div>
            <p>At least: 1 number, 1 symbol, 1 uppercase, 1 lowercase</p>
            <div class="input-group">
                <label for="rePassword" class="pw">确认密码<br>Repeat pw</label>
                <input type="password" id="rePassword" name="rePassword" required
                placeholder="两次密码保持一致Keep the same password for both times">
            </div>
            <div class="input-group">
                <label>验证码<br>CAPTCHA</label>
                <div class="captcha-group">
                    <input type="text" name="captcha" class="captcha-input" 
                           placeholder="输入验证码" required>
                    <img id="captcha-img" src="captcha.php" 
                         class="captcha-img" 
                         onclick="refreshCaptcha()" 
                         title="点击刷新验证码|Click to refresh">
                </div>
            </div>
            <button type="submit">注册|Register</button>
            <p>已有账号？<a href="login.php">立即登录</a></p>
            <p>Have Account？<a href="login.php">login</a></p>
            <p style="color:#c00;"><?php if (hasInfo()) echo getInfo(); ?></p>
        </form>
    </div>
  </div>
  <script>
  function validateForm() {
    // 用户名校验
    const username = document.getElementById('username').value.trim();
    const usernameRegex = /^(?![0-9]+$)[a-zA-Z0-9]{3,}$/;
    if (!usernameRegex.test(username)) {
        alert('用户名需3位以上英文数字组合，且不能为纯数字User name should be a combination of 3 or more alphanumeric digits, and cannot be a pure number.');
        return false;
    }

    const uid = document.getElementById('uid').value.trim();
    const uidRegex = /^\d+$/;
    if (!uidRegex.test(uid)) {
        alert('UID必须为纯数字|UID must be a plain number');
        return false;
    }
    // 密码校验
    const password = document.getElementById('password').value;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;
    if (!passwordRegex.test(password)) {
        alert('密码需包含大小写字母、数字和特殊字符，且至少8位|The password should contain upper and lower case letters, numbers and special characters and should be at least 8 digits long.');
        return false;
    }

    return true;

}
  </script>
</body>
</html>