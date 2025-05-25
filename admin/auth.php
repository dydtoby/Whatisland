<?php
/**
 * Created by PhpStorm.
 * User: JasonLee
 * Date: 2019/1/23
 * Time: 22:07
 */

if (empty(getSession('adminuser', 'admin'))) {
    header('location: login.php');
    exit;
}