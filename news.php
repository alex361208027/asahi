<?php
echo file_get_contents("templates/header.html");

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);


//date_default_timezone_set('PRC');
//$todaytime=date('Y-m-d H:i:s');

$result=mysqli_query($conn,"SELECT * FROM t_news where 1 ORDER BY datetime desc limit 100");

?> 
<table>
<?
while($row=$result->fetch_row()){
	?>
	<tr>
		<td><? echo $row[1]; ?></td>
		<td><? echo $row[2]; ?></td>
		<td><? echo $row[3]; ?></td>
	</tr>
<?
}
?> 
</table>
<?
$conn->close();
?>