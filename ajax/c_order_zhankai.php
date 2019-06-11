<?php
date_default_timezone_set('PRC');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$campany=$_POST['campany'];
$ordernum=$_POST['ordernum'];

$sql="SELECT banngo,quantity,hopedate,SHdate,ordernum,campany as thedate FROM t_teacher WHERE campany='$campany' AND ordernum='$ordernum'";
$result=mysqli_query($conn,$sql);

$quantity_total=0;
?>
<table style="width:100%;font-size:12px;">

<?
while($row=$result->fetch_row()){ 
?>
<tr onclick="location.href='2.php?t1=<? echo $row[5]; ?>&t6=<? echo $row[4]; ?>&t3=<? echo $row[0]; ?>&t9=1'">
<td><? echo $row[0]; ?></td>
<td align="right"><? echo $row[1];$quantity_total=$quantity_total+$row[1]; ?>pcs</td>
<td width="120px" align="right"><? if($row[3]=='0000-00-00'){echo "(希望)".$row[2];}else{echo "(上海)".$row[3];} ?></td>
</tr>	
<?
}
?>
<tr>
<td colspan="3"><hr></td>
</tr>	
<tr>
<td colspan="2" align="right">合计 <? echo $quantity_total ?>pcs</td>
<td></td>
</tr>	
</table>
<?
$conn->close();
?>
