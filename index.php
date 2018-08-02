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




if(mysqli_query($conn,"SELECT * FROM `t_user` WHERE user = '{$_COOKIE['asahiuser']}' AND userpw = '{$_COOKIE['asahiuserpw']}'")->num_rows > 0){

if(!$_COOKIE['loged']){
	$get_user_name=mysqli_query($conn,"SELECT user,name FROM `t_user` WHERE user = '{$_COOKIE['asahiuser']}'")->fetch_row();	
	if($get_user_name[1]){
		$read_user_name=$get_user_name[1];
	}else{
		$read_user_name=$get_user_name[0];
	}
	setCookie("loged",$read_user_name,time()+3600*12);
	$_COOKIE['loged']=$read_user_name;
}

if($logintime){
	mysqli_query($conn,"UPDATE `t_user` SET logintime = '$logintime' WHERE user = '{$_COOKIE['asahiuser']}' AND userpw = '{$_COOKIE['asahiuserpw']}'");
	 }

	 echo file_get_contents("templates/header.html");
?>

<body>
<table cellpadding="0" cellspacing="0" width="100%" height="100%"><!--主表格框-->
<tr><!--最外的表格框-->
<td width="120px;"><!--菜单栏-->
	<div style="width:100%;height:100%;background-color:#000000;">
		<style>
		#shangbutr{
			transition:all 0.5s;
			-moz-transition:all 0.5s;
			-webkit-transition:all 0.5s;
			-o-transition:all 0.5s
		}
		
		
		.caidanxuanxiao{
			padding:8px;color:white;font-size:12px;padding-left:15px;position:relative;
			
			transition:all 0.5s;
			-moz-transition:all 0.5s;
			-webkit-transition:all 0.5s;
			-o-transition:all 0.5s;
		}
		.caidanxuanxiao:hover{
			background-color:#DD0000;
		}
		ul{
			position:absolute;left:120px;top:0px;z-index:10;background-color:#888888;max-width:0px;overflow:hidden;
		
		}
		li{
			padding:9px;min-width:90px;
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
			background-color:#DD0000;
			transition-delay: 0.1s;
-moz-transition-delay: 0.1s; /* Firefox 4 */
-webkit-transition-delay: 0.1s; /* Safari 和 Chrome */
-o-transition-delay: 0.1s; /* Opera */
		}
		</style>
		<script>
		
		$(document).ready(function(){
			$(".caidanxuanxiao").click(function(){
				$(".caidanxuanxiao").attr("style","");
				$(this).attr("style","background-color:#FF6685;border-right:5px solid #DD0000")
				$("#shangbutr").attr("style","background-color:#FF6685");
				setTimeout('$("#shangbutr").attr("style","background-color:#F7F7F7");',800);
			});	
		});
		
		</script>
		<div style="padding:12px 0 0 25px;color:white;font-size:20px;"><img src="img/LOGO2.png"/></div>
		<br><br>
		<a href="index.php"><div class="caidanxuanxiao" style="background-color:#FF6685;border-right:5px solid #DD0000;"><img src="img/home.png"/> &nbsp; HOME >
		<ul>
				<li><a href="index.php" >回到首页</a></li>
				<li><a href="index.php" target="_blank">新建页面</a></li>
			</ul></div></a>
			
		<a href="indexother.php#findme_xinjian1" target="shangbu"><div class="caidanxuanxiao" ><img src="img/new.png" /> &nbsp; 新建订单 >
		<ul>
				<li><a href="indexother.php#findme_xinjian1" target="shangbu">客户订单</a></li>
				<li><a href="indexother.php#findme_xinjian2" target="shangbu">朝日订单</a></li>
			</ul></div></a>
