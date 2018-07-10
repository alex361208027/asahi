<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');
$date=date('Y-m-d');
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
////////////////////////////////////客户未处理订单数

$sql="SELECT COUNT(*) FROM t_teacher WHERE state = '' AND SHdate <> '0000-00-00' AND SHdate <= '$date'";
$result=mysqli_query($conn,$sql);
$row=$result->fetch_row();
echo "C未处理".$row[0]."<br>";
//mysqli_query($conn,"UPDATE `t_note` SET `note`='$row[0]',`time`='$todaytime' WHERE user='getchuli' AND remark='4'");
$txt=$row[0].",".$todaytime;
fwrite(fopen("ajax/write_data/cweichuli.html", "w"), $txt);

//////////////////////////朝日未处理订单数

$sql="SELECT COUNT(*) FROM t_poteacher WHERE state = '' AND JPdate <> '0000-00-00' AND JPdate <= '$date'";
$result=mysqli_query($conn,$sql);
$row=$result->fetch_row();
echo "PO未处理".$row[0]."<br>";
//mysqli_query($conn,"UPDATE `t_note` SET `note`='$row[0]',`time`='$todaytime' WHERE user='pochuli' AND remark='4'");
$txt=$row[0].",".$todaytime;
fwrite(fopen("ajax/write_data/poweichuli.html", "w"), $txt);


if(date('d')=='01'|| date('d')==11 || date('d')==22){
	////////////////////////////每月出货统计数(预测)
	$iii=-2;
	while($iii<3){

	$datesql=date('Ym',strtotime('+'.$iii.' month')); 
	$date1=date('Y-m',strtotime('+'.$iii.' month'));
	$date1=$date1."-01";
	$iii++;
	$date2=date('Y-m',strtotime('+'.$iii.' month'));
	$date2=$date2."-01";


	$sqlsum1="SELECT SUM(quantity) FROM `t_teacher` WHERE SHdate >= '$date1' AND SHdate < '$date2'";
	$sqlsum2="SELECT SUM(quantity) FROM `t_teacher` WHERE (SHdate =0 or SHdate is null) AND hopedate >= '$date1' AND hopedate < '$date2'";

	$resultsum1 = mysqli_query($conn,$sqlsum1);
	$resultsum2 = mysqli_query($conn,$sqlsum2);
	$rowsum1 = $resultsum1 -> fetch_array();
	$rowsum2 = $resultsum2 -> fetch_array();
	$finaltotal=$rowsum1[0]+$rowsum2[0];

	$chukuheji[]=$finaltotal;


	$chukuheji=implode(",",$chukuheji);
	echo $chukuheji;
	fwrite(fopen("ajax/write_data/chukutongji.html", "w"), $chukuheji);
	echo "出库统计完成<br>";
	

	
}else{
	echo "未统计".date('d')."<br>";
}


$conn->close();
?>
<script>
function close(){
	setTimeout("window.location.href='about:blank';window.close();",10000);
}
</script>
<body onload="close()">
<br><br><br><br>执行完毕，可以关闭
</body>