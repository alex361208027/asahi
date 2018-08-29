<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$checkbox=$_GET['checkbox'];
$chukudate=$_GET['chukudate'];
$expressnum=$_GET['expressnum'];
foreach($checkbox as $checkboxid => $_id){
	unset($zaiku_quantity);
	unset($zaiku_id);
	$row=mysqli_query($conn,"SELECT quantity,banngo,asahiorder,campany,ordernum FROM `t_teacher` WHERE _id='$_id'")->fetch_row();
	$resultzaiku=mysqli_query($conn,"SELECT quantity,_id FROM `t_inout` WHERE (outquantity is null OR outquantity = 0 OR quantity-outquantity>0) AND banngo='$row[1]' AND asahipo='$row[2]' order by quantity desc");
	while($rowzaiku=$resultzaiku->fetch_row()){
		$zaiku_quantity[]=$rowzaiku[0];
		$zaiku_id[]=$rowzaiku[1];
	}
	
	if($zaiku_id[0]){
		$zaiku_return_id=findtotal($row[0],$zaiku_quantity,$zaiku_id);
		if(count($zaiku_return_id)>0){
			foreach($zaiku_return_id as $f_num => $f_id){
			  $campany=$row[3].'<br>'.$row[4];
			  mysqli_query($conn,"UPDATE `t_inout` SET outquantity=quantity, outtime='$chukudate', campany='$campany', expressnum='$expressnum' WHERE _id = '$f_id'");	
			echo "+在库id：".$f_id;
			}
			mysqli_query($conn,"UPDATE `t_teacher` SET state='完成', SHdate='$chukudate' WHERE _id = '$_id'");	
			echo "-->订单id：".$_id."出库成功";
		}else{
			echo "其中一个错误 请尝试手动出库 error-1";
		}
		
	}else{
		echo "其中一个错误 请尝试手动出库 error-2";
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
	unset($ok);
	if(count($marki)>0){
		foreach($marki as $a => $b){
			$ok[]=$id[$b];
		}
		return $ok;
	}
}

 $conn->close();
 
?>