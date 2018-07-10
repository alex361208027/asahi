<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');
?>

<style>
input[type="text"],
input[type="button"],
input[type="password"],
input[type="email"],
input[type="submit"],
input[type="tel"]{
    width: 120px;
    height: 26px;
    line-height: 16px;
    margin: 0 0 10px;
    padding: 0 10px;
    border: none;
    color:white ;
    cursor: pointer;
    resize: none;
    font-size: 16px;
    border-bottom:2px solid #CCCCFF;
    background:none ;
	text-align:center;
	margin-top:6px;
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
	webkit-box-shadow: 0px 15px 18px #808080;
  -moz-box-shadow: 0px 15px 18px #808080;
  box-shadow: 0px 15px 18px #808080;
}

.bb{
	cursor:pointer;color:#180077;font-size:16px;margin-left:30px;background-color:#AAFFFF;padding:3px 10px 3px 10px;display:inline;
	-webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
   transition: all 0.3s;
-moz-transition: all 0.3s;	/* Firefox 4 */
-webkit-transition: all 0.3s;	/* Safari 和 Chrome */
-o-transition: all 0.3s;
}
.bb:hover{
	background-color:#FF6685;
}
</style>
<body>
<div width="100%" align="center">

	<div class="kk">
				  <div style="position:absolute;right:20px;top:50px;font-size:14px;color:white" align="left">
					<form action="index.php" method="post" id='login'>
					USER  <br><input type="text" name="user" size="10" maxlength="" /><br><br>
					PassWord <br><input type="password" name="userpw" size="10" maxlength="" /><br><br>
					<input type="hidden" name="logintime" value="<?php echo $todaytime; ?>"/>
					<div id="loging" class="bb" onclick="if(document.getElementsByName('user')[0].value==''||document.getElementsByName('userpw')[0].value==''){document.getElementById('error').style.display='block';setTimeout('document.getElementById(\'error\').style.display=\'none\'',2000)}else{document.getElementById('login').submit();document.getElementById('...').innerHTML='Loading.';}">Log In</div>
					</form>
					</div>
					<div id="error" style="position:absolute;right:0px;top:0px;width:480px;height:280px;background-color:#FF88A0;color:white;display:none;padding-top:18%;font-size:20px;filter:alpha(Opacity=90);-moz-opacity:0.9;opacity: 0.9;">ERROR!<br><br>账号或密码未输入</div>
	</div>
	<div style="cursor:pointer;position:relative;width:480px;text-align:right;font-size:11px;color:#FF335C;margin-top:10px;" onclick="beta()">
	<u>测试登录请点击此处</u><a id="href" href="http://www.asahi-rubber.cn/BETA/index.php?user=beta"></a>
	</div>
	<div style="position:relative;width:480px;text-align:right;font-size:12px;color:#FF335C;margin-top:10px;">
	*BETA Only for Chrome
	</div>
	<div style="position:relative;width:480px;text-align:center;font-size:12px;color:black;margin-top:10px;">
	网站备案号 <a href="http://www.miitbeian.gov.cn" target="_blank">沪ICP备18000509号-1</a>
	</div>
</div>
<script>
function beta(){
	document.getElementsByName('user')[0].value="beta";
	document.getElementsByName('userpw')[0].value="beta";
	document.getElementById('loging').onclick=function(){document.getElementById('href').click()};
}
</script>

</body>