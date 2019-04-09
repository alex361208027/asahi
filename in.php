<?php
if($_COOKIE['loged']){
echo file_get_contents("templates/header.html");

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');



if($_GET['in']){
$in = $_GET['in'];	
}else{
$in = $_POST['in'];
}
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$datestart = $_GET['datestart'];
$dateend = $_GET['dateend'];
	if($datestart&&$dateend){
		if($in){
		$select_date="intime >= '$datestart' AND intime <= '$dateend' AND";	
		}else{
		$select_date="outtime >= '$datestart' AND outtime <= '$dateend' AND outtime is not null AND";
		}
	}else{
		$select_date="";
	}
$search_lotnum= $_GET['search_lotnum'];
	if($search_lotnum){
		$select_lotnum="lotnum like '%$search_lotnum%' AND";
	}else{
		$select_lotnum="";
	}
$search_banngo= $_GET['search_banngo'];
	if($search_banngo){
		$select_banngo="banngo like '%$search_banngo%' AND";
	}else{
		$select_banngo="";
	}
$search_campany= $_GET['search_campany'];
	if($search_campany){
		$select_campany="campany like '%$search_campany%' AND";
	}else{
		$select_campany="";
	}




$iii=1;

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

if($_GET['nowpage']){
$nowpage = $_GET['nowpage'];
}else{
$nowpage=0;
}


if($in){
	$sql="SELECT * FROM `t_inout` WHERE $select_banngo $select_lotnum $select_campany $select_date (outquantity is null OR outquantity = 0) order by intime desc";
}else{
	$sql="SELECT * FROM `t_inout` WHERE $select_banngo $select_lotnum $select_campany $select_date outquantity > 0 order by outtime desc limit $nowpage,50";
}
$result=mysqli_query($conn,$sql);
?>
<style>
.message input{
	max-width:150px;
}
</style>
<br><br><br>
<div id="myDiv"> 
<table id="tableExcel" cellpadding="5" cellspacing="0" width="100%" style="text-align:center;font-size:12px;">
			<tr align="center" style="background-color:black;color:white;height:45px;">
				<td></td>
                <td>#</td>
				<td>状态</td>
				<td>Lot No.</td>
				<td>番号</td>
				<td>入库时数量</td>
				<td>入库时间</td>
				<td>出库时间</td>
				<td>朝日单号</td>
				<td>客户</td>
				<td>快递号</td>
				<td>备注</td>
				<!--<td></td>-->
            </tr>
<?php while($row=$result->fetch_row()){ 

	if($row[5]){
		$state="已出库";
		$bgcolor="#F7F7F7";
	}else{
		$state="在库中";
		$bgcolor="#FF99AD";
	}

?>
			<tr><form action="putout.php" method="post" target="_blank">
				<td align="right"><input type="checkbox" onclick="checkboxsum();" name="checkboxsum" _id="<? echo $row[9]; ?>" value="<?php echo $row[2]; ?>" /></td>
				<td style="color:#C4C4C4"><?php echo $iii;$iii=$iii+1; ?></td>
				<td style="max-width:45px;" bgcolor="<?php echo $bgcolor; ?>"><?php echo $state ?></td>
				<td><a href="###" onclick="in_lotnum('<?php echo $row[9] ?>')"><u><?php echo $row[0] ?></u></a></td>
				<td style="max-width:80px;"><?php echo $row[1] ?></td>
				<td><?php echo $row[2] ?></td>
				<td><?php echo $row[3] ?></td>
				<td><?php echo $row[4] ?></td>
				<td><?php echo $row[10] ?></td>
				<td><?php echo $row[6] ?></td>
				<td><?php echo $row[7] ?></td>
				<td><marquee scrolldelay="200" style="max-width:120px;font-size:12px;color:red;"><?php echo $row[8] ?></marquee></td>
				<!--<td><input type="hidden" name="_id" value="<?php echo $row[9] ?>"/><input type="submit" value="change"></td>-->
            </tr></form>
<?php } ?>

</table></div>
<br><br>

<div class="message">
<?php if(empty($in)){$nowpages=$nowpageend/50;echo "第".$nowpages."页";} ?> 
<button type="button" onclick="exceldownload('Zaiku');">导出Excel</button>  
<? echo file_get_contents("templates/table_select.html"); ?>
 <!--<button onclick="c_pi_qrcode()">QR-code</button> -->
 <form onsubmit="return false;" style="display:inline-block;">
<input type="submit" value=" 【検索】 " onclick="saerch_lotnum()"><a id="href" href=""></a>
 <input type="text" id="search_lotnum" value="<?php echo $search_lotnum ?>" placeholder="检索lotnum"/><input type="text" id="search_banngo" value="<?php echo $search_banngo ?>" placeholder="检索番号"/><input type="text" id="search_campany" list="kehulist" value="<?php echo $search_campany ?>" placeholder="检索客户"/>
&nbsp; <?php if(!$in){ ?>出货<?php } ?>日期<input type="date" id="datestart" value="<?php echo $datestart ?>" onchange="if(document.getElementById('dateend').value==''){document.getElementById('dateend').value=this.value;}"/>~<input type="date" id="dateend" value="<?php echo $dateend ?>"/>
</form>

</div>

<div class="sum_show">
<table width="100%" height="100%" align="center" valign="middle"><tr><td>
 <div id="sum_show" align="center">选中项合计</div>
</tr></td></table>
 <div class="sum_show_x">X</div>
</div>


<datalist id="kehulist">
<?php
$campany_list=explode(",",file_get_contents("ajax/write_data/campany.html"));
foreach($campany_list as $campany_list){
	echo "<option value='".$campany_list."'>";
}
?>	
</datalist>
<script>
function saerch_lotnum(str){
	document.getElementById('href').href="in.php?search_lotnum="+document.getElementById('search_lotnum').value+"&search_banngo="+document.getElementById('search_banngo').value+"&search_campany="+document.getElementById('search_campany').value+"&datestart="+document.getElementById('datestart').value+"&dateend="+document.getElementById('dateend').value+"&in="+document.getElementById('inin').value;
	if(str==2){
	document.getElementById('href').href+="&nowpage="+document.getElementById('nowpage').value;
	}
	document.getElementById('href').href=document.getElementById('href').href.replace("+","%2B");
	//alert(document.getElementById('href').href);
	document.getElementById('href').click();
}
</script>
<?php if(empty($in)){ ?>
<?php $nowpage=$nowpage+50; ?>
<input type="hidden" id="nowpage" value="<?php echo $nowpage ?>"/>
<input type='hidden' id='inin' value=''>
<button onclick="saerch_lotnum(2)">NEXT</button>

<?php }else{
	echo "<input type='hidden' id='inin' value='in'>";
} ?>

<!--ajas-->
<script>
function in_lotnum(str){
			document.getElementById("ajasdiv").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="-450";
			document.getElementById("ajasdivout").style.right="-450";
			setTimeout("document.getElementById('ajasdivout').style.right='0'",500)
			
			
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
					document.getElementById("ajasdiv").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("GET","./ajax/in_lotnum.php?_id="+str,true);
			xmlhttp.send();
			
}
function in_lotnum_complete(){
			str="";
			if(document.getElementsByName('in_quantity')[0].value==document.getElementsByName('in_outquantity')[0].value || document.getElementsByName('in_outquantity')[0].value==0 || document.getElementsByName('in_outquantity')[0].value==""){
			str="_id="+document.getElementsByName('in_id')[0].value+"&lotnum="+document.getElementsByName('in_lotnum')[0].value+"&banngo="+document.getElementsByName('in_banngo')[0].value+"&quantity="+document.getElementsByName('in_quantity')[0].value+"&intime="+document.getElementsByName('in_intime')[0].value+"&outtime="+document.getElementsByName('in_outtime')[0].value+"&outquantity="+document.getElementsByName('in_outquantity')[0].value+"&asahipo="+document.getElementsByName('in_asahipo')[0].value+"&campany="+document.getElementsByName('in_campany')[0].value+"&expressnum="+document.getElementsByName('in_expressnum')[0].value+"&remark="+document.getElementsByName('in_remark')[0].value;
			
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
					setTimeout("location.reload()",300);
					
				}
			  }
			xmlhttp.open("GET","./ajax/in_lotnum_complete.php?"+str,true);
			xmlhttp.send();
			}else{
				alert("出库数量不正确");
			}
}
function in_lotnum_delete(str){
			document.getElementById("ajasdiv2").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="345";
			document.getElementById("ajasdiv2").innerHTML="<button onclick=\"in_lotnum_delete_complete('"+str+"')\">确认删除</button>";

}

