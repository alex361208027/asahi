<style>
.po_list{
	display:inline-block;padding:5px;background:#EEEEFF;margin:2px;font-size:16px;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
}
.lot_list{
	display:inline-block;padding:5px;cursor:pointer;font-size:16px;
	background-color:#FFFFCC;margin:2px;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
}
.no_way{
	display:inline-block;padding:5px;color:white;font-size:16px;
	background:black;margin:2px;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
}

.quantity{
	font-size:12px;color:#777777;
}
</style>
<script type="text/javascript" src="../JS/jquery-3.2.1.min.js"></script>
<script>
$(function(){
	$(".lot_list").click(function(){
		if($(this).css("background-color")=="rgb(255, 255, 204)"){
			$(this).css("background-color","#EEEEFF");
		}else{
			$(this).css("background","");
		}
	});
});

</script>


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
			echo "*<div class='po_list'>【".$row[4]."】<b>".$row[1]."</b><font class='quantity'>(".$row[0].")</font></div> ";
			//$mm_count=1;
			foreach($zaiku_return_m as $mm){

					echo "<div class='lot_list'><b>".$zaiku_lotnum[$mm]."</b><font class='quantity'>(".$zaiku_quantity[$mm].")</font></div> ";
					$remove_inout_id[]=$zaiku_id[$mm];


			}
			
		}else{
			echo "*<div class='po_list'>【".$row[4]."】".$row[1]."<font class='quantity'>(".$row[0].")</font></div> <div class='no_way'>未找到对应批次</div>";
		}
		
	}else{
		echo "*<div class='po_list'>【".$row[4]."】".$row[1]."<font class='quantity'>(".$row[0].")</font></div> <div class='no_way'>未找到对应批次</div>";
	}
	echo "<br>";
}

function findtotal($all,$q,$id){
	Global $remove_inout_id;
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
						if(in_array($id[$i],$remove_inout_id)){
							$i++;
						}else{	
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
					}

			}else{
				$k++;
			}
		}
		
	}
		return $marki;
}

 $conn->close();
 
?>