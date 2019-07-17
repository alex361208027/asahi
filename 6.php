<?php
if($_COOKIE['loged']){
	
echo file_get_contents("templates/header.html");

require_once("libs/myfunction.php");
	
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');



//$shuzigengxin=$_GET['shuzigengxin'];


$t6 = $_POST['t6'];
$t1 = $_POST['t1'];
$t3 = $_POST['t3'];
$t5 = $_POST['t5'];$t5 = $_POST['t55'];
$t4 = $_POST['t4'];
if(!$t4){
	$t4 = $_GET['t4'];
}

$t7 = $_POST['t7'];$t77 = $_POST['t77'];
$t8 = $_POST['t8'];$t88 = $_POST['t88'];
$t9 = $_POST['t9'];
if(!$t9){
	$t9 = $_GET['t9'];
}

if($_GET['t11']){
	$t11 = $_GET['t11'];
}else{
$t11 = $_POST['t11'];
}

$eee=0;

if($t11){
	$tt11="AND JPdate <> 0  ";
	$nopox=$nopox."<div class='nopox'>納期待つ除き</div>";
}else{
	$tt11="";
}



if($t9){
	$tt9="";
	$nopox=$nopox."<div class='nopox'>含入荷済み</div>";
}else{
	$tt9="AND state = '' ";
}
if($_GET['php4-1ordernum']){
	$tt9="";
}

if($t6){
	$t6 = qukongge($t6); 
	$tt6="AND asahiorder like '%$t6%'";
	$nopox=$nopox."<div class='nopox'>".$t6."</div>";
}else{
	$tt6="AND asahiorder <> ''";
}
if($_GET['php4-1ordernum']){
	$php41ordernum=$_GET['php4-1ordernum'];
	$tt6="AND asahiorder = '$php41ordernum'";
	$nopox=$nopox."<div class='nopox'>".$php41ordernum."</div>";
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
		$date71="JPdate >= '$t7'";
	}
	if($t77){
		if($t7){
		$date72=" AND JPdate <= '$t77'";
		}else{
		$date72="JPdate <= '$t77'";	
		}
	}
	$tt7="AND ($date71 $date72 AND JPdate <> 0) ";
	
	$nopox=$nopox."<div class='nopox'>".$t7."~".$t77."</div>";
}else{
	$tt7="";
}
$select=$tt3.$tt1.$tt5.$tt4.$tt7.$tt9.$tt11.$tt6;


$nowpage=$_POST['nowpage'];
if(empty($nowpage)){
$nowpage=0;
}
$nowpagestart=$nowpage+1;
$nowpageend=$nowpage+100;


$orderby="order by JPdate,campany,asahiorder,hopedate,banngo asc";


$sql="SELECT * FROM `t_poteacher` WHERE $select $orderby limit $nowpage,100";

$result=mysqli_query($conn,$sql);


if($nopox){
	$nopo="检索条件:".$nopox;
}else{
	$nopo="朝日PO检索";	
}

?>
<body style="font-size:12px;min-width:800px">
<style>
table{border-collapse: collapse;}
.tabletr{
	border-top:solid 1px #d0dee5
}
</style>
<br><br><br>
<div class="nopo"><?php echo $nopo; ?></div><input type="hidden" id="cellss" value="">
<div id="myDiv" style="padding:0px;margin:0 5px;-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;overflow:hidden;"> 
<table id="tableExcel" cellpadding="1" cellspacing="0" width="100%" style="font-size:9px;">
<tr style="background-color:#B55D4C;color:white;height:33px;">
	<td></td>
	<td></td>
	<td align="center">状態</td>
	<td>朝日PO</td>
	<td>取引先</td>
	<td>品番</td>
	<td align="right">数量</td>
	<td></td>
	<td align="">(客)注文PO</td>
	<td>(客)希望納期</td>
	<td>日本出荷日</td>
	<td>備考</td>
</tr>

