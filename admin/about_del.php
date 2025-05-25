<?php
require '../db.func.php';
require '../tools.func.php';
require 'auth.php';

$id = intval($_GET['id']);
$prefix = getDBPrefix();
$sql = "DELETE FROM {$prefix}about_list WHERE id = '$id'";
execute($sql);
header('location: aboutList.php');