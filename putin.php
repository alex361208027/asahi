<?php
echo file_get_contents("templates/header.html");

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
date_default_timezone_set('PRC');
$today=date('Y-m-d');


$lotnum=$_POST['lotnum'];
$banngo=$_POST['banngo'];
$quantity=$_POST['quantity'];
$intime=$_POST['intime'];
$campany=$_POST['campany'];
$remark=$_POST['remark'];



$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);




if(!empty($lotnum) &&!empty($banngo)&&!empty($quantity)&&!empty($intime)){
	$sql2="SELECT * FROM `t_inout` WHERE lotnum='{$lotnum}'";
	$result2=mysqli_query($conn,$sql2);
	$rows2=$result2->num_rows;
	//if($rows2 > 0){
	//	echo $lotnum."已经存在！";
	//}else{
	mysqli_query($conn,"INSERT INTO `t_inout`(`lotnum`, `banngo`, `quantity`, `intime`, `campany`, `remark` ) VALUES ('$lotnum','$banngo','$quantity','$intime','$campany','$remark')");
	//}
}
	
	

$sql="SELECT * FROM `t_inout` WHERE 1 order by _id desc limit 0,20";
$result=mysqli_query($conn,$sql);
?>
<br>
<table cellpadding="0" cellspacing="0" width="100%" height="100%" style="font-size:12px;"><tr valign="top">
<td>
<div align="center" width="100%">
	<div class="php1"> 
<form action="putin.php" method="post">
<div class="php1campany">Lot No.<input type="text" name="lotnum" size="10" value=""></div>
<hr>
<div class="php1word">番号<input type="text" name="banngo" size="10" value=""></div>
<div class="php1word">数量<input type="text" name="quantity" size="10" value=""></div>
<div class="php1word">时间<input type="date" name="intime" size="10" value="<?php if(!empty($intime)){echo $intime;}else{echo date('Y-m-d');} ?>"></div>
<div class="php1word">客户<input type="text" name="campany" size="10" value="<?php if(!empty($campany)){echo $campany;} ?>"></div>
<div class="php1word">备注<input type="text" name="remark" size="10" value=""></div>
<input type="submit" value="录入">
</form>
</div>
</div>
</td>
<td>
最近入库列表：
 <table cellpadding="2" cellspacing="0" width="100%" style="text-align:center">
			<tr align="center" style="background-color:black;color:white;height:45px;">
                <!--<td>状态</td>-->
				<td>Lot No.</td>
				<td>番号</td>
				<td>入库时数量</td>
				<td>入库时间</td>
				<!--<td>出库时间</td>
				<td>剩余数量</td>-->
				<td>客户</td>
				<!--<td>快递号</td>-->
				<td>备注</td>
				<!--<td></td>-->
            </tr>
<?php while($row=$result->fetch_row()){ ?>
<tr>
				<!--<td bgcolor=""></td>-->
				<td><input type="hidden" name="t1" value="<?php echo $row[0] ?>"/><?php echo $row[0] ?></td>
				<td><?php echo $row[1] ?></td>
				<td><?php echo $row[2] ?>pcs</td>
				<td><?php echo $row[3] ?></td>
				<!--<td><?php echo $row[4] ?></td>
				<td><?php echo $restquantity ?></td>-->
				<td><?php echo $row[6] ?></td>
				<!--<td><?php echo $row[7] ?></td>-->
				<td><marquee scrolldelay="200" style="max-width:120px;font-size:12px;color:red;"><?php echo $row[8] ?></marquee></td>
				<!--<td><input type="submit" value="change"></td>-->
            </tr>
<?php } ?>

</table>

</td>
</tr></table>

<?php
 $conn->close();
 
?>

