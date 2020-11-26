<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');
?>
<script type="text/javascript" src="JS/jquery-3.2.1.min.js"></script>
<title>主页</title>
<style>
input[type="text"],
input[type="button"],
input[type="password"],
input[type="email"],
input[type="tel"]{
    width: 120px;
    height: 30px;
    line-height: 16px;
    margin: 0 0 10px;
    padding: 2px 10px;
    color:white ;
    cursor: pointer;
    resize: none;
    font-size: 16px;
    border:3px solid #CCCCFF;
    background:none;
	border-radius:15px;
	text-align:left;
	margin-top:6px;
	z-index:10;
	outline:none;
}
input[type="submit"],
input[type="button"]{
	border:0px solid #CCCCFF;
	
}
body{
	background-color:#F7F7F7;
}

.kk{
	position:relative;width:480px;height:280px;margin-top:100px;background-color:black;background-image: url(img/login<?php echo rand(1,4); ?>.png);overflow:hidden;
	-webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  webkit-box-shadow: 0px 5px 13px #808080;
  -moz-box-shadow: 0px 5px 13px #808080;
  box-shadow: 0px 5px 13px #808080;
  transition: all 1s;
-moz-transition: all 1s;	/* Firefox 4 */
-webkit-transition: all 1s;	/* Safari 和 Chrome */
-o-transition: all 1s;
}
.kk:hover{
	webkit-box-shadow: 0px 5px 13px black;
  -moz-box-shadow: 0px 5px 13px black;
  box-shadow: 0px 5px 13px black;
}

.bb{
	font-size:16px;padding:3px 10px 3px 10px;display:inline;text-align:center;width:90px;height:30px;
	border-radius:15px;
	font-weight:bold;background-color:#CCCCFF;border:3px solid #CCCCFF;
   transition: all 0.3s;
-moz-transition: all 0.3s;	/* Firefox 4 */
-webkit-transition: all 0.3s;	/* Safari 和 Chrome */
-o-transition: all 0.3s;
}
.bb:hover{
	background-color:#FF6685;
}

.t1{
	position:relative;margin-top:10px;
}
.t2{
	position:absolute;top:12px;font-size:12px;color:white;left:50px;background:none;cursor:pointer;
	transition: all 0.6s;
-moz-transition: all 0.6s;	/* Firefox 4 */
-webkit-transition: all 0.6s;	/* Safari 和 Chrome */
-o-transition: all 0.6s;
}
.t2_t{
	top:-13px;
	font-size:13px;color:#CCCCFF;
}
</style>
<body>
<div width="100%" align="center">

	<div class="kk">
				  <div style="position:absolute;right:20px;top:50px;font-size:14px;color:white" align="right">
					<form action="index.php" method="post" id='login' onsubmit="return false;">
					<div class="t1"><div class="t2" id="wuser">USER</div>&nbsp;<img src="img/user.png" width="20px" /> &nbsp; <input type="text" name="user" style="width:90px;" maxlength="" /></div>
					<div class="t1"><div class="t2" id="wpw">PassWord</div>&nbsp;<img src="img/mima.png" width="20px" /> &nbsp; <input type="password" name="userpw" style="width:90px;" maxlength="" /></div>
					<input type="hidden" name="logintime" value="<?php echo $todaytime; ?>"/>
					<div class="t1"><input type="submit" id="loging" class="bb" onclick="if(document.getElementsByName('user')[0].value==''||document.getElementsByName('userpw')[0].value==''){document.getElementById('error').style.display='block';setTimeout('document.getElementById(\'error\').style.display=\'none\'',2000)}else{document.getElementById('login').submit();document.getElementById('...').innerHTML='Loading.';}" value="Log In"/></div>
					</form>
					</div>
					<div id="error" style="position:absolute;right:0px;top:0px;width:480px;height:280px;background-color:#FF88A0;color:white;display:none;padding-top:18%;font-size:20px;filter:alpha(Opacity=90);-moz-opacity:0.9;opacity: 0.9;">ERROR!<br><br>账号或密码未输入</div>
	</div>
	<div class="kk" style="background:url('img/asahihp.png');background-size:cover;height:80px;margin-top:15px;cursor:pointer;" onclick="location.href='../hp'">
	<table width="100%" height="100%"><tr><td align="right" style="font-size:18px;color:white;padding-right:20px;font-weight:bold">关于我们</td></tr></table>
	</div>
	<div style="position:relative;width:480px;text-align:right;font-size:12px;color:#FF335C;margin-top:10px;">
	*BETA Only for Chrome
	</div>
	<div style="position:relative;width:480px;text-align:center;font-size:12px;color:black;margin-top:10px;">
	网站备案号 <a href="http://beian.miit.gov.cn" target="_blank">沪ICP备18000509号-1</a>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".t2").click(function(){
		$(this).siblings("input").select();
	});
	 
	$(":text").focus(function(){
		$("#wuser").addClass("t2_t");
	 });
	 $(":password").focus(function(){
		$("#wpw").addClass("t2_t");
	 });
	 
	 
	 
	 $(":text").focusout(function(){
		 if(!$(this).val()){
		$("#wuser").removeClass("t2_t");
		 }
	 });
	 $(":password").focusout(function(){
		 if(!$(this).val()){
		$("#wpw").removeClass("t2_t");
		 }
	 });
});


</script>

</body>