<head>
<script src="../JS/jquery-3.2.1.min.js"></script>
<title>外标签-缩放80%打印</title>
</head>
<style>
input{
	text-align:center;
	border:none;font-size:14px;
}
body{
	font-size:14px;
}
@media print {
 button{ display:none;}
 .memo{ display:none;}
}

</style>
<script>
$(document).ready(function(){
	
	$("#banngo").change(function(){
<?php
echo file_get_contents("wuliaohao.html");
?>

	for(b=0;b<banngo.length;b++){
		if($(this).val()==banngo[b]){
			f=b;
			break;
		}else{
			f="x";
		}
	}

	if(f!="x"){
		$("#wuliaohao").val(wuliaohao[f]);
		txt="<br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text="+$("#wuliaohao").val()+"&thickness=25&start=B&code=BCGcode128'/>";
		$("#wuliaohao").nextAll().remove();
		$("#wuliaohao").after(txt);
		
		$("title").prepend($(this).val());
		
	}else{
		alert("未找到该物料号")
	}
		
	});
	
	$(".qrcode").change(function(){
		document.getElementById('bigqr').innerHTML="";
		if($(this).val()){
		txt="<br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text="+$(this).val()+"&thickness=25&start=B&code=BCGcode128'/>";
		}else{
		txt="";	
		}
		$(this).nextAll().remove();
		$(this).after(txt);
	});
	
	$("#haha").change(function(){
		bigqr="";
		for(i=0;i<$("input").length;i++){
		bigqr=bigqr+$("input").eq(i).val().replace("+","%2B");
			if((i+1)<$("input").length){
				bigqr=bigqr+",";
			}
		}
	//alert("二维码信息:【"+bigqr+"】");
		document.getElementById('bigqr').innerHTML="<img src='http://qr.liantu.com/api.php?text="+bigqr+"' width='150px'/><br>朝日科技";
	});
	
	
});


</script>
<body>
<datalist id="pinfan">
<option value='NHSB046A+CAP'>
</datalist>
<table border="1" cellspacing="0" cellpadding="4">
<tr>
<td colspan="6" align="center"><img src="hyteralogo.gif" width="70px">海能达通信股份有限公司</td>
</tr>
<tr>
<td colspan="2">PN:</td><td align="center" colspan="3"><input id="wuliaohao" class="qrcode" type="text" value=""></td><td rowspan="4" align="center"><div id="bigqr"></div></td>
</tr>
<tr>
<td colspan="2">供应商料号:</td><td align="center" colspan="3"><input id="banngo" class="qrcode" type="text" value=""></td>
</tr>
<tr>
<td colspan="2">规格型号:</td><td align="center" colspan="3"><input type="text" list="pinfan" value=""></td>
</tr>
<tr>
<td colspan="2">Datecode:</td><td align="center" colspan="3"><input class="qrcode" type="text" value=""></td></td>
</tr>
<tr>
<td colspan="2">lot No:</td><td align="center" colspan="3"><input class="qrcode" type="text" value=""><td rowspan="3" align="center"><img src="hyteralogo.gif" width="100px"></td>
</tr>
<tr>
<td colspan="2">Qty:</td><td align="center" colspan="3"><input class="qrcode" type="text" value=""></td>
</tr>
<tr>
<td>PO:</td><td align="center" colspan="2"><input id="haha" type="text" value=""><td>MFG</td><td align="center" width="90px"></td>
</tr>
</table>
<a class="memo" href="wuliaohao.php">>>查询物料号</a> <a class="memo" href="qrcode-s.php">>>外标签链接</a>
</body>