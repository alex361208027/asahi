<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
date_default_timezone_set('PRC');

$campany=$_GET['campany'];
$banngo=$_GET['banngo'];
$num=$_GET['num'];
$year=$_GET['year'];
if($num<10){
	$num="0".$num;
}
echo $campany.$banngo."#".$num."月份明细#\r";

$date=$year."-".$num;

if($campany&&!$banngo){
	$where=" campany = '$campany' AND ";
	$group="GROUP BY banngo";
}elseif(!$campany&&$banngo){
	$where=" banngo = '$banngo' AND ";
	$group="GROUP BY campany";
}elseif($campany&&$banngo){
	$where="campany='$campany' AND banngo='$banngo' AND";
	$group="GROUP BY banngo";
}else{
	$where="";
	$group="GROUP BY campany";
}


$sql="SELECT campany,banngo,hopedate,SUM(quantity) FROM `t_teacher` WHERE $where hopedate like '$date%' $group";
$result=mysqli_query($conn,$sql);
while($row=$result->fetch_row()){

if($campany){
echo "【".$row[1]."】".$row[3];
}else{
echo "【".$row[0]."】".$row[3];	
}
echo "\r";

}



$conn->close();
?>