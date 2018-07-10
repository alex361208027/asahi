<?php

$_id =$_GET['_id'];
$t1 =$_GET['t1'];
$t2 =$_GET['t2'];
$t3 =$_GET['t3'];
$t5 =$_GET['t5'];
?>
<div style="margin:10px;">
<br>
<?php echo $t1."<br>".$t2; ?>
<hr>
<br>
<table>
<tr>
<td>客户名修改</td><td><input type="text" id="c_order_t1" value="<?php echo $t1 ?>"/></td>
</tr>
<tr>
<td>订单号修改</td><td><input type="text" id="c_order_t2" value="<?php echo $t2 ?>"/></td>
</tr>
<tr>
<td>订单日期修改</td><td><input type="date" id="c_order_t3" value="<?php echo $t3 ?>"/></td>
</tr>
<tr>
<td>备注修改</td><td><input type="text" id="c_order_t5" value="<?php echo $t5 ?>"/></td>
</tr>
<tr>
<td><input type="hidden" id="c_order_id" value="<?php echo $_id; ?>"/>
<input type="hidden" id="c_order_ot1" value="<?php echo $t1; ?>"/>
<input type="hidden" id="c_order_ot2" value="<?php echo $t2; ?>"/></td><td><button onclick="c_order_complete()">订单修改提交</button></td>
</tr>
<tr><td></td><td><hr><button onclick="c_order_delete('delete1=<?php echo $t1 ?>&delete2=<?php echo $t2 ?>')">删除该订单</button></td></tr>
</table>
</div>