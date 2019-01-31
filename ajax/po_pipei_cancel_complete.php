<?php
date_default_timezone_set('PRC');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$asahi_id=$_GET['_id'];
$sql =  "SELECT * FROM `t_poteacher` WHERE _id = '$asahi_id' limit 1";
$result = mysqli_query($conn,$sql);
$asahi_row=$result->fetch_row();
mysqli_query($conn,"UPDATE `t_poteacher` SET campanyorder='', hopedate='', customer_id='' WHERE _id='$asahi_row[9]' limit 1");
if($asahi_row[10]){
	mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder='', JPdate='',SHdate='',po_id='' WHERE _id = '$asahi_row[10]' limit 1");
}




$conn->close();
?>
