<?php
if($_COOKIE['loged']){
echo file_get_contents("templates/header.html");

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

if($_POST['search']){
$search=$_POST['search'];
}else{
$search=$_GET['search'];	
}
if($_GET['page']){
$page = $_GET['page'];
}else{
$page=0;
}
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);


if($search){
	if($search=="随机换一批"){
		$sql = "SELECT * FROM `t_namecard` WHERE 1 order by rand() limit 0,20";
		$search="";
	}else{
	$sql = "SELECT * FROM `t_namecard` WHERE name like '%$search%' OR campany like '%$search%' OR email like '%$search%' OR phone like '%$search%' OR tel like '%$search%' OR tel2 like '%$search%' limit $page,20";
	}
}else{
	$sql = "SELECT * FROM `t_namecard` WHERE 1 order by _id desc limit 0,20";
}
$result = $conn->query($sql);
?>
<body style="padding:1%;background-color:#F7F7F7">

<style>
.namecard{
	position:relative;margin-right:10px;margin-top:10px;
	width:287px;height:180px;overflow:hidden;
	display:inline-block;
	-webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  -webkit-box-shadow: 0px 2px 2px #BBBBBB;
  -moz-box-shadow: 0px 2px 2px #BBBBBB;
  box-shadow: 0px 2px 2px #BBBBBB;
  
  transition: all 0.2s;
-moz-transition: all 0.2s;	/* Firefox 4 */
-webkit-transition: all 0.2s;	/* Safari 和 Chrome */
-o-transition: all 0.2s;
}
.namecard:hover{
	margin-top:5px;margin-bottom:5px;
	-webkit-box-shadow: 0px 8px 8px #BBBBBB;
  -moz-box-shadow: 0px 8px 8px #BBBBBB;
  box-shadow: 0px 8px 8px #BBBBBB;
  transition-delay: 0.5s;
-moz-transition-delay: 0.5s; /* Firefox 4 */
-webkit-transition-delay: 0.5s; /* Safari 和 Chrome */
-o-transition-delay: 0.5s; /* Opera */
}

.namecardright{
	position:absolute;width:287px;height:180px;top:100px;left:270px;
	transition:left 0.5s;
-moz-transition:left 0.5s;
-webkit-transition:left 0.5s;
-o-transition:left 0.5s;

transition-delay: 0.5s;
-moz-transition-delay: 0.5s; /* Firefox 4 */
-webkit-transition-delay: 0.5s; /* Safari 和 Chrome */
-o-transition-delay: 0.5s; /* Opera */
}
.namecardright:hover{
	left:0px;
}
.namecardleft{
	position:absolute;width:287px;height:180px;top:100px;left:-270px;
	transition:left 0.5s;
-moz-transition:left 0.5s;
-webkit-transition:left 0.5s;
-o-transition:left 0.5s;

transition-delay: 0.5s;
-moz-transition-delay: 0.5s; /* Firefox 4 */
-webkit-transition-delay: 0.5s; /* Safari 和 Chrome */
-o-transition-delay: 0.5s; /* Opera */
}
.namecardleft:hover{
	left:0px;
}
.namecardin{
	position:absolute;
}

</style>

<?php while($row=$result->fetch_row()){ 
$numbercount++;
$bg=RAND(1,4);
if($bg==1){
	$bgcolor="#FFEEF1";
}elseif($bg==2){
	$bgcolor="#EEF1FF";
}elseif($bg==3){
	$bgcolor="#FFFFEE";
}elseif($bg==4){
	$bgcolor="white";
}
?>

<div class="namecard" style="background-color:<?php echo $bgcolor; ?>;">
<form action="namecardplus.php" method="post">
	<div class="namecardin" style="top:40px;left:90px;font-size:16px;"><input type="hidden" name="name1" value="<?php echo $row[0]; ?>"/><b><?php echo $row[0]; ?></b></div>
	<div class="namecardin" style="top:0px;left:0px;padding-top:5px;width:283px;padding-right:5px;height:20px;text-align:right;background-color:#555555;color:white;font-size:14px;"><input type="hidden" name="campany1" value="<?php echo $row[2]; ?>"/><?php echo $row[2]; ?></div>
	<div class="namecardin" style="top:60px;left:90px;font-size:12px;width:auto;color:#555555;width:370px;" title="<?php echo $row[3].$row[4].$row[5]; ?>"><?php echo $row[3]; ?> <?php echo $row[4]; ?> <?php echo $row[5]; ?>
		<div style="line-height:85%;width:180px"><?php echo $row[6]; ?></div>
	</div>

	<div class="namecardin" style="top:100px;left:90px;font-size:12px;width:180px;">
	<?php if($row[7]){echo "✆ ".$row[7]."<br>";} ?>
	<?php if($row[8]){echo "☎ ".$row[8];} ?>
	<?php if($row[9]){echo "<br>☎ ".$row[9];} ?>
	<?php if($row[10]){echo "<br>📠 ".$row[10];} ?>
	</div>
	
 <div class="namecardright">	
	<div class="namecardin" style="top:0px;left:90px;font-size:12px;width:180px;height:100%;background-color:<?php echo $bgcolor; ?>;"><?php echo $row[11]; ?><br>
	<?php echo $row[12]; ?></div>
 </div>
 
 <div class="namecardleft">	
	<div class="namecardin" style="top:0px;left:90px;font-size:12px;width:180px;height:100%;background-color:<?php echo $bgcolor; ?>;"><?php echo $row[13]; ?><br>
	<?php echo $row[14]; ?><div class="namecardin" style="right:0px;top:40px;"><?php echo $row[16]; ?><input type="hidden" name="_id" value="<?php echo $row[15]; ?>"/><input type="submit" value="编辑"/></div></div>
 </div>
 <div class="namecardin" style="top:50px;left:13px"><img src="img/<?php echo $row[1]; ?>.png" width=""></div>
</form>
</div>
<?php
}
?>
<?php $page+=20; ?>
<input type="hidden" id="search" value="<?php if($search){echo $search;}else{echo '随机换一批';} ?>"><input type="hidden" id="page" value="<?php echo $page ?>">
<?php if($numbercount>19){ ?><button onclick="nextpage()">Next</button><?php } ?>
<a id="href" href="###"></a>
<script>
function nextpage(){
	document.getElementById('href').href="namecard.php?search="+document.getElementById('search').value+"&page="+document.getElementById('page').value;
	//alert(document.getElementById('href').href);
	document.getElementById('href').click();
}
</script>
</body>
<?php

$conn->close();
}else{
	echo $_COOKIE['loged']." login?";
} 
?>