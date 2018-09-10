<?php

date_default_timezone_set('PRC');
$today=date('Y'.Äê.'m'.ÔÂ.'d'.ÈÕ);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$end=$_GET['end'];

echo file_get_contents("templates/header.html");
?>
<script>
$(document).ready(function(){
	$("input").click(function(){
		if($(this).is(':checked')){
			$(this).parents("tr").attr("bgcolor","#EEEEEE");
		}else{
			$(this).parents("tr").attr("bgcolor","");
		}
	});
});
</script>
<div id="myDiv" align="center"> 
<table id="tableExcel" cellpadding="8" cellspacing="0" style="font-size:12px;">
<tr style="background-color:#8888FF;color:white;height:30px;">
	<td ></td>
	<td align="right">Part No</td>
	<td align="">Quantity</td>
	<td align="">PO</td>
</tr>

<?php

$checkbox=$_GET['checkbox'];
			foreach($checkbox as $checkboxid => $_id){ 
				if($end==2){
				$row=mysqli_query($conn,"SELECT * FROM `t_teacher` WHERE _id='$_id'")->fetch_row();
				$banngo[]=$row[2];
				$quantity[]=$row[3];
				$po[]=$row[1];
				}elseif($end==6){
				$row=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id='$_id'")->fetch_row();
				$banngo[]=$row[1];
				$quantity[]=$row[2];
				$po[]=$row[0];
				}
			}

			$go=0;
			while($go<111){
				if($banngo[$go]){
					$ed=1;$ii=0;
					while($ed<111){
						if($checked[$ed]){
							if($checked[$ed]==$go){
								$ed++;
								$ii++;
							}else{								
								$ed++;
							}
						}else{
							echo $checked[$ed];
							break;
						}							
					}
					
					if($ii==0){
								$el=0;$quantitytotel=0;
								while($el<111){
									if($banngo[$el]){
										if($banngo[$el]==$banngo[$go]){
											$quantitytotel+=$quantity[$el];
												$eed=1;$iii=0;
												while($eed<111){
													if($checked[$eed]){
														if($checked[$eed]==$el){
															$iii++;
															break;
														}else{
															$eed++;
														}		
													}else{
														break;
													}
												}
												if($iii==0){
												$checked[]=$el;
												}
											$el++;
											
										}else{
											$el++;
										}
									}else{
										break;
									}
								}
								/////////////////////////
								$oo=0;$pos="";$samepo="";
								while($oo<111){
									if($po[$oo]){
										if($banngo[$oo]==$banngo[$go]){
											if($samepo==$po[$oo]){
												$font1= "<font color='white'>";
												$font2= "</font>";
												}else{
													$font1="";$font2="";
													
												}
									
											$pos=$pos." | ".$font1.$po[$oo].$font2."[".$quantity[$oo]."]<br>";
											$samepo=$po[$oo];
											$oo++;
											
										}else{
											$oo++;
										}
									}else{
										break;
									}
								}
								echo "<tr><td><input type='checkbox'/></td><td align='right'>".$banngo[$go]."</td><td>".$quantitytotel."</td><td>".$pos."</td></tr>";
								///////////////////////////
					}
					
					$go++;
				}else{
					break;
				}
			}
//foreach($checked as $a => $b)	{
//	echo $b."<br>";
//}		
?>

</table></div>
<?php
$conn->close();
?>