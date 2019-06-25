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
	$sql =  "SELECT * FROM `t_poteacher` WHERE _id= '$_id' limit 1";
	$result = mysqli_query($conn,$sql);
	$row=$result->fetch_row();
	$restquantity=$row[2]-$quantity;
	
	
	
	
	if($row[15]){
		$todaytime=$row[15];
	}
	
	
	
	
	if($restquantity>0){
		if($row[10]){
			mysqli_query($conn,"UPDATE `t_teacher` SET quantity='$restquantity', explode='$todaytime' WHERE _id='$row[10]' limit 1");
			$row_get_c_state=mysqli_query($conn,"SELECT * FROM `t_teacher` WHERE _id= '$row[10]' limit 1")->fetch_row();
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
			mysqli_query($conn,"INSERT INTO `t_poteacher` (`asahiorder`, `banngo`, `campany`, `campanyorder`, `quantity`, `JPdate`, `hopedate`,`state`, `remark`, `explode`) VALUES ('$row[0]','$row[1]','$row[5]','$row[6]','$quantity','$row[3]','$row[4]','$row[8]','$row[7]','$todaytime')");	
			$po_id=mysqli_insert_id($conn);
			
			$row_po_id=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id='$po_id' limit 1")->fetch_row();	
			$this_id=$row_po_id[9];
			
			mysqli_query($conn,"INSERT INTO `t_teacher`(`campany`, `ordernum`, `banngo`, `quantity`, `hopedate`, `asahiorder`, `JPdate`,`SHdate`, `po_id`, `remark`, `state`, `explode` ) VALUES ('$row_po_id[5]','$row_po_id[6]','$row_po_id[1]','$quantity','$row_po_id[4]','$row_po_id[0]','$row_po_id[3]','$SHdate','$this_id','$row_po_id[7]','$row_get_c_state[9]','$todaytime')");
			$c_id=mysqli_insert_id($conn);

			mysqli_query($conn,"UPDATE `t_poteacher` SET customer_id='$c_id' WHERE _id='$this_id' limit 1");
			echo "拆分完成(有对应PO)";
		}else{
			mysqli_query($conn,"INSERT INTO `t_poteacher` (`asahiorder`, `banngo`,`campany`, `quantity`, `JPdate`, `hopedate`,`state`, `remark`, `explode`) VALUES ('$row[0]','$row[1]','$row[5]','$quantity','$row[3]','$row[4]','$row[8]','$row[7]','$todaytime')");	
			echo "拆分完成(无对应PO)";
		}
		mysqli_query($conn,"UPDATE `t_poteacher` SET quantity='$restquantity', explode='$todaytime' WHERE _id = '$_id' limit 1");	
	}
}else{
	echo "没有数字";
}		



//////////////news
$newstime=date('Y-m-d H:i:s');
$something="拆分了朝日id:".$_id."，拆分数量为".$quantity."。";
mysqli_query($conn,"INSERT INTO `t_news`(`datetime`, `people`, `something`) VALUES ('$newstime','{$_COOKIE['loged']}','$something')");
//////////////news//////


$conn->close();

?>
