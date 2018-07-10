<?php
date_default_timezone_set('PRC');
$today=$_GET['today'];
$today=date('ymd',strtotime($today));

$asahiorder="PO".$today;

function fun($fun){
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "asahi";
	$conn = new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset ($conn,utf8);
	$sql="SELECT * FROM `t_postudent` WHERE asahiorder = '$fun'";
	$result = mysqli_query($conn,$sql);
	if($result->num_rows == 0){
		return "0";
	}else{
		return "1";
	}
	
}

for($i=1;$i<99;$i++){
	
	if(fun($asahiorder)=="1"){
		$asahiorder="PO".$today."0";
		$asahiorder=$asahiorder.$i;
	}else{
		echo $asahiorder;
		break;
	}
}
?>