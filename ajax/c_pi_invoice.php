<?php
date_default_timezone_set('PRC');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$thedate=$_GET['thedate'];
if(!$thedate){
	$thedate=date('Y-m-d');
}

$checkbox=$_GET['checkbox'];
//$invoice=$_GET['invoice'];
foreach($checkbox as $checkboxid => $_id){
	mysqli_query($conn,"UPDATE `t_teacher` SET invoice='$thedate' WHERE _id='$_id' limit 1");
	echo "第".($checkboxid+1)."条，【发票】操作成功\r";
}

//////////////news
$newstime=date('Y-m-d H:i:s');
$something="执行了一次[发票]操作。";
mysqli_query($conn,"INSERT INTO `t_news`(`datetime`, `people`, `something`) VALUES ('$newstime','{$_COOKIE['loged']}','$something')");
//////////////news//////

 $conn->close();
?>
