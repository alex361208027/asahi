<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$select=$_GET['select'];
$price1=$_GET['price1'];$price2=$_GET['price2'];

if($select==1){
	$selectprice="price";
}elseif($select==2){
	$selectprice="sellprice";
}
mysqli_query($conn,"UPDATE `t_poprice` SET oldprice='$price1', $selectprice='$price2' WHERE $selectprice='$price1'");


$conn->close();
?>