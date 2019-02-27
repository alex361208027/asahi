<?php
echo file_get_contents("templates/header.html");
require_once("libs/myfunction.php");

$t1 = $_POST['t1'];
$t2 = $_POST['t2'];$t2=qukongge($t2);
$t3 = $_POST['t3'];
$asahiorder = $_POST['asahiorder'];$asahiorder=qukongge($asahiorder);

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
// Check connection
if (empty($t1) || empty($t2)) {
    echo "信息不完整";
}else{
	$sql2 = "SELECT * FROM `t_student` WHERE ordernum = '$t2' AND campany='$t1' limit 1";
	$result2 = mysqli_query($conn,$sql2);
	$rows2=$result2->num_rows;

	
	if($rows2 > 0){
		echo "订单".$t2."已经存在！";
	}else{
		
	$sql = "INSERT INTO `t_student`(`campany`, `ordernum`, `orderdate`, `person`) VALUES ('$t1','$t2','$t3','{$_COOKIE['asahiuser']}')";
	mysqli_query($conn,"INSERT INTO `t_note`(`user`, `note`, `time`, `remark`) VALUES ('{$_COOKIE['asahiuser']}','$t2','$todaytime',8)");
	mysqli_query($conn,"DELETE FROM `t_note` WHERE remark = 8 order by time asc LIMIT 1");
	

if ($conn->query($sql) === TRUE) {
    echo "新订单创建成功<br>";
	if($asahiorder){
	$sql3 = "SELECT * FROM `t_postudent` WHERE asahiorder = '$asahiorder' limit 1";
	$result3 = mysqli_query($conn,$sql3);
	$rows3=$result3->num_rows;
		if($rows3==0){
		mysqli_query($conn,"INSERT INTO `t_postudent`(`asahiorder`, `orderdate`,`remark`, `person`) VALUES ('$asahiorder','$t3','$t1','{$_COOKIE['asahiuser']}')");
		mysqli_query($conn,"INSERT INTO `t_note`(`user`, `note`, `time`, `remark`) VALUES ('{$_COOKIE['asahiuser']}','$asahiorder','$todaytime',7)");
		mysqli_query($conn,"DELETE FROM `t_note` WHERE remark = 7 order by time asc LIMIT 1");
		}
	}
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
<body style="padding:2%" onload="document.getElementsByName('t5')[0].focus();">
<style> 
.hopedate
{
background:#CCCCFF;
animation:myfirst 2s infinite;
-moz-animation:myfirst 2s infinite; /* Firefox */
-webkit-animation:myfirst 2s infinite; /* Safari and Chrome */
-o-animation:myfirst 2s infinite; /* Opera */
}

@keyframes myfirst
{
0%   {background: #CCCCFF;}
50% {background: #FFFFBB;}
100% {background: #CCCCFF;}
}

@-moz-keyframes myfirst /* Firefox */
{
0%   {background: #CCCCFF;}
50% {background: #FFFFBB;}
100% {background: #CCCCFF;}
}

@-webkit-keyframes myfirst /* Safari 和 Chrome */
{
0%   {background: #CCCCFF;}
50% {background: #FFFFBB;}
100% {background: #CCCCFF;}
}

@-o-keyframes myfirst /* Opera */
{
0%   {background: #CCCCFF;}
50% {background: #FFFFBB;}
100% {background: #CCCCFF;}
}
</style>

<div align="" width="100%">
 <div class="php1">
	<form action="1-2.php" method="post">
		<input type="hidden" name="t1" value="<?php echo $t1 ?>"/>
		<input type="hidden" name="t2" value="<?php echo $t2 ?>"/>
	  <div class="php1campany"><?php echo $t2 ?></div>
	  <hr>
	  <div class="php1word">产品番号<input list="banngolist" class="inputlist" name="t5" value="" onfocusout="findbanngo(this.value+'&banngoname=5&campany='+document.getElementsByName('t1')[0].value)"/></div>
	  <div id="findbanngo" style="display:none;font-size:12px;color:red;padding-left:15px;">加载中</div>
	  <div class="php1word">产品数量<input list="quantitylist" class="inputlist" name="t6" onchange="quantitychecktest(this.value)"/></div>
	  <div class="php1word">希望交期<input type="date" class="hopedate" name="t7" value="<?php echo date('Y-m-d',strtotime('+2 month')); ?>" /></div>
	  <? if($asahiorder){ ?>
	  <div class="php1word">朝日订单<input type="text" name="asahiorder" value="<?php echo $asahiorder ?>" /></div>
	  <? } ?>
	  <input type="submit" value="添加产品" onclick="buttons(this)"/><br>
	</form>
 </div>	
</div>
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
  <?php
}
} 
  $conn->close();

?>