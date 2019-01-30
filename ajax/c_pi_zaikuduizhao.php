<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$checkbox=$_GET['checkbox'];

foreach($checkbox as $checkboxid => $_id){
	unset($zaiku_quantity);
	unset($zaiku_id);
	unset($zaiku_lotnum);
	$row=mysqli_query($conn,"SELECT quantity,banngo,asahiorder,campany,ordernum FROM `t_teacher` WHERE _id='$_id' limit 1")->fetch_row();
	$resultzaiku=mysqli_query($conn,"SELECT quantity,_id,lotnum FROM `t_inout` WHERE (outquantity is null OR outquantity = 0) AND banngo='$row[1]' AND asahipo='$row[2]' AND campany like '%$row[4]%' order by quantity desc");
	while($rowzaiku=$resultzaiku->fetch_row()){
		$zaiku_quantity[]=$rowzaiku[0];
		$zaiku_id[]=$rowzaiku[1];
		$zaiku_lotnum[]=$rowzaiku[2];
	}
	
	if($zaiku_id[0]){
		$zaiku_return_m=findtotal($row[0],$zaiku_quantity,$zaiku_id);
		if(count($zaiku_return_m)>0){
			echo "【".$row[2]."】".$row[1]."×".$row[0]."=";
			$mm_count=1;
			foreach($zaiku_return_m as $mm){
				if($mm_count>1){
				echo "+";
				}
				
			echo "【Lot】".$zaiku_lotnum[$mm]."×".$zaiku_quantity[$mm];
			
			$mm_count++;
			}
			
		}else{
			echo "【".$row[2]."】".$row[1]."×".$row[0]." = ???";
		}
		
	}else{
		echo "【".$row[2]."】".$row[1]."×".$row[0]." = ???";
	}
	echo "\r";
}

function findtotal($all,$q,$id){
	
	$js=0;
	$k=0;
	$c=count($q);

	while($k<$c){
		
		if($all==$js){
			break;
		}else{
			unset($marki);
			$i=$k;
			
			if($i!=$c){
				
					while($i<$c){
						$js=$js+$q[$i];
						if($all==$js){
							$marki[]=$i;
							$k++;
							break;
						}elseif($all>$js){
							$marki[]=$i;
							$i++;
						}elseif($all<$js){
							$js=$js-$q[$i];
							$i++;
						}
					}

			}else{
				$k++;
			}
		}
		
	}
	//unset($ok);
	//if(count($marki)>0){
		//foreach($marki as $a => $b){
		//	$ok[]=$id[$b];
		//}
		return $marki;
	//}
}

 $conn->close();
 
?>