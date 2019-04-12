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
	mysqli_query($conn,"UPDATE `t_poteacher` SET campanyorder='', hopedate='', customer_id='' WHERE campany='$delete1' AND campanyorder ='$delete2'");
	
	$delete="删除了 ".$delete1."的订单".$delete2;
	mysqli_query($conn,"INSERT INTO `t_note`(`user`, `note`, `time`, `remark`) VALUES ('{$_COOKIE['asahiuser']}','$delete','$todaytime',8)");
	mysqli_query($conn,"DELETE FROM `t_note` WHERE remark = 8 order by time asc LIMIT 1");

$conn->close();
?>