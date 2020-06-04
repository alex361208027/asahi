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

$checkbox=$_GET['checkbox'];
			foreach($checkbox as $checkboxid => $_id){
				$row=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id='$_id'")->fetch_row();
				$row_id[]=$row[9];
				$campany=$row[5];
				$hopedate[]=$row[4];
				$banngo[]=$row[1];
				$quantity[]=$row[2];
				
			}

function campany($campany) {
	Global $conn;
	$japanname=mysqli_query($conn,"SELECT other FROM `t_campany` WHERE campany='$campany'")->fetch_row();
	
	if($japanname[0]){
		return $japanname[0];
	}else{
		return $campany;
	}
	
}

$thecampany=campany($row[5]);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="" type="text/css" rel="stylesheet" charset=utf-8 >
<script type="text/javascript" src="JS/1.js"></script>
<script type="text/javascript" src="JS/jquery-3.2.1.min.js"></script>
 <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
   <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
     <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	   <link rel="stylesheet" href="jqueryui/style.css">
<link href='//imgcache.qq.com/qcloud/app/resource/ac/favicon.ico' rel='icon' type='image/x-icon'/>
<title><?php echo $row[0]."朝日科技-".$thecampany; ?></title>
<style>
input[type="date"],input[type="text"]{
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
table{
	border-collapse:collapse;
}
td{

	word-wrap:break-word;
	    word-break:break-all;
		    white-space:normal;
			    max-width:100px;
				min-height:50px;
				
}

.tr_clear{
	cursor:pointer;
}
tr{
	width:100%;
}
@media print {
 .printclass{ display:none;}
}

</style>
<script>
$(function(){

 $( "#sortable1" ).sortable({
	 items:'.sorttr',
	 stop:function(){
		 $(".sorttr").each(function(){
			 //setTimeOut(()=>{
			 check_index=Number($(this).index())-16;
			 check_index=Number(check_index);
			
			 $(this).children("td").eq(0).text(check_index);
			 //},100)
			 if(check_index%2==0){
				 $(this).css({"background":"#EEEEEE"});
			
			 }else{
				 $(this).css({"background":"white"});
			 }
		 });
		 
		 
	 }
 }).disableSelection();


	$("td").dblclick(function(){
		change_val=prompt("更改数据?(注:点击【取消】清空数据)",$(this).text());
		if($(this).attr("class")=="quantity"){
			change_val=thousandBitSeparator(change_val);
		}
		$(this).empty().append(change_val);
			qiuhe();
		
	});
	
	$(".tr_clear").click(function(){
		if(confirm("确定清除此行数据？")){
		$(this).nextAll("td").each(function(){
			$(this).empty();
		});
		qiuhe();
		}
	});
	
	$(".printclass").click(function(){
		$(this).empty().append('正在导出...');
		$("#sortable1").attr("width","800px");
		setTimeout(()=>{
			exceldownload('Customer');
			},500);
		setTimeout(()=>{	
		$(this).empty().append("导出EXCEL");	
		$("#sortable1").attr("width","100%");
			},4500);
	});
	
	function qiuhe(){
		var quantity_total=0;
		var priceall=0;var quantityall=0;
		$(".quantity").each(function(){
			if($(this).text()){
				quantity=$(this).text();
				quantity=Number(quantity.replace(",",""));quantityall=Number(quantityall)+Number(quantity);
				um=$(this).next().next().text();
				//um=Number(um.replace(",",""));
				singletotal=Number(um*1000)*Number(quantity*1000)/1000000;
				priceall=Number(priceall)+Number(singletotal);
				
				singletotal=thousandBitSeparator(singletotal);
				$(this).next().next().next().empty().append(singletotal);
			}
				
		});
		quantityall=thousandBitSeparator(quantityall);
		priceall=thousandBitSeparator(priceall);
		
	    $(".quantity_total").empty().append("<b>"+quantityall+"</b>");
		$(".quantity_total").next().next().next().empty().append("<b>"+priceall+"</b>");
	}
	
	
	
	
});


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
	hopedate=prompt("希望出荷日 统一更改为：",$(".hopedate").eq(0).text());
		if(hopedate){
		$(".hopedate").each(function(){
			if($(this).text()){
				$(this).empty().append(hopedate);
			}
		});
		}
	});
}



