<?
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$result=mysqli_query($conn,"SELECT * FROM `t_poprice` WHERE 1 order by banngo asc");


$txt=$txt."<table>";
$txt=$txt."<tr><td>#</td><td>客户</td><td>番号</td><td>进价</td><td>卖价</td><td>Reel</td><td>常用</td></tr>";

$iii=1;
while($row=$result->fetch_row()){ 
$txt=$txt."<tr><td>".$iii."</td><td>".$row[4]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[5]."</td><td>".$row[3]."</td><td>".$row[11]."</td></tr>";
$iii++;
}

$txt=$txt."</table>";
fwrite(fopen("moban/price.xlsx", "w"), $txt);

echo "moban/price.xlsx";

$conn->close();
?>