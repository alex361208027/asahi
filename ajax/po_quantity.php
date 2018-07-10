<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id=$_GET['_id'];$customer_id=$_GET['customer_id'];
$quantity=$_GET['quantity'];
mysqli_query($conn,"UPDATE `t_poteacher` SET quantity='$quantity' WHERE _id = '$_id'");
if($customer_id){
	mysqli_query($conn,"UPDATE `t_teacher` SET quantity='$quantity' WHERE _id='$customer_id' AND po_id='$_id'");
		}
echo $quantity;




$conn->close();
?>
