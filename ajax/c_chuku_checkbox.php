<?php
date_default_timezone_set('PRC');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$chukudate=$_GET['chukudate'];
$_id = $_GET['_id'];
$checkbox=$_GET['checkbox'];
$expressnum = $_GET['expressnum'];
$t1=$_GET['t1'];$t2=$_GET['t2'];$t4=$_GET['t4'];



if($expressnum){
setCookie("expressnum",$expressnum,time()+3600);
$_COOKIE['expressnum']=$expressnum;
}
if($chukudate){
setCookie("rukudate",$chukudate,time()+3600);
$_COOKIE['rukudate']=$chukudate;
}

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);
$iii=0;
$jjj=0;
$quantityplus=0;

        foreach($checkbox as $checkboxnum=>$checkboxid){
		  $sql =  "SELECT * FROM `t_inout` WHERE _id = '$checkboxid' limit 1";
		  $result = mysqli_query($conn,$sql);
		  $row=$result->fetch_row();
		  $getquantity[$jjj]=$row[2];$jjj=$jjj+1;
		  $quantityplus=$quantityplus+$row[2];
		}

if($t4==$quantityplus){
	//echo "操作记录：<br>";
	foreach($checkbox as $checkboxnum=>$checkboxid){
			$campany=$t1.$t2;
		  mysqli_query($conn,"UPDATE `t_inout` SET outquantity='$getquantity[$iii]', outtime='$chukudate', campany='$campany', expressnum='$expressnum' WHERE _id = '$checkboxid' limit 1");
			$iii=$iii+1;
		}
	mysqli_query($conn,"UPDATE `t_teacher` SET state='完成', SHdate='$chukudate' WHERE _id = '$_id' limit 1");	
	?>
	<div align="center" style="padding-top:15px;" onclick="javascript:window.opener=null;window.open('','_self');window.close();">
<img src="img/dagou.png"/><br>
<?php echo $t2." &nbsp; ".$t3." &nbsp; ".$t4." &nbsp; "."出货完成<br>"; ?>
</div>
	
	<?php
}else{
	echo "";
}


//////////////news
$newstime=date('Y-m-d H:i:s');
$something="执行了一次出库(单次)。";
mysqli_query($conn,"INSERT INTO `t_news`(`datetime`, `people`, `something`) VALUES ('$newstime','{$_COOKIE['loged']}','$something')");
//////////////news//////

 $conn->close();
 ?>