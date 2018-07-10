<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$mynote=$_GET['mynote'];
//$mynote = preg_split('/\r\n/',$_GET['mynote']);


if($mynote){
	$mynote=str_replace("\r\n","<br>",$mynote);
	mysqli_query($conn,"UPDATE `t_note` SET note='$mynote', time='$todaytime' WHERE user ='{$_COOKIE['asahiuser']}' AND remark = 0");
}


$conn->close();
?>
