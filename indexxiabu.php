<?php
echo file_get_contents("templates/header.html");

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";



$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);


$logintime=$_POST['logintime'];
$note=$_POST['note'];
$public=$_POST['public'];

$xxx=1;
?>
<style>
.touxiang{
	padding-top:9px;display:inline-block;
	text-align:center;font-size:12px;color:white;background-color:black;margin-right:10px;
	width:36px;height:27px;overflow:hidden;
	-webkit-border-radius: 18px;
  -moz-border-radius: 18px;
  border-radius: 18px;
}
.touxiang2{
	display:inline-block;
	text-align:center;font-size:12px;color:white;background-color:#F7F7F7;margin-right:10px;
	width:36px;height:36px;overflow:hidden;
	-webkit-border-radius: 18px;
  -moz-border-radius: 18px;
  border-radius: 18px;
} 
.xiaoxikuan{
	position:relative;
	width:300px;height:auto;
}
.xiaoxikuanX{
	position:absolute;
	right:10px;top:5px;
	cursor:pointer;
	display:none;
	color:#CCCCCC;
	font-size:12px;
}
.xiaoxikuan:hover > .xiaoxikuanX{
	display:inline-block;
}
.xiaoxikuanX:hover{
	color:black;
}
.xiaoxikuang_style{
	background-color:#DDE4FF;padding:9px 8px 8px 8px;display:inline-block;min-width:30px;font-size:14px;
	-webkit-border-radius: 0px 8px 8px 8px;
  -moz-border-radius: 0px 8px 8px 8px;
  border-radius: 0px 8px 8px 8px;
  -webkit-box-shadow: 1px 1px 2px #DDDDDD;
  -moz-box-shadow: 1px 1px 2px #DDDDDD;
  box-shadow: 1px 1px 2px #DDDDDD;
}
</style>
<script>
$(document).ready(function(){
			$("#fabuxinxi").click(function(){
				$(".fabu").css({"margin-top":"0px"});
				$(this).css({"display":"none"});
				$(this).next().css({"display":"block"});
			});
			
			$("#fasong").click(function(){
				$(this).prev().css({"display":"block"});
				$(this).css({"display":"none"});
				$(".fabu").css({"margin-top":"-81px"});
			});
});
</script>
<form action="in.php" id="zaiku1" method="post"><input type="hidden" name="in" value="in"/></form>
<body height="100%" style="min-width:800px">
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr>
	<td width="350px">
		<div id="gonggaolan" style="position:;z-index:1;width:300px;height:100%;padding:10px;overflow-x:hidden;padding:5px 30px 5px 30px;">
		<div style="width:350px;height:100%;overflow-x:hidden;">
		<style>
		.fabu{
			margin-top:-81px;
			transition:all 0.6s;
			-moz-transition:all 0.6s; 
			-webkit-transition:all 0.6s; 
			-o-transition:all 0.6s; 
		}
		</style>
		<script>
		function pn(){
			str=document.getElementsByName('publicnote')[0].value.replace(/\n/g, '_@').replace(/\r/g, '_#');
			str = str.replace(/_@/g, '<br>');
			var xmlhttp;
			if (str.length==0)
			  { 
			  document.getElementById("noteplus").innerHTML="";
			  return;
			  }
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }else{// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					
					var newNode = document.createElement("p");//创建P标签 
					newNode.innerHTML = xmlhttp.responseText;
					var oldNode = document.getElementById("noteplus"); 
					if (oldNode.lastChild == oldNode) {
						oldNode.appendChild(newNode);
						}else{
					oldNode.parentNode.insertBefore(newNode,oldNode.nextSibling);
						}

					document.getElementsByName("publicnote")[0].value="";
				}
			  }
			xmlhttp.open("GET","ajax/publicnote.php?publicnote="+str,true);
			xmlhttp.send();
					}
		</script>
		<div id="fabu" class="fabu">
		<textarea name="publicnote" style="width:300px;height:80px;"></textarea><br>
		<input type="button" id="fabuxinxi" value="发布信息"/><input type="button" style="display:none;background-color:#AAAAFF" id="fasong" onclick="pn()" value="发送"/>
		</div>
		<xx id="noteplus"></xx>
		<?php 
		$resultpublic = mysqli_query($conn,"SELECT * FROM `t_note` WHERE remark = 1 order by time desc limit 0,25");
		while($rowpublic=$resultpublic->fetch_row()){
			if(in_array($rowpublic[0],$mysave)){
					
				}else{
						$mysave[]=$rowpublic[0];	
						$get_user_name=mysqli_query($conn,"SELECT name FROM t_user WHERE user='$rowpublic[0]' limit 1")->fetch_row();
						if($get_user_name[0]){
						$myload[]=$get_user_name[0];
						}else{
						$myload[]=$rowpublic[0];
						}
						
				}
			$xiaoxikuan_bgcolor_num=array_search($rowpublic[0],$mysave);
			
			if($xiaoxikuan_bgcolor_num==0){
				$xiaoxikuan_bgcolor="#FFDDDD";
			}elseif($xiaoxikuan_bgcolor_num==1){
				$xiaoxikuan_bgcolor="#F7F7F7";
			}elseif($xiaoxikuan_bgcolor_num==2){
				$xiaoxikuan_bgcolor="#FFFFEE";
			}
				
		 ?>
		<div class="xiaoxikuan" id="xxx<?php echo $xxx ?>">
		<div class="xiaoxikuanX"><font onclick="xiaoxikuantop('<?php echo $rowpublic[2]; ?>','<?php echo $todaytime; ?>',<?php echo $xxx; ?>)"><置顶></font><font onclick="xiaoxikuanX('<?php echo $rowpublic[2]; ?>',<?php echo $xxx;$xxx++; ?>)"><删除></font></div>
		<table>
		<tr align="left">
		<td valign="top">
		<?php if(file_exists("upload/user_touxiang/".$rowpublic[0].".png")){echo "<div class='touxiang2'><img src='upload/user_touxiang/".$rowpublic[0].".png' width='36px'></div>";}else{echo "<div class='touxiang'>".mb_substr($rowpublic[0],0,3)."</div>";} ?>
		</td>
		<td>
		<font color="#DDDDDD" size="1"><?php  echo $myload[array_search($rowpublic[0],$mysave)]."&nbsp;".$rowpublic[2] ?></font><br>
		<div class="xiaoxikuang_style" style="background-color:<? echo $xiaoxikuan_bgcolor; ?>"><?php echo $rowpublic[1] ?></div><br><br>
		</td>
		</tr>
		</table>
		</div>
		<?php } ?>
		<font color="#C4C4C4" size="2">只显示最近25条信息</font>
		</div>
		</div>
	</td>
		<script>
		function myn(){
			str=document.getElementsByName('mynote')[0].value.replace(/\n/g, '_@').replace(/\r/g, '_#');
			str = str.replace(/_@/g, '<br>');
			str2 = document.getElementsByName('mynote')[0].value;
			var xmlhttp;
			if (str.length==0)
			  { 
			  document.getElementById("noteplus").innerHTML="";
			  return;
			  }
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }else{// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					document.getElementById("mynotegengxin").innerHTML="<font size='2' color='#FF5577'>备忘信息已更新</font>";
					document.getElementsByName("mynote")[0].value=str2;
					setTimeout("document.getElementById('mynotegengxin').innerHTML='&nbsp;'",2000);
				}
			  }
			xmlhttp.open("GET","ajax/mynote.php?mynote="+str,true);
			xmlhttp.send();
					}
		function xiaoxikuanX(str,xxx){
			var xmlhttp;
			if (str.length==0)
			  {
			  return;
			  }
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }else{// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					document.getElementById('xxx'+xxx).style.display='none';
				}
			  }
			xmlhttp.open("GET","ajax/xiaoxikuanX.php?xtime="+str,true);
			xmlhttp.send();
		}
		function xiaoxikuantop(str,time,xxx){
			$(document).ready(function(){
				$.post("ajax/xiaoxikuantop.php",{xtime:str,time:time},function(data,status){
					$("#noteplus").prepend($("#xxx"+xxx).html());
					$("#xxx"+xxx).remove();
				});
			});
			
		}
		</script>
	<td width="">
				<table cellpadding="0" cellspacing="0" width="100%" height="100%">
				<tr>
					<td width="" align="" valign="top">
						<div style="padding:4px 10px;background-color:#5E5E5E;color:white;display:inline-block" onclick="window.location.href='calendar.php'">REMARK</div><br>
						<textarea style="width:100%;min-height:230px;" name="mynote" onchange="myn()"><?php $rownote=mysqli_query($conn,"SELECT * FROM `t_note` WHERE user = '{$_COOKIE['asahiuser']}' AND remark=0 order by time desc limit 1")->fetch_row();$rownote[1]=str_replace("<br>","\r\n",$rownote[1]); echo $rownote[1]; ?></textarea>
						<div id="mynotegengxin"><font size="2" color="#FF5577">信息更新于:<?php echo $rownote[2];  ?></font></div>
					
					</td>
					<td width="" align="" valign="top">
						<div style="padding:10px;font-size:14px;padding-left:15%">
						<div style="padding:4px 10px;background-color:#5E5E5E;color:white;display:inline-block">最近新建的订单</div>
							<?php 
							$resultpublic = mysqli_query($conn,"SELECT * FROM `t_note` WHERE remark = 7 OR remark = 8 order by time desc limit 0,5");
							while($rowpublic=$resultpublic->fetch_row()){
								if(in_array($rowpublic[0],$mysave)){
					
										}else{
												$mysave[]=$rowpublic[0];	
												$get_user_name=mysqli_query($conn,"SELECT name FROM t_user WHERE user='$rowpublic[0]' limit 1")->fetch_row();
												if($get_user_name[0]){
												$myload[]=$get_user_name[0];
												}else{
												$myload[]=$rowpublic[0];
												}		
										}
							 ?>
						
							<div class="xiaoxikuan">
							<table>
							<tr align="left">
							<td valign="top">
							<?php if(file_exists("upload/user_touxiang/".$rowpublic[0].".png")){echo "<div class='touxiang2'><img src='upload/user_touxiang/".$rowpublic[0].".png' width='36px'></div>";}else{echo "<div class='touxiang'>".mb_substr($rowpublic[0],0,3)."</div>";} ?>
							</td>
							<td>
							<font color="#DDDDDD" size="1"><?php  echo $myload[array_search($rowpublic[0],$mysave)]."&nbsp;".$rowpublic[2] ?></font><br>
							<div class="xiaoxikuang_style"><a href="<?php if($rowpublic[3]==8){echo '4.php?ddt2=';}else{echo '4-1.php?asahit1=';} ?><?php echo $rowpublic[1]; ?>"><?php echo $rowpublic[1]; ?></a></div>
							</td>
							</tr>
							</table>
							</div>
							
							
							
							<?php } ?>
							
						</div>
					</td>
				</tr>
				<tr valign="">
					
					<td width="50%" align="left" valign="top">
					<hr>
						<?php $weichuli=file_get_contents("ajax/write_data/poweichuli.html"); $weichuli = explode(',',$weichuli); ?>
						
						<? if($weichuli[0]>0){ ?>
						<div class="xiaoxikuan">
							<table>
							<tr align="left">
							<td valign="top">
							<div class='touxiang'>朝日</div>
							</td>
							<td>
							<font color="#DDDDDD" size="1"><?php echo $weichuli[1]; ?></font><br>
							<div class="xiaoxikuang_style" style="background-color:#FFCCD6"><a href="6.php?" onclick="window.open('indexother.php#findme_chanpin5','shangbu');">等待处理的朝日PO项目有 <b><?php echo $weichuli[0]; ?></b> 个。</a></div><br><br>
							</td>
							</tr>
							</table>
						</div>
						<? } ?>
						
						
						<?php $weichuli=file_get_contents("ajax/write_data/cweichuli.html"); $weichuli = explode(',',$weichuli); ?>
						<? if($weichuli[0]>0){ ?>
						<div class="xiaoxikuan">
							<table>
							<tr align="left">
							<td valign="top">
							<div class='touxiang'>顧客</div>
							</td>
							<td>
							<font color="#DDDDDD" size="1"><?php echo $weichuli[1]; ?></font><br>
							<div class="xiaoxikuang_style" style="background-color:#FFCCD6"><a href="2.php" onclick="window.open('indexother.php#findme_chanpin2','shangbu');">等待处理的客户PO项目有 <b><?php echo $weichuli[0]; ?></b> 个。</a></div><br><br>
							</td>
							</tr>
							</table>
						</div>
						<? } ?>
						
						<?php $weichuli=file_get_contents("ajax/write_data/zaikushu.html"); $weichuli = explode(',',$weichuli); ?>
						<? if($weichuli[0]>0){ ?>
						<div class="xiaoxikuan">
							<table>
							<tr align="left">
							<td valign="top">
							<div class='touxiang'>在库</div>
							</td>
							<td>
							<font color="#DDDDDD" size="1"><?php echo $weichuli[1]; ?></font><br>
							<div class="xiaoxikuang_style" style="background-color:#FFCCD6"><a href="in.php?in=in" onclick="window.open('indexother.php#findme_zaiku','shangbu');">当前在库LED数 <b><?php echo $weichuli[0]; ?></b> pcs。</a></div><br><br>
							</td>
							</tr>
							</table>
						</div>
						<? } ?>
					</td>
					<td width="50%" align="center">

						<style>
						
							#vert{  
											width: 300px;  
											height: 200px;  
											border-left: 2px solid skyblue; 
											border-bottom: 2px solid skyblue; 
											background-color:;  
											position: relative; 
										}  
							#vert ul li{  
											float: left;  
											position: absolute;  
											bottom: 0px;  
											background-color: salmon;  
											text-align: center;  
											font-weight:;  
											color: black;  
											height: 100px;  
											width:30px;  
											list-style: none;  
										} 
										<?php 
										
										$chukutongji=file_get_contents("ajax/write_data/chukutongji.html"); $chukutongji = explode(',',$chukutongji);
										$color=888888;$left=30;
										for($ic=0;$ic<5;$ic++){
												echo "#vert ul li.c".$ic."{left: ".$left."px; height:".($chukutongji[$ic]/10000)."px;background-color:#".$color.";}\r\n";
												$color=$color-111111;
												$left=$left+50;	
										}	
												
												
										
										?>
										  
							</style>


						<div id="vert">  
							<!--<h3>统计数据</h3>  -->
								<ul>  
									<li class="c0"></li>  
									<li class="c1"></li>  
									<li class="c2"></li>  
									<li class="c3"></li>  
								    <li class="c4"></li>
								</ul>  
								
							</div> 
					<div style="width:300px;">
					<table width="100%"><tr>
					<td width="10%">&nbsp;</td>
					<td width="17%"><font size="1"><?php echo ($chukutongji[0]/1000)."K"; ?><br>&nbsp;</font></td>
					<td width="17%"><font size="1"><?php echo ($chukutongji[1]/1000)."K"; ?><br>上月</font></td>
					<td width="16%"><font size="1"><?php echo ($chukutongji[2]/1000)."K"; ?><br>本月</font></td>
					<td width="16%"><font size="1"><?php echo ($chukutongji[3]/1000)."K"; ?><br>次月</font></td>
					<td width="24%"><font size="1"><?php echo ($chukutongji[4]/1000)."K"; ?><br>预测</font></td>
					</tr>
					<tr><td align="center" colspan="6"><font color="#888888"><a href="total.php">每月实际出荷量及预测</a></font></td></tr>
					</table>
					</div>
					
					
					</td>
					
				</tr>
			</table>
		
	</td>
</tr>
	
</table>
</body>


<?php
 $conn->close();
?>