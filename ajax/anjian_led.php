<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$_id=$_GET['_id'];



$sql="SELECT * FROM `t_anjian` WHERE _id='$_id' limit 1";
$result=mysqli_query($conn,$sql);
$row=$result->fetch_row();

$parts=explode(",",$row[3]);
foreach($parts as $parts){
	$arry_parts[]=$parts;
}

$led=explode(",",$row[5]);
foreach($led as $led){
	$arry_led[]=$led;
}
$quantity=explode(",",$row[6]);
foreach($quantity as $quantity){
	$arry_quantity[]=$quantity;
}

?>
<div style="height:600px;OVERFLOW-Y:auto;">
<table width="600px">

<tr>
<td><?php echo $row[4]; ?></td><td><?php echo $row[1]; ?></td><td></td>
</tr>
<tr>
<td colspan="3"><?php echo $row[2]; ?></td>
</tr>
<tr>
<td colspan="3"><hr></td>
</tr>
<tr>
<td>【部位】</td><td>【LED】</td><td>【员数】</td>
</tr>
<?php for($i=0;$i<count($arry_led);$i++){ ?>
<tr>
<td><?php echo $arry_parts[$i]; ?></td><td><?php echo $arry_led[$i] ?></td><td><?php echo $arry_quantity[$i] ?></td>
</tr>
<?php } ?>
<tr>
<td colspan="3"><hr></td>
</tr>
<tr>
<td colspan="3"><?php echo $row[7]; ?></td>
</tr>
<tr>
<td colspan="3" align="right"><br>更新时间:<?php echo $row[8]; ?><br>
<a href="anjian_edit.php?_id=<?php echo $row[0]; ?>" target="_BLANK"><button>编辑</button></a>
</td>
</tr>
</table>
</div>
<?php
$conn->close();

?>
