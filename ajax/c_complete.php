<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$checked=$_GET['checked'];
$_id=$_GET['_id'];
if($checked){
mysqli_query($conn,"UPDATE `t_teacher` SET state='完成' WHERE _id = '$_id'");
echo "<div class='classcp1' style='background-color:blue'>完成</div>";
}else{
mysqli_query($conn,"UPDATE `t_teacher` SET state='' WHERE _id = '$_id'");	
echo "<div class='classcp1' style='background-color:blue'>取消完成</div>";
}

$conn->close();
?>
