<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

date_default_timezone_set('PRC');

$_id=$_POST['id'];$dateplus=$_POST['dateplus'];
if(!$dateplus){
	$dateplus=5;
}

foreach($_id as $_id){
$row=mysqli_query($conn,"SELECT JPdate FROM t_teacher WHERE _id='$_id' limit 1")->fetch_row();
if($row[0]&&$row[0]!="0000-00-00"){
	$fast_date=date('Y-m-d',strtotime('+'.$dateplus.' days',strtotime($row[0])));
}else{
	$fast_date="";
}

mysqli_query($conn,"UPDATE `t_teacher` SET `SHdate`='$fast_date' WHERE _id = '$_id' limit 1");
}
echo "操作完成";

 $conn->close();
?>