<hr>
		<a href="indexother.php#findme_chanpin5" target="shangbu"><div class="caidanxuanxiao"><img src="img/order.png" /> &nbsp; 搜索朝日 >
			<ul>
	
				<li><a href="indexother.php#findme_chanpin0" target="shangbu">朝日订单</a></li>
				<li><a href="indexother.php#findme_pipei" target="shangbu">订单匹配</a></li>
				<li><a href="indexother.php#findme_chanpin5" target="shangbu">検 &nbsp; 索</a></li>
				
			</ul></div></a>
		<a href="indexother.php#findme_chanpin2" target="shangbu"><div class="caidanxuanxiao"><img src="img/user.png" /> &nbsp; 查询客户 >
			<ul>
				<li><a href="indexother.php#findme_kehusousuo2" target="shangbu">客户订单</a></li>
				<li><a href="indexother.php#findme_pipei" target="shangbu">订单匹配</a></li>
				<li><a href="indexother.php#findme_chanpin2" target="shangbu">検 &nbsp; 索</a></li>
			</ul></div></a>
	<hr>	
		<a href="indexother.php#findme_zaiku" id="zaiku" target="shangbu"><div class="caidanxuanxiao"><img src="img/zaiku.png" /> &nbsp; 在 &nbsp; 库 >
			<ul>
				<li><form action="in.php" id="zaiku1" method="post" target="xiabu"><input type="hidden" name="in" value="in"/></form><a href="###" onclick="document.getElementById('zaiku1').submit();document.getElementById('zaiku').click()">目前在库</a></li>
				<li><a href="in.php" target="xiabu" onclick="document.getElementById('zaiku').click()">出库记录</a></li>
				<li><a href="putin.php" target="xiabu" onclick="document.getElementById('zaiku').click()">手动入库</a></li>
			</ul></div></a>
		<a href="#" onclick="document.getElementById('namecard2').click();document.getElementById('namecard1').click();"><div class="caidanxuanxiao" name="caidanxuanxiao" onclick="caidancolor(5)"><img src="img/namecard.png" /> &nbsp; 名 &nbsp; 片<a id="namecard1" href="indexother.php#findme_namecard" target="shangbu"></a><a id="namecard2" href="namecard.php" target="xiabu"></a></div></a>
		<a href="#" onclick="document.getElementById('project2').click();document.getElementById('project1').click();"><div class="caidanxuanxiao" name="caidanxuanxiao" onclick="caidancolor(6)"><img src="img/project.png" /> &nbsp; 项 &nbsp; 目<a id="project1" href="indexother.php#findme_project" target="shangbu"></a><a id="project2" href="project.php" target="xiabu"></a></div></a>
		
		<a href="indexother.php#hometop" target="shangbu"><div class="caidanxuanxiao"><img src="img/total.png"/> &nbsp; 统计(测试) >
		<ul>
				<li><a href="total.php" target="xiabu">统计</a></li>
				<!--<li><a href="total2.php" target="xiabu">> 统计(过去)</a></li>-->
			</ul></div></a>
			
		<a href="###" target=""><div class="caidanxuanxiao"><img src="img/other.png"/> &nbsp; 其 &nbsp; 他 >
		<ul>
				<li><a href="poprice.php" target="_blank">产品列表</a></li>
				<li><a href="campany.php" target="_blank">客户列表</a></li>
			</ul></div></a>	
			
		<a href="###" target=""><div class="caidanxuanxiao"><img src="img/other.png"/> &nbsp; 功 &nbsp; 能 >
		<ul>
				<li><a href="other/qrcode.php" target="_blank">海能达标签打印</a></li>
			</ul></div></a>		
	</div>
</td>
<td><!--右边主体-->
	<table cellpadding="0" cellspacing="0" width="100%" height="100%"><!--副表格框-->
	<style>
	.shangbutr{
		height:80px;overflow:hidden;width:100%;background-color:#F7F7F7;
		transition:background-color 0.5;
		-moz-transition:background-color 0.5;
		-webkit-transition:background-color 0.5;
		-o-transition:background-color 0.5;
	}
	.xiabutr{
		width:100%;max-height:100%;background-color:;
	}
	</style>
	<tr height="80px"><td><!--副表格上部-->
		<div class="shangbutr" id="shangbutr">
			<iframe frameborder="0" height="100%" width="100%" scrolling="no" id="shangbu" name="shangbu" src="indexother.php" >
				
			</iframe>
		</div>
	</td></tr>
	<tr><td><!--副表格下部-->
		<div class="xiabutr">
			<iframe frameborder="0" height="100%" width="100%" name="xiabu" id="xiabu" scrolling="yes" src="indexxiabu.php#findme">
				
			</iframe>
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