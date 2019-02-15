<?php
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$publicnote=$_GET['publicnote'];

if($publicnote){
	$publicnote=str_replace("\r","<br>",$publicnote); 
	mysqli_query($conn,"INSERT INTO `t_note`(`user`, `note`, `time`, `remark`) VALUES ('{$_COOKIE['asahiuser']}','$publicnote','$todaytime',1)");
	//mysqli_query($conn,"DELETE FROM `t_note` WHERE remark = 1 order by time asc LIMIT 1");
}

?>
<div class="xiaoxikuan">
		<table><tr align="left">
		<td valign="top">
		<div class='touxiang' style="background-color:#FF66A3">New<?php //echo mb_substr($_COOKIE['asahiuser'],0,3) ?></div>
		</td>
		<td>
		<font color="#DDDDDD" size="1"><?php echo $_COOKIE['loged']."&nbsp;".$todaytime ?></font><br>
		<div class="xiaoxikuang_style"><?php echo $publicnote ?></div><br><br>
		</td>
		</tr></table>
		</div>