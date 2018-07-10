<?php
if($_GET['click']){ ?>
<input type="text" id="newid" value="<?php echo $row[3] ?>" placeholder="新用户ID"/><br>
<input type="password" id="pw1" value="<?php echo $row[3] ?>" placeholder="密码"/><br>
<input type="password" id="pw2" value="<?php echo $row[3] ?>" placeholder="确认密码"/><br>
<br>
<div class="button" onclick="user_new('user=<?php echo $_GET['click']; ?>',2)">确认更改</div>
<?php
}else{
	$newid=$_GET['newid'];$pw1=$_GET['pw1'];$pw2=$_GET['pw2'];
	if($pw1 && $pw2 && $newid && $pw1==$pw2){
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "asahi";
	$conn = new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset ($conn,utf8);
	
	if(mysqli_query($conn,"SELECT user FROM `t_user` WHERE user = '$newid'")->num_rows == 0){
	mysqli_query($conn,"INSERT INTO `t_user`(`user`, `userpw`) VALUES ('$newid','$pw2')");
	echo "新用户创建成功！";
	mysqli_query($conn,"INSERT INTO `t_note`(`user`, `note`, `time`, `remark`) VALUES ('$newid','欢迎你','2017-12-12 12:12:12',0)");
	}else{
		echo "该ID已存在";
	}
	$conn->close();
	}else{
		echo "密码输入错误";
	}
}

?>