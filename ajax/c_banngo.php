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
$sql =  "SELECT * FROM `t_teacher` WHERE _id = '$_id'";
$result = mysqli_query($conn,$sql);
$row=$result->fetch_row();
?>
	<div class="php1"> 
		<input type="hidden" id="cells" value="<?php echo $cells ?>">
		<input type="hidden" id="c_banngo_campany" value="<?php echo $row[0] ?>">
		<input type="hidden" id="c_banngo_ordernum" value="<?php echo $row[1] ?>">
		<input type="hidden" id="c_banngo_id" value="<?php echo $row[12] ?>">
		<input type="hidden" id="c_banngo_quantity" value="<?php echo $row[3] ?>">
		<input type="hidden" id="c_banngo_thebanngo" value="<?php echo $row[2] ?>">
		<div class="php1campany"><?php echo $row[2]; ?></div>
		<div class="php1word1"><?php echo $row[0]." ".$row[1]; ?></div><br>
		<font color="#EEEEEE"><?php echo "本ID".$row[12]."对应的ID".$row[13] ?></font>
		<hr>
		<div class="php1word1">数量</div><div class="php1word1"><input type="text" onchange="c_quantity('quantity='+this.value+'&_id=<?php echo $row[12] ?>&po_id=<?php echo $row[13] ?>')" value="<?php echo $row[3]; ?>"/></div>
		<a href="###" onclick="c_chaifen('&_id=<?php echo $row[12] ?>')"><div class="banngobutton">拆分</div></a><br>
		<div class="php1word1">希望交期</div><div class="php1word1"><input type="date" onchange="c_hopedate('hopedate='+this.value+'&_id=<?php echo $row[12] ?>&po_id=<?php echo $row[13] ?>')" value="<?php echo $row[4]; ?>"/></div><br>
		<hr>
		<div class="php1word1"><a href="./4-1.php?asahit1=<?php echo $row[5] ?>" target="_blank">朝日订单号</div><div class="php1word1"></a><?php echo $row[5]; ?>
		<a href="./pipei.php?c2=<?php echo $row[2] ?>&po2=<?php echo $row[2] ?>"><div class="banngobutton">匹配朝日</div></a>
			</div><br>
		<div class="php1word1">日本发货日</div><div class="php1word1"><?php echo $row[6]; ?><font color='#D5D5D5' size='1'>日期更新来自朝日订单</font></div><br>
		<div class="php1word1"><a onclick="datecount(8)">上海发货日</a></div><div class="php1word1"><input type="date" onchange="c_shdate('shdate='+this.value+'&_id=<?php echo $row[12] ?>')" value="<?php echo $row[7]; ?>"/></div><br>
		<div class="php1word1">备注</div><div class="php1word1"><input type="text" onchange="c_remark('remark='+this.value+'&_id=<?php echo $row[12] ?>')" value="<?php echo $row[8]; ?>"/></div><br>
		<hr>
		<div class="php1word1">是否在库</div><div class="php1word1"> &nbsp; <input type="checkbox" name="t12" value="已入库" <?php if($row[11]=='已入库'){echo 'checked';} ?> onclick="c_yiruku('_id=<?php echo $row[12] ?>');if(document.getElementById('checked0').color=='#E6E6E6'){document.getElementById('checked0').color='';}else{document.getElementById('checked0').color='#E6E6E6';}" style="display:none">&nbsp;<font id="checked0" color="<?php if($row[11]!='已入库'){echo '#E6E6E6';} ?>" onclick="document.getElementsByName('t12')[0].style.display='inline-block';">已入库,可以出货</font></div><br>
						<a href="###"><div class="banngobutton" onclick="c_chuku('banngo=<?php echo $row[2] ?>&_id=<?php echo $row[12] ?>')">出库->完成</div></a><br>

		<div class="php1word1">状态</div><div class="php1word1"> &nbsp; <input type="checkbox" id="c_complete" value="完成" <?php if($row[9]=='完成'){echo 'checked';} ?> onclick="c_complete('_id=<?php echo $row[12] ?>');if(document.getElementById('checked1').color=='#E6E6E6'){document.getElementById('checked1').color='';}else{document.getElementById('checked1').color='#E6E6E6';}" style="display:none">&nbsp;<font id="checked1" color="<?php if($row[9]!='完成'){echo '#E6E6E6';} ?>" onclick="document.getElementById('c_complete').style.display='inline-block';">订单完成</font></div><br>
		<div class="php1word1">发票</div><div class="php1word1"> &nbsp; <input type="checkbox"  id="c_invouce" value="已开具" <?php if($row[10]=='已开具'){echo 'checked';} ?> onclick="c_invoice('_id=<?php echo $row[12] ?>');if(document.getElementById('checked2').color=='#E6E6E6'){document.getElementById('checked2').color='';}else{document.getElementById('checked2').color='#E6E6E6';}" style="display:none">&nbsp;<font id="checked2" color="<?php if($row[10]!='已开具'){echo '#E6E6E6';} ?>" onclick="document.getElementById('c_invouce').style.display='inline-block';">已开发票</font></div><br>
		<br>
		<a href="###" onclick="c_delete('_id=<?php echo $row[12] ?>')"><div class="banngobutton">删除</div></a>
		<a href="###" onclick="c_pipei_cancel('_id=<?php echo $row[12] ?>')"><div class="banngobutton">取消匹配</div></a>
	</div>
<?php 
$conn->close();
?>