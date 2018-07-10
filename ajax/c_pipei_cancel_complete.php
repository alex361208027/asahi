<?php
date_default_timezone_set('PRC');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$customer_id=$_GET['_id'];
$sql =  "SELECT * FROM `t_teacher` WHERE _id = '$customer_id'";
$result = mysqli_query($conn,$sql);
$customer_row=$result->fetch_row();
mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder='', JPdate='',SHdate='',po_id='' WHERE _id = '$customer_row[12]'");
if($customer_row[13]){
	mysqli_query($conn,"UPDATE `t_poteacher` SET campanyorder='', hopedate='', customer_id='' WHERE _id='$customer_row[13]'");
}




$conn->close();
?>
