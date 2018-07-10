<?php


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
	$sql =  "SELECT * FROM `t_teacher` WHERE _id= '$_id'";
	$result = mysqli_query($conn,$sql);
	$row=$result->fetch_row();
	$restquantity=$row[3]-$quantity;
	if($restquantity>0){
		if($row[13]){
			//老的对应po数量更新
			mysqli_query($conn,"UPDATE `t_poteacher` SET quantity='$restquantity' WHERE _id='$row[13]'");
			$result_get_po_state=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id= '$row[13]'");
			$row_get_po_state=$result_get_po_state->fetch_row();
			//创建新的c
			mysqli_query($conn,"INSERT INTO `t_teacher`(`campany`, `ordernum`, `banngo`, `quantity`, `hopedate`, `JPdate`, `SHdate`,`asahiorder`,`state`, `remark`) VALUES ('$row[0]','$row[1]','$row[2]','$quantity','$row[4]','$row[6]','$row[7]','$row[5]','$row[9]','$row[8]')");	
			//创建新的c对应的新po
			$result_c_id = mysqli_query($conn,"SELECT * FROM `t_teacher` WHERE campany='$row[0]' AND ordernum = '$row[1]' AND banngo='$row[2]' AND quantity='$quantity' order by _id desc");
			$row_c_id=$result_c_id->fetch_row();	$this_id=$row_c_id[12];
			mysqli_query($conn,"INSERT INTO `t_poteacher`(`asahiorder`, `banngo`, `quantity`,`JPdate`, `campany`, `campanyorder`, `customer_id`, `hopedate`, `remark`, `state` ) VALUES ('$row_c_id[5]','$row_c_id[2]','$row_c_id[3]','$row_c_id[6]','$row_c_id[0]','$row_c_id[1]','$this_id','$row_c_id[4]','$row_c_id[8]','$row_get_po_state[8]')");
			//新po id 回传
			$result_po_id = mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE customer_id='$this_id'");
			$row_po_id=$result_po_id->fetch_row();
			mysqli_query($conn,"UPDATE `t_teacher` SET po_id='$row_po_id[9]' WHERE _id='$this_id'");
			echo "拆分完成(有对应PO)";
		}else{
			//创建新的c
			mysqli_query($conn,"INSERT INTO `t_teacher`(`campany`, `ordernum`, `banngo`, `quantity`, `hopedate`, `JPdate`, `SHdate`,`state`, `remark`) VALUES ('$row[0]','$row[1]','$row[2]','$quantity','$row[4]','$row[6]','$row[7]','$row[9]','$row[8]')");		
			echo "拆分完成(无对应PO)";
		}
		//老的c数量更新
		mysqli_query($conn,"UPDATE `t_teacher` SET quantity='$restquantity' WHERE _id = '$_id'");
	}
	
}else{
	echo "没有数字";
}


$conn->close();

?>
