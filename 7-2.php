<?php
echo file_get_contents("templates/header.html");

// create short variable names, also can use '$_REQUEST['name']'
if($_GET['t1']){
	$t1 = $_GET['t1'];
}else{
$t1 = $_POST['t1'];
}
$t2 = $_POST['t2'];
$t3 = $_POST['t3'];
$t4 = $_POST['t4'];
if($_GET['t6']){
	$t6 = $_GET['t6'];
}else{
$t6 = $_POST['t6'];
}
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
 if(($t3&&$t4)||($_GET['t1'])){

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
// Check connection
if($t3&&$t4){
mysqli_query($conn,"INSERT INTO `t_poteacher`(`asahiorder`, `banngo`, `quantity`, `campany` ) VALUES ('$t1','$t3','$t4','$t6')");
}
    echo "继续录入产品或结束<br>";


?>
<body style="padding:2%">
<table><tr valign="top"><td>
<div width="100%">
 <div class="php1">
	<form action="7-2.php" method="post">
		<input type="hidden" name="t1" value="<?php echo $t1 ?>"/>
		<input type="hidden" name="t2" value="<?php echo $t2 ?>"/>
		<input type="hidden" name="t6" value="<?php echo $t6 ?>"/>
	  <div class="php1campany"><?php echo $t1 ?></div>
	  <hr>
	  <div class="php1word">产品番号<input type="text" name="t3" onchange="findbanngo(this.value+'&banngoname=3&campany='+document.getElementsByName('t6')[0].value)" /></div>
	  <div id="findbanngo" style="display:none;font-size:12px;color:red;padding-left:15px;">加载中</div>
	  <div class="php1word">产品数量<input type="text" name="t4" size="10" maxlength="" /></div>
	  <input type="submit" value="添加产品" onclick="buttons()"/>
	  </form>
	  <hr>
	  <form action="4-1.php" method="post">
	  <input type="hidden" name="asahit1" size="10" maxlength="" value="<?php echo $t1 ?>" />
	  <input style="float:right" type="submit" value="结束" />
	  </form>
	  
 </div>
</td>
<td>
</div>
  <div>已录入的产品:</div>
<?php
$sql2 =  "SELECT * FROM `t_poteacher` WHERE asahiorder = '{$t1}'";
$result2 = mysqli_query($conn,$sql2);
while($row2=$result2->fetch_row()){
	?>
	
	<div class="plist" align="center">
	<?php echo $row2[1]."<br><br><img src='img/LED.png' width='80px'/><br><br>".$row2[2]."<font size='3' color='black'>pcs</font>"; ?>
	</div>	
<?php } ?>	
</td></tr>
</table>
</body>
<?php $conn->close();
 }else{
	 echo "信息不完整";
 }
?>