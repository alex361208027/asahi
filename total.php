<?php

echo file_get_contents("templates/header.html");

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');


?>
<datalist id="kehulist">
<?php
echo file_get_contents("ajax/write_data/campany.html");
?>	
</datalist>
<hr>
<input type="text" list="kehulist" id="kehu" placeholder="客户名" value="" onchange="cleardd()">
<input type="text" id="pinfan" placeholder="品番" value="" onchange="cleardd()">
<select id="year">
<?php
$year=date('Y');
while($year>=2016){
?>
<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
<?php 
$year=$year-1;
} ?>
</select>年
<select id="month">
<option value="m">(每月)</option>
<option value="01">1</option>
<option value="02">2</option>
<option value="03">3</option>
<option value="04">4</option>
<option value="05">5</option>
<option value="06">6</option>
<option value="07">7</option>
<option value="08">8</option>
<option value="09">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="0">(全年)</option>
</select>月
<input type="submit" onclick="total()" value="统计"/><font color="#DFDBDC">根据客户订单(希望交期)进行统计</font>
<div id="dd">

</div>
<script>
function total(str){
			
			str="campany="+document.getElementById('kehu').value+"&banngo="+document.getElementById('pinfan').value+"&year="+document.getElementById('year').value+"&month="+document.getElementById('month').value;
		
			
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
					document.getElementById("dd").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("GET","./ajax/total.php?"+str,true);
			xmlhttp.send();
}


function detail(num){
	num++;

	str="campany="+document.getElementById('kehu').value+"&banngo="+document.getElementById('pinfan').value+"&num="+num+"&year="+document.getElementById('year').value;
	
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
					alert(xmlhttp.responseText);
				}
			  }
			xmlhttp.open("GET","./ajax/total2.php?"+str,true);
			xmlhttp.send();
	
}

function cleardd(){
	document.getElementById('dd').innerHTML="";
}
</script>
<?php
 $conn->close();
?>