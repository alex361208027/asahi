<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id=$_GET['_id'];$customer_id=$_GET['customer_id'];
$JPdate=$_GET['JPdate'];$hopedate=$_GET['hopedate'];
		
		


mysqli_query($conn,"UPDATE `t_poteacher` SET JPdate='$JPdate' WHERE _id = '$_id' limit 1");
if($customer_id){
		$hopedate5 = date('Y-m-d',(strtotime('+6 days',strtotime($JPdate))));
		if($hopedate && $hopedate5<=$hopedate){
		$SHdate= date('Y-m-d',(strtotime('-2 days',strtotime($hopedate))));
		}else{
		$SHdate= $hopedate5;if($JPdate==0){$SHdate=0;}
		}
	mysqli_query($conn,"UPDATE `t_teacher` SET JPdate='$JPdate', SHdate=IF(SHdate,IF(JPdate>=SHdate,'$hopedate5',SHdate),'$SHdate') WHERE _id='$customer_id' AND po_id='$_id' limit 1");
	}
echo $JPdate;

//////////////news
$newstime=date('Y-m-d H:i:s');
$something="修改了朝日id:".$_id."的日本日期为".$JPdate."。";
mysqli_query($conn,"INSERT INTO `t_news`(`datetime`, `people`, `something`) VALUES ('$newstime','{$_COOKIE['loged']}','$something')");
//////////////news//////

$conn->close();
?>
