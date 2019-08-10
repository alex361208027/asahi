<title>晶科QRcode</title>
<script src="../../JS/jquery-3.2.1.min.js"></script>
<script>
$(function(){
	$("#button_ok").click(function(){
		var qrcode="";
		var i=0;
		var full=0;
		$("input[type='text']").each(function(){
			if($(this).val()){
			qrcode=qrcode+$(this).val();
			if(i<5){
			qrcode=qrcode+"*";
			}
			i=i+1;
			full=1;
			}else{
			full=0;
			}
		});

////full=0;
//alert(qrcode);
		if(full){
	

		$.post("qrcode_weizhi_ajax.php",{qrcode:qrcode},function(data){
			$("#show").empty();
			$("#show").append(data);
		});
		}else{
			alert("填写不完整");
		}
	});
	
	$(".buzu").change(function(){
		weishu=$(this).attr("buzu");
		while($(this).val().length<weishu){
			$(this).val(0+$(this).val());
		}
	});
	
});
</script>
<style>
input{
	border:none;font-size:12px;
}
input[type="number"]{
	width:70px;text-align:center;background:black;color:white;
}
.table{
	padding:5px;
}
table{
	font-size:12px;
}

@media print {
 .printclass{ 
 display:none;
 }
}

</style>

<div class="printclass">
<table border="1" cellpadding="" cellspacing="0">
<tr>
<td>序号</td><td>字段名称</td><td>填写内容</td><td>说明</td>
</tr>
<tr>
<td>01</td><td>伟志料号</td><td><input type="text" id="IT" value="" /></td><td>伟志的物料编码，如：PFF-WT1234NN-01A</td>
</tr>
<tr>
<td>02</td><td>图纸版本号</td><td><input type="text" id="TB" value=""/></td><td>伟志图纸的版本号，如：A0</td>
</tr>
<tr>
<td>03</td><td>数量</td><td><input type="text" id="QT" value="" buzu="6" class="buzu"/></td><td>根据实际数量，单位PCS，不足位数时前面用“0”补足，如：001000</td>
</tr>

<tr>
<td>04</td><td>生产日期</td><td><input type="text" id="DA" value=""/></td><td>根据实际生产日期，如：2019年7月25日表示为190725</td>
</tr>
<tr>
<td>05</td><td>供方代码</td><td><input type="text" id="BG" value="" buzu="4" class="buzu"/></td><td>供应商在伟志的代码，不足位数时前面用“0”补足</td>
</tr>
<tr>
<td>06</td><td>生产批次</td><td><input type="text" id="LT" value="" buzu="6" class="buzu"/></td><td>根据实际批次，具体供应商自定义，不足位数时前面用“0”补足</td>
</tr>

</table>
<br><br><input type="button" id="button_ok" value="生成标签"/>
</div>

<div id="show">...</div>

