<?php

echo file_get_contents("templates/header.html");

date_default_timezone_set('PRC');

?>

<?

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$name1=$_POST['name1'];
$campany1=$_POST['campany1'];

$name2=$_POST['name2'];
$campany2=$_POST['campany2'];

$name3=$_POST['name3'];
$campany3=$_POST['campany3'];

$name=$_POST['name'];
$sex=$_POST['sex'];
$campany=$_POST['campany'];
$position=$_POST['position'];
$department=$_POST['department'];
$title=$_POST['title'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$tel=$_POST['tel'];
$tel2=$_POST['tel2'];
$fax=$_POST['fax'];
$address=$_POST['address'];
$post=$_POST['post'];
$web=$_POST['web'];
$remark=$_POST['remark'];

$_id=$_POST['_id'];
$datetime=date("Y-m-d");
$delete=$_POST['delete'];

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);


if($name&&$campany){
	//$likecampany=mb_substr($campany,0,6);
	//$sql="SELECT * FROM `t_namecard` WHERE name = '$name' AND campany like '%$likecampany%'";
	//$result = mysqli_query($conn,$sql);
	//if($result->num_rows == 0){
    mysqli_query($conn,"INSERT INTO `t_namecard`(`name`, `sex`, `campany`, `position`, `department`, `title`, `email`, `phone`, `tel`, `tel2`, `fax`, `address`, `post`, `web`, `remark`, `datetime`) VALUES ('$name', '$sex', '$campany', '$position', '$department', '$title', '$email', '$phone', '$tel', '$tel2', '$fax', '$address', '$post', '$web', '$remark', '$datetime')");
	echo "添加成功！<br><a href='namecardplus.php'><u>点击</u>继续添加</a><br><a href='namecard.php'><u>返回</u>名片页</a>";
		//}else{
		//	echo "已存在！";
		//}
	}elseif($name3&&$campany3){
		mysqli_query($conn,"UPDATE `t_namecard` SET `name`='$name3', `sex`='$sex', `campany`='$campany3',`position`='$position',`department`='$department',`title`='$title',`email`='$email',`phone`='$phone',`tel`='$tel',`tel2`='$tel2',`fax`='$fax',`address`='$address',`post`='$post',`web`='$web',`remark`='$remark',`datetime`='$datetime' WHERE _id = '$_id'");
		echo "修改成功！";
}elseif($delete){
	mysqli_query($conn,"DELETE FROM `t_namecard` WHERE _id = '{$delete}'");
	echo "删除成功！";
}elseif($name1&&$campany1){
	$sql="SELECT * FROM `t_namecard` WHERE name = '{$name1}' AND campany = '{$campany1}'";
	$result = mysqli_query($conn,$sql);
	$row=$result->fetch_row();
?>
<div style="display:inline-block;margin-left:10%">
<form action="namecardplus.php" method="post">
姓名<input type="text" name="name3" value="<?php echo $row[0]; ?>"/><br>
性别 &nbsp; <input type="radio" name="sex" value="男" <?php if($row[1]=='男'){echo 'checked';} ?>> &nbsp; 男
 &nbsp; &nbsp; <input type="radio" name="sex" value="女" <?php if($row[1]=='女'){echo 'checked';} ?>> &nbsp; 女<br>
公司<input type="text" name="campany3" style="width:400px" value="<?php echo $row[2]; ?>" /><br>
职位<input type="text" name="position" value="<?php echo $row[3] ?>"/>
部门<input type="text" name="department" value="<?php echo $row[4] ?>"/>
职称<input type="text" name="title" value="<?php echo $row[5] ?>"/><br>
邮箱<input type="text" name="email" style="width:400px" value="<?php echo $row[6] ?>"/><br>
手机<input type="text" name="phone" value="<?php echo $row[7] ?>"/><br>
电话<input type="text" name="tel" value="<?php echo $row[8] ?>"/>
<input type="text" name="tel2" value="<?php echo $row[9] ?>" placeholder="电话2"/><br>
传真<input type="text" name="fax" value="<?php echo $row[10] ?>"/><br>
地址<input type="text" name="address" style="width:400px" value="<?php echo $row[11] ?>"/>
邮编<input type="text" name="post" value="<?php echo $row[12] ?>"/><br>
网址<input type="text" name="web" value="<?php echo $row[13] ?>"/><br>
备注<input type="text" name="remark" style="width:400px" value="<?php echo $row[14] ?>"/><br>
<input type="hidden" name="_id" value="<?php echo $row[15]; ?>"/>
<input type="submit" value="确认修改" onclick="buttons(this)">
 &nbsp; <a href="#"><div style="display:inline-block;width:80px;height:22px;background-color:#FFAAAA;color:white;text-align:center;" onclick="javascript:document.getElementById('sure').style.display='block';document.getElementById('suretext').innerHTML='是否确定将<font color=\'red\'>'+ document.getElementsByName('name3')[0].value +'</font>删除？删除后将无法恢复。';">删除</div></a> 

</form>
</div>
<form action="namecardplus.php" id="delete" method="post"><input type="hidden" name="delete" value="<?php echo $row[15]; ?>"/></form>
<div class="sure" id="sure" align="center"><div id="suretext"></div>
<a href="#"><div class="sure1" style="left:0px;background-color:white;" onclick="javascript:document.getElementById('sure').style.display='none';">取消</div></a> 
<a href="#"><div class="sure1" style="right:0px;background-color:#FFBBBB;" onclick="javascript:document.getElementById('delete').submit();">确定</div></a> 
</div>


<br><br><br><br><br><br>
<?php
}else{ ?>
<div style="display:inline-block;margin-left:10%">
	<form action="namecardplus.php" method="post">【新建名片】<br>
姓名<input type="text" name="name" value="<?php echo $row[0] ?>"/><br>
性别 &nbsp; <input type="radio" name="sex" value="男" checked="checked"/> &nbsp; 男
 &nbsp; &nbsp; <input type="radio" name="sex" value="女"/> &nbsp; 女<br>
公司<input type="text" name="campany" style="width:400px" value="<?php echo $row[2] ?>" onchange="checkexist()"/><br>
职位<input type="text" name="position" value="<?php echo $row[3] ?>"/>
部门<input type="text" name="department" value="<?php echo $row[4] ?>"/>
职称<input type="text" name="title" value="<?php echo $row[5] ?>"/><br>
邮箱<input type="text" name="email" style="width:400px" value="<?php echo $row[6] ?>"/><br>
手机<input type="text" name="phone" value="<?php echo $row[7] ?>"/><br>
电话<input type="text" name="tel" value="<?php echo $row[8] ?>"/><a style="color:#AAAAAA" onclick="javascript:document.getElementById('tel2').style.display='inline-block';">++添加第二个号码</a>
<div id="tel2" style="display:none;"><input type="text" name="tel2" value="<?php echo $row[9] ?>" placeholder="电话2"/></div><br>
传真<input type="text" name="fax" value="<?php echo $row[10] ?>"/><br>
地址<input type="text" name="address" style="width:400px" value="<?php echo $row[11] ?>"/>
邮编<input type="text" name="post" value="<?php echo $row[12] ?>"/><br>
网址<input type="text" name="web" value="<?php echo $row[13] ?>"/><br>
备注<input type="text" name="remark" style="width:400px" value="<?php echo $row[14] ?>"/><br>
<input type="submit" value="确认提交" onclick="buttons(this)">
</form>
</div>
<script>
function checkexist(){
			var name=document.getElementsByName('name')[0].value;
			var campany=document.getElementsByName('campany')[0].value;
			if(name && campany){
				str="name="+name+"&campany="+campany;
				}else{
				alert("【姓名】和【公司】是必填项目");
				str="";
			}
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
					if(xmlhttp.responseText.length==0){
						
					}else{
						alert("该名片可能已存在，请尝试搜索 确认一下");
					}
					
				}
			  }
			xmlhttp.open("GET","./ajax/namecard_checkexist.php?"+str,true);
			xmlhttp.send();

}
</script>
<?php 
} 
$conn->close();

?>