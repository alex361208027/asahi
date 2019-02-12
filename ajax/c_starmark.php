<?
$_id=$_POST['id'];
if($_POST['star']==1){
$star=0;
}else{
$star=1;	
}


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

mysqli_query($conn,"UPDATE `t_teacher` SET starmark='$star' WHERE _id = '$_id' limit 1");
echo $star;

$conn->close();

?>