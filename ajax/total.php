<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
date_default_timezone_set('PRC');

$campany=$_GET['campany'];$banngo=$_GET['banngo'];
$year=$_GET['year'];$month=$_GET['month'];
if($month==0){
	$date=$year."-";
}elseif($month=='m'){
		$date=$year."-";	
}else{
	$date=$year."-".$month;
}




if($campany&&!$banngo){
	$sql="SELECT campany,banngo,hopedate,SUM(quantity) FROM `t_teacher` WHERE campany='$campany' AND hopedate like '$date%' GROUP BY banngo";
	if($month=='m'){
	$zongshu="该时段总数";
	}
	$where=" campany = '$campany' AND ";
}elseif(!$campany&&$banngo){
	$sql="SELECT campany,banngo,hopedate,SUM(quantity) FROM `t_teacher` WHERE banngo='$banngo' AND hopedate like '$date%'";
	$where=" banngo = '$banngo' AND ";
}elseif($campany&&$banngo){
	$sql="SELECT campany,banngo,hopedate,SUM(quantity) FROM `t_teacher` WHERE campany='$campany' AND banngo='$banngo' AND hopedate like '$date%'";
	$where="campany='$campany' AND banngo='$banngo' AND";
}else{
	$sql="SELECT campany,banngo,hopedate,SUM(quantity) FROM `t_teacher` WHERE hopedate like '$date%'";
	$zongshu="该时段总数";
	$where="";
}

if($month=='m'){
	$sql="SELECT campany,banngo,hopedate,SUM(quantity),SUBSTR(hopedate,1,7) as mdate FROM `t_teacher` WHERE $where hopedate like '$date%' GROUP BY mdate";
}

$result=mysqli_query($conn,$sql);

while($row=$result->fetch_row()){
	if($zongshu){
		if($month!='m'){
		echo $row[4]." ";
		echo $zongshu." ==> ";
		echo $row[3]."<br>";
		}
		$aa[]=$row[4];
		//$bb[]=$zongshu;
		$cc[]=$row[3];
	}else{
		if($month!='m'){
		echo $row[4]." ";
		echo $row[1]." ==> ";
		echo $row[3]."<br>";
		}
		$aa[]=$row[4];
		//$bb[]=$row[1];
		$cc[]=$row[3];
	}
}





$count=count($aa);
$max=max($cc);
$color[]="#222222";$color[]="#333333";$color[]="#555555";$color[]="#444444";$color[]="#666666";$color[]="#777777";$color[]="#888888";

if($month=='m'){
?>
<style>
						
							#vert{  
											width:1040px;  
											height: 400px;  
											border-left: 2px solid skyblue; 
											border-bottom: 2px solid skyblue; 
											background-color:;  
											position: relative;  
											margin:10px;
										}  
							#vert ul li{  
											float: left;  
											position: absolute;  
											bottom: 0px;  
											background-color:salmon;  
											text-align: center;  
											font-weight:;  
											color: black;  
											height: 100px;  
											width:30px;  
											list-style: none;  
											cursor:pointer
										} 
							
							
							<?php $ii=0; for($i=0;$i<12;$i++){
							if(substr($aa[$ii],6,6)==($i+1)||substr($aa[$ii],5,6)==($i+1)){
								echo "#vert ul li.c".$i."{left: ".(40+$i*80)."px; height:".($cc[$ii]/($max/300))."px;background-color:".$color[Rand(0,6)].";-webkit-animation:myfirst 1s;}";
								$ii++;
							}else{
								echo "#vert ul li.c".$i."{left: ".(40+$i*80)."px; height:0px;background-color:;-webkit-animation:myfirst 1s;}";
								
							}
							
							}?>
							@-webkit-keyframes myfirst{
								0% {height:0px;}
								
								}
							
							.yuefen{
								width:80px;display:inline-block;font-size:10px;background-color:;
							}
							.shuzi{
								margin:-20px 0 0 -5px;font-size:8px;
							}						
</style>
<div id="vert">
 
								<ul>  
								<?php $i=0;while($i<12){  ?>
									<li class="c<?php echo $i; ?>" onmousedown="detail(<?php echo $i; ?>)"><div class="shuzi">
									<?php 
									if(($i+1)<10){
										$search_i="0".($i+1);
									}else{
										$search_i=($i+1);
									}
									$search_i=$year."-".$search_i;
									if(in_array($search_i,$aa)){
										echo $cc[array_search($search_i,$aa)];
									}else{
										echo "";
									}
									?>
									</div></li>  
								<?php $i++;} ?>	
								</ul>  							
								
</div> 
<br>
<div style="width:50px;display:inline-block"><?php echo $year; ?></div>
<?php 
$monthE[]="January";$monthE[]="February";$monthE[]="March";$monthE[]="April";$monthE[]="May";$monthE[]="June";$monthE[]="July";$monthE[]="August";$monthE[]="September";$monthE[]="October";$monthE[]="November";$monthE[]="December";

for($i=0;$i<12;$i++){
							
									//if(($i+1)<10){
									//	$search_i="0".($i+1);
									//}else{
									//	$search_i=($i+1);
									//}
									//$search_i=$year."-".$search_i;
									//if(in_array($search_i,$aa)){
										?><!--<div class="yuefen"><?php //echo $cc[array_search($search_i,$aa)]."<br>".$aa[array_search($search_i,$aa)]; ?></div><?php
									//}else{
									//	?><div class="yuefen"><?php //echo ($i+1)."月Null"; ?></div>--><?php
									//}
									
									?><div class="yuefen"><?php echo ($i+1)."月<br>".$monthE[$i]; ?></div><?php
									
							
} ?>					

<?php 
}

$conn->close();
?>