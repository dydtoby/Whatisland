<?php
// 1. 删除当前登录用户的session
require '../tools.func.php';

deleteSession('admin');

header('location: login.php');
