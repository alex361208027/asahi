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
//$row_news=mysqli_query($conn,"SELECT campany,ordernum,banngo,quantity FROM `t_teacher` WHERE _id = '$_id' limit 1")->fetch_row();


if($_id){
		mysqli_query($conn,"UPDATE t_teacher SET campany=CONCAT('<s>',campany,'</s>'), asahiorder=CONCAT('<s>',asahiorder,'</s>'), banngo=CONCAT('<s>',banngo,'</s>'), SHdate=IF(SHdate='0000-00-00','2111-11-11',date_add(SHdate,interval 100 year)), po_id='' WHERE _id='$_id' AND SHdate < '2100-01-01' limit 1");
		echo "删&留底";
		//if($po_delete){
		//	mysqli_query($conn,"DELETE FROM `t_poteacher` WHERE customer_id='$_id' limit 1");
		//	echo "<br>匹配的PO删除成功";
		//	$something="删除了客户id".$_id."以及其匹配的朝日订单。";
		//}else{
			mysqli_query($conn,"UPDATE `t_poteacher` SET campanyorder='', hopedate='', customer_id='' WHERE customer_id='$_id' limit 1");
		//	$something="删除了客户id".$_id;
		//}
}else{
	echo "删除失败";
}

//////////////news
//$newstime=date('Y-m-d H:i:s');
//$something=$something."【".$row_news[0].$row_news[1]."】".$row_news[2]."×".$row_news[3];


//mysqli_query($conn,"INSERT INTO `t_news`(`datetime`, `people`, `something`) VALUES ('$newstime','{$_COOKIE['loged']}','$something')");
//////////////news//////


$conn->close();
?>