</script>
<body style="background-color">
<button type="button" class="printclass">导出Excel</button>
<div style="width:21cm;height:29.7cm;background-color:white;position:relative;overflow:;" class="asahiorder" id="myDiv">
	<table width="100%" style="font-size:12px;" cellspacing="0" cellpadding="0" id="sortable1">
	<tr><td width="8%"></td><td width="20%"></td><td width="10%"></td><td width="5%"></td><td width="13%"></td><td width="18%"></td><td width="12%"></td><td width="12%"></td></tr>
	<tr><td colspan="8" align="center" style="font-size:24px;font-weight:bold;letter-spacing:2px">朝日科技（上海）有限公司</td></tr>
	<tr><td colspan="8" align="center" style="font-size:16px;font-weight:bold">ASAHI TECHNOLOGY(SHANGHAI)CO.LTD</td></tr>
	<tr><td colspan="8" align="center" style="font-size:24px;font-weight:bold;letter-spacing:3px" height="80px">PURCHASE ORDER</td></tr>
	<tr><td>To:</td><td colspan="4">ASAHI RUBBERINC.INC</td><td>Document No.</td><td colspan="2" style="font-weight:bold;font-size:13px;"><? echo $row[0]; ?></td></tr>
	<tr><td></td><td colspan="4">2-7-2, Dotecho, Omuta-ku</td><td>Issue Date:</td><td colspan="2" align="left"><?php echo date('d-M-y'); ?></td></tr>
	<tr><td></td><td colspan="4">Saitama-shi,Saitama,330-0801,Japan</td><td>Currencey:</td><td colspan="2">JPY</td></tr>
	<tr><td>Attn:</td><td colspan="4">Mr.Ichikawa</td><td>Terms of Delivery:</td><td colspan="2">CIF ShangHai</td></tr>
	<tr><td>Tel#</td><td colspan="4">81-48-650-6055</td><td>Delivery Method:</td><td colspan="2">AIR</td></tr>
	<tr><td>Fax#</td><td colspan="4">81-48-650-5205</td><td>Payment Terms:</td><td colspan="2">TTT90</td></tr>
	<tr><td>Ship To:</td><td colspan="4">Summit Center, Unit818, No.1088</td><td>Customer Name:</td><td colspan="2"><?php echo $thecampany;  ?></td></tr>
	<tr><td></td><td colspan="4">Yan'an West Road, Shanghai,</td><td></td><td colspan="2"></td></tr>
	<tr><td></td><td colspan="4">200052, P R China</td><td></td><td colspan="2"></td></tr>
	<tr><td>Tel#</td><td colspan="4">86-21-6212-6466</td><td></td><td colspan="2"></td></tr>
	<tr><td>Fax#</td><td colspan="4">86-21-6212-6466</td><td></td><td colspan="2"></td></tr>
	<tr height="30px"><td colspan="8" align="center"></td></tr>
	<tr height="25px" align="center" style="border-top:3px solid black;border-bottom:1px solid black"><td>#</td><td>Item Description</td><td align="right">Quantity</td><td>UM</td><td>Unit Price(JPY)</td><td>Amount(JPY)</td><td title="批量修出荷日" style="cursor:pointer;" onclick="same_date()">希望出荷日</td><td>回答出荷日</td></tr>


<?php		

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
								<tr class="sorttr" align="center" height="25px" bgcolor="<?php if($iii%2==0){echo "#EEEEEE";} ?>">
								<?php $rowprice=mysqli_query($conn,"SELECT * FROM `t_poprice` WHERE banngo='$rowfinal[1]' AND campany='$campany' order by _id desc")->fetch_row(); ?>
					<td width="" class="tr_clear"><?php echo $iii;$iii++; ?></td>
					<td width=""><?php echo $rowfinal[1] ?><?php if($rowprice[6]){echo "<br>".$rowprice[6]."";} ?></td>
					<td width="" class="quantity" align="right"><?php echo number_format($quantitytotel);$total+=$quantitytotel; ?></td>
					<td width=""><?php if($rowfinal[1]){echo "pcs";} ?></td>
					<td width=""><?php echo $rowprice[2] ?></td>
					<td width="" class="danjiaheji"><?php echo number_format($rowprice[2]*$quantitytotel);$total2+=($rowprice[2]*$quantitytotel) ?></td>
					<td width="" class="hopedate"><?php 
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
					} ?></td>
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
				<tr class="sorttr" align="center" height="25px" bgcolor="<?php if($iii%2==0){echo "#EEEEEE";} ?>">
					<td width=""><?php echo $iii;$iii++; ?></td>
					<td width=""></td>
					<td width="" class="quantity" align="right"></td>
					<td width=""></td>
					<td width=""></td>
					<td width="" class="danjiaheji"></td>
					<td width=""></td>
					<td width=""></td>
				</tr>
			<?php } ?>
				<tr class="heji" height="25px" align="center" style="border-top:1px solid black;border-bottom:3px solid black;">
					<td width="" style="border-top:none;"></td>
					<td width="">Total:</td>
					<td width="" class="quantity_total" align="right"><b><?php echo number_format($total) ?></b></td>
					<td width="">pcs</td>
					<td width="">Amount(JPY):</td>
					<td width="" class="danjiaheji"><b><?php echo number_format($total2) ?></b></td>
					<td width=""></td>
					<td width=""> </td>
				</tr>







	<tr height="30px"><td colspan="8" align="center"></td></tr>
	<tr style="font-size:14px;font-weight:bold"><td colspan="4">Vender Confirmation</td><td></td><td colspan="3">ASAHI TECHNOLOGY(SHANGHAI)CO.,LTD</td></tr>
	<tr height="80px"><td colspan="8" align="right"><img src="img/gaizhang.png" width="175px" height="175px" onclick="window.print()" title="点击打印/导出PDF" style="cursor:pointer;margin:<? echo rand(-20,-30) ?>px <? echo rand(10,50) ?>px <? echo rand(-10,-5) ?>px 0px"></td></tr>
	<tr style="font-size:14px;font-weight:bold;border-top:2px solid black;"><td colspan="4">Confirmation by</td><td></td><td colspan="3"></td></tr>
	
	
	</table>
	
	
</div>
</body>
<?php
$conn->close();
?>