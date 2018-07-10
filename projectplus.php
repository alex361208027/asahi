<?php
echo file_get_contents("templates/header.html");

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$about=$_POST['about'];
$context=$_POST['context'];
$date=$_POST['date'];
$statu=$_POST['statu'];

$project=$_POST['project'];
$projectplus=$_POST['projectplus'];
$projectchange=$_POST['projectchange'];
$projectdelete=$_POST['projectdelete'];

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

if(!empty($project)){
	$sql="SELECT * FROM `t_project` WHERE project = '{$project}'";
	$result = mysqli_query($conn,$sql);
	$row=$result->fetch_row();
	$row[2]=str_replace("<br>","\r",$row[2]); 
	 }elseif(!empty($projectplus)){
		$sqlproject="SELECT * FROM `t_project` WHERE project = '{$projectplus}'";
		$resultproject = mysqli_query($conn,$sqlproject);
		if($resultproject->num_rows > 0){
			echo "已存在！";
		}else{
		mysqli_query($conn,"INSERT INTO `t_project`(`project`, `about`, `context`, `date`, `statu`) VALUES ('$projectplus', '$about', '$context', '$date', '$statu')");
		mysqli_query($conn,"INSERT INTO `t_projectx`(`project`, `date`, `context`) VALUES ('$projectplus', '$date', '项目记录开始')");
			echo "创建成功！";
		}
	}elseif(!empty($projectchange)){
		mysqli_query($conn,"UPDATE `t_project` SET `about`='$about',`context`='$context',`date`='$date',`statu`='$statu' WHERE project = '{$projectchange}'");
		echo "修改成功！";
	}elseif(!empty($projectdelete)){
		mysqli_query($conn,"DELETE FROM `t_project` WHERE project = '{$projectdelete}'");
		mysqli_query($conn,"DELETE FROM `t_projectx` WHERE project = '{$projectdelete}'");
		echo "删除成功！";
	} ?>
		<div style="display:inline-block;margin-left:10%">
	<form action="projectplus.php" method="post">【项目】<br>
项目名:<?php if(empty($project)){ ?><input type="text" name="projectplus" value="<?php echo $row[0] ?>"/><?php }else{ echo $row[0]; ?><input type="hidden" name="projectchange" value="<?php echo $row[0] ?>"/><?php } ?><br>
简介<input type="text" name="about" value="<?php echo $row[1] ?>"/><br>
基本信息<textarea name="context" style="width:285px;height:80px;"><?php echo $row[2] ?></textarea><br>
<input type="hidden" name="date" value="<?php echo $todaytime; ?>"/>
进度(百分比)<input type="text" name="statu" value="<?php echo $row[4] ?>"/>%<br>
<input type="submit" value="确认提交">
</form>
</div>

<div style="float:right;">
<form action="projectplus.php" method="post">
项目名<input type="text" name="projectdelete" value=""/><br>
<input type="submit" value="删除">
</form>
</div>
<?php
$conn->close();
?>