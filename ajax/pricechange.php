<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$todaytime=date("Y-m-d");
$select=$_GET['select'];
$price1=$_GET['price1'];
$price2=$_GET['price2'];


$price1_1="[".$todaytime."]".$price1;

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

if($select==1){
	$selectprice="price";
	$selectoldprice="oldprice";
}elseif($select==2){
	$selectprice="sellprice";
	$selectoldprice="oldsellprice";
}
mysqli_query($conn,"UPDATE `t_poprice` SET $selectoldprice='$price1_1', $selectprice='$price2' WHERE $selectprice='$price1'");


$conn->close();
?>