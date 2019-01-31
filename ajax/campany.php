<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$_id=$_GET['_id'];
$campanyname=$_GET['campanyname'];$japanname=$_GET['japanname'];
$position=$_GET['position'];$address=$_GET['address'];$addresscampany=$_GET['addresscampany'];
$remark=$_GET['remark'];
if($position){
	mysqli_query($conn,"UPDATE `t_campany` SET position=position+1 WHERE 1 order by position desc");
	
	mysqli_query($conn,"UPDATE `t_campany` SET position='0' WHERE _id='$_id' limit 1");
	echo $position;
}elseif($campanyname){
mysqli_query($conn,"UPDATE `t_campany` SET campanyname='$campanyname', remark='$remark',other='$japanname',address='$address',addresscampany='$addresscampany' WHERE _id='$_id' limit 1");
echo "ok";
}else{
mysqli_query($conn,"DELETE FROM `t_campany` WHERE _id='$_id' limit 1");	
echo $_id;
}


$result=mysqli_query($conn,"SELECT * FROM `t_campany` WHERE 1 order by position asc");
while($row=$result->fetch_row()){
$txt=$txt."<option value='".$row[1]."'>";
}
fwrite(fopen("write_data/campany.html", "w"), $txt);



$conn->close();
?>