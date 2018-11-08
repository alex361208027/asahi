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
$remark=$_GET['remark'];
mysqli_query($conn,"UPDATE `t_poteacher` SET remark='$remark' WHERE _id = '$_id'");
if($customer_id){
	mysqli_query($conn,"UPDATE `t_teacher` SET remark='$remark' WHERE _id='$customer_id' AND po_id='$_id'");
		}
echo "<marquee scrolldelay='200'>".$remark."</marquee>";
?>
