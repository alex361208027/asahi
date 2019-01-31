<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id=$_GET['_id'];$po_id=$_GET['po_id'];
$quantity=$_GET['quantity'];
mysqli_query($conn,"UPDATE `t_teacher` SET quantity='$quantity' WHERE _id = '$_id' limit 1");
if($po_id){
	mysqli_query($conn,"UPDATE `t_poteacher` SET quantity='$quantity' WHERE _id='$po_id' AND customer_id='$_id' limit 1");
		}
echo $quantity;




$conn->close();
?>
