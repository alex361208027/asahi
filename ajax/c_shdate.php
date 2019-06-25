<?php
date_default_timezone_set('PRC');


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id=$_GET['_id'];
$SHdate=$_GET['shdate'];
mysqli_query($conn,"UPDATE `t_teacher` SET `SHdate`='$SHdate' WHERE _id = '$_id' limit 1");
echo $SHdate;

//////////////news
$newstime=date('Y-m-d H:i:s');
$something="修改了客户id".$_id."的上海日期为".$SHdate."。";
mysqli_query($conn,"INSERT INTO `t_news`(`datetime`, `people`, `something`) VALUES ('$newstime','{$_COOKIE['loged']}','$something')");
//////////////news//////
?>
