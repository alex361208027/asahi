<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);


$checkbox=$_GET['checkbox'];
$SHdate=$_GET['SHdate'];
if($SHdate){
foreach($checkbox as $checkboxid => $_id){
	mysqli_query($conn,"UPDATE `t_teacher` SET SHdate='$SHdate' WHERE _id='$_id'");
	echo "第".($checkboxid+1)."条，【发货日】操作成功\r";
}
}else{
	echo "未输入上海时间";
}
 $conn->close();
?>
