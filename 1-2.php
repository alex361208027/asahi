<?php
echo file_get_contents("templates/header.html");
require_once("libs/myfunction.php");


if($_GET['t1']){
	$t1 = $_GET['t1'];
}else{
$t1 = $_POST['t1'];
}
if($_GET['t2']){
	$t2 = $_GET['t2'];
}else{
$t2 = $_POST['t2'];
}
//$t3 = $_POST['t3'];
//$t4 = $_POST['t4'];
$t5 = $_POST['t5'];
$t6 = $_POST['t6'];
$t7 = $_POST['t7'];
$asahiorder = $_POST['asahiorder'];$asahiorder=qukongge($asahiorder);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
 if(($t5&&$t6)||($_GET['t1']&&$_GET['t2'])){
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
if($t5&&$t6){
mysqli_query($conn,"INSERT INTO `t_teacher`(`campany`, `ordernum`, `banngo`, `quantity`, `hopedate` ) VALUES ('$t1','$t2','$t5','$t6','$t7')");
}

    echo "继续录入产品或结束<br>";
	if($asahiorder){	 
		$result_c_id = mysqli_query($conn,"SELECT * FROM `t_teacher` WHERE campany='$t1' AND ordernum = '$t2' AND banngo='$t5' AND quantity='$t6' order by _id desc");
		$row_c_id=$result_c_id->fetch_row();	$this_id=$row_c_id[12];
		mysqli_query($conn,"INSERT INTO `t_poteacher`(`asahiorder`, `banngo`, `quantity`, `campany`, `campanyorder`, `customer_id`, `hopedate` ) VALUES ('$asahiorder','$t5','$t6','$row_c_id[0]','$row_c_id[1]','$this_id','$row_c_id[4]')");
		
		$result_po_id = mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE customer_id='$this_id'");
		$row_po_id=$result_po_id->fetch_row();
		mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder='$asahiorder' , po_id='$row_po_id[9]' WHERE _id='$this_id'");
	}


?>
<body style="padding:2%" onload="document.getElementsByName('t5')[0].focus();">
<table><tr><td valign="top">
<div width="">
 <div class="php1">
	<form action="1-2.php" method="post">
		<input type="hidden" name="t1" value="<?php echo $t1 ?>"/>
		<input type="hidden" name="t2" value="<?php echo $t2 ?>"/>
	  <div class="php1campany"><?php echo $t2 ?></div>
	  <hr>
	  <div class="php1word">产品番号<input list="banngolist" class="inputlist" name="t5" value="" onchange="findbanngo(this.value+'&banngoname=5&campany='+document.getElementsByName('t1')[0].value)"/></div>
	  <div id="findbanngo" style="display:none;font-size:12px;color:#FFAABB;padding-left:20px;">加载中</div>
	  <div class="php1word">产品数量<input list="quantitylist" class="inputlist" name="t6" onchange="quantitycheck(this.value)"/></div>
	  <div class="php1word">希望交期<input type="date" name="t7" value="<?php echo $t7 ?>" /></div>
	  <input type="submit" value="添加产品" onclick="buttons(this)" /><br>
	  朝日订单<input type="text" name="asahiorder" value="<?php echo $asahiorder ?>"/ placeholder="同时创建朝日订单">
	  </form>
	  <hr>
	  <form action="4.php" method="GET">
	  <input type="hidden" name="ddt2" size="10" maxlength="" value="<?php echo $t2 ?>" />
	  <input style="float:right" type="submit" value="结束" />
	  </form>
	  
 </div>
</div> 
</td>
<td>
 <div>已录入的产品:<?php if(!empty($asahiorder)){echo "<br>(同时录入朝日订单".$asahiorder.")"; } ?></div>
<?php
$sql2 =  "SELECT * FROM `t_teacher` WHERE campany='$t1' AND ordernum = '$t2'";
$result2 = mysqli_query($conn,$sql2);
while($row2=$result2->fetch_row()){
	?>
	
	<div class="plist" align="center">
	<?php echo $row2[2]."<br><br><img src='img/LED.png' width='80px'/><br><br>".$row2[3]."<font size='3' color='black'>pcs</font><br><font size='3' color='black'>".$row2[4]."</front>"; ?>
	</div>	
<?php } ?>	
</td></tr>
</table>
<?php $result=mysqli_query($conn,"SELECT banngo FROM `t_poprice` WHERE campany='$t1' order by banngo asc"); ?>
<input type='hidden' id='quantitycheck' value=''/>
<datalist id="banngolist">
<?php
while($row=$result->fetch_row()){
?>	
<option value="<?php echo $row[0] ?>">
<?php } ?>
</datalist>
<datalist id="quantitylist">
<option value='3000'><option value='6000'><option value='9000'><option value='12000'><option value='15000'><option value='18000'><option value='21000'><option value='24000'><option value='27000'><option value='30000'><option value='36000'><option value='48000'>
</datalist>
</body>
<?php $conn->close();
 }else{
	 echo "信息不完整";
 }
?>