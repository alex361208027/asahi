<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);



$campany=$_GET['campany'];
$campanyname=$_GET['campanyname'];
//$position=$_GET['position'];
//$remark=$_GET['remark'];


$search=$_GET['search'];


$sqllogin="SELECT * FROM `t_user` WHERE user = '{$_COOKIE['asahiuser']}' AND userpw = '{$_COOKIE['asahiuserpw']}'";
$resultlogin = mysqli_query($conn,$sqllogin);
if($resultlogin->num_rows > 0){

if($campany&&$campanyname){
	if(mysqli_query($conn,"SELECT * FROM `t_campany` WHERE campany = '$campany'")-> num_rows > 0){
		echo $campany."已经存在，<a href='campany.php'>回到首页</a>";
	}else{
		mysqli_query($conn,"INSERT INTO `t_campany`(`campany`, `campanyname`, `position`) VALUES ('$campany','$campanyname','888')");
		echo $campanyname." &nbsp <-添加成功,<a href='campany.php'>回到首页</a>";
	}
}else{
	if($search){
$sql = "SELECT * FROM `t_campany` WHERE campanyname like '%$search%' OR reamrk like '%$search%' order by id desc";		
	}else{
$sql = "SELECT * FROM `t_campany` WHERE 1 order by position asc";
	}
$result=mysqli_query($conn,$sql);
$i=1;
?>
<style>	
input[type="text"]{
	width:200px;
    height: 20px;
    
    margin: 0;
    padding: 0;
    border: none;
    color:#666666 ;
    cursor: pointer;
    resize: none;
    background:#EEEEFF;
	text-align:center;
margin-right: 3px;
}
</style>
<form action="campany.php" method="GET">
<input type="text" name="campany" value="" placeholder="客户简称"><input type="text" name="campanyname" value="" placeholder="客户全称"><input type="submit" value="新建/添加">
</form>
<hr>
<form action="campany.php" method="GET">
<input type="text" name="search" style="width:200px" value="<?php echo $search ?>" placeholder="搜索"><input type="submit" value="搜索">
</form>
<table cellpadding="2" cellspacing="0" align="center">
<tr style="background-color:#FF6685;color:white;height:;" align="center">
<td width="50px"></td>
<td width="50px">#</td>
<td>客户全称(送货单公司全称)</td>
<td></td>
<td>日本向简称</td>
<td>送货单地址</td>
<td>备注</td>
<td></td><td></td>
</tr>
<?php while($row=$result->fetch_row()){ ?>
	<tr>
	<td><button id="position<?php echo $row[0] ?>" onclick="position(<?php echo $row[0]; ?>)">置顶</button></td>
	<td><i><?php echo $i ?>.</i></td>
	<td align="center"><input type="text" id="campanyname<?php echo $row[0]; ?>" value="<?php echo $row[2] ?>"></td>
	<td align="center"><?php echo $row[1]; ?></td>
	<td align="center"><input type="text" style="width:80px" id="japanname<?php echo $row[0]; ?>" value="<?php echo $row[5] ?>"></td>
	<td align="center"><input type="text" id="addresscampany<?php echo $row[0] ?>" value="<?php echo $row[7]; ?>" placeholder="收货单位"><br><input type="text" id="address<?php echo $row[0]; ?>" value="<?php echo $row[6] ?>" placeholder="收货地址"></td>
	<td><input type="text" id="remark<?php echo $row[0] ?>" value="<?php echo $row[4]; ?>"></td>
	<td><button id="button<?php echo $row[0] ?>" onclick="campany(<?php echo $row[0]; ?>)">确认编辑</button></td>
	<td><form action="upload/campanylogo.php" method="post" enctype="multipart/form-data"><label><?php if(file_exists("upload/campanylogo/".$row[1].".png")){echo "<img src='upload/campanylogo/".$row[1].".png' width='60px'>";}else{echo "+公司logo";} ?>
		<input type="file" name="file" style="display:none" onchange="document.getElementById('submit<?php echo $row[0]; ?>').click();"/></label>
		<input type="hidden" name="campany" value="<?php echo $row[1]; ?>">
		<input type="submit" name="submit" id="submit<?php echo $row[0]; ?>" value="提交头像图片" style="display:none;"/></form>
	</td>
	</tr>
<?php	
$i++;
} ?>
</table>
<script>
function campany(id){
			str="";
			str="campanyname="+document.getElementById('campanyname'+id).value+"&japanname="+document.getElementById('japanname'+id).value+"&remark="+document.getElementById('remark'+id).value+"&address="+document.getElementById('address'+id).value+"&addresscampany="+document.getElementById('addresscampany'+id).value+"&_id="+id;
			//alert(str);
			var xmlhttp;
			if (str.length==0)
			  { 
			  //document.getElementById("ajasdiv").innerHTML="";
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
					
					if(isNaN(xmlhttp.responseText)==true){
					
						document.getElementById("button"+id).innerHTML="已更新";
						//document.getElementById("button"+id).onclick="";
					}else{
						
						//document.getElementById("campany"+xmlhttp.responseText).value="";
						document.getElementById("button"+id).innerHTML="已删除";
						document.getElementById("button"+id).onclick="";
					}
					
					
				}
			  }
			xmlhttp.open("GET","ajax/campany.php?"+str,true);
			xmlhttp.send();
}
function position(id){
			str="";
			str="position=1&_id="+id;
			//alert(str);
			var xmlhttp;
			if (str.length==0)
			  { 
			  //document.getElementById("ajasdiv").innerHTML="";
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
					
						setTimeout("location.reload()",500);
		
				}
			  }
			xmlhttp.open("GET","ajax/campany.php?"+str,true);
			xmlhttp.send();
}
</script>
	
<?php
}

}
else{
	echo "朝日科技(上海)有限公司-送货单系统<br><a href='a.php'>请登录</a>";
}
$conn->close();
?>