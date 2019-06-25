<?php
date_default_timezone_set('PRC');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);


$_id=$_GET['_id'];
$po_delete=$_GET['po_delete'];



if($_id){
		mysqli_query($conn,"DELETE FROM `t_teacher` WHERE _id = '$_id' limit 1");
		echo "删除成功";
		if($po_delete){
			mysqli_query($conn,"DELETE FROM `t_poteacher` WHERE customer_id='$_id' limit 1");
			echo "<br>匹配的PO删除成功";
			$something="删除了客户id:".$_id."以及其匹配的朝日订单。";
		}else{
			mysqli_query($conn,"UPDATE `t_poteacher` SET campanyorder='', hopedate='', customer_id='' WHERE customer_id='$_id' limit 1");
			$something="删除了客户id:".$_id;
		}
}else{
	echo "删除失败";
}

//////////////news
$newstime=date('Y-m-d H:i:s');

mysqli_query($conn,"INSERT INTO `t_news`(`datetime`, `people`, `something`) VALUES ('$newstime','{$_COOKIE['loged']}','$something')");
//////////////news//////


$conn->close();
?>
