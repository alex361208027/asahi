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

?>

<html>
<head>
   <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
   <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<script>
function year(shit){
	shit.href="total_highcharts.php?year="+document.getElementById('year').value+"&month="+document.getElementById('month').value+"&qian="+document.getElementById('qian').value+"&hou="+document.getElementById('hou').value+"&ok=1";
	if(document.getElementById('total').checked){
			shit.href+="&total="+document.getElementById('total').value;
		}
		
	campanynum=document.getElementsByName('campanynum');
	for(i=0;i<campanynum.length;i++){
		if(campanynum[i].checked){
			shit.href+="&campanynum[]="+campanynum[i].value;
		}
	}
	//alert(shit.href);
	//shit.href="##";
}
</script>
<style>
input{
	width:70px;background:none;border:1px solid black;
}
</style>
<body>
年度<input type="text" value="<?php echo $year; ?>" id="year"/>
月份<input type="text" value="<?php echo $month; ?>" id="month"/> <a href="" onclick="year(this)"><button>Go</button></a>
（包含前<input type="text" value="<?php if($qian){echo $qian;}else{echo 9;} ?>" id="qian" style="width:40px" />个月，
后<input type="text" value="<?php if($hou){echo $hou;}else{echo 2;} ?>" id="hou" style="width:40px"/>个月的数据）<br>
&nbsp;<label><input type="checkbox" <?php if(!$ok){echo "checked";}elseif($total){echo "checked";} ?> id="total" value="1" />【月总数】</label>

<?php

$checkboxnum=0;
foreach($campany as $checkboxcampany){ ?>
	
&nbsp;<label><input type="checkbox" <?php if(in_array($checkboxnum,$campanynum)){ echo "checked";} ?> name="campanynum" value="<?php echo $checkboxnum; ?>" /><?php echo $checkboxcampany; ?></label>
	
<?php
$checkboxnum++;
} ?>


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