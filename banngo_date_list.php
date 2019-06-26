<?php

echo file_get_contents("templates/header.html");

date_default_timezone_set('PRC');



$campany=$_POST["campany"];
$today=$_POST["startdate"];
if(!$today){
$today=date('Y-m-d');
}

$weeks=$_POST["weeks"];
if(!$weeks){
$weeks=18;
}

if($campany){

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$get_date=date('Y-m-d',strtotime("-7 days",strtotime($today)));
$result_get_banngo=mysqli_query($conn,"SELECT banngo,sum(quantity) FROM t_teacher WHERE campany='$campany' AND SHdate > '$get_date' group by banngo");
while($row_get_banngo=$result_get_banngo->fetch_row()){
	$banngo[]=$row_get_banngo[0];
	$banngo_quantity_sum[]=$row_get_banngo[1];
}

}
?>
<script>

</script>
<style>
hide{
	display:none;
}


</style>
<datalist id="kehulist">
<?php
$campany_list=explode(",",file_get_contents("ajax/write_data/campany.html"));
foreach($campany_list as $campany_list){
	echo "<option value='".$campany_list."'>";
}
?>	
</datalist>
<form action="banngo_date_list.php" method="post">
<input type="text" name="campany" list="kehulist" style="width:150px" value="<?php echo $campany ?>" placeholder="客户名">
起始日期<input type="date" name="startdate" value="<? echo $today; ?>">
周数<input type="number" name="weeks" style="width:50px" value="<? echo $weeks; ?>"> 
<input type="submit" value="ok"><? if($campany){ ?><button type="button" onclick="this.innerHTML='正在导出...';exceldownload('Customer');setTimeout(()=>{this.innerHTML='导出EXCEL'},2000)">导出Excel</button><? } ?>
</form>
<?

if($campany){
?>
<div style="height:auto;width:100%;overflow-x:scroll;" id="myDiv">
<table width="auto" cellpadding="0" cellspacing="0" >
<? 					
					$dd=0;
					 	while($dd<7){
						if(date('w',strtotime($today))==6){
							if($dd==0){
							$today=date('Y-m-d',(strtotime('-7 days',strtotime($today)))); 
							}
							break;
						}else{
							$today=date('Y-m-d',(strtotime('-1 days',strtotime($today)))); 
							$dd++;
						}
						}
						
						echo "<tr style='height:30px'>";
						echo "<td></td>";
						$dd=0;
						while($dd<$weeks){
						echo "<td align='right' style='min-width:100px;background:black;color:white;font-size:14px;'>";
						echo "[+".$dd."周]";
						echo "</td>";
						$dd++;
						}
						echo "</tr>";
						
						echo "<tr style='height:30px'>";					
						echo "<td></td>";
						$dd=0;
						while($dd<$weeks){
						echo "<td align='right' style='min-width:100px;background:black;color:white;'>";
						$today=date('Y-m-d',(strtotime('+1 days',strtotime($today))));
						$sunday[]=$today;
						echo date("m/d",strtotime("+3 days",strtotime($today)))."";
						//echo "~";
						$today=date('Y-m-d',(strtotime('+6 days',strtotime($today))));
						$saturday[]=$today;
						//echo date("m/d",strtotime($today))."】";
						echo "</td>";
						$dd++;
						}
						echo "</tr>";

				for($i=0;$i<count($banngo);$i++){

						echo "<tr align='right'>";
						echo "<td align='right' style='min-width:80px;padding-right:10px;'>".$banngo[$i]."</td>";
						$dd=0;
						$quantity_total=0;unset($quantity_total_array);
						while($dd<$weeks){
						echo "<td>";
						$row_sum=mysqli_query($conn,"SELECT sum(quantity) FROM t_teacher WHERE banngo='$banngo[$i]' AND campany='$campany' AND SHdate >= '$sunday[$dd]' AND SHdate <= '$saturday[$dd]'")->fetch_row();
						echo $row_sum[0];
						$quantity_total=$quantity_total+$row_sum[0];
						$quantity_total_array[]=$quantity_total;
						echo "</td>";
						$dd++;
						}					
						echo "</tr>";
						
						echo "<tr align='right'>";
						echo "<td></td>";//echo "<td>(".$banngo_quantity_sum[$i].")</td>";
						$dd=0;
						while($dd<$weeks){
						echo "<td style='color:#BBBBBB;border-bottom:solid 1px black;font-size:12px;'>";		
						echo $quantity_total_array[$dd];
						echo "</td>";
						$dd++;
						}					
						echo "</tr>";
						
				}	
						

?>
<tr><td></td><td colspan="<? echo $weeks ?>">*数据不包含[交期待定]项</td></tr>
</table>
</div>
<?php
}
 $conn->close();
?>