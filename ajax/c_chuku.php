<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d');

$banngo=$_GET['banngo'];
$_id=$_GET['_id'];




$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$sql =  "SELECT * FROM `t_inout` WHERE (outquantity is null OR outquantity = 0) AND banngo like '%$banngo%'";
$result = mysqli_query($conn,$sql);
if($result->num_rows == 0){
	$tt=20;
	while($tt>0){
	$banngo=substr($banngo,0,$tt);
	
	$sql =  "SELECT * FROM `t_inout` WHERE (outquantity is null OR outquantity = 0) AND banngo like '%$banngo%'";
	$result = mysqli_query($conn,$sql);
		if($result->num_rows > 0){
			break;
		}else{
			$tt=$tt-1;
		}
	}
	
}


 ?>
 <div style="padding:15px">出库日:<input type="date" id="c_chuku_date" value="<?php if($_COOKIE['rukudate']){echo $_COOKIE['rukudate'];}else{echo $todaytime;} ?>"><input type="text" id="c_chuku_express" value="<?php echo $_COOKIE['expressnum']; ?>" placeholder="运单号(后三位)">
<button onclick="buttons(this);c_chuku_checkbox()">确定</button><hr>
 <?php
while($row=$result->fetch_row()){
 ?>
<input type="checkbox" name="c_chuku_checkbox" value="<?php echo $row[9]; ?>" onclick="if(document.getElementById('chukuchecked<?php echo $jjj; ?>').color=='#BBBBBB'){document.getElementById('chukuchecked<?php echo $jjj; ?>').color='';}else{document.getElementById('chukuchecked<?php echo $jjj; ?>').color='#BBBBBB';}"/><font id="chukuchecked<?php echo $jjj;$jjj=$jjj+1; ?>" color="#BBBBBB"><?php echo $row[1]." &nbsp; ".$row[2]."pcs &nbsp; Lot:".$row[0]."<br> &nbsp;  &nbsp; ".$row[6].$row[10]."<font color='#BBBBBB'>".$row[8]."</font>"; ?></font><br>

 <?php ;} ?>
 </div>