<?php
date_default_timezone_set('PRC');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id=$_GET['_id'];
if($_id){
		mysqli_query($conn,"DELETE FROM `t_poteacher` WHERE _id = '$_id'");
		echo "删除成功";
		mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder='', JPdate='',SHdate='',po_id='' WHERE po_id = '$_id'");
}else{
	echo "删除失败";
}
$conn->close();
?>