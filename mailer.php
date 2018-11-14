<?php
echo file_get_contents("templates/header.html");

?>
<script>
$(document).ready(function(){
	$("button").click(function(){
		//alert($("#context").val());
	$.post("libs/mailer/sendmail.php",{to:$("#to").val(),tocc:$("#tocc").val(),title:$("#title").val(),content:$("#content").val()},function(data,status){alert(data);});
	});
});

</script>
<style>

</style>
<body>
收信人<input type="text" id="to" value="361208027@qq.com" placeholder="" /><br>
抄送<input type="text" id="tocc" value="licy@asahi-rubber.com.cn"/><br>
标题<input type="text" id="title" value="haha"/><br>
邮件内容<br><textarea id="content">haha</textarea>
<button>ok</button>
</body>