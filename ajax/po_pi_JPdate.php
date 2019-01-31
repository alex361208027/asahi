<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);


$checkbox=$_GET['checkbox'];
date_default_timezone_set('PRC');
$JPdate=$_GET['JPdate'];
if($JPdate){
	foreach($checkbox as $checkboxid => $_id){
	mysqli_query($conn,"UPDATE `t_poteacher` SET JPdate='$JPdate' WHERE _id='$_id' limit 1");
	echo "第".($checkboxid+1)."条，操作成功\r";
	$result=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id='$_id' limit 1");
	$row=$result->fetch_row();
	if(!empty($row[10])&&!empty($row[6])){
		
		$hopedate5 = date('Y-m-d',(strtotime('+5 days',strtotime($JPdate))));
		if($row[4] && $hopedate5<=$row[4]){
		$SHdate= date('Y-m-d',(strtotime('-2 days',strtotime($row[4]))));
		}else{
		$SHdate = $hopedate5;
		}
		
		mysqli_query($conn,"UPDATE `t_teacher` SET JPdate='$JPdate', SHdate=IF(SHdate,IF(JPdate>=SHdate,'$hopedate5',SHdate),'$SHdate') WHERE _id='$row[10]' AND po_id='$_id' limit 1");
	}
}
}else{
	echo "未输入日本时间";
}
 $conn->close();
?>
