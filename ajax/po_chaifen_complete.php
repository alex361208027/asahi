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
	$sql =  "SELECT * FROM `t_poteacher` WHERE _id= '$_id' limit 1";
	$result = mysqli_query($conn,$sql);
	$row=$result->fetch_row();
	$restquantity=$row[2]-$quantity;
	if($restquantity>0){
		if($row[10]){
			mysqli_query($conn,"UPDATE `t_teacher` SET quantity='$restquantity' WHERE _id='$row[10]'");
			$result_get_c_state=mysqli_query($conn,"SELECT * FROM `t_teacher` WHERE _id= '$row[10]'");
			$row_get_c_state=$result_get_c_state->fetch_row();
			/////get SHdate
			if($row[3]){
				$hopedate5 = date('Y-m-d',(strtotime('+5 days',strtotime($row[3]))));
				if($row[4] && $hopedate5<=$row[4]){
				$SHdate= date('Y-m-d',(strtotime('-2 days',strtotime($row[4]))));
				}else{
				$Shdate= $hopedate5;
				}
			}
			/////new po
			mysqli_query($conn,"INSERT INTO `t_poteacher` (`asahiorder`, `banngo`, `campany`, `campanyorder`, `quantity`, `JPdate`, `hopedate`,`state`, `remark`) VALUES ('$row[0]','$row[1]','$row[5]','$row[6]','$quantity','$row[3]','$row[4]','$row[8]','$row[7]')");	
			
			$result_po_id = mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE asahiorder='$row[0]' AND banngo = '$row[1]' AND quantity='$quantity' order by _id desc");
			$row_po_id=$result_po_id->fetch_row();	$this_id=$row_po_id[9];
			
			mysqli_query($conn,"INSERT INTO `t_teacher`(`campany`, `ordernum`, `banngo`, `quantity`, `hopedate`, `asahiorder`, `JPdate`,`SHdate`, `po_id`, `remark`, `state` ) VALUES ('$row_po_id[5]','$row_po_id[6]','$row_po_id[1]','$quantity','$row_po_id[4]','$row_po_id[0]','$row_po_id[3]','$SHdate','$this_id','$row_po_id[7]','$row_get_c_state[9]')");
			
			$result_c_id = mysqli_query($conn,"SELECT * FROM `t_teacher` WHERE po_id='$this_id'");
			$row_c_id=$result_c_id->fetch_row();
			mysqli_query($conn,"UPDATE `t_poteacher` SET customer_id='$row_c_id[12]' WHERE _id='$this_id'");
			echo "拆分完成(有对应PO)";
		}else{
			mysqli_query($conn,"INSERT INTO `t_poteacher` (`asahiorder`, `banngo`,`campany`, `quantity`, `JPdate`, `hopedate`,`state`, `remark`) VALUES ('$row[0]','$row[1]','$row[5]','$quantity','$row[3]','$row[4]','$row[8]','$row[7]')");	
			echo "拆分完成(无对应PO)";
		}
		mysqli_query($conn,"UPDATE `t_poteacher` SET quantity='$restquantity' WHERE _id = '$_id'");	
	}
}else{
	echo "没有数字";
}		






$conn->close();

?>
