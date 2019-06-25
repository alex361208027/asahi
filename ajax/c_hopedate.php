<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id=$_GET['_id'];$po_id=$_GET['po_id'];
$hopedate=$_GET['hopedate'];
mysqli_query($conn,"UPDATE `t_teacher` SET hopedate='$hopedate' WHERE _id = '$_id' limit 1");
if($po_id){
	mysqli_query($conn,"UPDATE `t_poteacher` SET hopedate='$hopedate' WHERE _id='$po_id' AND customer_id='$_id' limit 1");
		}
echo $hopedate;

//////////////news
$newstime=date('Y-m-d H:i:s');
$something="修改了客户id:".$_id."的希望日期为".$hopedate."。";
mysqli_query($conn,"INSERT INTO `t_news`(`datetime`, `people`, `something`) VALUES ('$newstime','{$_COOKIE['loged']}','$something')");
//////////////news//////


$conn->close();
?>
