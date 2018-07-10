<script src="../JS/jquery-3.2.1.min.js"></script>
<script>
<?php 
echo file_get_contents("wuliaohao.html");
?>

$(document).ready(function(){
 $("[app='xianshi']").click(function(){
	for(i=0;i<banngo.length;i++){
	txt="<input name='banngo[]' type='text' value='"+banngo[i]+"'><input name='wuliaohao[]' type='text' value='"+wuliaohao[i]+"'><br>";
	$("#main").append(txt);
	}
	$(this).next().attr("style","display:block");
	$(this).remove();
 });
 
 $("[app='new']").click(function(){	
	txt="<input name='banngo[]' type='text' value=''><input name='wuliaohao[]' type='text' value=''><br>";
	$("#main").append(txt);
	$(this).next().attr("style","display:block");
	$(this).remove();
 });
   
	
});



</script>
<body>
海能达物料号：
<form action="wuliaohao-write.php" method="post">
<button id="xianshi" app="xianshi">显示</button><button app='new' style="display:none">+new</button><input type="submit" value="确认提交" style="display:none">
<div id="main"></div>
</form>
</body>