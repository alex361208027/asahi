<title>朝日用户管理</title>
<?
echo file_get_contents("templates/header.html");
date_default_timezone_set('PRC');

$theuser=$_GET['theuser'];
if($theuser=$_COOKIE['asahiuser']){
	
	?>
	<body>
	<style>
	.mulu{
		color:#999999;padding:4px;cursor:pointer;display:inline-block;
	}
	.mulu:hover{
		color:white;
	}
	.button{
		margin-left:10px;padding:3px 6px;background:black;color:white;display:inline-block;cursor:pointer;
		-webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
	}
	</style>
	<script>
	function touxiang_upload(){
		//document.getElementById('user_name').innerHTML="正在上传头像";
		//setTimeout("document.getElementById('submit').style.display='block';",8000);

		$(function(){
      
		   var file =$("#file")[0].files[0];
		   
           var formData = new FormData();
		   
           formData.append('file',file);
		   
           $.ajax({
             type: "POST",
             url: "upload/user_touxiang.php",  //同目录下的php文件
             data:formData,
             cache:false,  
             processData:false, 
             contentType:false,
             success: function(data){  //请求成功后的回调函数
               $("#show_touxiang").empty();
			   $("#show_touxiang").append(data);
			 }
			});
 
		})
		
	}
	
	
	</script>
	<br><br>
	<table width="700px" align="center" cellspacing="0" cellpadding="0">
		<tr>
			<td width="35%">
				<div style="position:relative;padding:10px;width:(100%-10px);min-height:400px;background:#FFBBBB;text-align:center;color:white;-webkit-border-radius: 13px 0px 0px 13px;-moz-border-radius: 13px 0px 0px 13px;border-radius: 13px 0px 0px 13px;" align="center">
					<br>
				
						<label><div id="show_touxiang" style="overflow:hidden;cursor:pointer;display:inline-block;width:66px;height:66px;background:white;-webkit-border-radius: 33px 33px 33px 33px;-moz-border-radius: 33px 33px 33px 33px;border-radius: 33px 33px 33px 33px;" align="center">
							<?php if(file_exists("upload/user_touxiang/".$theuser.".png")){echo "<img src='upload/user_touxiang/".$theuser.".png' width='66px'/>";} ?>
						</div><br>
						<input type="file" id="file" style="display:none" onchange="touxiang_upload()"></label>

					<div id="user_name"><?php echo $_COOKIE['loged']; ?></div>
					<br>
					<div class="mulu" onclick="user_xinxi('click=<?php echo $theuser; ?>',1)">用户信息</div><br>
					<div class="mulu" onclick="user_mima('click=<?php echo $theuser; ?>',1)">密码更改</div><br>
					<div class="mulu" onclick="user_new('click=<?php echo $theuser; ?>',1)">创建新用户</div><br>
					<br>
					<!--<a href="index.php"><div class="mulu">回到首页</div></a><br>-->
					<a href="a.php" target="_top"><div class="mulu">重新登录</div></a><br>

				</div>
			</td>
			<td width="65%">
				<div id="xiaoxi" style="padding:10px;width:(100%-10px);min-height:400px;background:#FFDDDD;-webkit-border-radius: 0px 13px 13px 0px;-moz-border-radius: 0px 13px 13px 0px;border-radius: 0px 13px 13px 0px;">
				
				</div>
			</td>
		</tr>
	</table>
	</body>
	<?
	
	
}else{
	echo "xxx";
}


?>



<script>
function user_xinxi(str,num){
			
			if(num==2){
			str=str+"&name="+document.getElementById("name").value;
			
			}
			
			var xmlhttp;
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }else{// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					
					
					document.getElementById("xiaoxi").innerHTML=xmlhttp.responseText;
					
				}
			  }
			xmlhttp.open("GET","./ajax/user_xinxi.php?"+str,true);
			xmlhttp.send();
	
}

function user_mima(str,num){
			
			if(num==2){
			str=str+"&pw1="+document.getElementById("pw1").value+"&pw2="+document.getElementById("pw2").value+"&pw3="+document.getElementById("pw3").value;
			
			}
			
			var xmlhttp;
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }else{// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					
					
					document.getElementById("xiaoxi").innerHTML=xmlhttp.responseText;
					
				}
			  }
			xmlhttp.open("GET","./ajax/user_mima.php?"+str,true);
			xmlhttp.send();
	
}

function user_new(str,num){
			
			if(num==2){
			str=str+"&newid="+document.getElementById("newid").value+"&pw1="+document.getElementById("pw1").value+"&pw2="+document.getElementById("pw2").value;
			
			}
			
			var xmlhttp;
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }else{// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					
					
					document.getElementById("xiaoxi").innerHTML=xmlhttp.responseText;
					
				}
			  }
			xmlhttp.open("GET","./ajax/user_new.php?"+str,true);
			xmlhttp.send();
	
}

</script>