<head>
<title>QRcode</title>
<script src="../../JS/jquery-3.2.1.min.js"></script>
</head>

<style>
table{
	font-size:12px;
}
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

input{
	text-align:center;
	border:none;font-size:12px;
}

.main{
  display:inline-block;
 padding:1px;  
}

@media print {
 button{ display:none;}
 .memo{ display:none;}
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

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);


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
		
		$po_substr[]=substr($row[4],0,10);
		
		if($zaiku_id[0]){

			$zaiku_return_m=findtotal($row[0],$zaiku_quantity,$zaiku_id);
			if(count($zaiku_return_m)>0){
				foreach($zaiku_return_m as $mm){
					   $remove_inout_id[]=$zaiku_id[$mm];
				}
				
			}else{
				echo "没有找到对应在库";
			}
			
		}else{
			echo "没有找到对应在库";
		}
	}
	
	
	
$id=$remove_inout_id;	

}else{
$id=$_GET['checkbox'];
}


//////////////////datecode
$datecode=$_GET["datecode"];

if(!$datecode){
	?>
<form action="qrcode_hytera.php" method="get">
<input type="hidden" name="data" value="2" />
<?
foreach($checkbox as $_id){
	?>
		<input type="hidden" name="checkbox[]" value="<? echo $_id; ?>" />
	<?
}


foreach($id as $id_lot){
	$row_lot=mysqli_query($conn,"SELECT lotnum FROM t_inout WHERE _id='$id_lot' limit 1")->fetch_row();
	echo $row_lot[0];
	?>
<input type="text" name="datecode[]" value="" />
	<?
	echo "<br>";
}
?>
<br><input type="submit" value="生成二维码"/>
</form>




<?
//////////////////datecode//

}else{

$i_date=0;

foreach($id as $id){
	$row_in=mysqli_query($conn,"SELECT banngo,quantity,lotnum FROM t_inout WHERE _id='$id' limit 1")->fetch_row();
	$reel=mysqli_query($conn,"SELECT reel,description FROM t_poprice WHERE banngo='$row_in[0]' AND campany='$row[3]' limit 1")->fetch_row();
	
	if($reel[0]==3000){$nxsb="NHSB046A+CAP";}else if($reel[0]==2000){$nxsb="NSSB064+CAP";}else if($reel[0]==6000){$nxsb="NSSB146A+CAP";}
	$nxsb_2b=str_replace("+","%2B",$nxsb);
	$songhuodan_wuliaohao[]=$reel[1];
	$songhuodan_banngo[]=$row_in[0];
	$songhuodan_po[]=$po_substr[$i_date];
	$songhuodan_lot[]=$row_in[2];
	$songhuodan_quantity[]=$row_in[1];
	$songhuodan_date[]=$datecode[$i_date];
	?>
<div class="main">
<table border="1" cellspacing="0" cellpadding="2">
<tr>
<td colspan="6" align="center"><img src="img/hyteralogo.gif" width="70px">海能达通信股份有限公司</td>
</tr>
<tr>
<td colspan="2">PN:</td><td align="center" colspan="3"><? echo $reel[1]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $reel[1]; ?>&thickness=25&start=B&code=BCGcode128'/></td><td rowspan="4" align="center"><img src='http://qr.liantu.com/api.php?text=<? echo $reel[1].",".$row_in[0].",".$nxsb_2b.",".$datecode[$i_date].",".$row_in[2].",".$row_in[1].",".$po_substr[$i_date]; ?>' width='150px'/><br>朝日科技</td>
</tr>
<tr>
<td colspan="2">供应商料号:</td><td align="center" colspan="3"><? echo $row_in[0]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $row_in[0]; ?>&thickness=25&start=B&code=BCGcode128'/></td>
</tr>
<tr>
<td colspan="2">规格型号:</td><td align="center" colspan="3"><? echo $nxsb; ?></td>
</tr>
<tr>
<td colspan="2">Datecode:</td><td align="center" colspan="3"><? echo $datecode[$i_date]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $datecode[$i_date]; ?>&thickness=25&start=B&code=BCGcode128'/></td></td>
</tr>
<tr>
<td colspan="2">lot No:</td><td align="center" colspan="3"><? echo $row_in[2]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $row_in[2]; ?>&thickness=25&start=B&code=BCGcode128'/><td rowspan="3" align="center"><img src="img/hyteralogo.gif" width="100px"></td>
</tr>
<tr>
<td colspan="2">Qty:</td><td align="center" colspan="3"><? echo $row_in[1]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $row_in[1]; ?>&thickness=25&start=B&code=BCGcode128'/></td>
</tr>
<tr>
<td>PO:</td><td align="center" colspan="2"><? echo $po_substr[$i_date]; ?><td>MFG</td><td align="center" width="90px"></td>
</tr>
</table>
</div>
	<?
	$round=$row_in[1]/$reel[0];
	for($i=0;$i<$round;$i++){
	?>
	<div class="main">
		<table border="1" cellspacing="0" cellpadding="2">
<tr>
<td colspan="2" align="center"><img src="img/hyteralogo.gif" width="70px">海能达通信股份有限公司</td><td rowspan="4" align="center"><img src='http://qr.liantu.com/api.php?text=<? echo $reel[1].",".$row_in[0].",".$nxsb_2b.",".$datecode[$i_date].",".$row_in[2].",".$reel[0].",".$po_substr[$i_date]; ?>' width='120px'/><br>朝日科技</td>
</tr>
<tr>
<td>PN:</td><td align="center"><? echo $reel[1]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $reel[1]; ?>&thickness=25&start=B&code=BCGcode128'/></td>
</tr>
<tr>
<td>供应商料号:</td><td align="center"><? echo $row_in[0]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $row_in[0]; ?>&thickness=25&start=B&code=BCGcode128'/></td>
</tr>
<tr>
<td>规格型号:</td><td align="center"><? echo $nxsb; ?></td>
</tr>
<tr>
<td>Datecode:</td><td align="center"><? echo $datecode[$i_date]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $datecode[$i_date]; ?>&thickness=25&start=B&code=BCGcode128'/></td><td rowspan="4" align="center"><img src="img/hyteralogo.gif" width="100px"></td>
</tr>
<tr>
<td>lot No:</td><td align="center"><? echo $row_in[2]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $row_in[2]; ?>&thickness=25&start=B&code=BCGcode128'/></td>
</tr>
<tr>
<td>Qty:</td><td align="center"><? echo $reel[0]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $reel[0]; ?>&thickness=25&start=B&code=BCGcode128'/></td>
</tr>
<tr>
<td>PO:</td><td align="center"><? echo $po_substr[$i_date]; ?></td>
</tr>
</table>
	</div>
	<?
	}
	echo "<br>";$i_date++;
}

}

