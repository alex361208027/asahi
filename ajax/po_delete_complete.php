<?php
date_default_timezone_set('PRC');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id=$_GET['_id'];
$c_delete=$_GET['c_delete'];
$row_news=mysqli_query($conn,"SELECT asahiorder,campany,banngo,quantity FROM `t_poteacher` WHERE _id = '$_id' limit 1")->fetch_row();
if($_id){
		mysqli_query($conn,"DELETE FROM `t_poteacher` WHERE _id = '$_id' limit 1");
		echo "删除成功";
		if($c_delete){
			mysqli_query($conn,"DELETE FROM `t_teacher` WHERE po_id = '$_id' limit 1");
			$something="删除了朝日id:".$_id."以及其匹配的客户订单。";
		}else{
			mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder='', JPdate='',SHdate='',po_id='' WHERE po_id = '$_id' limit 1");
			$something="删除了朝日id:".$_id;
		}
}else{
	echo "删除失败";
}

//////////////news
$newstime=date('Y-m-d H:i:s');
$something=$something."【".$row_news[0].$row_news[1]."】".$row_news[2]."×".$row_news[3];
mysqli_query($conn,"INSERT INTO `t_news`(`datetime`, `people`, `something`) VALUES ('$newstime','{$_COOKIE['loged']}','$something')");
//////////////news//////

$conn->close();
?>
