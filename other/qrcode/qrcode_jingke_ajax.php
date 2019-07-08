<?
echo "二维码内容:";
echo $qrcode=$_POST['qrcode'];
$qrcode_each=explode(";",$_POST['qrcode_each']);
$gg=$_POST['gg'];
$qrcode_api=file_get_contents("../qrcode_api.html");




?>
<br>
<div class="table">
<table border="1" cellpadding="" cellspacing="0">
<tr>
<td>供应商:</td><td>朝日科技（上海）有限公司</td>
<td rowspan="9"><img src="<? echo $qrcode_api.$qrcode; ?>" width="150px" height="150px"></td>
</tr>
<tr>
<td>物料名称:</td><td>硅胶油墨</td>
</tr>
<tr>
<td>物料代码:</td><td><? echo $qrcode_each[0]; ?></td>
</tr>
<tr>
<td>产品型号:</td><td>SWP-PK-03</td>
</tr>
<tr>
<td>生产批号:</td><td><? echo $qrcode_each[1]; ?></td>
</tr>
<tr>
<td>生产日期:</td><td><? echo $qrcode_each[4]; ?></td>
</tr>
<tr>
<td>有效日期：</td><td><? echo $qrcode_each[5]; ?></td>
</tr>
<tr>
<td>数    量:</td><td><? echo $gg; ?>g</td>
</tr>
<tr>
<td>ROHS要求</td><td>SGS</td>
</tr>
<tr>
<td>储存条件</td><td colspan="2">温度25℃以下，湿度35-75%</td>
</tr>
</table>
</div>
<hr>
<?

for($i=0;$i<($gg/$qrcode_each[2]);$i++){
	?>
<div class="table">
<table border="1" cellpadding="" cellspacing="0">
<tr>
<td>供应商:</td><td>朝日科技（上海）有限公司</td>
<td rowspan="9"><img src="<? echo $qrcode_api.$qrcode; ?>" width="150px" height="150px"></td>
</tr>
<tr>
<td>物料名称:</td><td>硅胶油墨</td>
</tr>
<tr>
<td>物料代码:</td><td><? echo $qrcode_each[0]; ?></td>
</tr>
<tr>
<td>产品型号:</td><td>SWP-PK-03</td>
</tr>
<tr>
<td>生产批号:</td><td><? echo $qrcode_each[1]; ?></td>
</tr>
<tr>
<td>生产日期:</td><td><? echo $qrcode_each[4]; ?></td>
</tr>
<tr>
<td>有效日期：</td><td><? echo $qrcode_each[5]; ?></td>
</tr>
<tr>
<td>数    量:</td><td><? echo $qrcode_each[2]; ?>g</td>
</tr>
<tr>
<td>ROHS要求</td><td>SGS</td>
</tr>
<tr>
<td>储存条件</td><td colspan="2">温度25℃以下，湿度35-75%</td>
</tr>
</table>
</div>
<hr>
	<?
}
?>
