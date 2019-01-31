<?php
if($_GET['click']){ ?>
<input type="password" id="pw1" value="" placeholder="原密码"/><br><br>
<input type="password" id="pw2" value="" placeholder="新密码"/><br>
<input type="password" id="pw3" value="" placeholder="确认新密码"/><br>
<br>
<div class="button" onclick="user_mima('user=<?php echo $_GET['click']; ?>',2)">确认更改</div>
<?php
}else{
	$user=$_GET['user'];$pw1=$_GET['pw1'];$pw2=$_GET['pw2'];$pw3=$_GET['pw3'];
	if($pw1 && $pw2 && $pw3 && $pw2==$pw3){
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "asahi";
	$conn = new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset ($conn,utf8);
	
	if(mysqli_query($conn,"SELECT * FROM `t_user` WHERE user='$user' AND userpw='$pw1' limit 1")->num_rows > 0){
	mysqli_query($conn,"UPDATE t_user SET userpw = '$pw3' WHERE user='$user' AND userpw='$pw1' limit 1");
	echo "修改成功！";
	}else{
		echo "原密码错误";
	}
	$conn->close();
	}else{
		echo "新密码输入错误";
	}
}

?>