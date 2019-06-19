<?


?>
<script type="text/javascript" src="JS/jquery-3.2.1.min.js"></script>
<script>
$(function(){
	$("#button").click(function(){
		$("#copy").after($("#copy").html());
	});
});
</script>
<style>
xiao{
	font-size:12px;
}
tr{
	height:44px;
}
td{
	position:relative;border:1px solid black;
}
input[type='text']{
	margin-left:20px;font-size:22px;border:none;background:none;padding:0px;
}

</style>
<body>
<input type="button" id="button" value="more"/>打印时 缩放到53%
<div id="copy">
<table width="600px" cellspacing="0" cellpadding="0" style="border:1px solid black;margin:10px;">
<tr>
<td colspan="2" valign="top"><xiao>Parts No</xiao><br><input type="text" value="E1XXXX" style="width:300px"/><div style="position:absolute;bottom:0px;right:10px;"><input type="text" value="2019/01/01" style="width:100px;text-align:right;font-size:16px;"/></div></td>
</tr>
<tr>
<td colspan="2" valign="top"><xiao>Description</xiao><br><input type="text" value="NXSBX46A+CAP(CXXXXXX-XX)" style="width:500px"/></td>
</tr>
<tr>
<td colspan="2" valign="top"><xiao>Quantity</xiao><br><div style="position:absolute;top:5px;left:100px;"><input type="text" value="X000" style="width:200px;text-align:right;font-size:33px;"/> PCS</div></td>
</tr>
<tr>
<td width="50%"><xiao>CD</xiao><br><input type="text" value="C05143"/></td><td valign="top" width="50%"><xiao>LotNo.</xiao><br><input type="text" value="800XXXXX-10" /></td>
</tr>
<tr>
<td colspan="2" valign="top"><xiao>Reference</xiao><br><input type="text" value="LED" style="width:400px"/></td>
</tr>
<tr>
<td colspan="2" align="center"><img src="img/LOGO4.png" height="28px"/> <font size="6">ASAHI RUBBER INC.</font></td>
</tr>
</table>
</div>

</body>