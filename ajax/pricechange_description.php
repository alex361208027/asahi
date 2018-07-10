<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$description=$_GET['description'];$mcd=$_GET['mcd'];$color_x=$_GET['color_x'];$color_y=$_GET['color_y'];
$_id=$_GET['_id'];
if($description){
	mysqli_query($conn,"UPDATE `t_poprice` SET description='$description' WHERE _id='$_id'");
}elseif($mcd){
	mysqli_query($conn,"UPDATE `t_poprice` SET mcd='$mcd' WHERE _id='$_id'");	
}elseif($color_x){
	mysqli_query($conn,"UPDATE `t_poprice` SET color_x='$color_x' WHERE _id='$_id'");
}elseif($color_y){
	mysqli_query($conn,"UPDATE `t_poprice` SET color_y='$color_y' WHERE _id='$_id'");	
}
$conn->close();
?>