<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$_id=$_GET['_id'];
$lotnum=$_GET['lotnum'];
$banngo=$_GET['banngo'];
$intime=$_GET['intime'];
$quantity=$_GET['quantity'];
$outtime=$_GET['outtime'];
$outquantity=$_GET['outquantity'];
$campany=$_GET['campany'];
$expressnum=$_GET['expressnum'];
$remark=$_GET['remark'];
$asahipo=$_GET['asahipo'];

mysqli_query($conn,"UPDATE `t_inout` SET lotnum='$lotnum', banngo='$banngo', intime='$intime', quantity='$quantity', outtime='$outtime', outquantity='$outquantity', asahipo='$asahipo', campany='$campany', expressnum='$expressnum', remark='$remark' WHERE _id = '$_id' limit 1");
	echo $lotnum;
$conn->close();
?>