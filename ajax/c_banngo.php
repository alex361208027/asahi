<?php
date_default_timezone_set('PRC');
$today=date('Y-m-d');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id=$_GET['_id'];
$cells=$_GET['cells'];
$sql =  "SELECT * FROM `t_teacher` WHERE _id = '$_id' limit 1";
$result = mysqli_query($conn,$sql);
$row=$result->fetch_row();
?>
<div class="php1"> 
<table cellspacing="2" cellpadding="2" style="font-size:13px;" width="100%">
		<input type="hidden" id="cells" value="<?php echo $cells ?>">
		<input type="hidden" id="c_banngo_campany" value="<?php echo $row[0] ?>">
		<input type="hidden" id="c_banngo_ordernum" value="<?php echo $row[1] ?>">
		<input type="hidden" id="c_banngo_id" value="<?php echo $row[12] ?>">
		<input type="hidden" id="c_banngo_quantity" value="<?php echo $row[3] ?>">
		<input type="hidden" id="c_banngo_thebanngo" value="<?php echo $row[2] ?>">
	<tr>
		<td colspan="2"><?php echo $row[0]." ".$row[1]; ?></font></td>
	</tr>
	<tr>
		<td colspan="2"><font size="4"><b id="c_banngo_banngo"><?php echo $row[2]; ?></b></font></td>
	</tr>
	<tr>
		<td colspan="2"><font color="#EEEEEE" size="1"><?php echo "本ID".$row[12]."对应的ID".$row[13] ?></font></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td>数量</td>
		<td><input type="text" onchange="c_quantity('quantity='+this.value+'&_id=<?php echo $row[12] ?>&po_id=<?php echo $row[13] ?>')" value="<?php echo $row[3]; ?>"/><div class="banngobutton" onclick="c_chaifen('&_id=<?php echo $row[12] ?>')">拆分</div></td>
	</tr>
	<tr>
		<td>希望交期</td>
		<td><input type="date" onchange="c_hopedate('hopedate='+this.value+'&_id=<?php echo $row[12] ?>&po_id=<?php echo $row[13] ?>')" value="<?php echo $row[4]; ?>"/></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td>朝日订单号</td>
		<td><?php echo $row[5]; ?><a href="./pipei.php?c2=<?php echo $row[2] ?>&po2=<?php echo $row[2] ?>"><div class="banngobutton">匹配朝日</div></a></td>
	</tr>
	<tr>
		<td>日本发货日</td>
		<td><?php echo $row[6]; ?><font color='#D5D5D5' size='1'>日期更新来自朝日订单</font></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td>上海发货日</td>
		<td><input type="date" onchange="c_shdate('shdate='+this.value+'&_id=<?php echo $row[12] ?>')" value="<?php echo $row[7]; ?>"/></td>
	</tr>
	<tr>
		<td>备注</td>
		<td><input type="text" onchange="c_remark('remark='+this.value+'&_id=<?php echo $row[12] ?>&po_id=<?php echo $row[13] ?>')" value="<?php echo $row[8]; ?>"/></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td>是否在库</td>
		<td><input type="checkbox" name="t12" value="已入库" <?php if($row[11]=='已入库'){echo 'checked';} ?> onclick="c_yiruku('_id=<?php echo $row[12] ?>');if(document.getElementById('checked0').color=='#E6E6E6'){document.getElementById('checked0').color='';}else{document.getElementById('checked0').color='#E6E6E6';}" style="display:none">&nbsp;<font id="checked0" color="<?php if($row[11]!='已入库'){echo '#E6E6E6';} ?>" onclick="document.getElementsByName('t12')[0].style.display='inline-block';">已入库,可以出货</font><div class="banngobutton" onclick="c_chuku('banngo=<?php echo $row[2] ?>&_id=<?php echo $row[12] ?>')">出库</div></td>
	</tr>
	<tr>
		<td>状态</td>
		<td><input type="checkbox" id="c_complete" value="完成" <?php if($row[9]=='完成'){echo 'checked';} ?> onclick="c_complete('_id=<?php echo $row[12] ?>');if(document.getElementById('checked1').color=='#E6E6E6'){document.getElementById('checked1').color='';}else{document.getElementById('checked1').color='#E6E6E6';}" style="display:none">&nbsp;<font id="checked1" color="<?php if($row[9]!='完成'){echo '#E6E6E6';} ?>" onclick="document.getElementById('c_complete').style.display='inline-block';">订单完成</font></td>
	</tr>
	<tr>
		<td>发票</td>
		<td><input type="checkbox"  id="c_invouce" value="" <?php if($row[10]!='0000-00-00'){echo 'checked';} ?> onclick="c_invoice('_id=<?php echo $row[12] ?>');if(document.getElementById('checked2').color=='#E6E6E6'){document.getElementById('checked2').color='';}else{document.getElementById('checked2').color='#E6E6E6';}" style="display:none">&nbsp;<font id="checked2" color="<?php if($row[10]=='0000-00-00'){echo '#E6E6E6';} ?>" onclick="document.getElementById('c_invouce').style.display='inline-block';">已开发票</font></td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
	<tr>
		<td></td>
		<td><div class="banngobutton" onclick="c_delete('_id=<?php echo $row[12]; ?>')">删除</div> <div class="banngobutton" href="###" onclick="c_pipei_cancel('_id=<?php echo $row[12] ?>')">取消匹配</div></td>
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