<?php
date_default_timezone_set('PRC');
$today=date('y'.'m'.'d');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$iii=1;

function campany($campany) {
	Global $conn;
	$japanname=mysqli_query($conn,"SELECT other FROM `t_campany` WHERE campany='$campany'")->fetch_row();
	
	if($japanname[0]){
		return $japanname[0];
	}else{
		return $campany;
	}
	
}


?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="CSS/1.css" type="text/css" rel="stylesheet" charset=utf-8 >
<script type="text/javascript" src="JS/1.js"></script>
<script type="text/javascript" src="JS/jquery-3.2.1.min.js"></script>
<link href='//imgcache.qq.com/qcloud/app/resource/ac/favicon.ico' rel='icon' type='image/x-icon'/>
<style>
.asahiorder input[type="date"],
.asahiorder input[type="text"],
.asahiorder .inputlist{
	width:300px;
    height: auto;
    line-height: 16px;
    margin: 0;
    padding: 0;
    border: none;
    color:black ;
    cursor: pointer;
    resize: none;
    /**border-bottom:1px solid #AAAAAA;**/
    background:none;
	text-align:left;
	margin-top:0px;
	margin-left:0px;
	font-family: Arial;
	font-size:14px;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	font-size:14px;
}
.songhuodan input[type="date"],
.songhuodan input[type="text"],
.songhuodan .inputlist{
	width:100%;
    height: 25px;
    line-height: 16px;
    margin: 0;
    padding: 0;
    border: none;
    color:black ;
    cursor: pointer;
    resize: none;
    /**border-bottom:1px solid #AAAAAA;**/
    background:none;
	text-align:center;
	margin-top:0px;
	margin-left:0px;
	font-family: Arial;
	font-size:12px;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	font-size:13px;
}
td{
	fmt:formatnumber;
}
.heji td{
	border-top:black solid 1px;
	border-bottom:black solid 2px;
}
.quantity input[type="text"]{
	text-align:right;
}
.danjiaheji input[type="text"]{
	text-align:right;padding-right:20px;
}


</style>
<script>


function jisuanqi(){
		var rows=1;
		var table=document.getElementById('table');
		var priceall=0;var quantityall=0;
		while(rows<20){
			if(table.rows[rows].cells[2].getElementsByTagName("input")[0].value){
				quantity=table.rows[rows].cells[2].getElementsByTagName("input")[0].value;
				quantity=Number(quantity.replace(",",""));quantityall=quantityall+quantity;
				um=table.rows[rows].cells[4].getElementsByTagName("input")[0].value;
				um=Number(um.replace(",",""));
				singletotal=um*quantity;
				table.rows[rows].cells[5].getElementsByTagName("input")[0].value=thousandBitSeparator(singletotal);
				priceall=priceall+singletotal;
				rows=rows+1;
			}else{
				break;
			}
		}
		document.getElementById('priceall').value=thousandBitSeparator(priceall);
		document.getElementById('quantityall').value=thousandBitSeparator(quantityall);
		
		
}
function thousandBitSeparator(num) {
  var num = (num || 0).toString(), result = '';
    while (num.length > 3) {
        result = ',' + num.slice(-3) + result;
        num = num.slice(0, num.length - 3);
    }
    if (num) { result = num + result; }
    return result;
}

function same_date(){
	$(function(){

		hopedate=$(".hopedate").eq(0).val();
		$(".hopedate").val(hopedate);
	});
}

</script>
<body style="background-color:">
<div style="width:820px;height:1150px;background-color:white;position:relative;overflow:hidden" class="asahiorder">

	<div style="position:absolute;top:20px;left:0px;width:100%;font-size:25px;text-align:center;"><b>朝日科技(上海)有限公司</b></div>
	<div style="position:absolute;top:50px;left:0px;width:100%;font-size:15px;text-align:center;"><b>ASAHI TECHNOLOGY(SHANGHAI)CO.LTD</b></div>
	<div style="position:absolute;top:90px;left:0px;width:100%;font-size:25px;text-align:center;letter-spacing:3px"><b>PURCHASE ORDER</b></div>
	<div style="position:absolute;top:420px;left:0px;width:100%;font-size:25px;text-align:center;">
	<hr style="height:0px;border:none;border-top:2px ridge black;width:100%">
	</div>
	<div class="printclass" style="position:absolute;top:400px;right:80px;width:;font-size:15px;text-align:right;border:2px solid red;cursor:pointer;color:red;padding:3px;text-align:right" onclick="same_date()">使用同一日期</div>
	<div class="printclass" style="position:absolute;top:400px;right:0px;width:;font-size:15px;text-align:right;border:2px solid red;cursor:pointer;color:red;padding:3px" onclick="window.print()">点击打印</div>
	<div style="position:absolute;top:440px;left:0px;width:100%;height:auto;background-color:;" class="songhuodan">
		<table cellspacing="0" width="100%" border="0" cellpadding="2" id="table" style="font-size:14px;">
			<tr align="center" bgcolor="">
				<td width="20px;">#</td>
				<td width="130px">Item Description</td>
				<td width="30px" align="right">Quantity</td>
				<td width="30px" align="left">UM</td>
				<td width="50px">Unit Price(JPY)</td>
				<td width="40px">Amount(JPY)</td>
				<td width="50px">希望出荷日</td>
				<td width="80px">回答出荷日</td>
			</tr>
