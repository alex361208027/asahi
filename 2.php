<?php
if($_COOKIE['loged']){

echo file_get_contents("templates/header.html");

require_once("libs/myfunction.php");
	
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');
//$today7=date('Y-m-d',strtotime('+7 days'));



$php4ordernum=$_GET['php4ordernum'];

if($_GET['t6']){
$t6 = $_GET['t6'];
}else{
$t6 = $_POST['t6'];
}

if($_GET['t1']){
$t1 = $_GET['t1'];
}else{
$t1 = $_POST['t1'];
}

if($_GET['t3']){
$t3 = $_GET['t3'];
}else{
$t3 = $_POST['t3'];
}

$t5 = $_POST['t5'];
$t4 = $_POST['t4'];
if(!$t4){
	$t4 = $_GET['t4'];
}
$t7 = $_POST['t7'];$t77 = $_POST['t77'];
$selectdate=$_POST['selectdate'];

if($_GET['t9']){
$t9 = $_GET['t9'];
}else{
$t9 = $_POST['t9'];
}


if($_GET['t11']){
	$t11 = $_GET['t11'];
}else{
$t11 = $_POST['t11'];
}
$t12 = $_POST['t12'];



if($t11){
	$tt11=" AND JPdate <> 0 ";
	$nopox="<div class='nopox'>納期待つ除き</div>";
}else{
	$tt11="";
}




if($t9){
		$tt9="";
		$nopox=$nopox."<div class='nopox'>含完成</div>";
}else{
		$tt9="AND state = ''";
}

if($php4ordernum){
	$tt9="";
}


if($t6){
	$t6 = qukongge($t6); 
	$tt6="AND ordernum like '%$t6%'";
	$nopox=$nopox."<div class='nopox'>".$t6."</div>";
}else{
	$tt6="AND ordernum <> ''";
}

if($php4ordernum){
	$tt6="AND ordernum = '$php4ordernum'";
	$nopox=$nopox."<div class='nopox'>".$php4ordernum."</div>";
}

if($t1){
	$explode_t1=explode(";",$t1);
	for($i=0;$i<count($explode_t1);$i++){
		if($i==0){
		$each_t1="campany='".$explode_t1[$i]."'";
		}else{
		$each_t1=$each_t1." OR campany='".$explode_t1[$i]."'";	
		}
	}
	$tt1="AND (".$each_t1.")";
	$nopox=$nopox."<div class='nopox'>".$t1."</div>";
}else{
	$tt1="";
}
if($t3){
	
	$t3 = qukongge($t3); 
	$explode_t3=explode(";",$t3);
	for($i=0;$i<count($explode_t3);$i++){
		if($i==0){
		$each_t3="banngo like '%".$explode_t3[$i]."%'";
		}else{
		$each_t3=$each_t3." OR banngo like '%".$explode_t3[$i]."%'";	
		}
	}
	
	$tt3="(".$each_t3.") ";
	//$tt3="banngo like '%$t3%' ";
	$nopox=$nopox."<div class='nopox'>".$t3."</div>";
}else{
	$tt3="banngo <> '' ";
}
if($t5){
	$tt5="AND (invoice = '' OR invoice is null) AND state = '完成' ";
	$nopox=$nopox."<div class='nopox'>未开票</div>";
}else{
	$tt5="";
}
if($t4){
	if(stripos($t4,'id')!== false){
	$t4=str_replace("id","",$t4);
	$tt4="AND _id = '$t4' ";
	$nopox=$nopox."<div class='nopox'>id".$t4."</div>";
	}else{
	$tt4="AND quantity = '$t4' ";
	$nopox=$nopox."<div class='nopox'>数量".$t4."</div>";
	}
}else{
	$tt4="";
}
if($t7||$t77){
	if($t7){
		$date71="$selectdate >= '$t7'";
		$date81="hopedate >= '$t7'";
	}
	if($t77){
		if($t7){
		$date72="AND $selectdate <= '$t77'";
		$date82="AND hopedate <= '$t77'";
		}else{
		$date72="$selectdate <= '$t77'";	
		$date82="hopedate <= '$t77'";
		}
	}
	$tt7="AND (($date71 $date72) OR ($selectdate = '0000-00-00' AND $date81 $date82 ))";
	$nopox=$nopox."<div class='nopox'>".$t7."~".$t77."</div>";
}else{
	$tt7="";
}

if($t12){
	$tt12="AND asahiorder2 <> ''";
	$nopox=$nopox."<div class='nopox'>在库のみ</div>";
}else{
	$tt12="";
}

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$nowpage=$_POST['nowpage'];
if(empty($nowpage)){
$nowpage=0;
}
$nowpagestart=$nowpage+1;
$nowpageend=$nowpage+100;

$sql="SELECT *,IF(SHdate='0000-00-00',hopedate,SHdate) as thedate FROM `t_teacher` WHERE $tt3 $tt1 $tt5 $tt4 $tt7 $tt9 $tt11 $tt6 $tt12 order by thedate,campany,ordernum,banngo asc limit $nowpage,100";

$result=mysqli_query($conn,$sql);


if($nopox){
	$nopo="检索条件:".$nopox;
}else{
	$nopo="お客様PO检索";	
}

?>
<body style="font-size:12px;min-width:800px">
<style>
.starmark{
	cursor:pointer;display:inline-block;
}
table{border-collapse: collapse;}
.tabletr{
	border-top:solid 1px #d0dee5
}



</style>
<br><br><br>
<div class="nopo"><?php echo $nopo; ?></div>
<div id="myDiv" style="padding:0px;margin:0 5px;-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;overflow:hidden;"> 
<table id="tableExcel" cellpadding="1" cellspacing="0" width="100%" style="font-size:12px;">
<tr style="background-color:#8F77B5;color:white;height:33px;">
	<td class="2_td_checkbox"><?php?></td>
	<td width="5px"></td>
	<td align="center" class="2_td_state">状態</td>
	<td>取引先</td>
	<td>注文PO</td>
	<td>品番</td>
	<td align="right">数量</td>
	<td align="left"></td>
	<td>订单納期</td>
	<td>朝日PO</td>
	<td>日本出荷日</td>
	<td>朝日科技出货</td>
	<td class="2_td_tuichi"></td>
	<td>发票</td>
</tr>

<?php while($row=$result->fetch_row()){ 
							if($row[9] == '完成'){
								$bgimg='#BBBBFF';$states='完成';
							}elseif($row[6] == 0){
								if($row[13] == 0){
								$bgimg='#000000';$states='未匹配';	
								}else{
								$bgimg='#000000';$states='納期待つ';
								}
							}elseif($row[11]=="已入库"&&$row[7] <= date('Y-m-d')){
								$bgimg='#FF0033';$states='要出荷';
							}elseif($row[11]=="已入库"){
								$bgimg='#FF0033';$states='出荷待つ';
							}elseif($row[6] > date('Y-m-d')){
								$bgimg='#00DDB1';$states='生産中';
							}elseif($row[6] == date('Y-m-d')){
								$bgimg='#FF7792';$states='日本出荷';
							}elseif(date('Y-m-d',(strtotime('+4 days',strtotime($row[6])))) >= date('Y-m-d')){
								$bgimg='#FF7792';$states='通関中';
								
							}else{
								$bgimg='#999999';$states='入荷待つ';
							}
							
							if($states!='完成'&& (($row[7]<= date('Y-m-d',(strtotime('+4 days',strtotime($row[6])))) && $row[7]!="0000-00-00")||($row[6]=="0000-00-00" && $row[7]!="0000-00-00")) ){
								
								$tuichi='<div class="classcp1" style="background-color:#FF6685;color:white;">調</div>';
								
 							}elseif( $states!='完成' && date('Y-m-d',(strtotime('+7 days',strtotime($row[4])))) < $row[7] &&  date('Y-m-d',(strtotime('+11 days',strtotime($row[6])))) < $row[7] ){
								$tuichi='<div class="classcp1" style="background-color:black;color:white;">遅</div>';
							}elseif( $states!='完成'&& $row[7]!='0000-00-00' && date('Y-m-d',(strtotime('-7 days',strtotime($row[4])))) > $row[7] ){
								$tuichi='<div class="classcp1" style="background-color:#000077;color:white;">早</div>';
							}else{
								$tuichi="";
							}
							
							
							
							if($states!='完成' && $row[8]){
						
								if(mb_strlen($row[8])>4){
									$diandian="..";
								}else{
									$diandian="";
								}
								$remark4=mb_substr($row[8],0,4).$diandian;
	
							}else{
								$remark4="";
							}
							
							if($row[15]){
								$tuichi=$tuichi.'<div class="classcp1" style="background-color:yellow;color:black;">拆</div>';
							}
					
	if($same_po==$row[1]&&$same_banngo==$row[2]){
		$same=1;
	}else{
		$same=0;
	}
	$same_po=$row[1];$same_banngo=$row[2]; 
?>
<tr <?php  if($colordate!=$row[7]){if($bgcolor==""){$bgcolor="#F7F7F7";}else{$bgcolor="";} echo "bgcolor='".$bgcolor."'"; }else{echo "bgcolor='".$bgcolor."'";}$colordate=$row[7]; ?> <? if(!$same){echo "class='tabletr'";} ?>>
	
	<td align="right" class="2_td_checkbox"><input type="checkbox" name="checkboxsum" onclick="checkboxsum();" value="<?php echo $row[3]; ?>" _id="<?php echo $row[12] ?>" cells="<?php echo $jjj+1; ?>"/></td>
	<td align="center"><?php echo $jjj+1; ?></td>
	<td align="center" class="2_td_state"><div class="classcp1" style="background-color:<?php echo $bgimg; ?>" title="<? echo $row[8]."(".$states.")"; ?>"><?php if($remark4){echo $remark4;}else{echo $states;} ?></div></td>
	<td class="pick_same" value="<? echo $row[0] ?>"><?php if(!$same){echo $row[0];} ?></td>
	<td class="pick_same" value="<? echo $row[1] ?>"><a href="4.php?ddt2=<?php echo $row[1] ?>"><?php if(!$same){echo $row[1];} ?></a></td>
	<td style="max-width:120px;" class="pick_same" value="<? echo $row[2] ?>"><u onclick="c_banngo('_id=<?php echo $row[12] ?>&cells=<?php echo $jjj+1 ?>')"><?php echo $row[2] ?></u></td>
	<td align="right"><?php echo $row[3] ?></td>
	<td>pcs</td>
	<td><?php if($row[4]<=$row[6]){ echo "<font color='red'>".$row[4]."</font>"; }else{ echo $row[4]; } ?></td>
	<td class="pick_same" value="<? echo $row[5] ?>" style="color:#0000AA"><a href="4-1.php?asahit22=<?php echo $row[5] ?>"><?php echo $row[5] ?></a></td>
	<td style="color:#0000AA" onclick="window.open('6.php?t4=id<? echo $row[13] ?>&t9=1')" title="点击查看该朝日品番"><?php echo $row[6] ?></td>
	<td><b><?php echo $row[7] ?></b></td>
	<td class="2_td_tuichi"><div class='starmark' val="<? echo $row[12]; ?>" val2="<? echo $row[14]; ?>"><? echo "<img src='img/star".$row[14].".png'/>" ?></div><? echo $tuichi; ?></td>
	<td><?php if($row[10]=='0000-00-00'){}else{echo $row[10];} ?></td>
	<?php $jjj=$jjj+1 ?>
	
</tr>
<?php } ?>
</table></div>
<script>
function mycheckbox(str){

	var button="";
	if(str==1){
		button="songhuodan.php?";
	}else if(str==2){
		button="hebing.php?";
	}
	
	var ss=document.getElementsByName('checkboxsum');
	for(i=0;i<ss.length;i++){
		if(ss[i].checked){
		button+="checkbox[]="+ss[i].getAttribute("_id")+"&";
		}
	}
	button+="end=2";
	window.open(button,"_BLANK");
}

$(document).ready(function(){
	$("input").click(function(){
		if($(this).is(':checked')){
			$(this).parents("tr").attr("bgcolor","#FFFFDD");
		}else{
			$(this).parents("tr").attr("bgcolor","");
		}
	});
	
	$(".starmark").click(function(){
		self=this;
		$.post("ajax/c_starmark.php",{id:$(this).attr("val"),star:$(this).attr("val2")},function(data,status){
			$(self).attr("val2",data);
			data="img/star"+data+".png";
			$(self).children().attr("src",data);
		});
	});
 
	
	


	
	
	
});

function td_remove(){
	$(document).ready(function(){
			$('.2_td_checkbox').remove();
			$('.2_td_state').remove();
			$('.2_td_tuichi').remove();
	});
	
}




</script>


<div class="message">

<button type="button" onclick="this.innerHTML='正在导出...';td_remove();setTimeout(()=>{exceldownload('Customer');},500);setTimeout(()=>{location.reload()},25000);">导出Excel</button>
<? echo file_get_contents("templates/table_select.html"); ?>
</div>


<div class="sum_show">
<table width="100%" height="100%" align="center" valign="middle"><tr><td>
 <div id="sum_show" align="center">选中项合计</div><div class="sum_show_caozuo">操作</div>
</tr></td></table>
 <ul class="hide" title="选中项批量操作">
	<li><div class="sum_show_hide_x">X</div></li>
	<li onclick="mycheckbox(2);" class="close_hide"><img src="img/tongji.png" height="14px"> &nbsp; 合并统计</li>
	<li onclick="mycheckbox(1)" class="close_hide"><img src="img/songhuodan.png" height="14px"> &nbsp; 生成送货单</li>
	<li onclick="c_pi_zaikuduizhao()" class="close_hide"><img src="img/pici.png" height="14px"> &nbsp; 查看在库批次号</li>
	<li onclick="c_pi_qrcode(2)" class="close_hide"><img src="img/qrcode.png" height="14px"> &nbsp; 生成QR-code</li>
	<li onclick="c_fastest_date(1)" class="close_hide"><img src="img/riqi.png" height="14px"> &nbsp; 设为最快发货日</li>
	<li onclick="c_fastest_date(2)" class="close_hide"><img src="img/riqi.png" height="14px"> &nbsp; 设为最佳发货日</li>
	<li><hr></li>
	<li><input type="date" id="SHdate" value="<?php echo date('Y-m-d') ?>"></li>
	<li onclick="c_pi_shdate()" class="close_hide"><img src="img/riqi.png" height="14px"> &nbsp; 更改上海发货日</li> 
	<li onclick="c_pi_chuku()" class="close_hide"><img src="img/chuku.png" height="14px"> &nbsp; 出库</li>
	<li onclick="c_pi_invoice()" class="close_hide"><img src="img/fapiao.png" height="14px"> &nbsp; 开具发票</li>
	<li> &nbsp; </li>
 </ul>
 <div class="sum_show_x">X</div>
 <div class="sum_show_move" value="1" style="position:absolute;cursor:pointer;right:20px;top:20px;margin-top:-20px;margin-right:-20px">↑</div>
 <div class="sum_show_move" value="2" style="position:absolute;cursor:pointer;right:20px;top:20px;margin-top:20px;margin-right:-20px">↓</div>
</div>




<form action="2.php" method="post">
<?php $nowpage=$nowpage+100; ?>
<?php if($jjj>=100){ ?><input type="submit" value=" &nbsp; " style="background:url('img/next.png') no-repeat;width:46px;height:32px;">
<input type="hidden" name="nowpage" value="<?php echo $nowpage ?>"/>
<input type="hidden" name="t6" value="<?php echo $t6 ?>"/><input type="hidden" name="t1" value="<?php echo $t1 ?>"/><input type="hidden" name="t3" value="<?php echo $t3 ?>"/>
<input type="hidden" name="t5" value="<?php echo $t5 ?>"/><input type="hidden" name="t4" value="<?php echo $t4 ?>"/><input type="hidden" name="selectdate" value="<?php echo $selectdate; ?>"/>
<input type="hidden" name="t7" value="<?php echo $t7 ?>"/><input type="hidden" name="t77" value="<?php echo $t77 ?>"/><input type="hidden" name="t9" value="<?php echo $t9 ?>"/>
<input type="hidden" name="t11" value="<?php echo $t11 ?>"/><input type="hidden" name="t12" value="<?php echo $t12 ?>"/>
<?php }elseif($jjj<1){echo "无内容：请尝试更改检索";} ?>
</form>
<br><br>

<div class="tishi">客户检索页面</div>


<br><br>

<!--ajas-->
<style>

.ajasdivout{
	position:fixed;right:0px;top:18px;min-height:400px;width:350px;background-color:white;
	-webkit-box-shadow: -8px 4px 18px #BBBBBB;
  -moz-box-shadow: -8px 4px 18px #BBBBBB;
  box-shadow: -8px 4px 18px #BBBBBB;
	transition: all 1s;
-moz-transition: all 1s;	/* Firefox 4 */
-webkit-transition: all 1s;	/* Safari 和 Chrome */
-o-transition: all 1s;
}
.ajasdivout2{
	position:fixed;right:0px;top:18px;min-height:400px;max-height:500px;overflow-x:hidden;overflow-y:scroll;width:400px;background-color:white;
	-webkit-box-shadow: -8px 4px 18px #BBBBBB;
  -moz-box-shadow: -8px 4px 18px #BBBBBB;
  box-shadow: -8px 4px 18px #BBBBBB;
	transition: all 1s;
-moz-transition: all 1s;	/* Firefox 4 */
-webkit-transition: all 1s;	/* Safari 和 Chrome */
-o-transition: all 1s;
}
.ajasdivx{
	position:absolute;right:0px;top:0px;background-color:;font-size:20px
}
input[type="date"],
input[type="text"],
input[type="button"],
input[type="password"],
input[type="email"],
input[type="submit"],
input[type="tel"],
.inputlist{
	width:auto;
    height: auto;
    line-height: 16px;
    margin: 0;
    padding: 0;
    border: none;
    color:#666666 ;
    cursor: pointer;
    resize: none;
    /**border-bottom:1px solid #AAAAAA;**/
    background:none;
	text-align:left;
	margin-top:0px;
	margin-left:0px;
	font-family: Arial;
	font-size:12px;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}
</style>






</body>
<?php
 $conn->close();
echo file_get_contents("templates/footer.html");

}else{
	echo $_COOKIE['loged']." login?";
} 
?>