<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$xtime=$_GET['xtime'];

if($xtime){
	mysqli_query($conn,"DELETE FROM `t_note` WHERE time='$xtime' AND remark=1 limit 1");
}


$conn->close();
?>