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
$today7=date('Y-m-d',strtotime('+7 days'));




//$shuzigengxin=$_GET['shuzigengxin'];

$php4ordernum=$_GET['php4ordernum'];

$t6 = $_POST['t6'];
$t1 = $_POST['t1'];
$t3 = $_POST['t3'];
$t5 = $_POST['t5'];
$t4 = $_POST['t4'];
$t7 = $_POST['t7'];$t77 = $_POST['t77'];
//$t8 = $_POST['t8'];$t88 = $_POST['t88'];
$t9 = $_POST['t9'];
$t10 = $_POST['t10'];
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


if($t10){
	$tt10="AND po_id = '' ";
	$nopox=$nopox."<div class='nopox'>未分配</div>";
}else{
	$tt10="";
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
	$tt1="AND campany = '$t1' ";
	$nopox=$nopox."<div class='nopox'>".$t1."</div>";
}else{
	$tt1="";
}
if($t3){
	
	$t3 = qukongge($t3); 
	
	$tt3="banngo like '%$t3%' ";
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
	$tt4="AND quantity = '$t4' ";
	$nopox=$nopox."<div class='nopox'>数量".$t4."</div>";
}else{
	$tt4="";
}
if($t7||$t77){
	if($t7){
		$date71="SHdate >= '$t7'";
		$date81="hopedate >= '$t7'";
	}
	if($t77){
		if($t7){
		$date72="AND SHdate <= '$t77'";
		$date82="AND hopedate <= '$t77'";
		}else{
		$date72="SHdate <= '$t77'";	
		$date82="hopedate <= '$t77'";
		}
	}
	$tt7="AND (($date71 $date72) OR (SHdate = '0000-00-00' AND $date81 $date82 ))";
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

$sql="SELECT *,IF(SHdate='0000-00-00',hopedate,SHdate) as thedate FROM `t_teacher` WHERE $tt3 $tt1 $tt5 $tt4 $tt7 $tt9 $tt10 $tt11 $tt6 $tt12 order by thedate,campany,ordernum,banngo asc limit $nowpage,100";

$result=mysqli_query($conn,$sql);


if($nopox){
	$nopo="检索条件:".$nopox;
}else{
	$nopo="お客様PO检索";	
}

?>
<body style="font-size:12px;min-width:800px">
<style>
tr:hover{
	background-color:#AAAAFF;
}
td:hover{
	color:white;
}
.starmark{
	cursor:pointer;
	
}
</style>
<br><br><br>
<div class="nopo"><?php echo $nopo; ?></div>
<div id="myDiv" style="padding:0px;margin:0 5px;-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;overflow:hidden;"> 
<table id="tableExcel" cellpadding="1" cellspacing="0" width="100%" style="font-size:12px;">
<tr style="background-color:#8F77B5;color:white;height:33px;">
	<td class="2_td_1"><?php?></td>
	<td width="5px"></td>
	<td width="5px" class="2_td_3"></td>
	<td align="center" class="2_td_4">状態</td>
	<td>取引先</td>
	<td>注文PO</td>
	<td>品番</td>
	<td align="right">数量</td>
	<td align="left"></td>
	<td>订单納期</td>
	<td>朝日PO</td>
	<td>日本出荷日</td>
	<td>上海出荷日</td>
	<td>備考</td>
	<td>发票</td>
	<td class="2_td_16"></td>
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
							
							if($states!='完成'&& $row[7]<$row[6] ){
-								$tuichi='<div class="classcp1" style="background-color:#FF6685;color:white;">調</div>';
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
								if($row[7]=='0000-00-00'){
									$bgimg='black';
								}elseif($row[11]){
									$bgimg='#FF0033';
								}else{
								$bgimg='#000066';
								}
								$states=$remark4;
								
							}
?>
<tr <?php  if($colordate!=$row[7]){if($bgcolor==""){$bgcolor="#F7F7F7";}else{$bgcolor="";} echo "bgcolor='".$bgcolor."'"; }else{echo "bgcolor='".$bgcolor."'";}$colordate=$row[7]; ?>>
	<? 
	if($same_po==$row[1]&&$same_banngo==$row[2]){
		$same=1;
	}else{
		$same=0;
	}
	$same_po=$row[1];$same_banngo=$row[2]; 
	?>
	<td align="right" class="2_td_1"><input type="checkbox" name="checkboxsum" value="<?php echo $row[3]; ?>" _id="<?php echo $row[12] ?>" cells="<?php echo $jjj+1; ?>"/></td>
	<td align="center"><?php echo $jjj+1; ?></td>
	<td class="2_td_3"><div class='starmark' val="<? echo $row[12]; ?>" val2="<? echo $row[14]; ?>"><? echo "<img src='img/star".$row[14].".png'/>" ?></div></td>
	<td align="center" class="2_td_4"><div class="classcp1" style="background-color:<?php echo $bgimg; ?>"><?php echo $states; ?></div></td>
	<td><?php if(!$same){echo $row[0];} ?></td>
	<td><a href="4.php?ddt2=<?php echo $row[1] ?>"><?php if(!$same){echo $row[1];} ?></a></td>
	<td style="max-width:120px;"><a href="###" onclick="c_banngo('_id=<?php echo $row[12] ?>&cells=<?php echo $jjj+1 ?>')" ><u><?php echo $row[2] ?></u></a></td>
	<td align="right"><?php echo $row[3] ?></td>
	<td>pcs</td>
	<td><?php if($row[4]<=$row[6]){ echo "<font color='red'>".$row[4]."</font>"; }else{ echo $row[4]; } ?></td>
	<td><a href="4-1.php?asahit22=<?php echo $row[5] ?>"><?php echo $row[5] ?></a></td>
	<td><?php echo $row[6] ?></td>
	<td><b><?php echo $row[7] ?></b></td>
	<td><marquee scrolldelay="200"><?php echo $row[8] ?></marquee></td>
	<td><?php echo $row[10]; ?></td>
	<td class="2_td_16"><? echo $tuichi; ?></td>
	<?php $jjj=$jjj+1 ?>
	
</tr>
<?php } ?>
</table></div>
<div class="message">

