<title>晶科QRcode</title>
<script src="../../JS/jquery-3.2.1.min.js"></script>
<script>
$(function(){
	$("#button_ok").click(function(){
		var qrcode="";
		var qrcode_each="";
		var full=0;
		$("input[type='text']").each(function(){
			if($(this).val()){
			qrcode=qrcode+$(this).attr("id")+"="+$(this).val()+";";
			qrcode_each=qrcode_each+$(this).val()+";";
			full=1;
			}else{
			full=0;
			}
		});
		var gg=$("#gg").val();
		if(full){
	

		$.post("qrcode_jingke_ajax.php",{qrcode:qrcode,qrcode_each:qrcode_each,gg:gg},function(data){
			$("#show").empty();
			$("#show").append(data);
		});
		}else{
			alert("填写不完整");
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
<td>序号</td><td>关键字</td><td>字段名称</td><td>样板内容</td><td>定义</td>
</tr>
<tr>
<td>01</td><td>IT</td><td>物料代码</td><td><input type="text" id="IT" value=""/></td><td>客户端(APT)料号</td>
</tr>
<tr>
<td>02</td><td>SL</td><td>供应商批号</td><td><input type="text" id="SL" value=""/></td><td>指物料制造商的生产流水号</td>
</tr>
<tr>
<td>03</td><td>QT</td><td>数量</td><td><input type="text" id="QT" value="500"/></td><td>指出货数量（或每小包数量）</td>
</tr>
<tr>
<td>04</td><td>UT</td><td>单位</td><td><input type="text" id="UT" value="g"/></td><td>物料数量单位</td>
</tr>
<tr>
<td>05</td><td>PD</td><td>生产日期</td><td><input type="text" id="PD" value=""/></td><td>指物料变为可销售成品时的日期</td>
</tr>
<tr>
<td>06</td><td>ED</td><td>有效日期</td><td><input type="text" id="ED" value=""/></td><td>指物料截止使用日期</td>
</tr>
<tr>
<td>07</td><td>YD</td><td>硬度</td><td><input type="text" id="YD" value=""/></td><td>硅胶油墨硬度</td>
</tr>
<tr>
<td>08</td><td>AN</td><td>A胶粘度</td><td><input type="text" id="AN" value=""/></td><td>A胶粘度</td>
</tr>
<tr>
<td>09</td><td>BN</td><td>B胶粘度</td><td><input type="text" id="BN" value=""/></td><td>B胶粘度</td>
</tr>
</table>
总计<input type="number" id="gg" value="1000" />克 
<br><br><input type="button" id="button_ok" value="生成标签"/>
</div>

<div id="show">...</div>

