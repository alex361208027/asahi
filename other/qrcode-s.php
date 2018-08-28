
<head>
<script src="../JS/jquery-3.2.1.min.js"></script>
<title>小标签-1页4面打印</title>
</head>
<style>
input{
	text-align:center;min-width:200px;
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
//function GetQueryString(name)
//{
//     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
//     var r = window.location.search.substr(1).match(reg);
//     if(r!=null)return  unescape(r[2]); return null;
//}

$(document).ready(function(){
//	$("#href").click(function(){
//		for(i=0;i<$("input").length;i++){
//			if(i==5){
	
//			}else{
//		$("input").eq(i).val(GetQueryString("w"+i));
//			}
//		}
//	});
	
	$("#heihei").change(function(){
		for(i=0;i<$("input").length;i++){
			if($("input").eq(i).val()){
				$("input").eq(i).attr("value",$("input").eq(i).val());
				if(i==2||i==6){}else{
				txt="<br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text="+$("input").eq(i).val()+"&thickness=25&start=B&code=BCGcode128'/>";
				$("input").eq(i).nextAll().remove();
				$("input").eq(i).after(txt);
				}
			}
		}
		
		$("title").prepend($("input").eq(1).val());
		
		bigqr="";
		for(i=0;i<$("input").length;i++){
		bigqr=bigqr+$("input").eq(i).val().replace("+","%2B");;
			if((i+1)<$("input").length){
				bigqr=bigqr+",";
			}
		}
		//alert(bigqr);
		$("#bigqr").after("<img src='http://qr.liantu.com/api.php?text="+bigqr+"' width='150px'/><br>朝日科技");
		
	});
	
	
	
	
	
	
	
	
	
	
	$("#banngo").change(function(){
<?php
echo file_get_contents("wuliaohao.html");
?>		
	
	for(b=0;b<banngo.length;b++){
		if($(this).val()===banngo[b]){
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
		$("#wuliaohao").attr("value",$("#wuliaohao").val());
		
		$("title").empty();
		$("title").prepend($(this).val()+"小标签-1页4面打印");
		
	}else{
		alert("未找到该物料号")
	}
		
	});
	
	
	
	$("input").change(function(){
		$(this).attr("value",$(this).val());
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
		bigqr=bigqr+$("input").eq(i).val().replace("+","%2B");;
			if((i+1)<$("input").length){
				bigqr=bigqr+",";
			}
		}
		//alert(bigqr);
		document.getElementById('bigqr').innerHTML="<img src='http://qr.liantu.com/api.php?text="+bigqr+"' width='150px'/><br>朝日科技";
	});
	
	$("button").click(function(){
		for(c=1;c<8;c++){
		$("#main").after($("#main").html());
		}
		$(this).attr("style","display:none");
		$("input").attr("readonly","readonly");
	});
	
});


</script>
<body>
<datalist id="pinfan">
<option value='NHSB046A+CAP'>
</datalist>
<button>copy</button><!--<a id="href" onclick="this.style.display='none';">自动填充>>>></a>-->
<div id="main" style="display:inline-block">
<div style="display:inline-block;margin:40px 0 0 30px" >
<table border="1" cellspacing="0" cellpadding="4">
<tr>
<td colspan="2" align="center"><img src="hyteralogo.gif" width="70px">海能达通信股份有限公司</td><td rowspan="4" align="center"><div id="bigqr"></div></td>
</tr>
<tr>
<td>PN:</td><td align="center"><input id="wuliaohao" class="qrcode" type="text" value="<?php echo $_GET['w0']; ?>"></td>
</tr>
<tr>
<td>供应商料号:</td><td align="center"><input id="banngo" class="qrcode" type="text" value="<?php echo $_GET['w1']; ?>"></td>
</tr>
<tr>
<td>规格型号:</td><td><input type="text" list="pinfan" value="<?php echo $_GET['w2']; ?>"></td>
</tr>
<tr>
<td>Datecode:</td><td align="center"><input class="qrcode" type="text" value="<?php echo $_GET['w3']; ?>"></td><td rowspan="4" align="center"><img src="hyteralogo.gif" width="100px"></td>
</tr>
<tr>
<td>lot No:</td><td align="center"><input class="qrcode" type="text" value="<?php echo $_GET['w4']; ?>"></td>
</tr>
<tr>
<td>Qty:</td><td align="center"><input id="heihei" class="qrcode" type="text" value=""></td>
</tr>
<tr>
<td>PO:</td><td align="center"><input id="haha" type="text" value="<?php echo $_GET['w6']; ?>"></td>
</tr>
</table>
</div>
</div>
<br>
</body>