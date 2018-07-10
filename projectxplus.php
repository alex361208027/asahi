<?php
echo file_get_contents("templates/header.html");

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$projectx=$_POST['projectx'];
$projectxplus=$_POST['projectxplus'];
$projectxchange=$_POST['projectxchange'];
$projectxdelete=$_POST['projectxdelete'];
$datedelete=$_POST['datedelete'];


$context=$_POST['context'];
$date=$_POST['date'];
$odate=$_POST['odate'];

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
	
	if(!empty($projectx)){
		if(!empty($date)){
			$sql="SELECT * FROM `t_projectx` WHERE project = '{$projectx}' AND date = '{$date}'";
		}else{
		$sql="SELECT * FROM `t_projectx` WHERE project = '{$projectx}'";
		}
		$result = mysqli_query($conn,$sql);
		$row=$result->fetch_row();
		$row[2]=str_replace("<br>","\r",$row[2]);
?>

<div style="display:inline-block;margin-left:10%"><form action="projectxplus.php" method="post">
【项目x】<br>
项目名:<input type="hidden" name="<?php if(empty($date)){echo 'projectxplus';}else{echo 'projectxchange';} ?>" value="<?php if(empty($date)){echo $projectx;}else{echo $row[4];} ?>"/><?php echo $projectx; ?><br>
日期<input type="datetime" name="date" value="<?php if(empty($date)){echo $todaytime;}else{echo $row[1];} ?>"/><br><input type="hidden" name="odate" value="<?php echo $row[1]; ?>"
<br>信息<br><textarea name="context" style="width:500px;height:300px;"><?php if(!empty($date)){echo $row[2];} ?></textarea><br>
<input type="submit" value="确认提交">
</form></div>

<div style="float:right;">
<form action="projectxplus.php" method="post" id="delete">
<input type="hidden" name="projectxdelete" value="<?php echo $projectx; ?>"/>
<input type="hidden" name="datedelete" value="<?php echo $row[4]; ?>"/>
</form>
<a href="#"><div style="width:80px;height:22px;background-color:#FFAAAA;color:white;display:inline-block;padding:5px;" onclick="javascript:document.getElementById('sure').style.display='block';document.getElementById('suretext').innerHTML='是否确定将记录删除？删除后将无法恢复。';">删除</div></a> 
</div>
<div class="sure" id="sure" align="center"><div id="suretext"></div>
<a href="#"><div class="sure1" style="left:0px;background-color:white;" onclick="javascript:document.getElementById('sure').style.display='none';">取消</div></a> 
<a href="#"><div class="sure1" style="right:0px;background-color:#FFBBBB;" onclick="javascript:document.getElementById('delete').submit();">确定</div></a> 
</div>

<?php
	}elseif(!empty($projectxplus)){
		mysqli_query($conn,"INSERT INTO `t_projectx`(`project`, `date`, `context`, `user`) VALUES ('$projectxplus', '$date', '$context', '{$_COOKIE['asahiuser']}')");
		mysqli_query($conn,"UPDATE `t_project` SET `date` = '$date' WHERE project = '{$projectxplus}'");
		echo "添加成功！";
	}elseif(!empty($projectxchange)){
		$context=str_replace("\r","<br>",$context);
		mysqli_query($conn,"UPDATE `t_projectx` SET `context` = '$context', `date` = '$date', `user` = '{$_COOKIE['asahiuser']}' WHERE _id = '$projectxchange'");
		echo "修改成功！";
	}elseif(!empty($projectxdelete)){
		mysqli_query($conn,"DELETE FROM `t_projectx` WHERE _id = '$datedelete'");
		echo "删除成功！";
	}
$conn->close();
?>