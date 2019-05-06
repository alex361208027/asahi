<html>
<head>
<meta charset="utf-8">
<title>Lotnum</title>
</head>
<body>



<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

date_default_timezone_set('PRC');
$today=$_POST['today'];
if(!$today){
$today=date('Y-m-d');
}

$checkbox=$_GET['checkbox'];
if($checkbox){

	?>
<form action="upload_lotnum.php" method="post" enctype="multipart/form-data">
   (STEP 1) 确认入库日期：<input type="date" name="today" value="<? echo $today; ?>"><br><br>
   (STEP 2) 上传表格：
	<input type="file" name="file" id="file">
<a href="upload/moban/lotnum.xlsx">模板下载</a><br>	<br>	
(STEP 3) 以下入库项确认后即可<input type="submit" name="submit" value="提交">
	<table>
<?
foreach($checkbox as $_id){
	$result=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id='$_id' limit 1");
	while($row=$result->fetch_row()){
	?>
	<tr>
		<td><input type="checkbox" name="popo[]" value="<? echo $row[9]; ?>" checked></td>
		<td><? echo $row[0]; ?></td>
		<td><? echo $row[1]; ?></td>
		<td><? echo $row[2]; ?></td>
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
foreach($popo as $popo){
	$result=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id='$popo' limit 1");
	$row=$result->fetch_row();
		if($row[8]==""){
		$p_banngo[]=$row[1];
		$p_po[]=$row[0];
		$p_quantity[]=$row[2];
		$p_campany[]=$row[5].$row[6];
		$p_id[]=$row[9];
		
		$p_quantity_check[]=$row[2];
		}

}

}
	
// 允许上传的图片后缀
$allowedExts = array("xls","xlsx", "xlsm");
$temp = explode(".", $_FILES["file"]["name"]);
echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名
if (
($_FILES["file"]["size"] < 2048000)   // 小于 2000 kb
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
        echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
        echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
        
        // 判断当期目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("upload/" . $_FILES["file"]["name"]))
        {
            echo $_FILES["file"]["name"] . " 文件已经存在。 ";
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
            echo "文件存储在: " . "upload/" . $_FILES["file"]["name"];
        }
    }
}else{
    echo "未上传文件/非法的文件格式";
}




echo "<br>work:<br>";

require_once("./libs/PHPExcel-1.8/Classes/PHPExcel.php");
require_once("./libs/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");
require_once("./libs/PHPExcel-1.8/Classes/PHPExcel/Reader/Excel5.php");



$objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2007 for 2007 format 
//$objPHPExcel = $objReader->load("./upload/".$_FILES['file']['name']); //$filename可以是上传的文件，或者是指定的文件
$objPHPExcel = $objReader->load("upload/lotnum.xlsx"); //test
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); // 取得总行数 
$highestColumn = $sheet->getHighestColumn(); // 取得总列数
 
//循环读取excel文件,读取一条,插入一条
for($rows=2;$rows<=$highestRow;$rows++){
$b[] = $objPHPExcel->getActiveSheet()->getCell("B".$rows)->getValue();//BANNGO
$c[] = $objPHPExcel->getActiveSheet()->getCell("C".$rows)->getValue();//PO
$d[] = $objPHPExcel->getActiveSheet()->getCell("D".$rows)->getValue();//Lotnum
$e[] = $objPHPExcel->getActiveSheet()->getCell("E".$rows)->getValue();//QUANTITY

$e_check[]=$objPHPExcel->getActiveSheet()->getCell("E".$rows)->getValue();
}

$checkall="";
//////////////march_text
for($ma=0;$ma<count($p_banngo);$ma++){
	for($mb=0;$mb<count($b);$mb++){
		if($p_banngo[$ma]==$b[$mb]&&$p_po[$ma]==$c[$mb]&&$p_quantity_check[$ma]==$e_check[$mb]){
			$e_check[$mb]=0;$p_quantity_check[$ma]=0;
			break;
		}
	}
}


for($ma=0;$ma<count($p_banngo);$ma++){
	for($mb=0;$mb<count($b);$mb++){
	 if($p_quantity_check[$ma]!=0){
		if($p_banngo[$ma]==$b[$mb]&&$p_po[$ma]==$c[$mb]){
			if($e_check[$mb]!=0&&($p_quantity_check[$ma]-$e_check[$mb])==0){
			$e_check[$mb]=0;$p_quantity_check[$ma]=0;
			unset($o_quantity);
			break;
			}elseif($e_check[$mb]!=0&&($p_quantity_check[$ma]-$e_check[$mb])>0){
			$o_quantity=$p_quantity_check[$ma];
			$p_quantity_check[$ma]=$p_quantity_check[$ma]-$e_check[$mb];$e_check[$mb]=0;
			}elseif($e_check[$mb]!=0&&($p_quantity_check[$ma]-$e_check[$mb])<0){
			$e_check[$mb]=$e_check[$mb]-$p_quantity_check[$ma];$p_quantity_check[$ma]=0;
			break;
			}
		}
	 }	
	}
}

for($ma=0;$ma<count($p_banngo);$ma++){
	if($p_quantity_check[$ma]!=0){
		echo "检测到未能匹配订单:【".$p_id[$ma]."】".$p_po[$ma]."/".$p_banngo[$ma]."/(".$o_quantity.")".$p_quantity_check[$ma]."<==>???<br>";	
		$checkall=1;
	}
}
for($mb=0;$mb<count($b);$mb++){
	if($e_check[$mb]!=0){
		echo "检测到未能匹配invoices: ???<==>【invoices】".$c[$mb]."/".$b[$mb]."/".$d[$mb]."/".$p_quantity_check[$ma]."<br>";
		$checkall=1;
	}
}

