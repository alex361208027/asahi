<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');
$delete1 =$_GET['delete1'];$delete2 =$_GET['delete2'];

	mysqli_query($conn,"DELETE FROM `t_student` WHERE campany='{$delete1}' AND ordernum ='{$delete2}'");
	mysqli_query($conn,"DELETE FROM `t_teacher` WHERE campany='{$delete1}' AND ordernum ='{$delete2}'");
	mysqli_query($conn,"INSERT INTO `t_note`(`user`, `note`, `time`, `remark`) VALUES ('删除订单','{$_COOKIE['asahiuser']}删除了【{$delete1}】的订单【{$delete2}】','$todaytime','1')");


$conn->close();
?>