<?php

echo file_get_contents("templates/header.html");
date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$sql="SELECT campany FROM `t_campany` WHERE 1";
$result=mysqli_query($conn,$sql);
while($row=$result->fetch_row()){
	$campany[]=$row[0];
}
$ok=$_GET['ok'];$total=$_GET['total'];$campanynum=$_GET['campanynum'];
$year=$_GET['year'];$month=$_GET['month'];$qian=$_GET['qian'];$hou=$_GET['hou'];
if(!$year){
	$year=date('Y');
}
if(!$month){
	$month=date('m');
}
$banngo=$_GET['banngo'];
if($banngo){
	$banngook=1;
	if($campanynum){
	$banngocampany=$campany[$campanynum[0]];
	$select_banngocampany="campany = '$banngocampany' AND";
	}
}else{
	$banngook="";
}
?>

<html>
<head>
   <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
   <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<style>
#campanybanngo{
	background:#EEEEEE;
	padding:4px;
}
</style>
<script>
$(document).ready(function(){
	
	
	
	$(".campanybanngo").click(function(){
		$("input[type='checkbox']").attr("checked",false);			
		//$(this).prev().attr('checked',"checked");


	});
	
	//$("input[type='checkbox']").click(function(){
	//	document.getElementById("campanybanngo").innerHTML="...";
	//});
	
	
});


function year(shit){
	banngo=document.getElementsByName("banngo[]");
	shit.href="total_highcharts.php?year="+document.getElementById('year').value+"&month="+document.getElementById('month').value+"&qian="+document.getElementById('qian').value+"&hou="+document.getElementById('hou').value+"&ok=1";
	if(banngo.length>0){
		for(i=0;i<banngo.length;i++){
			if(banngo[i].checked){				
				shit.href+="&banngo[]="+banngo[i].value;
			}
		}
	
	}
		if(document.getElementById('total').checked){
				shit.href+="&total="+document.getElementById('total').value;
			}
			
		campanynum=document.getElementsByName('campanynum');
		for(i=0;i<campanynum.length;i++){
			if(campanynum[i].checked){
				shit.href+="&campanynum[]="+campanynum[i].value;
			}
		}
	
	shit.href=shit.href.replace("+","%2B");
	//alert(shit.href);
}



function campanybanngo(str){
			document.getElementById("campanybanngo").innerHTML="正在加载...";
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

					
					document.getElementById('campanybanngo').innerHTML=xmlhttp.responseText;
					
				}
			  }
			xmlhttp.open("GET","./ajax/total_campanybanngo.php?campany="+str,true);
			xmlhttp.send();

}

function checkcampany(str){
	//alert()
	for(i=0;i<document.getElementsByName('campanynum').length;i++){
		if(document.getElementsByName('campanynum')[i].getAttribute("value2")==str){
			document.getElementsByName('campanynum')[i].checked=true;
		}
	}
}

</script>
<style>
input[type='number']{
	width:40px;background:none;border:1px solid black;padding:3px 0px
}
</style>
<body>
年度<input type="number" value="<?php echo $year; ?>" id="year" style="width:50px"/>
月份<input type="number" value="<?php echo $month; ?>" id="month"/> <a href="" onclick="year(this)"><button>【检索】</button></a>
（包含前<input type="number" value="<?php if($qian){echo $qian;}else{echo 9;} ?>" id="qian" />个月，
后<input type="number" value="<?php if($hou){echo $hou;}else{echo 2;} ?>" id="hou" />个月的数据）<br>
&nbsp;<label><input type="checkbox" <?php if(!$ok){echo "checked";}elseif($total){echo "checked";} ?> id="total" value="1" />【月总数】</label>

<?php

$checkboxnum=0;
foreach($campany as $checkboxcampany){ ?>
	
&nbsp;<input type="checkbox" <?php if(in_array($checkboxnum,$campanynum)){ echo "checked";} ?> name="campanynum" value="<?php echo $checkboxnum; ?>" value2="<?php echo $checkboxcampany; ?>"/><a class="campanybanngo" href="#" onclick="campanybanngo('<?php echo $checkboxcampany; ?>');"><?php echo $checkboxcampany; ?></a>
	
<?php
$checkboxnum++;
} ?>
<div id="campanybanngo"><?php 
if($banngook){
	echo $banngocampany.":";
	foreach($banngo as $banngos){
		echo $banngos.";";
	}
	
}else{
	echo "...";
}
?></div>

<?php if($ok){ 
for($i=-$qian;$i<($hou+1);$i++){
$date[]=date('Y-m',(strtotime($i.' months',strtotime($year."-".$month))));
}
?>
<div id="container" style="width:auto;height:auto;min-width: 800px; min-height: 500px; margin:auto"></div>
<script language="JavaScript">
$(document).ready(function() {
   var title = {
       text: '月订单量'   
   };
   var subtitle = {
        text: '日期统计来源订单的希望交期'
   };
   var xAxis = {
       categories: [
	   '<?php echo $date[0]; ?>'<?php
	   for($i=1;$i<(count($date));$i++){
		   echo ",'".$date[$i]."'";
	   }
	   ?>
	   ]
   };
   var yAxis = {
      title: {
         text: 'pcs'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   

   var tooltip = {
      valueSuffix: 'pcs'
   }

   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };

   var series =  [
      <?php	
	  if($banngook){
		for($c=0;$c<(count($banngo));$c++){
			  $quantitytotal=0;
			  echo "{data:[";
			  for($d=0;$d<(count($date));$d++){
					  if($d!=0){ echo ","; }
					  $sql="SELECT SUM(quantity) FROM `t_teacher` WHERE $select_banngocampany banngo = '$banngo[$c]' AND hopedate like '$date[$d]%' GROUP BY banngo";
					  $result=mysqli_query($conn,$sql);
					  $row=$result->fetch_row();
					  if($row[0]==0){ echo 0; }else{ echo $row[0]; }
					  $quantitytotal=$quantitytotal+$row[0];
			  }
			  echo "],name:'".$banngo[$c]." (合计".$quantitytotal.")'},";
		  }
	  }else{
		  if($total){
			  $quantitytotal=0;
			  echo "{data:[";
			  for($d=0;$d<(count($date));$d++){
					  if($d!=0){ echo ","; }
					  $sql="SELECT SUM(quantity) FROM `t_teacher` WHERE hopedate like '$date[$d]%'";
					  $result=mysqli_query($conn,$sql);
					  $row=$result->fetch_row();
					  if($row[0]==0){ echo 0; }else{ echo $row[0]; }
					  $quantitytotal=$quantitytotal+$row[0];
			  }
			  echo "],name:'各月总数 (合计".$quantitytotal.")'},";
		  }
		  
		  
		  for($c=0;$c<(count($campany));$c++){
			  $quantitytotal=0;
			  if(in_array($c,$campanynum)){
			  echo "{data:[";
			  for($d=0;$d<(count($date));$d++){
					  if($d!=0){ echo ","; }
					  $sql="SELECT SUM(quantity) FROM `t_teacher` WHERE campany = '$campany[$c]' AND hopedate like '$date[$d]%' GROUP BY campany";
					  $result=mysqli_query($conn,$sql);
					  $row=$result->fetch_row();
					  if($row[0]==0){ echo 0; }else{ echo $row[0]; }
					  $quantitytotal=$quantitytotal+$row[0];
			  }
			  echo "],name:'".$campany[$c]." (合计".$quantitytotal.")'},";
			  }
		  }
	  } 
	  ?>
	  
   ];

   var json = {};

   json.title = title;
   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;

   $('#container').highcharts(json);
});
</script>
<?php } ?>
</body>
</html>