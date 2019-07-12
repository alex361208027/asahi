<head>
<title>QRcode</title>
<script src="../../JS/jquery-3.2.1.min.js"></script>
</head>
<script>
$(function(){
	$("#same_date").click(function(){
		$(".input_date").val($(".input_date").eq(0).val());
	});
});
</script>
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
		
		if($zaiku_id[0]){

			$zaiku_return_m=findtotal($row[0],$zaiku_quantity,$zaiku_id);
			if(count($zaiku_return_m)>0){
				foreach($zaiku_return_m as $mm){
					$po_substr[]=substr($row[4],0,10);
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
<input type="text" class="input_date" name="datecode[]" value="" placeholder="出厂日期"/>
	<?
	echo "<br>";
}
?>
<br><input type="button" id="same_date" value="使用同一日期"/> <input type="submit" value="生成二维码"/>
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
	
	////songhuodan
	$songhuodan_reel[]=$reel[0];
	$songhuodan_nxsb_2b[]=$nxsb_2b;
	$songhuodan_wuliaohao[]=$reel[1];
	$songhuodan_banngo[]=$row_in[0];//番号
	$songhuodan_po[]=$po_substr[$i_date];//单号
	$songhuodan_lot[]=$row_in[2];//批次号
	$songhuodan_quantity[]=$row_in[1];//数量
	$songhuodan_date[]=$datecode[$i_date];
	////songhuodan////

	$i_date++;
}

	$f=0;
	while($f<count($songhuodan_lot)){
		if($songhuodan_quantity[$f]>0){
			$ff=$f+1;
			while($ff<count($songhuodan_lot)){
				if($songhuodan_banngo[$f]==$songhuodan_banngo[$ff]&&$songhuodan_po[$f]==$songhuodan_po[$ff]&&$songhuodan_lot[$f]==$songhuodan_lot[$ff]){
					$songhuodan_quantity[$f]=$songhuodan_quantity[$f]+$songhuodan_quantity[$ff];
					$songhuodan_quantity[$ff]=0;
					$ff++;
				}else{
					$ff++;
				}
			}
			$f++;
		}else{
			$f++;
		}
	}
	
$print_label=0;
while($print_label<count($songhuodan_lot)){
	if($songhuodan_quantity[$print_label]>0){
?>
<div class="main">
<table border="1" cellspacing="0" cellpadding="2">
<tr>
<td colspan="6" align="center"><img src="img/hyteralogo.gif" width="70px">海能达通信股份有限公司</td>
</tr>
<tr>
<td colspan="2">PN:</td><td align="center" colspan="3"><? echo $songhuodan_wuliaohao[$print_label]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $songhuodan_wuliaohao[$print_label]; ?>&thickness=25&start=B&code=BCGcode128'/></td><td rowspan="4" align="center"><img src='http://qr.liantu.com/api.php?text=<? echo $songhuodan_wuliaohao[$print_label].",".$songhuodan_banngo[$print_label].",".$songhuodan_nxsb_2b[$print_label].",".$songhuodan_date[$print_label].",".$songhuodan_lot[$print_label].",".$songhuodan_quantity[$print_label].",".$songhuodan_po[$print_label]; ?>' width='150px'/><br>朝日科技</td>
</tr>
<tr>
<td colspan="2">供应商料号:</td><td align="center" colspan="3"><? echo $songhuodan_banngo[$print_label]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $songhuodan_banngo[$print_label]; ?>&thickness=25&start=B&code=BCGcode128'/></td>
</tr>
<tr>
<td colspan="2">规格型号:</td><td align="center" colspan="3"><? echo str_replace("%2B","+",$songhuodan_nxsb_2b[$print_label]); ?></td>
</tr>
<tr>
<td colspan="2">Datecode:</td><td align="center" colspan="3"><? echo $songhuodan_date[$print_label]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $songhuodan_date[$print_label]; ?>&thickness=25&start=B&code=BCGcode128'/></td></td>
</tr>
<tr>
<td colspan="2">lot No:</td><td align="center" colspan="3"><? echo $songhuodan_lot[$print_label]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $songhuodan_lot[$print_label]; ?>&thickness=25&start=B&code=BCGcode128'/><td rowspan="3" align="center"><img src="img/hyteralogo.gif" width="100px"></td>
</tr>
<tr>
<td colspan="2">Qty:</td><td align="center" colspan="3"><? echo $songhuodan_quantity[$print_label]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $songhuodan_quantity[$print_label]; ?>&thickness=25&start=B&code=BCGcode128'/></td>
</tr>
<tr>
<td>PO:</td><td align="center" colspan="2"><? echo $songhuodan_po[$print_label]; ?><td>MFG</td><td align="center" width="90px"></td>
</tr>
</table>
</div>
	<?
	$round=$songhuodan_quantity[$print_label]/$songhuodan_reel[$print_label];
	for($i=0;$i<$round;$i++){
	?>
	<div class="main">
		<table border="1" cellspacing="0" cellpadding="2">
<tr>
<td colspan="2" align="center"><img src="img/hyteralogo.gif" width="70px">海能达通信股份有限公司</td><td rowspan="4" align="center"><img src='http://qr.liantu.com/api.php?text=<? echo $songhuodan_wuliaohao[$print_label].",".$songhuodan_banngo[$print_label].",".$songhuodan_nxsb_2b[$print_label].",".$songhuodan_date[$print_label].",".$songhuodan_lot[$print_label].",".$songhuodan_reel[$print_label].",".$songhuodan_po[$print_label]; ?>' width='120px'/><br>朝日科技</td>
</tr>
<tr>
<td>PN:</td><td align="center"><? echo $songhuodan_wuliaohao[$print_label]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $songhuodan_wuliaohao[$print_label]; ?>&thickness=25&start=B&code=BCGcode128'/></td>
</tr>
<tr>
<td>供应商料号:</td><td align="center"><? echo $songhuodan_banngo[$print_label]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $songhuodan_banngo[$print_label]; ?>&thickness=25&start=B&code=BCGcode128'/></td>
</tr>
<tr>
<td>规格型号:</td><td align="center"><? echo str_replace("%2B","+",$songhuodan_nxsb_2b[$print_label]); ?></td>
</tr>
<tr>
<td>Datecode:</td><td align="center"><? echo $songhuodan_date[$print_label]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $songhuodan_date[$print_label]; ?>&thickness=25&start=B&code=BCGcode128'/></td><td rowspan="4" align="center"><img src="img/hyteralogo.gif" width="100px"></td>
</tr>
<tr>
<td>lot No:</td><td align="center"><? echo $songhuodan_lot[$print_label]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $songhuodan_lot[$print_label]; ?>&thickness=25&start=B&code=BCGcode128'/></td>
</tr>
<tr>
<td>Qty:</td><td align="center"><? echo $songhuodan_reel[$print_label]; ?><br><img src='http://b.wwei.cn/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=0&font_size=8&text=<? echo $songhuodan_reel[$print_label]; ?>&thickness=25&start=B&code=BCGcode128'/></td>
</tr>
<tr>
<td>PO:</td><td align="center"><? echo $songhuodan_po[$print_label]; ?></td>
</tr>
</table>
	</div>
	<?
	}
	}
	$print_label++;
	echo "<br>";
}


}


if($songhuodan_po){
	$i_song=0;
	while($i_song<count($songhuodan_lot)){
		if($songhuodan_po[$i_song]&&$songhuodan_quantity[$i_song]>0){
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
		for($i_saerch=0;$i_saerch<count($songhuodan_lot);$i_saerch++){
		if(in_array($the_songhuodan_po,$songhuodan_po)){
			$earch_result=array_search($the_songhuodan_po,$songhuodan_po);
				if($songhuodan_quantity[$earch_result]>0){
				?>
				<input type="hidden" name="wuliaohao[]" value="<? echo $songhuodan_wuliaohao[$earch_result]; ?>" />
				<input type="hidden" name="po[]" value="<? echo $songhuodan_po[$earch_result]; ?>" />
				<input type="hidden" name="banngo[]" value="<? echo $songhuodan_banngo[$earch_result]; ?>" />
				<input type="hidden" name="lot[]" value="<? echo $songhuodan_lot[$earch_result]; ?>" />
				<input type="hidden" name="quantity[]" value="<? echo $songhuodan_quantity[$earch_result]; ?>" />
				<input type="hidden" name="date[]" value="<? echo $songhuodan_date[$earch_result]; ?>" />
				<?
				}
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
