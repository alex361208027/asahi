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
mysqli_query($conn,"UPDATE `t_teacher` SET invoice='$thedate' WHERE _id = '$_id' limit 1");
echo "已开具";
$something="设置客户id:".$_id."为[已开票]";
}else{
mysqli_query($conn,"UPDATE `t_teacher` SET invoice='' WHERE _id = '$_id' limit 1");	
echo "<font color='red'>已取消</font>";
$something="设置客户id:".$_id."为[取消开票]";
}

//////////////news
$newstime=date('Y-m-d H:i:s');

mysqli_query($conn,"INSERT INTO `t_news`(`datetime`, `people`, `something`) VALUES ('$newstime','{$_COOKIE['loged']}','$something')");
//////////////news//////

$conn->close();
?>
