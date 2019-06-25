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
if($checked){
mysqli_query($conn,"UPDATE `t_teacher` SET state='完成' WHERE _id = '$_id' limit 1");
echo "<div class='classcp1' style='background-color:blue'>完成</div>";
$something="设置客户id:".$_id."为[完成]";
}else{
mysqli_query($conn,"UPDATE `t_teacher` SET state='' WHERE _id = '$_id' limit 1");	
echo "<div class='classcp1' style='background-color:blue'>取消完成</div>";
$something="设置客户id:".$_id."为[取消完成]";
}


//////////////news
$newstime=date('Y-m-d H:i:s');
mysqli_query($conn,"INSERT INTO `t_news`(`datetime`, `people`, `something`) VALUES ('$newstime','{$_COOKIE['loged']}','$something')");
//////////////news//////

$conn->close();
?>
