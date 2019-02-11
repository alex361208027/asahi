<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');
$delete =$_GET['delete'];

mysqli_query($conn,"DELETE FROM `t_postudent` WHERE asahiorder='$delete'");
mysqli_query($conn,"DELETE FROM `t_poteacher` WHERE asahiorder='$delete'");
//mysqli_query($conn,"INSERT INTO `t_note`(`user`, `note`, `time`, `remark`) VALUES ('删除订单','{$_COOKIE['asahiuser']}删除了【朝日】订单【{$delete}】','$todaytime','1')");
$delete="删除了 朝日订单".$delete;
mysqli_query($conn,"INSERT INTO `t_note`(`user`, `note`, `time`, `remark`) VALUES ('{$_COOKIE['asahiuser']}','$delete','$todaytime',7)");
mysqli_query($conn,"DELETE FROM `t_note` WHERE remark = 7 order by time asc LIMIT 1");

$conn->close();
?>