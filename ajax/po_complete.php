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
mysqli_query($conn,"UPDATE `t_poteacher` SET state='已入库' WHERE _id = '$_id' limit 1");
echo "<div class='classcp1' style='background-color:blue'>入荷済み</div>";
$something="设置朝日id:".$_id."为[入荷済み]";
}else{
mysqli_query($conn,"UPDATE `t_poteacher` SET state='' WHERE _id = '$_id' limit 1");	
echo "<div class='classcp1' style='background-color:blue'>取消入荷</div>";
$something="设置朝日id:".$_id."为[取消入荷]";
}

//////////////news
$newstime=date('Y-m-d H:i:s');
mysqli_query($conn,"INSERT INTO `t_news`(`datetime`, `people`, `something`) VALUES ('$newstime','{$_COOKIE['loged']}','$something')");
//////////////news//////

$conn->close();
?>
