<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id=$_GET['_id'];
$campany=$_GET['campany'];
$price=$_GET['price'];$sellprice=$_GET['sellprice'];
$reel=$_GET['reel'];$other=$_GET['other'];
if($price){
mysqli_query($conn,"UPDATE `t_poprice` SET campany='$campany', price='$price', sellprice='$sellprice', reel='$reel', other='$other' WHERE _id='$_id'");
echo "ok";
}else{
mysqli_query($conn,"DELETE FROM `t_poprice` WHERE _id='$_id'");	
echo $_id;
}

$conn->close();
?>