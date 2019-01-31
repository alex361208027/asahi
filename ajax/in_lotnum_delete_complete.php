<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$_id=$_GET['_id'];
mysqli_query($conn,"DELETE FROM `t_inout` WHERE _id ='$_id' limit 1");
echo "已删除,正在刷新...";
$conn->close();
?>