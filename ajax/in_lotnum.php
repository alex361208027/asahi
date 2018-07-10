<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id=$_GET['_id'];
$sql =  "SELECT * FROM `t_inout` WHERE _id = '$_id'";
$result = mysqli_query($conn,$sql);
$row=$result->fetch_row();
$restquantity=$row[2]-$row[5];
	if($restquantity==0){
		$state="已出库";
		$bgcolor="#F7F7F7";
	}elseif($row[5]==0){
		$state="在库中";
		$bgcolor="#FF99AD";
	}else{
		$state="部分在库";
		$bgcolor="#FFCCD6";
	}
?>
	<div class="php1"> 
		<div class="php1word1"><input type="text" style="font-size:16px" name="in_lotnum" value="<?php echo $row[0]; ?>" /></div>
		<div class="php1word1" style="background-color:<?php echo $bgcolor ?>;width:30px"><?php echo $state ?></div><br>
		<input type="hidden" name="in_id" value="<?php echo $row[9] ?>"/>
		<hr>
		<div class="php1word1">品番</div><div class="php1word1"><input type="text" name="in_banngo" value="<?php echo $row[1]; ?>"/></div><br>
		<div class="php1word1">入库数量</div><div class="php1word1"><input type="text" name="in_quantity" value="<?php echo $row[2]; ?>"/></div>
		<a href="###" onclick="in_lotnum_chaifen('_id=<?php echo $row[9] ?>')"><div class="banngobutton">拆分</div></a><br>
		<div class="php1word1">入库时间</div><div class="php1word1"><input type="date" name="in_intime" value="<?php echo $row[3]; ?>"/></div><br>
		<div class="php1word1">出库时间</div><div class="php1word1"><input type="date" name="in_outtime" value="<?php if(empty($row[4])){echo $outtime;}else{echo $row[4];$outtime=$row[4];} ?>"/></div><br>
		<div class="php1word1">出库数量</div><div class="php1word1"><input type="text" name="in_outquantity" value="<?php echo $row[5]; ?>"/></div><br>
		<div class="php1word1">朝日单号</div><div class="php1word1"><input type="text" name="in_asahipo" value="<?php echo $row[10]; ?>"/></div><br>
		<div class="php1word1">客户名</div><div class="php1word1"><input type="text" name="in_campany" value="<?php echo $row[6]; ?>"/></div><br>
		<div class="php1word1">快递号</div><div class="php1word1"><input type="text" name="in_expressnum" value="<?php echo $row[7]; ?>"/></div><br>
		<div class="php1word1">备注</div><div class="php1word1"><input type="text" name="in_remark" value="<?php echo $row[8]; ?>"/></div><br>
		<button onclick="in_lotnum_complete()">确认修改</button>
		 &nbsp;  &nbsp; 
		<?php if($row[5]){ ?><button onclick="document.getElementsByName('in_outtime')[0].value='';document.getElementsByName('in_outquantity')[0].value='';this.style.display='none';" class="banngobutton">取消出库</button>
		&nbsp;<?php } ?>
		<a href="###" onclick="in_lotnum_delete('_id=<?php echo $row[9] ?>');buttons(this)"><div class="banngobutton">删除</div></a>
	</div>
<?php 
$conn->close();
?>