<?php while($row=$result->fetch_row()){ 
							if($row[8] == '已入库'){
								$bgimg='#BBBBFF';$states='入荷済み';
							}elseif($row[3] == 0){
								$bgimg='#000000';$states='納期待つ';
							}elseif($row[3] > date('Y-m-d')){
								$bgimg='#00DDB1';$states='生産中';
							}elseif($row[3] == date('Y-m-d')){
								$bgimg='#FF7792';$states='日本出荷';
								//$eee=$eee+1;
							}elseif(date('Y-m-d',(strtotime('+4 days',strtotime($row[3])))) >= date('Y-m-d')){
								$bgimg='#FF7792';$states='通関中';
								//$eee=$eee+1;
							}else{
								$bgimg='#999999';$states='上海着';
								//$eee=$eee+1;
							}
							
							
?>
<tr <?php  if($colordate!=$row[3]){if($bgcolor==""){$bgcolor="#F7F7F7";}else{$bgcolor="";} echo "bgcolor='".$bgcolor."'"; }else{echo "bgcolor='".$bgcolor."'";}$colordate=$row[3]; ?> class="tabletr">
	
	<td align="right"><input type="checkbox" name="checkboxsum" onclick="checkboxsum()" value="<?php echo $row[2]; ?>" _id="<?php echo $row[9] ?>" cells="<?php echo $jjj+1; ?>"/></td>
	<td align="center"><?php echo $jjj+1; ?></td>
	<td align="center"><div class="classcp1" style="background-color:<?php echo $bgimg; ?>"><?php echo $states; ?></div></td>
	<td class="pick_same" value="<?php echo $row[0]; ?>"><a href="4-1.php?asahit1=<?php echo $row[0]; ?>" ><?php echo $row[0]; ?></a></td>
	<td class="pick_same" value="<?php echo $row[5]; ?>"><?php echo $row[5]; ?></td>
    <td class="pick_same" value="<?php echo $row[1]; ?>"><u onclick="po_banngo('_id=<?php echo $row[9] ?>&cells=<?php echo $jjj+1 ?>')"><?php echo $row[1]; ?></u><?php if($row[3]!="0000-00-00" &&!$row[8] && $row[3]<date('Y-m-d')){ ?><a href="###" onclick="document.getElementById('ajasdiv').innerHTML='';document.getElementById('cellss').value='<?php echo $jjj+1; ?>';eee=1;po_ru_quantity=<?php echo $row[2]; ?>;po_ruku('t2=<?php echo $row[1] ?>&t3=<?php echo $row[2] ?>&t6=<?php echo $row[5] ?>&t7=<?php echo $row[6] ?>&customer_id=<?php echo $row[10] ?>&_id=<?php echo $row[9] ?>&asahipo=<?php echo $row[0] ?>')">[入库]</a><?php } ?></td>
	<td align="right"><?php echo $row[2]; ?></td>
	<td align="left">pcs</td>
	<td class="pick_same" value="<?php echo $row[6]; ?>" align="" style="color:#0000AA"><a href="4.php?ddt2=<?php echo $row[6]; ?>" ><?php echo $row[6]; ?></a></td>
	<td style="color:#0000AA" onclick="window.open('2.php?t4=id<? echo $row[10] ?>&t9=1')" title="点击查看该客户品番"><?php if($row[4]==0){ echo ""; }elseif($row[4]<=$row[3]){ echo "<font color='red'>".$row[4]."</font>"; }else{ echo $row[4]; } ?></td>
	<td><b><?php if($row[3]==0){ echo ""; }else{ echo $row[3]; } ?></b></td>
	<td><marquee scrolldelay="200"><?php echo $row[7] ?></marquee><? if($row[11]){echo "[拆]";} ?></td>
	<?php $jjj=$jjj+1 ?>
	
</tr>
<?php } ?>
</table></div>

