<?php
echo file_get_contents("templates/header.html");

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);



$sqllogin="SELECT * FROM `t_user` WHERE user = '{$_COOKIE['asahiuser']}' AND userpw = '{$_COOKIE['asahiuserpw']}'";
$resultlogin = mysqli_query($conn,$sqllogin);
if($resultlogin->num_rows > 0){

$campany=$_GET['campany'];
$banngo=$_GET['banngo'];
$price=$_GET['price'];$sellprice=$_GET['sellprice'];$reel=$_GET['reel'];
$search=$_GET['search'];$han=$_GET['han'];

if($banngo&&$price){
	if(mysqli_query($conn,"SELECT * FROM `t_poprice` WHERE banngo = '$banngo' AND campany = '$campany'")-> num_rows > 0){
		echo $banngo." &nbsp  <a href='poprice.php'>已经存在!请在此确认！     ->回到首页</a>";
		?>
		<form action="poprice.php" method="GET">
		<input list="kehulist" class="inputlist" name="campany" style="width:150px" value="" placeholder="客户名" /><input type="text" name="banngo" style="width:200px" value="" placeholder="新番号"><input type="text" name="price" value="" placeholder="进价"><input type="text" name="sellprice" value="" placeholder="卖价"><input type="text" name="reel" value="" placeholder="pcs/reel"><input type="submit" value="添加">
		</form>
		<?
	}else{
		mysqli_query($conn,"INSERT INTO `t_poprice`(`campany`,`banngo`, `price`,`sellprice`, `reel`) VALUES ('$campany','$banngo','$price','$sellprice','$reel')");
		echo $banngo." &nbsp  <-<a href='poprice.php'>添加成功!     ->回到首页</a>";
				?>
		<form action="poprice.php" method="GET">
		<input list="kehulist" class="inputlist" name="campany" style="width:150px" value="" placeholder="客户名" /><input type="text" name="banngo" style="width:200px" value="" placeholder="新番号"><input type="text" name="price" value="" placeholder="进价"><input type="text" name="sellprice" value="" placeholder="卖价"><input type="text" name="reel" value="" placeholder="pcs/reel"><input type="submit" value="添加">
		</form>
		<?
	}
}else{
	if($han){
		$han="";
	}else{
		$han="and state=0";
	}
	if($search){
	$sql = "SELECT * FROM `t_poprice` WHERE (banngo like '%$search%' OR campany ='$search' OR description like '%$search%' OR price = '$search' OR sellprice = '$search') $han order by banngo asc";		
	}else{
	$sql = "SELECT * FROM `t_poprice` WHERE banngo is not null $han order by banngo asc";
	}
	$result=mysqli_query($conn,$sql);
	$i=1;
?>
<style>	
input[type="text"], .inputlist{
	width:100px;
    height: 20px;
    
    margin: 0;
    padding: 0;
    border: none;
    color:#666666 ;
    cursor: pointer;
    resize: none;
    background:#EEEEFF;
	text-align:center;
margin-right: 3px;
}


.beizhu{
	min-width:150px;
}

.buchangyong:hover{
	color:blue;cursor: pointer;
}

.sb{
	position:relative;display:inline;
}
.state{
	display:none;position:absolute;top:-10px;left:25px;
}
.statebutton{
	
}
ul, li{
	min-width:100px;
}
ul{
	padding:2px;
}
li{
	font-size:12px;margin-top:5px;display:inline-block;
}


cc{
	color:#B6ADB8;
}

.oldprice{
	border:1px solid black;position:absolute;top:0px;left:0px;background:white;padding:1px;z-index:99;font-size:12px;
	display:none;
}
.oldnewprice{
	position:relative;
}
.oldnewprice:hover > .oldprice{
	display:inline-block;top:100%;
}

.oldsellprice{
	border:1px solid black;position:absolute;top:0px;left:0px;background:white;padding:1px;z-index:99;font-size:12px;
	display:none;
}
.oldnewsellprice{
	position:relative;
}
.oldnewsellprice:hover > .oldsellprice{
	display:inline-block;top:100%
}
</style>
<script>
$(document).ready(function(){
	$(".statebutton").click(function(){
	if($(this).next().css("display")=='none'){
		$('.statebutton').css("background","");
		$(this).css("background","#777777");
		$('.state').fadeOut();
	    $(this).next().fadeIn();
	}else{
		$(this).next().fadeOut();
		$(this).css("background","");
	}
	});
	
});
</script>	
<div style="position:fixed;background:#FFBBBB;border:2px solid balck;width:100%;z-index:100;padding-bottom:10px" align="right">
<form action="poprice.php" method="GET">添加新品番：
<input list="kehulist" class="inputlist" name="campany" style="width:150px" value="" placeholder="客户名" /><input type="text" name="banngo" style="width:200px" value="" placeholder="新番号"><input type="text" name="price" value="" placeholder="进价"><input type="text" name="sellprice" value="" placeholder="卖价"><input type="text" name="reel" value="" placeholder="pcs/reel"><input type="submit" value="添加">
</form>
</div>
<br><br><br><br>
<datalist id="kehulist">
<?php
$campany_list=explode(",",file_get_contents("ajax/write_data/campany.html"));
foreach($campany_list as $campany_list){
	echo "<option value='".$campany_list."'>";
}
?>	
</datalist>

<hr>
<form action="poprice.php" method="GET">
<input type="text" name="search" list="kehulist" style="width:200px" value="<?php echo $search ?>" placeholder="搜索"><input type="submit" value="搜索"> <input type="checkbox" name="han" value="1" <? if(!$han){echo 'checked';} ?>/>含不常用品番
</form>
<? if($search){ ?>
<table cellpadding="2" cellspacing="0" >
<tr style="background-color:#FF6685;color:white;height:;" align="center">
<td width="50px">#</td>
<td>客户</td>
<td>番号</td>
<td>进价(JPY)</td>
<td>卖价(RMB)</td>
<td>pcs/reel</td>
<td>订单品名补充</td>
<td></td>
</tr>
<?php while($row=$result->fetch_row()){ ?>
	<tr>
	<td><i><?php echo $i ?>.</i></td>
	<td align="center"><input type="text" id="campany<?php echo $row[0] ?>" value="<?php echo $row[4] ?>"></td>
	<td align="center"><?php if($row[11]==0){echo $row[1];}elseif($row[11]==1){echo "<cc>".$row[1]."</cc>";} ?></td>
	<td><div class="oldnewprice"><div class="oldprice"><? echo $row[12] ?></div><input type="text" id="price<?php echo $row[0] ?>" value="<?php echo $row[2] ?>"></div></td>
	<td><div class="oldnewsellprice"><div class="oldsellprice"><? echo $row[13] ?></div><input type="text" id="sellprice<?php echo $row[0] ?>" value="<?php echo $row[5] ?>"></div></td>
	<td><input type="text" id="reel<?php echo $row[0] ?>" value="<?php echo $row[3] ?>"></td>
	<td><input type="text" id="other<?php echo $row[0] ?>" value="<?php echo $row[6] ?>"></td>
	<td><button id="button<?php echo $row[0] ?>" onclick="po_price(<?php echo $row[0] ?>)">确认编辑</button> 
	<div class="sb"><button class="statebutton" onclick="po_state(<?php echo $row[0] ?>)">></button>
	<div class="state">
	<ul>
	<li>【<?php echo $row[1] ?>】</li>
	<li><input type="text" class="beizhu" value="<?php echo $row[7]; ?>" id="description<?php echo $row[0] ?>" onchange="description(<?php echo $row[0] ?>,1)" placeholder="点击输入备注"/></li>
	<li>mcd:<input type="text" value="<?php echo $row[8]; ?>" id="mcd<?php echo $row[0] ?>" style="width:50px" onchange="description(<?php echo $row[0] ?>,2)" placeholder="mcd"/></li>
	<li>X:<input type="text" value="<?php echo $row[9]; ?>" id="color_x<?php echo $row[0] ?>" style="width:50px" onchange="description(<?php echo $row[0] ?>,3)" placeholder="x"/></li>
	<li>Y:<input type="text" value="<?php echo $row[10]; ?>" id="color_y<?php echo $row[0] ?>" style="width:50px" onchange="description(<?php echo $row[0] ?>,4)" placeholder="y"/></li>
	<li class="buchangyong" onclick="buchangyong(<?php echo $row[0]; ?>,<?php echo $row[11]; ?>,this)"><?php if($row[11]==0){echo "设置为不常用";}elseif($row[11]==1){echo "设置为常用";} ?></li>
	</ul>
	</div>
	</div></td>
	</tr>
<?php	
$i++;
} ?>
</table>
注意：当“进价”为空时，则表示删除该品番。<br>
批量修改价格：<select id="select">
<option value="1">进价</option>
<option value="2">卖价</option>
</select><input type="text" id="price1" value="" placeholder="所有此价格">=><input type="text" id="price2" value="" placeholder="更新为新价格"><button onclick="pricechange()">确认更改</button>
<br><br>
<button id="exceldownload">下载所有价格的EXCEL版本</button>
<br><br>
<script>
$(document).ready(function(){
	$("#exceldownload").click(function(){
	 $.post("upload/poprice_excel.php",{ok:1},function(data){
		window.location.href="upload/"+data;
	 });
});
});

function po_price(id){
			str="";
			str="campany="+document.getElementById('campany'+id).value+"&price="+document.getElementById('price'+id).value+"&sellprice="+document.getElementById('sellprice'+id).value+"&reel="+document.getElementById('reel'+id).value+"&other="+document.getElementById('other'+id).value+"&_id="+id;
			//alert(str);
			var xmlhttp;
			if (str.length==0)
			  { 
			  
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
					
					if(isNaN(xmlhttp.responseText)==true){
					
						document.getElementById("button"+id).innerHTML="已更新";
						//document.getElementById("button"+id).onclick="";
					}else{
						
						document.getElementById("price"+xmlhttp.responseText).value="";
						document.getElementById("button"+id).innerHTML="已删除";
						document.getElementById("button"+id).onclick="";
					}
					
					
				}
			  }
			xmlhttp.open("GET","ajax/po_price.php?"+str,true);
			xmlhttp.send();
}



function pricechange(){
			str="";
			str="select="+document.getElementById('select').value+"&price1="+document.getElementById('price1').value+"&price2="+document.getElementById('price2').value;
			//alert(str);
			var xmlhttp;
			if (str.length==0)
			  { 
			  
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
					
					setTimeout("location.reload()",500);
				}
			  }
			xmlhttp.open("GET","ajax/pricechange.php?"+str,true);
			xmlhttp.send();
}

function description(id,num){
			str="";
			if(num==1){
			str="description="+document.getElementById('description'+id).value;
			}else if(num==2){
			str="mcd="+document.getElementById('mcd'+id).value;	
			}else if(num==3){
			str="color_x="+document.getElementById('color_x'+id).value;	
			}else if(num==4){
			str="color_y="+document.getElementById('color_y'+id).value;	
			}
			str=str+"&_id="+id;
			var xmlhttp;
			if (str.length==0)
			  { 
			  
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
					
					//alert(xmlhttp.responseText);
				}
			  }
			xmlhttp.open("GET","ajax/pricechange_description.php?"+str,true);
			xmlhttp.send();
}

function buchangyong(str,state,thiss){
			str="_id="+str+"&state="+state;
			
			var xmlhttp;
			if (str.length==0)
			  { 
			  
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
					//xmlhttp.responseText
					//setTimeout("location.reload()",500);
					thiss.innerHTML="设置成功！";
				}
			  }
			xmlhttp.open("GET","ajax/po_price_buchangyong.php?"+str,true);
			xmlhttp.send();
}
</script>
<? } ?>
<?php
}

}
else{
	echo "朝日科技(上海)有限公司-送货单系统<br><a href='a.php'>请登录</a>";
}
$conn->close();
?>