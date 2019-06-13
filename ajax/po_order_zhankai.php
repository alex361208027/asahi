<?php
date_default_timezone_set('PRC');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$asahiorder=$_POST['asahiorder'];

$sql="SELECT banngo,quantity,hopedate,JPdate,asahiorder,campany,_id FROM t_poteacher WHERE asahiorder='$asahiorder'";
$result=mysqli_query($conn,$sql);

$quantity_total=0;
?>
<table style="width:100%;font-size:12px;">

<?
while($row=$result->fetch_row()){ 
?>
<tr onclick="po_banngo('_id=<?php echo $row[6] ?>')">
<td><? echo $row[0]; ?></td>
<td align="right"><? echo $row[1];$quantity_total=$quantity_total+$row[1]; ?>pcs</td>
<td width="120px" align="right"><? if($row[3]=='0000-00-00'){echo "(希望)".$row[2];}else{echo "(日本)".$row[3];} ?></td>
<td align="center"><? echo $row[5]; ?></td>
</tr>	
<?
}
?>
<tr>
<td colspan="4"><hr></td>
</tr>	
<tr>
<td colspan="2" align="right">合计 <? echo $quantity_total ?>pcs</td>
<td></td>
<td></td>
</tr>	
</table>
<?
$conn->close();
?>
