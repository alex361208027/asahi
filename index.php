<?php
$user=$_POST['user'];
$userpw=$_POST['userpw'];
$logintime=$_POST['logintime'];
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');
$user=strtolower($user);
if($user){
setCookie("asahiuser",$user,time()+3600*12);
$_COOKIE['asahiuser']=$user;
setCookie("asahiuserpw",$userpw,time()+3600*12);
$_COOKIE['asahiuserpw']=$userpw;

$_COOKIE['loged']="";
}


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";



// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);




if(mysqli_query($conn,"SELECT * FROM `t_user` WHERE user = '{$_COOKIE['asahiuser']}' AND userpw = '{$_COOKIE['asahiuserpw']}' limit 1")->num_rows > 0){

if(!$_COOKIE['loged']){
	$get_user_name=mysqli_query($conn,"SELECT user,name FROM `t_user` WHERE user = '{$_COOKIE['asahiuser']}' limit 1")->fetch_row();	
	if($get_user_name[1]){
		$read_user_name=$get_user_name[1];
	}else{
		$read_user_name=$get_user_name[0];
	}
	setCookie("loged",$read_user_name,time()+3600*12);
	$_COOKIE['loged']=$read_user_name;
}

if($logintime){
	mysqli_query($conn,"UPDATE `t_user` SET logintime = '$logintime' WHERE user = '{$_COOKIE['asahiuser']}' AND userpw = '{$_COOKIE['asahiuserpw']}' limit 1");
	 }

	 echo file_get_contents("templates/header.html");
?>

<body>
<table cellpadding="0" cellspacing="0" width="100%" height="100%"><!--主表格框-->
<tr><!--最外的表格框-->
<td width="60px;"><!--菜单栏-->
	<div style="width:100%;height:100%;background-color:#0C4842;">
		<style>
		#shangbutr{
			transition:all 0.5s;
			-moz-transition:all 0.5s;
			-webkit-transition:all 0.5s;
			-o-transition:all 0.5s
		}
		
		
		.caidanxuanxiao{
			padding:10px;color:white;font-size:12px;padding-left:18px;position:relative;
			border-bottom:1px solid #6D5F62;
			cursor:pointer;
			transition:all 0.5s;
			-moz-transition:all 0.5s;
			-webkit-transition:all 0.5s;
			-o-transition:all 0.5s;
		}
		.caidanxuanxiao:hover{
			background-color:#233342;
		}
		ul{
			position:absolute;left:60px;top:0px;z-index:10;background-color:#34495e;max-width:0px;overflow:hidden;
		
		}
		li{
			padding:10px;min-width:90px;
		}
		li,ul{		
			color:white;
			transition:all 0.5s;
			-moz-transition:all 0.5s;
			-webkit-transition:all 0.5s;
			-o-transition:all 0.5s;
			
transition-delay: 0.8s;
-moz-transition-delay: 0.8s; /* Firefox 4 */
-webkit-transition-delay: 0.8s; /* Safari 和 Chrome */
-o-transition-delay: 0.8s; /* Opera */
			
		}
		.caidanxuanxiao:hover > ul{
			max-width:100px;
		}
		li:hover{
			background-color:#233342;
			transition-delay: 0.1s;
-moz-transition-delay: 0.1s; /* Firefox 4 */
-webkit-transition-delay: 0.1s; /* Safari 和 Chrome */
-o-transition-delay: 0.1s; /* Opera */
		}
		.daohangimg{
			width:20px;
		}
		
		</style>
		<script>
		
		$(document).ready(function(){
			$(".caidanxuanxiao").click(function(){
				$(".caidanxuanxiao").attr("style","");
				$(this).attr("style","background-color:#8E354A;")
				$("#shangbutr").css({"background-color":"#FF6685"});
				setTimeout('$("#shangbutr").css({"background-color":"white"});',800);
			});	
		});
		
		</script>
		<div style="padding-top:10px"><table width="100%"><tr width="100%"><td align="center"><a href="index.php" target="_blank"><img src="img/LOGO2.png" width="40px"/></a></td></tr></table></div>
		<br><br>
		<a href="index.php"><div class="caidanxuanxiao" style="background-color:#8E354A;" title="HOME"><img src="img/home.png" class="daohangimg"/>
		<ul>
				<li><a href="index.php" >回到首页</a></li>
				<li><a href="index.php" target="_blank">新建页面</a></li>
			</ul>
		</div></a>
			
		<a href="indexother.php#findme_xinjian1" target="shangbu"><div class="caidanxuanxiao" title="新建订单"><img src="img/new.png" class="daohangimg"/>
		<ul>
				<li><a href="indexother.php#findme_xinjian1" target="shangbu">客户订单</a></li>
				<li><a href="indexother.php#findme_xinjian2" target="shangbu">朝日订单</a></li>
			</ul>
		</div></a>

		<a href="indexother.php#findme_chanpin5" target="shangbu"><div class="caidanxuanxiao" title="朝日订单"><img src="img/order.png" class="daohangimg"/>
			<ul>
	
				<li><a href="indexother.php#findme_chanpin0" target="shangbu">朝日订单</a></li>
				<li><a href="indexother.php#findme_pipei" target="shangbu">订单匹配</a></li>
				<li><a href="indexother.php#findme_chanpin5" target="shangbu">検 &nbsp; 索</a></li>
				
			</ul>
		</div></a>
		<a href="indexother.php#findme_chanpin2" target="shangbu"><div class="caidanxuanxiao" title="客户订单"><img src="img/user.png" class="daohangimg"/>
			<ul>
				<li><a href="indexother.php#findme_kehusousuo2" target="shangbu">客户订单</a></li>
				<li><a href="indexother.php#findme_pipei" target="shangbu">订单匹配</a></li>
				<li><a href="indexother.php#findme_chanpin2" target="shangbu">検 &nbsp; 索</a></li>
			</ul>
		</div></a>

		<a href="indexother.php#findme_zaiku" target="shangbu"><div class="caidanxuanxiao" title="出 入 库"><img src="img/zaiku.png" class="daohangimg"/>
			<ul>
				<li><a href="###" onclick="window.open('in.php?in=in','xiabu');window.open('indexother.php#findme_zaiku','shangbu');">目前在库</a></li>
				<li><a href="in.php" target="xiabu" onclick="window.open('indexother.php#findme_zaiku','shangbu');">出库记录</a></li>
				<li><a href="putin.php" target="xiabu" onclick="window.open('indexother.php#findme_zaiku','shangbu');">手动入库</a></li>
			</ul>
		</div></a>
		<div class="caidanxuanxiao" name="caidanxuanxiao" onclick="window.open('namecard.php','xiabu');window.open('indexother.php#findme_namecard','shangbu');caidancolor(5)" title="名片"><img src="img/namecard.png" class="daohangimg"/></div>
		<div class="caidanxuanxiao" name="caidanxuanxiao" onclick="window.open('project.php','xiabu');window.open('indexother.php#findme_project','shangbu');caidancolor(6)" title="日志"><img src="img/project.png" class="daohangimg"/></div>
		
		<a href="indexother.php#hometop" target="shangbu"><div class="caidanxuanxiao" title="统计"><img src="img/total.png" class="daohangimg"/>
		<ul>
				<!--<li><a href="total.php" target="xiabu">统计</a></li>-->
				<li><a href="total_highcharts.php" target="xiabu">统 计</a></li>
				<li><a href="banngo_date_list.php" target="xiabu">供料表</a></li>
			</ul></div></a>
			
		<div class="caidanxuanxiao" title="列表"><img src="img/other.png" class="daohangimg"/>
		<ul>
				<li><a href="poprice.php" target="_blank">产品列表</a></li>
				<li><a href="campany.php" target="_blank">客户列表</a></li>
				<li><a href="anjian.php" target="_blank">案件列表</a></li>
			</ul></div>
			
		<div class="caidanxuanxiao" title="功能"><img src="img/otherfunction.png" class="daohangimg"/>
		<ul>
				<li><a href="label_print.php" target="_blank">标签打印</a></li>
				<li><a href="other/qrcode.php" target="_blank"><s>海能达标签打印</s></a></li>
			</ul></div>	
		<div class="caidanxuanxiao" title="页面设置"><img src="img/page.png" class="daohangimg"/>
		<ul>
				<li><a href="###" onclick="document.getElementById('shangbutr').style.height='160px';document.getElementById('tabletop').style.height='160px';">手机页面</a></li>
				<li><a href="###" onclick="document.getElementById('shangbutr').style.height='80px';document.getElementById('tabletop').style.height='80px';">电脑页面</a></li>
			</ul></div>
	</div>
