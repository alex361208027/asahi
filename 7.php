<?php
echo file_get_contents("templates/header.html");
require_once("libs/myfunction.php");
?>

<?php
$t1 = $_POST['t1'];
$t2 = $_POST['t2'];$t2=qukongge($t2);
$t4 = $_POST['t4'];
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

if (!$t1 || !$t2) {
    echo "信息不完整";
}else{
	$sql2 = "SELECT * FROM `t_postudent` WHERE asahiorder = '$t1'";
	$result2 = mysqli_query($conn,$sql2);
	$rows2=$result2->num_rows;
	
	if($rows2 > 0){
		echo "订单".$t1."已经存在！";
	}else{
	mysqli_query($conn,"INSERT INTO `t_postudent`(`asahiorder`, `orderdate`,`remark`, `person`) VALUES ('$t1','$t2','$t4','{$_COOKIE['asahiuser']}')");
	mysqli_query($conn,"INSERT INTO `t_note`(`user`, `note`, `time`, `remark`) VALUES ('{$_COOKIE['asahiuser']}','$t1','$todaytime',7)");
	mysqli_query($conn,"DELETE FROM `t_note` WHERE remark = 7 order by time asc LIMIT 1");	
	
	//fwrite(fopen("templates/new_asahi_po.html","w"),$t1);

?>
<body style="padding:2%">
新订单创建成功<br>
<div align="" width="100%">
 <div class="php1">
	<form action="7-2.php" method="post">
		<input type="hidden" name="t1" value="<?php echo $t1 ?>"/>
		<input type="hidden" name="t2" value="<?php echo $t2 ?>"/>
		<input type="hidden" name="t6" value="<?php echo $t4 ?>"/>
	  <div class="php1campany"><?php echo $t1 ?></div>
	  <hr>
	  <div class="php1word">产品番号<input type="text" name="t3" onchange="findbanngo(this.value+'&banngoname=3&campany='+document.getElementsByName('t6')[0].value)"/></div>
	  <div id="findbanngo" style="display:none;font-size:12px;color:red;padding-left:15px;">加载中</div>
	  <div class="php1word">产品数量<input type="text" name="t4" /></div>
	  <input type="submit" value="添加产品" onclick="buttons()"/><br>
	</form>
 </div>	
</div>
</body>
  <?php
}
}
  $conn->close();

?>