<script>
function mycheckbox(str){
	var button=document.getElementById('button3');
	if(str==1){
		button.href="songhuodan.php?";
	}else if(str==2){
		button.href="hebing.php?";
	}
	
	var ss=document.getElementsByName('checkboxsum');
	for(i=0;i<ss.length;i++){
		if(ss[i].checked){
		button.href+="checkbox[]="+ss[i].getAttribute("_id")+"&";
		}
	}
	button.href+="end=2";
	button.click();
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
			$('.2_td_1').remove();
			$('.2_td_3').remove();
			$('.2_td_4').remove();
			$('.2_td_16').remove();
	});
}

</script>
<button type="button" onclick="td_remove();setTimeout(()=>{method5('tableExcel')},500)">导出Excel</button>  
<button type="button" style="background-color:#CCCCFF" onclick="checkboxsum()">选中项合计</button> &nbsp; <input type="number" style="width:40px" id="checkall1" value="1" onchange="checkall12()"/>~<input type="number" style="width:40px" id="checkall2" value="99" onchange="checkall12()"/>
<a href="" id="button3" target="_blank"></a><button onclick="mycheckbox(2)">选中项合并统计</button> &nbsp; <button onclick="mycheckbox(1)">选中项生成送货单</button> &nbsp; <button onclick="c_pi_zaikuduizhao()">其他</button>
</div>
<form action="2.php" method="post">
<?php $nowpage=$nowpage+100; ?>
<?php if($jjj>=100){ ?><input type="submit" value=" &nbsp; " style="background:url('img/next.png') no-repeat; width:46px; height:32px;">
<input type="hidden" name="nowpage" value="<?php echo $nowpage ?>"/>
<input type="hidden" name="t6" value="<?php echo $t6 ?>"/><input type="hidden" name="t1" value="<?php echo $t1 ?>"/><input type="hidden" name="t3" value="<?php echo $t3 ?>"/>
<input type="hidden" name="t5" value="<?php echo $t5 ?>"/><input type="hidden" name="t4" value="<?php echo $t4 ?>"/>
<input type="hidden" name="t7" value="<?php echo $t7 ?>"/><input type="hidden" name="t77" value="<?php echo $t77 ?>"/><input type="hidden" name="t9" value="<?php echo $t9 ?>"/>
<input type="hidden" name="t10" value="<?php echo $t10 ?>"/><input type="hidden" name="t11" value="<?php echo $t11 ?>"/><input type="hidden" name="t12" value="<?php echo $t12 ?>"/>
<?php }elseif($jjj<1){echo "无内容：请尝试更改检索";} ?>
</form>
<br><br>
<div class="xiaokuan">
<button onclick="c_pi_shdate()">【批量】选中项上海发货日</button> &nbsp; 【批量】日期：<input type="date" id="SHdate" value="<?php echo date('Y-m-d') ?>">
<button onclick="c_pi_chuku()">【批量】选中项出库</button> &nbsp; <input type="text" id="expressnum" value="" placeholder="运单号后三位">||
<button onclick="c_pi_invoice()">【批量】选中项开具发票</button>
</div>
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