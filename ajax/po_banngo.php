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
$cells=$_GET['cells'];
$sql =  "SELECT * FROM `t_poteacher` WHERE _id = '$_id'";
$result = mysqli_query($conn,$sql);
$row=$result->fetch_row();
?>
	<div class="php1"> 
		<input type="hidden" id="cells" value="<?php echo $cells ?>">
		<input type="hidden" id="po_banngo_asahiorder" value="<?php echo $row[0] ?>">
		<input type="hidden" id="po_banngo_id" value="<?php echo $row[9] ?>">
		<input type="hidden" id="po_banngo_quantity" value="<?php echo $row[2] ?>">
		<div class="php1campany"><?php echo $row[1]; ?></div>
		<div class="php1word1"><?php echo $row[0]; ?></div><br>
		<font color="#EEEEEE"><?php echo "本ID".$row[9]."对应的ID".$row[10] ?></font>
		<hr>
		<div class="php1word1">数量</div><div class="php1word1"><input type="text" onchange="po_quantity('quantity='+this.value+'&_id=<?php echo $row[9] ?>&customer_id=<?php echo $row[10] ?>')" value="<?php echo $row[2]; ?>"/></div>
				<a href="###" onclick="po_chaifen('&_id=<?php echo $row[9] ?>')"><div class="banngobutton">拆分</div></a><br>
		<div class="php1word1">希望交期</div><div class="php1word1"><?php echo $row[4]; ?><font color='#D5D5D5' size='1'>日期更新来自客户订单</font></div><br>
		<hr>
		<div class="php1word1">日本发货日</div><div class="php1word1"><input type="date" onchange="po_JPdate('JPdate='+this.value+'&_id=<?php echo $row[9] ?>&customer_id=<?php echo $row[10] ?>&hopedate=<?php echo $row[4]; ?>')" value="<?php echo $row[3]; ?>"/></div><br>
		<div class="php1word1">客户名</div><div class="php1word1"><input type="text" name="t6" size="10" maxlength="" value="<?php echo $row[5]; ?>"/></div><br>
		<div class="php1word1"><a href="./4.php?ddt2=<?php echo $row[6] ?>" target="_blank">客户订单号</div><div class="php1word1"></a><?php echo $row[6]; ?>
		<a href="./pipei.php?po2=<?php echo $row[1] ?>&c2=<?php echo $row[1] ?>"><div class="banngobutton">匹配客户</div></a>
			</div><br>
		<div class="php1word1">备注</div><div class="php1word1"><input type="text" onchange="po_remark('remark='+this.value+'&_id=<?php echo $row[9] ?>&customer_id=<?php echo $row[10] ?>')" value="<?php echo $row[7]; ?>"/></div><br>
		<hr>
		<div class="php1word1">状态</div><div class="php1word1"><input type="checkbox" id="po_complete" value="已入库" <?php if($row[8]=='已入库'){echo 'checked';} ?> onclick="po_complete('_id=<?php echo $row[9] ?>');if(document.getElementById('checked1').color=='#E6E6E6'){document.getElementById('checked1').color='';}else{document.getElementById('checked1').color='#E6E6E6';}" style="display:none">&nbsp;<font id="checked1" color="<?php if($row[8]!='已入库'){echo '#E6E6E6';} ?>" onclick="document.getElementById('po_complete').style.display='inline-block';">已入库</font></div><br>
		<a href="###"><div class="banngobutton" onclick="eee=1;po_ru_quantity=<?php echo $row[2]; ?>;po_ruku('t2=<?php echo $row[1] ?>&t3=<?php echo $row[2] ?>&t6=<?php echo $row[5] ?>&customer_id=<?php echo $row[10] ?>&_id=<?php echo $row[9] ?>&asahipo=<?php echo $row[0] ?>')">入库->完成</div></a><br>
		<br>
		<a href="###" onclick="po_delete('_id=<?php echo $row[9] ?>')"><div class="banngobutton">删除</div></a>
		<a href="###" onclick="po_pipei_cancel('_id=<?php echo $row[9] ?>')"><div class="banngobutton">取消匹配</div></a>
</div>
<?php 
$conn->close();
?>