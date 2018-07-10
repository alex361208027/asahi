<?php
date_default_timezone_set('PRC');


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$name=$_GET['name'];
$campany=$_GET['campany'];
$name=mb_substr($name,0,3);
$campany=mb_substr($campany,0,2);
$sql="SELECT * FROM `t_namecard` WHERE name like '%$name%' AND campany like '%$campany%'";
$result = mysqli_query($conn,$sql);
if($result->num_rows == 0){
	echo "";
}else{
	echo 66;
	}

$conn->close();
?>