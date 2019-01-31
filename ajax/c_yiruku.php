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
$check=$_GET['check'];
if($check){
	mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder2='' WHERE _id = '$_id' limit 1");
}else{
	mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder2='已入库' WHERE _id = '$_id' limit 1");
}

$conn->close();
?>
