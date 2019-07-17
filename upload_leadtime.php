<html>
<head>
<meta charset="utf-8">
<title>Leadtime</title>
<script type="text/javascript" src="JS/jquery-3.2.1.min.js"></script>
</head>
<style>
.pp{
	display:none;
}
</style>
<script>
$(function(){
	var delay_time=100;
	$(".pp").each(function(){
		
		$(this).delay(delay_time).fadeIn(1000);
		delay_time=delay_time+100;
	});
});
</script>
<body>



<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

date_default_timezone_set('PRC');



$checkbox=$_GET['checkbox'];
if($checkbox){
	?>
<form action="upload_leadtime.php" method="post" enctype="multipart/form-data">
(STEP 1) 上传表格：
	<input type="file" name="file" id="file">
<a href="upload/moban/leadtime.xlsx">模板下载</a><br>
<br>	

(STEP 2) 以下入库项确认后即可<input type="submit" name="submit" value="提交" onclick="this.style.display='none'">
	<table>
<?
foreach($checkbox as $_id){
	$result=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id='$_id' limit 1");
	while($row=$result->fetch_row()){
	?>
	<tr>
		<td><input type="checkbox" name="popo[]" value="<? echo $row[9]; ?>" checked></td>
		<td><? echo $row[0]; ?></td>
		<td><? echo "@".$row[1]; ?></td>
		<td><? echo "×".$row[2]; ?></td>
	</tr>
	<?
	}		
}
	?>	
	</table>


</form>
<?
}

if($_FILES["file"]){
	
$popo=$_POST['popo'];
if($popo){
	echo "PO读取成功...<br>";
foreach($popo as $popo){
	$result=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id='$popo' limit 1");
	$row=$result->fetch_row();
		if($row[8]==""){
		$p_po[]=$row[0];
		$p_banngo[]=$row[1];
		$p_quantity[]=$row[2];
		$p_quantity_check[]=$row[2];
		$p_jpdate[]=$row[3];
		$p_hopedate[]=$row[4];
		$p_id[]=$row[9];

		}

}

}	
	
	
	
// 允许上传的图片后缀
$allowedExts = array("xls","xlsx", "xlsm");
$temp = explode(".", $_FILES["file"]["name"]);
//echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名
if (
($_FILES["file"]["size"] < 2048000)   // 小于 2000 kb
&& in_array($extension, $allowedExts)){
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        //echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
       // echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
       // echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
       // echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
        
        // 判断当期目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("upload/" . $_FILES["file"]["name"]))
        {
           // echo $_FILES["file"]["name"] . " 文件已经存在。 ";
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/leadtime.xlsx");
          //  echo "文件存储在: " . "upload/" . $_FILES["file"]["name"];
        }
    }
}else{
    echo "未上传文件/非法的文件格式";
}




echo "文件读取成功...<br>";

require_once("./libs/PHPExcel-1.8/Classes/PHPExcel.php");
require_once("./libs/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");
require_once("./libs/PHPExcel-1.8/Classes/PHPExcel/Reader/Excel5.php");



$objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2007 for 2007 format 
//$objPHPExcel = $objReader->load("./upload/".$_FILES['file']['name']); //$filename可以是上传的文件，或者是指定的文件
$objPHPExcel = $objReader->load("upload/leadtime.xlsx"); //test
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); // 取得总行数 
$highestColumn = $sheet->getHighestColumn(); // 取得总列数

PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH;
 
//循环读取excel文件,读取一条,插入一条
for($rows=2;$rows<=$highestRow;$rows++){
$Ea[] = $objPHPExcel->getActiveSheet()->getCell("A".$rows)->getValue();//po
$Eb[] = $objPHPExcel->getActiveSheet()->getCell("B".$rows)->getValue();//banngo
$Ec[] = $objPHPExcel->getActiveSheet()->getCell("C".$rows)->getValue();//quantity
$Ec_check[]=$objPHPExcel->getActiveSheet()->getCell("C".$rows)->getValue();
$Ed[] = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP( $objPHPExcel->getActiveSheet()->getCell("D".$rows)->getValue() ) );//date

$Ecount[]=$Ea[($rows-2)].$Eb[($rows-2)].$Ec[($rows-2)];
//$Ee[] = $objPHPExcel->getActiveSheet()->getCell("E".$rows)->getValue();


}

require_once("./libs/myfunction.php");




foreach(array_count_values($Ecount) as $key => $num){
	if($num>1){
		$Ecount2[]=$key;
	}
}



//////////////march_test/
for($ma=0;$ma<count($p_po);$ma++){
	for($mb=0;$mb<count($Ea);$mb++){
		if($p_po[$ma]==$Ea[$mb] && $p_banngo[$ma]==$Eb[$mb] && $p_quantity[$ma]==$Ec[$mb]&&$Ec_check[$mb]!=0 && in_array($Ecount[$mb],$Ecount2)==false){
			
		mysqli_query($conn,"UPDATE `t_poteacher` SET JPdate='$Ed[$mb]' WHERE _id = '$p_id[$ma]' limit 1");
	
		$pick_SHdate5=SHdate5($Ed[$mb],$p_hopedate[$ma]);
		mysqli_query($conn,"UPDATE `t_teacher` SET JPdate='$Ed[$mb]', SHdate=IF(SHdate,IF(JPdate>=SHdate,'$pick_SHdate5[0]',SHdate),'$pick_SHdate5[1]') WHERE po_id='$p_id[$ma]' limit 1");
						
			echo "<div class='pp'>[id".$p_id[$ma]."] / ".$p_po[$ma]." / ".$p_banngo[$ma]." / ".$p_quantity[$ma]." / <s>".$p_jpdate[$ma]."</s> --> ".$Ed[$mb]."[row".$mb."]</div>";
			//echo "<br>";
			$Ec_check[$mb]=0;$mc=0;
			break;
		}else{
			$mc=1;
		}
	}
	if($mc){
		echo "<div class='pp'>[id".$p_id[$ma]."] / ".$p_po[$ma]." / ".$p_banngo[$ma]." / ".$p_quantity[$ma]." / ".$p_jpdate[$ma]." --> 请手动输入</div>";
					//echo "<br>";
	}
}




//////////////march_test/




unlink("./upload/leadtime.xlsx");
}



$conn->close();
?>

</body>
</html>