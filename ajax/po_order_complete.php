<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id =$_GET['_id'];
$t1 =$_GET['t1'];$ot1 =$_GET['ot1'];
$t2 =$_GET['t2'];
$t4 =$_GET['t4'];

mysqli_query($conn,"UPDATE `t_postudent` SET asahiorder='$t1', orderdate='$t2', remark='$t4' WHERE _id='$_id' limit 1");
mysqli_query($conn,"UPDATE `t_poteacher` SET asahiorder='$t1' WHERE asahiorder='$ot1'");
mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder='$t1' WHERE asahiorder='$ot1'");

$conn->close();
?>