<?php		$checkbox=$_GET['checkbox'];
			foreach($checkbox as $checkboxid => $_id){
				$row=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id='$_id'")->fetch_row();
				$row_id[]=$row[9];
				$campany=$row[5];
				$hopedate[]=$row[4];
				$banngo[]=$row[1];
				$quantity[]=$row[2];
				
			}

			$go=0;
			while($go<111){
				if($banngo[$go]){
					$ed=1;$ii=0;
					while($ed<111){
						if($checked[$ed]){
							if($checked[$ed]==$go){
								$ed++;
								$ii++;
							}else{								
								$ed++;
							}
						}else{
							echo $checked[$ed];
							break;
						}							
					}
					
					if($ii==0){
								$el=0;$quantitytotel=0;
								while($el<111){
									if($banngo[$el]){
										if($banngo[$el]==$banngo[$go]&&$hopedate[$el]==$hopedate[$go]){
											$quantitytotel+=$quantity[$el];
												$eed=1;$iid=0;
												while($eed<111){
													if($checked[$eed]){
														if($checked[$eed]==$el){
															$iid++;
															break;
														}else{
															$eed++;
														}		
													}else{
														break;
													}
												}
												if($iid==0){
												$checked[]=$el;
												}
											$el++;
											
										}else{
											$el++;
										}
									}else{
										break;
									}
								}
								$rowfinal=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id='$row_id[$go]'")->fetch_row();
								?>
								<tr align="center" bgcolor="<?php if($iii%2==0){echo "#EEEEEE";} ?>">
								<?php $rowprice=mysqli_query($conn,"SELECT * FROM `t_poprice` WHERE banngo='$rowfinal[1]' AND campany='$campany' order by _id desc")->fetch_row(); ?>
					<td width="20px"><input type="text" value="<?php echo $iii;$iii++; ?>"/></td>
					<td width="130px"><input type="text"  <?php if(mb_strlen($rowfinal[1])>22){echo "style='font-size:6px' value='".mb_substr($rowfinal[1],0,20)."'";}else{ echo "value='".$rowfinal[1]."'";} ?> />
										<?php if(mb_strlen($rowfinal[1])>22){echo "<br><input type='text' style='font-size:6px;height:10px;' value='".mb_substr($rowfinal[1],20)."' />";} ?>
										<?php if($rowprice[6]){echo "<br><input type='text' style='font-size:6px;height:10px;' value='".$rowprice[6]."' />";} ?></td>
					<td width="30px" class="quantity"><input type="text" value="<?php echo number_format($quantitytotel);$total+=$quantitytotel; ?>" onchange="jisuanqi()"/></td>
					<td width="30px" align="left"><?php if($rowfinal[1]){echo "pcs";} ?></td>
					<td width="50px"><input type="text" value="<?php echo $rowprice[2] ?>" onchange="jisuanqi()"/></td>
					<td width="40px" class="danjiaheji"><input type="text" value="<?php echo number_format($rowprice[2]*$quantitytotel);$total2+=($rowprice[2]*$quantitytotel) ?>"/></td>
					<td width="50px"><input class="hopedate" type="text" value="<?php 
					if(in_array($rowfinal[4],$mysave)){
						echo $myload[array_search($rowfinal[4],$mysave)];
					}else{
						$mysave[]=$rowfinal[4];
					
					if($rowfinal[4]<date('Y-m-d',strtotime('+40 days'))){
					 $rowfinal[4]=date('Y-m-d',(strtotime('-3 days',strtotime($rowfinal[4])))); 	
					}elseif($rowfinal[4]>date('Y-m-d',strtotime('+64 days'))){
					 $rowfinal[4]=date('Y-m-d',(strtotime('-9 days',strtotime($rowfinal[4])))); 
					}else{
					 $rowfinal[4]=date('Y-m-d',(strtotime('-6 days',strtotime($rowfinal[4])))); 
					}
						$dd=0;
					 	while($dd<7){
						if(date('w',strtotime($rowfinal[4]))==5){
							echo $rowfinal[4];
							
							$myload[]=$rowfinal[4];
							
							break;
						}else{
						$rowfinal[4]=date('Y-m-d',(strtotime('-1 days',strtotime($rowfinal[4])))); 
						$dd++;
						}
					}
					} ?>"/></td>
					<td width="80px"> </td>
				</tr>
								<?php
								
					}
					
					$go++;
				}else{
					break;
				}
			}
			 ?>
			<?php for($iiii=$iii;$iiii<=10;$iiii++){ ?>
				<tr align="center" bgcolor="<?php if($iii%2==0){echo "#EEEEEE";} ?>">
					<td width="20px"><input type="text" value="<?php echo $iii;$iii++; ?>"/></td>
					<td width="130px"><input type="text" value=""/></td>
					<td width="30px" class="quantity"><input type="text" value=""/></td>
					<td width="30px" align="left"><input type="text" value=""/></td>
					<td width="50px"><input type="text" value=""/></td>
					<td width="40px" class="danjiaheji"><input type="text" value=""/></td>
					<td width="50px"><input type="text" value=""/></td>
					<td width="80px"> </td>
				</tr>
			<?php } ?>
				<tr class="heji" align="center" bgcolor="">
					<td width="20px" style="border-top:none;"></td>
					<td width="130px">Total:</td>
					<td width="30px" class="quantity"><b><input type="text" id="quantityall" value="<?php echo number_format($total) ?>"/></b></td>
					<td width="30px" align="left">pcs</td>
					<td width="50px">Amount(JPY):</td>
					<td width="40px" class="danjiaheji"><b><input type="text" id="priceall" value="<?php echo number_format($total2) ?>"/></b></td>
					<td width="50px"></td>
					<td width="80px"> </td>
				</tr>
				
		</table>
	</div>
	<div style="position:absolute;top:150px;left:20px;font-size:;">
		<table cellpadding="2" cellspacing="0" width="100%" border="0" >
				<tr valign="top">
				<td>To:</td><td><input type="text" value="ASAHI RUBBERINC.INC"/><br><input type="text" value="2-7-2, Dotecho, Omiya-ku"/><br><input type="text" value="Saitama-shi,Saitama,330-0801,Japan"/></td>
				</tr>
				<tr>
				<td>Attn:</td><td><input type="text" value="Mr.Ichikawa"/></td>
				</tr>
				<tr>
				<td>Tel#</td><td><input type="text" value="81-48-650-6055"/></td>
				</tr>
				<tr>
				<td>Fax#</td><td><input type="text" value="81-48-650-5205"/></td>
				</tr>
				<tr>
				<td> </td><td> </td>
				</tr>
				<tr valign="top">
				<td>Ship to:</td><td><input type="text" value="Summit Center, Unit516, No.1088,"/><br><input type="text" value="Yanan West Road, Shanghai,"/><br><input type="text" value="200052, P R China"/></td>
				</tr>
				<tr>
				<td>Attn:</td><td><input type="text" value="Ms.Malin"/></td>
				</tr>
				<tr>
				<td>Tel#</td><td><input type="text" value="86-21-6212-6466"/></td>
				</tr>
				<tr>
				<td>Fax#</td><td><input type="text" value="86-21-6212-6466"/></td>
				</tr>		
		</table>
	</div>

	<div style="position:absolute;top:150px;right:-120px;font-size:;">
		<table cellpadding="2" cellspacing="0" width="100%" border="0" >
				<tr>
				<td>Document No.</td><td><input type="text" value="<?php echo $row[0] ?>"/></td>
				</tr>
				<tr>
				<td>Issue Date:</td><td><input type="text" value="<?php echo date('d-M-y') ?>"/></td>
				</tr>
				<tr>
				<td>Currencey:</td><td><input type="text" value="JPY"/></td>
				</tr>
				<tr>
				<td>Terms of Delivery:</td><td><input type="text" value="CIF ShangHai"/></td>
				</tr>
				<tr>
				<tr>
				<td>Delivery Method:</td><td><input type="text" value="AIR"/></td>
				</tr>
				<tr>
				<td>Payment Terms:</td><td><input type="text" value="TTT90"/></td>
				</tr>
				<tr>
				<td>Customer name:</td><td><input type="text" value="<?php $thecampany=campany($row[5]);echo $thecampany;  ?>"/></td>
				</tr>
				<tr>
				
		</table>
	</div>
	<div style="position:absolute;bottom:<?php if($iii>11){echo "00";}else{echo "60";} ?>px;left:20px;font-size:;width:330px">
		<table cellpadding="2" cellspacing="0" width="100%" border="0" >
				<tr valign="top">
				<td>Vender Confirmation</td>
				</tr>
				<tr height="80px">
				<td style="border-bottom:black solid 2px;"> </td>
				</tr>
				<tr height="50px">
				<td>Confirmation by</td>
				</tr>
				
		</table>
	</div>
	<div style="position:absolute;bottom:<?php if($iii>11){echo "00";$rand60=60;}else{echo "60";$rand60=0;} ?>px;left:480px;font-size:;width:330px">
		<table cellpadding="2" cellspacing="0" width="100%" border="0" >
				<tr valign="top">
				<td>ASAHI TECHNOLOGY(SHANGHAI)CO.,LTD</td>
				</tr>
				<tr height="80px">
				<td style="border-bottom:black solid 2px;"> </td>
				</tr>
				<tr height="50px">
				<td>&nbsp;</td>
				</tr>
				
		</table>
	</div>
	<div style="position:absolute;bottom:<?php echo rand(80-$rand60,120-$rand60) ?>px;left:<?php echo rand(530,560) ?>px;">
	<img src="img/gaizhang.png" width="175px" height="175px">
	</div>
</div>
</body>
<head>
<title><?php echo $row[0]."朝日科技-".$thecampany; ?></title>
</head>
<?php
$conn->close();
?>