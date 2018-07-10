<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$sql=$_POST['sql'];

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
if($sql){
	echo "执行完毕<br>";
	mysqli_query($conn,"{$sql}");
}


if($_COOKIE['asahiuser']=="lcy"||$_COOKIE['asahiuser']=="李成业"){
	?>
<form action="admin.php" method="post">
<input type="text" name="sql" style="width:500px" value=""><br><input type="submit" value="ok">
</form>

<?php
}else{
	echo "error";
}
$conn->close();
?>