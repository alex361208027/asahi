<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$_id=$_POST['id'];
$onoff=$_POST['onoff'];

if($onoff==1){
	$onoff="";
	echo "";
}else{
	$onoff=1;
	echo 1;
}

mysqli_query($conn,"UPDATE t_poteacher SET pipei='$onoff' WHERE _id='$_id' limit 1");

$conn->close();
?>