<script>
function mycheckbox(str){
	var button="";
	if(str==1){
		button="asahiorder.php?";
	}else if(str==2){
		button="hebing.php?";
	}else if(str==4){
		button="upload_lotnum.php?";
	}else if(str==5){
		button="upload_leadtime.php?";
	}
	var ss=document.getElementsByName('checkboxsum');
	for(i=0;i<ss.length;i++){
		if(ss[i].checked){
		button+="checkbox[]="+ss[i].getAttribute("_id")+"&";
		}
	}
	button+="end=6";
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
});
//function orderbyhopedate(str){
//	document.getElementById('href').href="6.php?"+str;
//	document.getElementById('href').click();
//}

function po_pi_lotnum(str){
	
	
			str="";
			var checkbox=document.getElementsByName('checkboxsum');
			str+="JPdate="+document.getElementById('JPdate').value;
			for(i=0;i<checkbox.length;i++){
				if(checkbox[i].checked){
				str+="&checkbox[]="+checkbox[i].getAttribute('_id');
				}
			}
			
			
			var xmlhttp;
			if (str.length==0)
			  { 
			  //document.getElementById("ajasdiv").innerHTML="";
			  return;
			  }
			if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }else{// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{	
					
				
				}
			  }
			xmlhttp.open("GET","upload_lotnum.php?"+str,true);
			xmlhttp.send();
			
		
	
}


</script>


<div class="message">

<button type="button" onclick="this.innerHTML='正在导出...';setTimeout(()=>{exceldownload('Asahi');},500);setTimeout(()=>{this.innerHTML='导出EXCEL';},9500);">导出Excel</button>
<? echo file_get_contents("templates/table_select.html"); ?>
</div>

<div class="sum_show">


<table width="100%" height="100%" align="center" valign="middle"><tr><td>
 <div id="sum_show" align="center">选中项合计</div><div class="sum_show_caozuo">操作</div>
</tr></td></table>
<ul class="hide" title="选中项批量操作">
	<li><div class="sum_show_hide_x">X</div></li>
<li onclick="mycheckbox(2)" class="close_hide"><img src="img/tongji.png" height="14px"> &nbsp; 合并统计</li>
<li onclick="mycheckbox(1)" class="close_hide"><img src="img/songhuodan.png" height="14px"> &nbsp; 生成朝日订单</li>
<li><hr></li>
<li><input type="date" id="JPdate" value=""></li>
<li onclick="po_pi_JPdate()" class="close_hide"><img src="img/riqi.png" height="14px"> &nbsp; 更改日本发货日</li>
<li onclick="mycheckbox(5)" class="close_hide"><img src="img/chuku.png" height="14px"> &nbsp; 纳期录入</li>
<li onclick="mycheckbox(4)" class="close_hide"><img src="img/chuku.png" height="14px"> &nbsp; lotnum入库</li>
<li> &nbsp; </li>
 </ul>
 <div class="sum_show_x">X</div>
</div>
<form action="6.php" method="post">
<?php $nowpage=$nowpage+100; ?>
<?php if($jjj>=100){ ?><input type="submit" value=" &nbsp; " style="background:url('img/next.png') no-repeat; width:46px; height:32px;">
<input type="hidden" name="nowpage" value="<?php echo $nowpage ?>"/>
<input type="hidden" name="t6" value="<?php echo $t6 ?>"/><input type="hidden" name="t1" value="<?php echo $t1 ?>"/><input type="hidden" name="t3" value="<?php echo $t3 ?>"/>
<input type="hidden" name="t5" value="<?php echo $t5 ?>"/><input type="hidden" name="t55" value="<?php echo $t55 ?>"/><input type="hidden" name="t4" value="<?php echo $t4 ?>"/>
<input type="hidden" name="t7" value="<?php echo $t7 ?>"/><input type="hidden" name="t77" value="<?php echo $t77 ?>"/><input type="hidden" name="t9" value="<?php echo $t9 ?>"/>
<input type="hidden" name="t11" value="<?php echo $t11 ?>"/>
<?php }elseif($jjj<1){echo "无内容：请尝试更改检索";}?>
</form>
<br><br>
<div class="tishi">朝日检索页面</div>
<br><br>

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