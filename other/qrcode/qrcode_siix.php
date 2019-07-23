<title>QRcode</title>
<style>
.qrcode_main{
	padding:3px;
	width:210px;
	height:130px;
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
yy{
	color:#BBBBBB;
}
</style>
<?
////////////////////////////////////////function	
	function findtotal($all,$q,$id){
	Global $remove_inout_id;
	$js=0;
	$k=0;
	$c=count($q);

	while($k<$c){
		
		if($all==$js){
			break;
		}else{
			unset($marki);
			$i=$k;
			
			if($i!=$c){
				
					while($i<$c){
						if(in_array($id[$i],$remove_inout_id)){
							$i++;
						}else{	
							$js=$js+$q[$i];
							if($all==$js){
								$marki[]=$i;
								$k++;
								break;
							}elseif($all>$js){
								$marki[]=$i;
								$i++;
							}elseif($all<$js){
								$js=$js-$q[$i];
								$i++;
							}
						}
					}

			}else{
				$k++;
			}
		}
		
	 }
	 return $marki;
	}
////////////////////////////////////////function	

$qrcode_api=file_get_contents("qrcode_api.html");
//echo $qrcode_api."<br>";
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$title=$_GET['title'];
$data=$_GET['data'];
if($data==2){
	$checkbox=$_GET['checkbox'];
	foreach($checkbox as $_id){
		unset($zaiku_quantity);
		unset($zaiku_id);
		unset($zaiku_lotnum);
		$row=mysqli_query($conn,"SELECT quantity,banngo,asahiorder,campany,ordernum FROM `t_teacher` WHERE _id='$_id' limit 1")->fetch_row();
		$resultzaiku=mysqli_query($conn,"SELECT quantity,_id,lotnum FROM `t_inout` WHERE (outquantity is null OR outquantity = 0) AND banngo='$row[1]' AND asahipo='$row[2]' AND campany like '%$row[4]%' order by quantity desc");
		while($rowzaiku=$resultzaiku->fetch_row()){
			$zaiku_quantity[]=$rowzaiku[0];
			$zaiku_id[]=$rowzaiku[1];
			$zaiku_lotnum[]=$rowzaiku[2];
		}

		if($zaiku_id[0]){

			$zaiku_return_m=findtotal($row[0],$zaiku_quantity,$zaiku_id);
			if(count($zaiku_return_m)>0){
				foreach($zaiku_return_m as $mm){
					   $remove_inout_id[]=$zaiku_id[$mm];
				}
				
			}else{
				echo "其中一个没有找到对应在库error1";
			}
			
		}else{
			echo "其中一个没有找到对应在库error2";
		}
	}
	
	
	
$id=$remove_inout_id;	

}else{
$id=$_GET['checkbox'];
}

foreach($id as $id){
	$row=mysqli_query($conn,"SELECT banngo,quantity,lotnum FROM t_inout WHERE _id='$id' limit 1")->fetch_row();
	$reel=mysqli_query($conn,"SELECT reel FROM t_poprice WHERE banngo='$row[0]' limit 1")->fetch_row();
	?>
	<div class="qrcode_main">
		<table width="100%" cellpadding="0" class="qrcode_table">
			<tr>
			<td valign="top"><xx>品番</xx><br><? echo $row[0]; ?></td>
			<td align="right" valign="top" rowspan="3"><img src="<? echo $qrcode_api; ?>%23<? echo $row[0]; ?>%23<? echo $row[1]; ?>" width='88px'/><br><yy><? echo $title."&nbsp;"; ?>(外箱)</yy></td>
			</tr>
			<tr>
			<td valign="top"><xx>数量</xx><br><? echo $row[1]; ?></td>
			</tr>
			<tr>
			<td colspan="2" valign="top"><xx>LotNo.<br><? echo $row[2]; ?></xx></td>
			</tr>
		</table>
	</div>
	<?
	$round=$row[1]/$reel[0];
	for($i=0;$i<$round;$i++){
	?>
	<div class="qrcode_main">
		<table width="100%" cellpadding="0" class="qrcode_table">
			<tr>
			<td valign="top"><xx>品番</xx><br><? echo $row[0]; ?></td>
			<td align="right" valign="top" rowspan="3"><img src="<? echo $qrcode_api; ?>%23<? echo $row[0]; ?>%23<? echo $reel[0]; ?>" width='88px'/><br><yy><? echo $title."&nbsp;"; ?>(<? echo ($i+1)."/".$round ?>)</yy></td>
			</tr>
			<tr>
			<td valign="top"><xx>数量</xx><br><? echo $reel[0]; ?></td>
			</tr>
			<tr>
			<td colspan="2" valign="top"><xx>LotNo.<br><? echo $row[2]; ?></xx></td>
			</tr>
		</table>
	</div>
	<?
	}
	echo "<hr>";
}



$conn->close();
?>
