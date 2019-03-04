<title>QRcode</title>
<style>
.qrcode_main{
	width:212px;
	height:132px;
	background:white;
	display:inline-block;
	margin:3px;
	border:1px solid black;
	overflow:hidden;
}
xx{
	font-size:12px;
	font-weight:normal;
}
.qrcode_table{
	font-size:16px;font-weight:bold;
}
</style>
<?
$id=$_GET['checkbox'];

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);


foreach($id as $id){
	$row=mysqli_query($conn,"SELECT banngo,quantity,lotnum FROM t_inout WHERE _id='$id' limit 1")->fetch_row();
	$reel=mysqli_query($conn,"SELECT reel FROM t_poprice WHERE banngo='$row[0]' limit 1")->fetch_row();
	?>
	<div class="qrcode_main">
		<table width="100%" cellpadding="5" class="qrcode_table">
			<tr>
			<td valign="top"><xx>品番</xx><br><? echo $row[0]; ?></td>
			<td align="right" valign="top" rowspan="3"><img src="<img src='http://api.kuaipai.cn/qr?chl=#<? echo $row[0]; ?>#<? echo $row[1]; ?>" width="88px"/><br>外箱</td>
			</tr>
			<tr>
			<td valign="top"><xx>数量</xx><br><? echo $row[1]; ?></td>
			</tr>
			<tr>
			<td colspan="2" valign="top"><xx>LotNo.</xx><br><? echo $row[2]; ?></td>
			</tr>
		</table>
	</div>
	<?
	$round=$row[1]/$reel[0];
	for($i=0;$i<$round;$i++){
	?>
	<div class="qrcode_main">
		<table width="100%" cellpadding="5" class="qrcode_table">
			<tr>
			<td valign="top"><xx>品番</xx><br><? echo $row[0]; ?></td>
			<td align="right" valign="top" rowspan="3"><img src="<img src='http://qr.liantu.com/api.php?text=#<? echo $row[0]; ?>#<? echo $reel[0]; ?>" width="88px"/><br><? echo ($i+1)."/".$round ?></td>
			</tr>
			<tr>
			<td valign="top"><xx>数量</xx><br><? echo $reel[0]; ?></td>
			</tr>
			<tr>
			<td colspan="2" valign="top"><xx>LotNo.</xx><br><? echo $row[2]; ?></td>
			</tr>
		</table>
	</div>
	<?
	}
	echo "<hr>";
}
?>