//$songhuodan_wuliaohao[]=$reel[1];
//	$songhuodan_banngo[]=$row_in[0];
//	$songhuodan_po[]=$po_substr;
//	$songhuodan_lot[]=$row_in[2];
//	$songhuodan_quantity[]=$row_in[1];

if($songhuodan_po){
	$i_song=0;
	while($i_song<count($songhuodan_lot)){
		if($songhuodan_po[$i_song]){
		?>
		<form action="songhuodan_hytera.php" method="get" target="_BLANK">
		<input type="hidden" name="wuliaohao[]" value="<? echo $songhuodan_wuliaohao[$i_song]; ?>" />
		<input type="hidden" name="po[]" value="<? echo $songhuodan_po[$i_song]; ?>" />
		<input type="hidden" name="banngo[]" value="<? echo $songhuodan_banngo[$i_song]; ?>" />
		<input type="hidden" name="lot[]" value="<? echo $songhuodan_lot[$i_song]; ?>" />
		<input type="hidden" name="quantity[]" value="<? echo $songhuodan_quantity[$i_song]; ?>" />
		<input type="hidden" name="date[]" value="<? echo $songhuodan_date[$i_song]; ?>" />
		<?
		$the_songhuodan_po=$songhuodan_po[$i_song];
		unset($songhuodan_po[$i_song]);
		for($i_saerch=0;$i_saerch<count($songhuodan_po);$i_saerch++){
		if(in_array($the_songhuodan_po,$songhuodan_po)){
			$earch_result=array_search($the_songhuodan_po,$songhuodan_po);
			?>
		<input type="hidden" name="wuliaohao[]" value="<? echo $songhuodan_wuliaohao[$earch_result]; ?>" />
		<input type="hidden" name="po[]" value="<? echo $songhuodan_po[$earch_result]; ?>" />
		<input type="hidden" name="banngo[]" value="<? echo $songhuodan_banngo[$earch_result]; ?>" />
		<input type="hidden" name="lot[]" value="<? echo $songhuodan_lot[$earch_result]; ?>" />
		<input type="hidden" name="quantity[]" value="<? echo $songhuodan_quantity[$earch_result]; ?>" />
		<input type="hidden" name="date[]" value="<? echo $songhuodan_date[$earch_result]; ?>" />
			<?
			unset($songhuodan_po[$earch_result]);
			}
		}
		?>
		

		<input type="submit" class="memo" value="生成送货单[<? echo $the_songhuodan_po; ?>]" />
		</form>
		<?
		}
		$i_song++;
	}
}




$conn->close();
?>
