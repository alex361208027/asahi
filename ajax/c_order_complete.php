<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id =$_GET['_id'];
$t1 =$_GET['t1'];$ot1 =$_GET['ot1'];
$t2 =$_GET['t2'];$ot2 =$_GET['ot2'];
$t3 =$_GET['t3'];
$t5 =$_GET['t5'];

mysqli_query($conn,"UPDATE `t_student` SET campany='$t1', ordernum='$t2', orderdate='$t3', remark='$t5' WHERE _id='$_id'");
mysqli_query($conn,"UPDATE `t_teacher` SET campany='$t1', ordernum='$t2' WHERE campany='$ot1' AND ordernum='$ot2'");
mysqli_query($conn,"UPDATE `t_poteacher` SET campany='$t1', campanyorder='$t2' WHERE campany='$ot1' AND campanyorder='$ot2'");
?>