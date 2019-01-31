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
$sql =  "SELECT * FROM `t_inout` WHERE _id = '$_id' limit 1";
$result = mysqli_query($conn,$sql);
$row=$result->fetch_row();
$quantity=$_GET['quantity'];
$restquantity=$row[2]-$quantity;
mysqli_query($conn,"INSERT INTO `t_inout`(`lotnum`, `banngo`, `quantity`, `intime`,`outtime`,`outquantity`, `campany`,`expressnum`, `remark`, `asahipo` ) VALUES ('$row[0]','$row[1]','$quantity','$row[3]','$row[4]','$row[5]','$row[6]','$row[7]','$row[8]','$row[10]')");
mysqli_query($conn,"UPDATE `t_inout` SET quantity='$restquantity' WHERE _id = '$_id' limit 1");

	
	
$conn->close();
?>