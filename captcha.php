<?php
session_start();

// 创建验证码图片
$width = 120;
$height = 40;
$image = imagecreatetruecolor($width, $height);

// 设置背景色
$bgColor = imagecolorallocate($image, 255, 255, 255);
imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);

// 生成随机验证码
$charset = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
$captchaCode = substr(str_shuffle($charset), 0, 4);
$_SESSION['captcha'] = strtolower($captchaCode);

// 使用内置字体绘制文字
for ($i = 0; $i < 4; $i++) {
    $fontColor = imagecolorallocate($image, rand(0, 100), rand(0, 100), rand(0, 100));
    imagestring(
        $image, 
        5, // 内置字体大小5是最大的
        15 + $i * 20, 
        12, 
        $captchaCode[$i], 
        $fontColor
    );
}

// 添加干扰线
for ($i = 0; $i < 6; $i++) {
    $lineColor = imagecolorallocate($image, rand(150, 250), rand(150, 250), rand(150, 250));
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
}

// 输出图片
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);