unset($o_quantity);
//////////////march_test/
if(!$checkall){
//////////////march
for($ma=0;$ma<count($p_banngo);$ma++){
	for($mb=0;$mb<count($b);$mb++){
		if($p_banngo[$ma]==$b[$mb]&&$p_po[$ma]==$c[$mb]&&$p_quantity[$ma]==$e[$mb]){
			echo "【".$p_id[$ma]."】".$p_po[$ma]."/".$p_banngo[$ma]."/()".$p_quantity[$ma]."<==>【invoices】".$c[$mb]."/".$b[$mb]."/".$d[$mb]."/".$e[$mb]." @@".$d[$mb]."|".$p_banngo[$ma]."|".$e[$mb]."|".$today."|".$p_campany[$ma]."|".$p_po[$ma]."<br>";
			mysqli_query($conn,"INSERT INTO `t_inout`(`lotnum`, `banngo`, `quantity`, `intime`, `campany`, `asahipo` ) VALUES ('$d[$mb]','$p_banngo[$ma]','$p_quantity[$ma]','$today','$p_campany[$ma]','$p_po[$ma]')");
			mysqli_query($conn,"UPDATE `t_poteacher` SET state='已入库' WHERE _id='$p_id[$ma]' limit 1");
			mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder2='已入库' WHERE po_id='$p_id[$ma]' limit 1");
			$e[$mb]=0;$p_quantity[$ma]=0;
			break;
		}
	}
}


for($ma=0;$ma<count($p_banngo);$ma++){
	for($mb=0;$mb<count($b);$mb++){
	 if($p_quantity[$ma]!=0){
		if($p_banngo[$ma]==$b[$mb]&&$p_po[$ma]==$c[$mb]){
			if($e[$mb]!=0&&($p_quantity[$ma]-$e[$mb])==0){
			echo "【".$p_id[$ma]."】".$p_po[$ma]."/".$p_banngo[$ma]."/(".$o_quantity.")".$p_quantity[$ma]."<==>【invoices】".$c[$mb]."/".$b[$mb]."/".$d[$mb]."/".$e[$mb]." @@".$d[$mb]."|".$p_banngo[$ma]."|".$e[$mb]."|".$today."|".$p_campany[$ma]."|".$p_po[$ma].".<br>";
			mysqli_query($conn,"INSERT INTO `t_inout`(`lotnum`, `banngo`, `quantity`, `intime`, `campany`, `asahipo` ) VALUES ('$d[$mb]','$p_banngo[$ma]','$e[$mb]','$today','$p_campany[$ma]','$p_po[$ma]')");
			mysqli_query($conn,"UPDATE `t_poteacher` SET state='已入库' WHERE _id='$p_id[$ma]' limit 1");
			mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder2='已入库' WHERE po_id='$p_id[$ma]' limit 1");
			$e[$mb]=0;$p_quantity[$ma]=0;
			unset($o_quantity);
			break;
			}elseif($e[$mb]!=0&&($p_quantity[$ma]-$e[$mb])>0){
			$o_quantity=$p_quantity[$ma];
			echo "【".$p_id[$ma]."】".$p_po[$ma]."/".$p_banngo[$ma]."/(".$o_quantity.")".$e[$mb]."<==>【invoices】".$c[$mb]."/".$b[$mb]."/".$d[$mb]."/".$e[$mb]." @@".$d[$mb]."|".$p_banngo[$ma]."|".$e[$mb]."|".$today."|".$p_campany[$ma]."|".$p_po[$ma]."..<br>";
			mysqli_query($conn,"INSERT INTO `t_inout`(`lotnum`, `banngo`, `quantity`, `intime`, `campany`, `asahipo` ) VALUES ('$d[$mb]','$p_banngo[$ma]','$e[$mb]','$today','$p_campany[$ma]','$p_po[$ma]')");
			$p_quantity[$ma]=$p_quantity[$ma]-$e[$mb];$e[$mb]=0;
			}elseif($e[$mb]!=0&&($p_quantity[$ma]-$e[$mb])<0){
			echo "【".$p_id[$ma]."】".$p_po[$ma]."/".$p_banngo[$ma]."/(".$o_quantity.")".$p_quantity[$ma]."<==>【invoices】".$c[$mb]."/".$b[$mb]."/".$d[$mb]."/".$p_quantity[$ma]." @@".$d[$mb]."|".$p_banngo[$ma]."|".$p_quantity[$ma]."|".$today."|".$p_campany[$ma]."|".$p_po[$ma]."...<br>";
			mysqli_query($conn,"INSERT INTO `t_inout`(`lotnum`, `banngo`, `quantity`, `intime`, `campany`, `asahipo` ) VALUES ('$d[$mb]','$p_banngo[$ma]','$p_quantity[$ma]','$today','$p_campany[$ma]','$p_po[$ma]')");
			mysqli_query($conn,"UPDATE `t_poteacher` SET state='已入库' WHERE _id='$p_id[$ma]' limit 1");
			mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder2='已入库' WHERE po_id='$p_id[$ma]' limit 1");
			$e[$mb]=$e[$mb]-$p_quantity[$ma];$p_quantity[$ma]=0;
			break;
			}
		}
	 }	
	}
}
echo "OVER";
//////////////march/
}else{
	echo "存不多余项目！！<br>";
}

echo "<br>work end!"; 

unlink("./upload/".$_FILES['file']['name']);
}
$conn->close();
?>

</body>
</html>