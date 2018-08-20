<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$banngo=$_GET['banngo'];$campany=$_GET['campany'];$banngoname=$_GET['banngoname'];
$sql="SELECT * FROM `t_poprice` WHERE banngo = '$banngo' AND campany like '$campany'";
$result = mysqli_query($conn,$sql);
if($result->num_rows == 0){
	echo "数据库里未找到属于该客户的番号!!!<br>如果是新品番，<a href='./poprice.php' target='_blank'><u>点击</u></a>进入品番数据库，添加该新品番。<hr style='width:250px'>";
	$tt=20;
	while($tt>0){
	$banngo=substr($banngo,0,$tt);
	
	$sql="SELECT * FROM `t_poprice` WHERE banngo like '%$banngo%' AND campany like '$campany'";
	$result = mysqli_query($conn,$sql);
	
		if($result->num_rows > 0){
			echo "您可能要输入的是：";
			break;
		}else{
			$tt=$tt-1;
		}
	}
	
	while($row=$result->fetch_row()){ ?>
		<a href="###" onclick="thispinfan('<?php echo $row[1]; ?>',<?php echo $banngoname; ?>);findbanngo_display()"/><u><?php echo $row[1] ?></u></a> &nbsp;
	<?php }
	
}else{
	$row=$result->fetch_row();
	if($row[3]==3000){
		echo "<input type='hidden' id='quantitycheck' value='3000'/>";
	}elseif($row[3]==6000){
		echo "<input type='hidden' id='quantitycheck' value='6000'/>";
	}elseif($row[3]==2000){
		echo "<input type='hidden' id='quantitycheck' value='2000'/>";
	}
	
	
	$sql="SELECT * FROM `t_poteacher` WHERE banngo = '$banngo' AND customer_id = ''";
	$result = mysqli_query($conn,$sql);
	if($result->num_rows == 0){
		
	}else{
		echo "该品番可能有多余<a target='_BLANK' href='pipei.php'><u>在库</u></a><br>请注意：如果确实有多余在库，则下方朝日订单号不填写，以免多下订单";
	}
	
}
$conn->close();
?>
