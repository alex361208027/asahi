<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id=$_GET['_id'];$state=$_GET['state'];

if($_id){
	if($state==0){
mysqli_query($conn,"UPDATE `t_poprice` SET state=1 WHERE _id='$_id' limit 1");
	}elseif($state==1){
mysqli_query($conn,"UPDATE `t_poprice` SET state=0 WHERE _id='$_id' limit 1");		
	}
}

$conn->close();
?>