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
mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder='', JPdate='',SHdate='',po_id='' WHERE asahiorder='$delete'");


//mysqli_query($conn,"INSERT INTO `t_note`(`user`, `note`, `time`, `remark`) VALUES ('{$_COOKIE['asahiuser']}','$delete','$todaytime',7)");
mysqli_query($conn,"DELETE FROM `t_note` WHERE remark = 7 order by time asc LIMIT 1");


//////////////news
$newstime=date('Y-m-d H:i:s');
$something="删除了 朝日订单".$delete;
mysqli_query($conn,"INSERT INTO `t_news`(`datetime`, `people`, `something`) VALUES ('$newstime','{$_COOKIE['loged']}','$something')");
//////////////news//////

$conn->close();
?>