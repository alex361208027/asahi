<?php
echo file_get_contents("templates/header.html");
require_once("libs/myfunction.php");

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

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

if($_GET['t3']){
	$t3 = $_GET['t3'];
}else if($_POST['t3']){
	$t3 = $_POST['t3'];
}else{
	$t3 = date('Y-m-d');
}

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
$insert_c_id=mysqli_insert_id($conn);
	
	if($asahiorder){	 
		$sql3 = "SELECT * FROM `t_postudent` WHERE asahiorder = '$asahiorder' limit 1";
		$result3 = mysqli_query($conn,$sql3);
		$rows3=$result3->num_rows;
		if($rows3==0){
			if($rows3==0){
			mysqli_query($conn,"INSERT INTO `t_postudent`(`asahiorder`, `orderdate`,`remark`, `person`) VALUES ('$asahiorder','$t3','$t1','{$_COOKIE['asahiuser']}')");
			mysqli_query($conn,"INSERT INTO `t_note`(`user`, `note`, `time`, `remark`) VALUES ('{$_COOKIE['asahiuser']}','$asahiorder','$todaytime',7)");
			mysqli_query($conn,"DELETE FROM `t_note` WHERE remark = 7 order by time asc LIMIT 1");
			}else{
				$note_asahiorder_exist="(朝日订单【".$asahiorder."】新建成功)";
			}
			

		}
	
		mysqli_query($conn,"INSERT INTO `t_poteacher`(`asahiorder`, `banngo`, `quantity`, `campany`, `campanyorder`, `customer_id`, `hopedate` ) VALUES ('$asahiorder','$t5','$t6','$t1','$t2','$insert_c_id','$t7')");
		$insert_po_id=mysqli_insert_id($conn);

		mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder='$asahiorder' , po_id='$insert_po_id' WHERE _id='$insert_c_id' limit 1");
		
	}

?>
<body style="padding:2%" onload="document.getElementsByName('t5')[0].focus();">
继续录入产品或结束<br>
<table><tr><td valign="top">
<div width="">
 <div class="php1">
	<form action="1-2.php" method="post">
		<input type="hidden" name="t1" value="<?php echo $t1 ?>"/>
		<input type="hidden" name="t2" value="<?php echo $t2 ?>"/>
	<? echo	$note_asahiorder_exist; ?>
	  <div class="php1campany"><?php echo $t2 ?></div>
	  <hr>
	  <div class="php1word">产品番号 <input list="banngolist" class="inputlist" name="t5" value="" onfocusout="findbanngo(this.value+'&banngoname=5&campany='+document.getElementsByName('t1')[0].value)"/></div>
	  <div id="findbanngo" style="display:none;font-size:12px;color:#FFAABB;padding-left:20px;">加载中</div>
	  <div class="php1word">产品数量 <input list="quantitylist" class="inputlist" name="t6" onchange="quantitychecktest(this.value)"/></div>
	  <div class="php1word">希望交期 <input type="date" name="t7" value="<?php echo $t7 ?>" /></div>
	  <div class="php1word">朝日订单 <input type="text" name="asahiorder" value="<?php echo $asahiorder ?>" placeholder="创建朝日订单 并录入"/><? if(!$asahiorder){ ?><input type="button" value="生成朝日单号" onclick="buttons(this);newponum(1,'<? echo date('Y-m-d'); ?>')"/><? } ?></div>
	  <input type="submit" value="添加产品" onclick="buttons(this)" /><br>
	  <p><? //echo $insert_c_id."/".$insert_po_id; ?></p>
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
<div style="-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;padding:8px;border:1px solid black;">
 <div><img src="upload/campanylogo/<?php echo $t1;?>.png" width="60px"><?php echo $t2;?></div>
 <table cellspacing="2" cellpadding="4">
	<tr bgcolor="black" style="color:white;">
	<td>#</td>
	<td>番号</td>
	<td align="right">数量</td>
	<td>交期</td>
	<td>朝日订单</td>
	</tr>	
<?php

$sql2 =  "SELECT * FROM `t_teacher` WHERE campany='$t1' AND ordernum = '$t2'";
$result2 = mysqli_query($conn,$sql2);
while($row2=$result2->fetch_row()){
	?>
	<tr bgcolor="#EEEEEE">
	<td><?php $ggg++;echo $ggg; ?></td>
	<td><?php echo $row2[2]; ?></td>
	<td align="right"><?php echo $row2[3];$ttt=$ttt+$row2[3]; ?></td>
	<td><?php echo $row2[4]; ?></td>
	<td><a href="4-1.php?asahit22=<?php echo $row2[5]; ?>"><?php echo $row2[5]; ?></a></td>
	</tr>	
<?php } ?>	
<?php for($i=$ggg;$i<5;$i++){ ?>
	<tr bgcolor="#EEEEEE">
	<td><?php echo ($i+1); ?></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	</tr>	
<?php } ?>
	<tr bgcolor="#DDDDDD">
	<td></td>
	<td align="right">Total:</td>
	<td align="right"><b><?php echo $ttt; ?></b></td>
	<td></td>
	<td></td>
	</tr>	
</table>
</div>
</td></tr>
</table>
<?php $result=mysqli_query($conn,"SELECT banngo FROM `t_poprice` WHERE campany='$t1' order by banngo asc"); ?>
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