<?php
date_default_timezone_set('PRC');
//$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$campany=$_GET['campany'];
$sql="SELECT banngo FROM `t_poprice` WHERE campany ='$campany' order by banngo asc";
$result = mysqli_query($conn,$sql);

while($row=$result->fetch_row()){
		?>
		<label onclick="checkcampany('<?php echo $campany; ?>')"><input type="checkbox" value="<?php echo $row[0] ?>" name="banngo[]"/><?php echo $row[0] ?></label>
<?php	}

$conn->close();
?>
