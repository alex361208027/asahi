<?php

$_id =$_GET['_id'];
$t1 =$_GET['t1'];
$t2 =$_GET['t2'];
$t4 =$_GET['t4'];
?>
<div style="margin:10px;">
<br>
<?php echo $t1; ?>
<hr>
<br>
<table>
<tr>
<td>朝日订单号修改</td><td><input type="text" id="po_order_t1" value="<?php echo $t1 ?>"/></td>
</tr>
<tr>
<td>朝日订单日期修改</td><td><input type="date" id="po_order_t2" value="<?php echo $t2 ?>"/></td>
</tr>
<tr>
<td>备注修改</td><td><input type="text" id="po_order_t4" value="<?php echo $t4 ?>"/></td>
</tr>
<tr>
<td><input type="hidden" id="po_order_id" value="<?php echo $_id; ?>"/>
<input type="hidden" id="po_order_ot1" value="<?php echo $t1; ?>"/>
</td>
<td><button onclick="po_order_complete()">订单修改提交</button></td>
</tr>
<tr><td></td><td><hr><button onclick="po_order_delete('<?php echo $t1 ?>')">删除该订单</button></td></tr>
</table>
</div>