</td>
<td><!--右边主体-->
	<table cellpadding="0" cellspacing="0" width="100%" height="100%"><!--副表格框-->
	<tr style="height:80px;" id="tabletop"><td><!--副表格上部-->
		<div class="shangbutr" id="shangbutr" style="height:80px;overflow:hidden;width:100%;background-color:white;transition:background-color 0.5;-moz-transition:background-color 0.5;-webkit-transition:background-color 0.5;-o-transition:background-color 0.5;">
			<iframe frameborder="0" height="100%" width="100%" scrolling="no" id="shangbu" name="shangbu" src="indexother.php" ></iframe>
		</div>
	</td></tr>
	<tr><td><!--副表格下部-->
		<div class="xiabutr" style="width:100%;max-height:100%;background-color:;">
			<iframe frameborder="0" height="100%" width="100%" name="xiabu" id="xiabu" scrolling="yes" src="indexxiabu.php#findme"></iframe>
		</div>
	</td></tr>
	</table>
</td>
</tr>
</table>

</body>
<?php
}else{
	setCookie("loged","",time()+1);
	$_COOKIE['loged']="";
	if(!empty($user)){
		echo "<a href='a.php'>账号或密码错误，请重新登录</a>";
	}else{
		?>
		<body onload="document.getElementById('href').click()">
		<a href='a.php' id="href">正在跳转登录界面</a>
		</body>
		<?php
	}
}
$conn->close();
?>