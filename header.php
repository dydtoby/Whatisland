<?php
$script = basename($_SERVER['SCRIPT_FILENAME']);
require '../tools.func.php';
require '../db.func.php';
$username = getSession('username', 'shop');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <title>Cream广场</title>
</head>
<body>
    <!-- <section class="banner"> -->
        <!-- <div class="bannerImg" style="background-image:url('./images/banner1.jpg');"></div> -->
        <nav>
            <ul class="topUl">
                <?php if (empty($username)): ?>
                <li>
                    <a href="./login.php">登录</a>
                </li>
                <li>
                    <a href="./register.php">注册</a>
                </li>
                <?php else: ?>
            <li>  <a href="cart.php" style="margin-right:20px;">购物车</a></li>
                <!-- <li href="cart.php" style="margin-right:20px;">购物车</li> -->
                欢迎回来， <?php echo $username; ?> <li><a href="logout.php"  onclick="return confirm('确认退出？')">退出</a></li>
                <?php endif; ?>
            </ul>
            <ul class="FirstUl">
                <li class="has-submenu <?php echo substr($script, 0, 5) == 'index' ? 'hover' : ''; ?>"><a href="./index.php">Cream广场</a>
                    <ul class="SecondUl">
                        <li class="<?php echo $script === 'index_bwg.php' ? 'hover' : ''; ?>">
                            <a href="./index_bwg.php">奶油星物馆</a>
                        </li>
                        <!-- <li class="<?php echo $script === 'index_ly.php' ? 'hover' : ''; ?>">
                            <a href="./index_ly.php">米莉可乐园</a>
                        </li> -->
                        <li class="<?php echo $script === 'index_xyc.php' ? 'hover' : ''; ?>">
                            <a href="./index_xyc.php">许愿池</a>
                        </li>
                    </ul>
                </li>
                <li  class="has-submenu <?php echo substr($script, 0, 4) == 'shop' ? 'hover' : ''; ?>"><a href="#" >奶油商店街</a>
                    <ul class="SecondUl">
                    <!-- <li class="<?php echo $script === 'shop_xny.php' ? 'hover' : ''; ?>">
                            <a href="./shop_xny.php">小奶油的商铺</a>
                        </li>
                        <li class="<?php echo $script === 'shop_jys.php' ? 'hover' : ''; ?>">
                            <a href="./shop_jys.php">岛民交易所</a>
                        </li> -->
                        <li class="<?php echo $script === 'shop_blank.php' ? 'hover' : ''; ?>">
                            <a href="./shop_blank.php">鼠鼠银行</a>
                        </li>
                        <li class="<?php echo $script === 'shop_list.php' ? 'hover' : ''; ?>">
                            <a href="./shop_list.php">小奶油商城</a>
                        </li>
                    </ul>
                </li>
                <li  <?php echo substr($script, 0, 3) == 'sea' ? 'hover' : ''; ?>><a href="./sea.php">岛民海景房</a></li>
                <li  <?php echo substr($script, 0, 2) == 'tu' ? 'hover' : ''; ?>><a href="./tu.php">兔堡堡</a></li>
                <li  <?php echo substr($script, 0, 5) == 'about' ? 'hover' : ''; ?>><a href="./about.php">关于</a></li>
            </ul>
        </nav>
    <!-- </section> -->