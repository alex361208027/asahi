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
$sql =  "SELECT * FROM `t_poteacher` WHERE _id = '$_id' limit 1";
$result = mysqli_query($conn,$sql);
$row=$result->fetch_row();
?>
	<div class="php1"> 
<table cellspacing="2" cellpadding="2" style="font-size:13px;" width="100%">
		<input type="hidden" id="cells" value="<?php echo $cells ?>">
		<input type="hidden" id="po_banngo_asahiorder" value="<?php echo $row[0] ?>">
		<input type="hidden" id="po_banngo_id" value="<?php echo $row[9] ?>">
		<input type="hidden" id="po_banngo_quantity" value="<?php echo $row[2] ?>">
	<tr>
		<td colspan="2"><?php echo $row[1]; ?></font></td>
	</tr>
	<tr>
		<td colspan="2"><font size="4"><b><?php echo $row[0]; ?></b></font></td>
	</tr>
	<tr>
		<td colspan="2"><font color="#EEEEEE" size="1"><?php echo "本ID".$row[9]."对应的ID".$row[10] ?></font></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td>数量</td>
		<td><input type="text" onchange="po_quantity('quantity='+this.value+'&_id=<?php echo $row[9] ?>&customer_id=<?php echo $row[10] ?>')" value="<?php echo $row[2]; ?>"/><div class="banngobutton" onclick="po_chaifen('&_id=<?php echo $row[9] ?>')">拆分</div></td>
	</tr>
	<tr>
		<td>希望交期</td>
		<td><input type="date" onchange="po_JPdate('JPdate='+this.value+'&_id=<?php echo $row[9] ?>&customer_id=<?php echo $row[10] ?>&hopedate=<?php echo $row[4]; ?>')" value="<?php echo $row[3]; ?>"/></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td>日本发货日</td>
		<td><input type="date" onchange="po_JPdate('JPdate='+this.value+'&_id=<?php echo $row[9] ?>&customer_id=<?php echo $row[10] ?>&hopedate=<?php echo $row[4]; ?>')" value="<?php echo $row[3]; ?>"/></font></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td>客户名</td>
		<td><input type="text" name="t6" size="10" maxlength="" value="<?php echo $row[5]; ?>"/></td>
	</tr>
	<tr>
		<td>客户订单号</td>
		<td><?php echo $row[6]; ?><a href="./pipei.php?po2=<?php echo $row[1] ?>&c2=<?php echo $row[1] ?>"><div class="banngobutton">匹配客户</div></a></td>
	</tr>
	
	<tr>
		<td>备注</td>
		<td><input type="text" onchange="po_remark('remark='+this.value+'&_id=<?php echo $row[9] ?>&customer_id=<?php echo $row[10] ?>')" value="<?php echo $row[7]; ?>"/></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td>状态</td>
		<td><input type="checkbox" id="po_complete" value="已入库" <?php if($row[8]=='已入库'){echo 'checked';} ?> onclick="po_complete('_id=<?php echo $row[9] ?>');if(document.getElementById('checked1').color=='#E6E6E6'){document.getElementById('checked1').color='';}else{document.getElementById('checked1').color='#E6E6E6';}" style="display:none">&nbsp;<font id="checked1" color="<?php if($row[8]!='已入库'){echo '#E6E6E6';} ?>" onclick="document.getElementById('po_complete').style.display='inline-block';">已入库</font></td>
	</tr>
	<tr>
		<td></td>
		<td><a href="###"><div class="banngobutton" onclick="eee=1;po_ru_quantity=<?php echo $row[2]; ?>;po_ruku('t2=<?php echo $row[1] ?>&t3=<?php echo $row[2] ?>&t6=<?php echo $row[5] ?>&t7=<?php echo $row[6] ?>&customer_id=<?php echo $row[10] ?>&_id=<?php echo $row[9] ?>&asahipo=<?php echo $row[0] ?>')">入库</div></a></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td></td>
		<td><div class="banngobutton" onclick="po_delete('_id=<?php echo $row[9] ?>')">删除</div> 
		<div class="banngobutton" onclick="po_pipei_cancel('_id=<?php echo $row[9] ?>')">取消匹配</div></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
</table>	

</div>
<?php 
$conn->close();
?>




