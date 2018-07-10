<?php
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
$search=$_GET['search'];

if($banngo&&$price){
	if(mysqli_query($conn,"SELECT * FROM `t_poprice` WHERE banngo = '$banngo' AND campany = '$campany'")-> num_rows > 0){
		echo $banngo."已经存在，<a href='poprice.php'>回到首页</a>";
	}else{
		mysqli_query($conn,"INSERT INTO `t_poprice`(`campany`,`banngo`, `price`,`sellprice`, `reel`) VALUES ('$campany','$banngo','$price','$sellprice','$reel')");
		echo $banngo." &nbsp  <-添加成功,<a href='poprice.php'>回到首页</a>";
	}
}else{
	if($search){
$sql = "SELECT * FROM `t_poprice` WHERE banngo like '%$search%' OR campany like '%$search%' OR description like '%$search%' order by banngo asc";		
	}else{
$sql = "SELECT * FROM `t_poprice` WHERE 1 order by banngo asc";
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
.banngo{
	position:relative;
}

.description input{
background:none;color:#FFFF11;width:95%
}
.description{
	display:;
	color:white; z-index:10;
	position:absolute;top:0px;right:0px;background:#777777;padding:0px 0px;width:100%;max-height:0px;overflow:hidden;
-webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  -webkit-box-shadow: 0px 1px 8px #BBBBBB;
  -moz-box-shadow: 0px 1px 8px #BBBBBB;
  box-shadow: 0px 1px 8px #BBBBBB;
  
transition:all 1.3s;
-moz-transition:all 1.3s; /* Firefox 4 */
-webkit-transition:all 1.3s; /* Safari and Chrome */
-o-transition:all 1.3s; /* Opera */

transition-delay: 1s;
-moz-transition-delay: 1s; /* Firefox 4 */
-webkit-transition-delay: 1s; /* Safari 和 Chrome */
-o-transition-delay: 1s; /* Opera */
  
}

.banngo:hover > .description{
	display:;padding:4px 0px;
	max-height:300px;
}

.description hr{
	width:95%
}

</style>	
<form action="poprice.php" method="GET">
<input list="kehulist" class="inputlist" name="campany" style="width:150px" value="" placeholder="客户名" /><input type="text" name="banngo" style="width:200px" value="" placeholder="新番号"><input type="text" name="price" value="" placeholder="进价"><input type="text" name="sellprice" value="" placeholder="卖价"><input type="text" name="reel" value="" placeholder="pcs/reel"><input type="submit" value="添加">
</form>
<datalist id="kehulist">
<?php
echo file_get_contents("ajax/write_data/campany.html");
?>	
</datalist>
<hr>
<form action="poprice.php" method="GET">
<input type="text" name="search" list="kehulist" style="width:200px" value="<?php echo $search ?>" placeholder="搜索番号"><input type="submit" value="搜索">
</form>
<table cellpadding="2" cellspacing="0" align="center">
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
	<td align="center" class="banngo"><?php echo $row[1] ?><div class="description"><?php echo $row[1] ?><hr>
	<input type="text" value="<?php echo $row[7]; ?>" id="description<?php echo $row[0] ?>" onchange="description(<?php echo $row[0] ?>,1)" placeholder="点击输入备注"/><br>
	mcd:<input type="text" value="<?php echo $row[8]; ?>" id="mcd<?php echo $row[0] ?>" style="width:50px" onchange="description(<?php echo $row[0] ?>,2)" placeholder="mcd"/>
	X:<input type="text" value="<?php echo $row[9]; ?>" id="color_x<?php echo $row[0] ?>" style="width:50px" onchange="description(<?php echo $row[0] ?>,3)" placeholder="x"/>
	Y:<input type="text" value="<?php echo $row[10]; ?>" id="color_y<?php echo $row[0] ?>" style="width:50px" onchange="description(<?php echo $row[0] ?>,4)" placeholder="y"/>
	</div></td>
	<td><input type="text" id="price<?php echo $row[0] ?>" value="<?php echo $row[2] ?>"></td>
	<td><input type="text" id="sellprice<?php echo $row[0] ?>" value="<?php echo $row[5] ?>"></td>
	<td><input type="text" id="reel<?php echo $row[0] ?>" value="<?php echo $row[3] ?>"></td>
	<td><input type="text" id="other<?php echo $row[0] ?>" value="<?php echo $row[6] ?>"></td>
	<td><button id="button<?php echo $row[0] ?>" onclick="po_price(<?php echo $row[0] ?>)">确认编辑</button></td>
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
<br><br><br>
<script>
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
</script>

<?php
}

}
else{
	echo "朝日科技(上海)有限公司-送货单系统<br><a href='a.php'>请登录</a>";
}
$conn->close();
?>