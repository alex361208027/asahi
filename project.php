<?php
if($_COOKIE['loged']){
echo file_get_contents("templates/header.html");

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$search=$_POST['search'];

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$nowpage=$_POST['nowpage'];
if(empty($nowpage)){
$nowpage=0;
}
$nowpagestart=$nowpage+1;
$nowpageend=$nowpage+5;
	
if(!empty($search)){
	$sql = "SELECT * FROM `t_project` WHERE project like '%{$search}%'";
}else{
$sql = "SELECT * FROM `t_project` WHERE 1 order by date desc limit $nowpage,5";
}
$result = $conn->query($sql);

$iii=1;
?>
<style>
.projectbox{
	position:relative;
	width:100%;height:100px;min-width:600px;
	/**-webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  border-radius: 8px;**/
  background-color:;
}
.projectimg{
	position:absolute;
	font-size:18px;
	top:20%;left:3%;
	color:;
}
.projecttitle{
	position:absolute;
	font-size:18px;
	top:25%;left:15%;
	color:#5E5E5E;
}
.projectabout{
	position:absolute;max-width:15%;
	font-size:12px;
	top:45%;left:15%;
	color:#A2A2A2;
}
.projecttime{
	position:absolute;
	font-size:14px;
	top:30%;left:40%;
	color:#A2A2A2;
}
.projectstatubg{
	position:absolute;
	width:100px;height:10px;
	background-color:#E6E6E6;
	top:40%;left:65%;
	color:#A2A2A2;
}
.projectstatu{
	position:absolute;
	width:;height:10px;
	top:40%;left:65%;
}
.projectchange{
	position:absolute;
	font-size:14px;
	top:30%;right:3%;
	color:red;
	border:2px;
}
</style>
<body style="padding:2%;">
<?php while($row=$result->fetch_row()){ ?>
<div class="projectbox">
	<form action="projectplus.php" method="post" target="_blank">
	<a href="projectx.php?project=<?php echo $row[0] ?>">
	<div class="projectimg"><img src="img/文件夹.png"/></div>
	<div class="projecttitle"><?php echo $row[0]; ?><input type="hidden" name="project" value="<?php echo $row[0]; ?>"/></div>
	<div class="projectabout"><?php echo $row[1]; ?></div>
	</a>
	<div class="projecttime">更新时间<br><?php echo $row[3]; ?></div>
	<div class="projectstatubg"><div style="margin-left:105px;margin-top:-3px;"><?php echo $row[4]; ?>%</div></div>
	<div class="projectstatu" style="<?php echo 'width:'.$row[4].'px;background-color:yellow;'; ?>"></div>
	<div class="projectchange"><input type="submit" value="编辑"/></div>
	</form>
</div>
<hr>
<?php $iii=$iii+1; } ?>
<form action="project.php" method="post">
<?php $nowpage=$nowpage+5; ?>
<input type="hidden" name="nowpage" value="<?php echo $nowpage ?>"/>
<input type="submit" value="Next">
</form>
<br><br>
</body>
<?php
$conn->close();
}else{
	echo $_COOKIE['loged']." login?";
} 
?>