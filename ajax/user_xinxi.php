<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "asahi";
	$conn = new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset ($conn,utf8);



if($_GET['click']){ 
$user=$_GET['click'];
$row=mysqli_query($conn,"SELECT * FROM `t_user` WHERE user='$user' limit 1")->fetch_row();
?>
<input type="text" id="name" value="<?php echo $row[3] ?>" placeholder="可填写新名字"/><br><br>
<br>
<div class="button" onclick="user_xinxi('user=<?php echo $user; ?>',2)">确认更改</div>
<?php

}else{
	$user=$_GET['user'];$name=$_GET['name'];
	if($name){
	
	
	mysqli_query($conn,"UPDATE t_user SET name = '$name' WHERE user='$user'");
	echo "修改成功！";
	
	}else{
		echo "没有输入";
	}
}


	$conn->close();
?>