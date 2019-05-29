<?php
date_default_timezone_set('PRC');
$todaytime=date('YmdHis');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
date_default_timezone_set('PRC');

$_id=$_GET['_id'];
$quantity=$_GET['quantity'];

if($quantity){
	$sql =  "SELECT * FROM `t_teacher` WHERE _id= '$_id' limit 1";
	$result = mysqli_query($conn,$sql);
	$row=$result->fetch_row();
	$restquantity=$row[3]-$quantity;
	
	if($row[12]){
		echo "注意：货物已入库，请在[出入库]中拆分货物。";
		echo "\r";
	}
	
	
	if($row[15]){
		$todaytime=$row[15];
	}
	
	if($restquantity>0){
		if($row[13]){
			//老的对应po数量更新
			mysqli_query($conn,"UPDATE `t_poteacher` SET quantity='$restquantity', explode='$todaytime' WHERE _id='$row[13]' limit 1");
			$row_get_po_state=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id= '$row[13]' limit 1")->fetch_row();
			//创建新的c
			mysqli_query($conn,"INSERT INTO `t_teacher`(`campany`, `ordernum`, `banngo`, `quantity`, `hopedate`, `JPdate`, `SHdate`,`asahiorder`,`asahiorder2`,`state`, `remark`, `invoice`, `explode`) VALUES ('$row[0]','$row[1]','$row[2]','$quantity','$row[4]','$row[6]','$row[7]','$row[5]','$row[11]','$row[9]','$row[8]','$row[10]','$todaytime')");	
			//创建新的c对应的新po
			$c_id=mysqli_insert_id($conn);

			$row_c_id=mysqli_query($conn,"SELECT * FROM `t_teacher` WHERE _id='$c_id' limit 1")->fetch_row();	
			$this_id=$row_c_id[12];
			mysqli_query($conn,"INSERT INTO `t_poteacher`(`asahiorder`, `banngo`, `quantity`,`JPdate`, `campany`, `campanyorder`, `customer_id`, `hopedate`, `remark`, `state`, `explode` ) VALUES ('$row_c_id[5]','$row_c_id[2]','$row_c_id[3]','$row_c_id[6]','$row_c_id[0]','$row_c_id[1]','$this_id','$row_c_id[4]','$row_c_id[8]','$row_get_po_state[8]','$todaytime')");
			//新po id 回传
			$po_id=mysqli_insert_id($conn);
			mysqli_query($conn,"UPDATE `t_teacher` SET po_id='$po_id' WHERE _id='$this_id' limit 1");
			echo "拆分完成(有对应PO)";
		}else{
			//创建新的c
			mysqli_query($conn,"INSERT INTO `t_teacher`(`campany`, `ordernum`, `banngo`, `quantity`, `hopedate`, `JPdate`, `SHdate`,`state`, `remark`, `explode`) VALUES ('$row[0]','$row[1]','$row[2]','$quantity','$row[4]','$row[6]','$row[7]','$row[9]','$row[8]','$todaytime')");		
			echo "拆分完成(无对应PO)";
		}
		//老的c数量更新
		mysqli_query($conn,"UPDATE `t_teacher` SET quantity='$restquantity', explode='$todaytime' WHERE _id = '$_id' limit 1");
	}
	
}else{
	echo "没有数字";
}


$conn->close();

?>
