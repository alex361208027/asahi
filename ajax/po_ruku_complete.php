<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
date_default_timezone_set('PRC');
$today=date('Y-m-d');


$t3=$_GET['t3'];//quantity
$t6=$_GET['t6'];//campany
$t7=$_GET['t7'];//campanyorder

$asahipo=$_GET['asahipo'];
$_id=$_GET['_id'];
$customer_id=$_GET['customer_id'];

$checkbox=$_GET['checkbox'];

$lotnum=$_GET['lotnum'];
$banngo=$_GET['banngo'];
$quantity=$_GET['quantity'];
$intime=$_GET['intime'];
$campany=$t6.$t7;

$lotnum2=$_GET['lotnum2'];
//$banngo2=$_GET['banngo2'];
$quantity2=$_GET['quantity2'];

$quantitytotle+=$quantity;

for($i=0;$i<9;$i++){
	if($quantity2[$i]){
	$quantitytotle+=$quantity2[$i];
	}else{
		break;
	}
}

if($intime){
setCookie("rukudate",$intime,time()+3600);
$_COOKIE['rukudate']=$intime;
}

if($lotnum){

	if($t3==$quantitytotle){

		$conn = new mysqli($servername, $username, $password, $dbname);
		mysqli_set_charset ($conn,utf8);

		if($lotnum&&$banngo&&$quantity&&$intime){
			
			if($checkbox){
				$rows2=0;
			}else{
				$sql2="SELECT * FROM `t_inout` WHERE lotnum='$lotnum' limit 1";
				$result2=mysqli_query($conn,$sql2);
				$rows2=$result2->num_rows;
			}
			
			if($rows2 > 0){
				//echo "*".$lotnum."已经存在*";
				echo "404";
			}else{
				if($checkbox){
					mysqli_query($conn,"INSERT INTO `t_inout`(`lotnum`, `banngo`, `quantity`, `intime`, `campany`, `asahipo` ) VALUES ('$lotnum','$banngo','$quantity','$intime','$campany','$asahipo')");
					echo $lotnum."叠加录入成功\r";	
					
				}else{
					mysqli_query($conn,"INSERT INTO `t_inout`(`lotnum`, `banngo`, `quantity`, `intime`, `campany`, `asahipo` ) VALUES ('$lotnum','$banngo','$quantity','$intime','$campany','$asahipo')");
					echo $lotnum."录入成功\r";	
				}
				for($i=0;$i<9;$i++){
						if($lotnum2[$i]&&$quantity2[$i]){
							mysqli_query($conn,"INSERT INTO `t_inout`(`lotnum`, `banngo`, `quantity`, `intime`, `campany`, `asahipo` ) VALUES ('$lotnum2[$i]','$banngo','$quantity2[$i]','$intime','$campany','$asahipo')");
							echo $lotnum2[$i]."录入成功\r";
						}else{
							break;
						}
					}
				
			mysqli_query($conn,"UPDATE `t_poteacher` SET state='已入库' WHERE _id='$_id' limit 1");
			mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder2='已入库' WHERE _id='$customer_id' AND po_id='$_id' limit 1");
			
			
				
			$conn->close();	
			}
		}
		
		
	}else{
		
		echo 0;
	}
}else{
	echo 0;
}

?>