function in_lotnum_delete_complete(str){
			
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
					document.getElementById("ajasdiv2").innerHTML=xmlhttp.responseText;;
					setTimeout("location.reload()",2000);
				}
			  }
			xmlhttp.open("GET","./ajax/in_lotnum_delete_complete.php?"+str,true);
			xmlhttp.send();
			
}

function in_lotnum_chaifen(str){
			document.getElementById("ajasdiv2").innerHTML="正在加载...";
			document.getElementById("ajasdivout2").style.right="345";
			document.getElementById("ajasdiv2").innerHTML="<input type='text' value='' id='in_lotnum_chaifen_quantity' placeholder='输入要拆分出去的数量' /><button onclick=\"in_lotnum_chaifen_complete('"+str+"&quantity='+document.getElementById('in_lotnum_chaifen_quantity').value)\">确认拆分</button>";

}

function in_lotnum_chaifen_complete(str){
			
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
					setTimeout("location.reload()",300);
				}
			  }
			xmlhttp.open("GET","./ajax/in_lotnum_chaifen_complete.php?"+str,true);
			xmlhttp.send();
			
}


//setTimeout("location.reload()",2000);
////////
</script>
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
font-size:12px;
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
font-size:12px;
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

<?php
 $conn->close();
 echo file_get_contents("templates/footer.html");
}else{
	echo $_COOKIE['loged']." login?";
} 
?>