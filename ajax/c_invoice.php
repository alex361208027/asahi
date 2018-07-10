<?php
date_default_timezone_set('PRC');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$checked=$_GET['checked'];
$_id=$_GET['_id'];
$thedate=$_GET['thedate'];
if(!$thedate){
	$thedate=date('Y-m-d');
}
if($checked){
mysqli_query($conn,"UPDATE `t_teacher` SET invoice='$thedate' WHERE _id = '$_id'");
echo "已开具";
}else{
mysqli_query($conn,"UPDATE `t_teacher` SET invoice='' WHERE _id = '$_id'");	
echo "<font color='red'>已取消</font>";
}

$conn->close();
?>
