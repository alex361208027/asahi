<?php
echo file_get_contents("templates/header.html");

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
if($_GET['project']){
$project=$_GET['project'];	
}else{
$project=$_POST['project'];
}

$search=$_POST['search'];

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$nowpage=$_POST['nowpage'];
if(empty($nowpage)){
$nowpage=0;
}
$nowpagestart=$nowpage+1;
$nowpageend=$nowpage+10;

if(!empty($search)){
	$sql = "SELECT * FROM `t_projectx` WHERE context like '%{$search}%' order by date desc limit $nowpage,10";
}else{
	$sql = "SELECT * FROM `t_projectx` WHERE project = '{$project}' order by date desc limit $nowpage,10";
	}
$result = $conn->query($sql);
?>
<style>
.class0{
	position:relative;width:700px;font-size:12px;
}
.class1{
	background-color:#E0FFCC;;color:#4D4D4D;padding:6px;max-width:500px;display:inline-block;overflow:hidden;max-height:120px;
-webkit-border-radius: 7px;
  -moz-border-radius: 7px
  transition: all 1s;
-moz-transition: all 1s;
-webkit-transition: all 1s;
-o-transition: all 1s;
}
.class2{
	position:absolute;
	display:none;margin-left:5px;
}
.class0:hover > .class2{
	display:inline-block;
}
.class0:hover > .class1{
	background-color:#FFDDDD;
}
</style>
<body style="padding:0 4% 0 4%;font-size:12px;min-width:800px">
<br><br><br>
<table cellpadding="0" cellspacing="0" width="100%" >
<?php while($row=$result->fetch_row()){ 
$row[2]=str_replace("\r","<br>",$row[2]); ?>
	<form action="projectxplus.php" method="post" target="_blank">
	<input type="hidden" name="projectx" value="<?php echo $row[0]; ?>"/>
	<tr>
	<td width="150px"><font color="#FF9999"><b><?php echo substr($row[1],0,10); ?></b></font><input type="hidden" name="date" value="<?php echo $row[1]; ?>"/></td>
	<td><div style="position:relative;width:1px;"><div style="position:absolute;left:-6px;top:-8px;"><img src="img/redpoint.png"/></div></div></td>
	<td style="border-left:5px solid #CCCCFF;padding:15px;padding-left:70px;">
	<div class="class0"><div class="class1" onclick="this.style.maxHeight='2000px';"><?php echo $row[2]; ?></div><div class="class2"><?php echo $row[0]; ?><br>[编辑者]<?php echo $row[3]; ?><input type="submit" value="编辑"/></div></div>
	</td>		
	</tr>
	</form>
<?php $name=$row[0];} ?>
</table>
<div style="position:absolute;top:0px;left:0px;width:90%;background-color:#FFDDDD;padding:5px 5% 5px 5%;">
<div style="display:inline-block;"><form id="projectx" action="projectxplus.php" method="post" target="_blank">
<font size="5"><?php echo $project; ?><input type="hidden" name="projectx" value="<?php echo $project; ?>"/></font></form>
</div>
<div style="display:inline-block;margin-left:10%;cursor:pointer"><a onclick="document.getElementById('projectx').submit();" target="_blank">+++添加新日程</a></div>
</div>
<?php 



$sql = "SELECT * FROM `t_project` WHERE project = '{$project}'";
$result = $conn->query($sql);
$row=$result->fetch_row();
$row[2]=str_replace("\r","<br>",$row[2]);
 ?>
<?php if(!empty($row[2])){ ?><div style="position:absolute;top:10%;right:0px;width:200px;color:#AAAAAA;"><div style="color:white;background-color:black;padding:5px;">基本信息：</div><?php echo $row[2]; ?></div> <?php } ?>
<form action="projectx.php" method="post">
<?php $nowpage=$nowpage+10; ?>
<input type="hidden" name="nowpage" value="<?php echo $nowpage ?>"/><input type="hidden" name="project" value="<?php echo $project ?>"/>
<input type="submit" value="Next">
</form><br>
</body>
<?php
$conn->close();
echo file_get_contents("templates/footer.html");
?>