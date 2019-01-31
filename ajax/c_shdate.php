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
$SHdate=$_GET['shdate'];
mysqli_query($conn,"UPDATE `t_teacher` SET `SHdate`='$SHdate' WHERE _id = '$_id' limit 1");
echo $SHdate;
?>
