<?php
echo "work:<br>";

require_once("./libs/PHPExcel-1.8/Classes/PHPExcel.php");
require_once("./libs/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");
require_once("./libs/PHPExcel-1.8/Classes/PHPExcel/Reader/Excel5.php");


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2007 for 2007 format 
$objPHPExcel = $objReader->load("./libs/PHPExcel-1.8/test.xlsx"); //$filename可以是上传的文件，或者是指定的文件
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); // 取得总行数 
$highestColumn = $sheet->getHighestColumn(); // 取得总列数
 
//循环读取excel文件,读取一条,插入一条
for($rows=2;$rows<=$highestRow;$rows++){

$a = $objPHPExcel->getActiveSheet()->getCell("A".$rows)->getValue();//获取A列的值
$b = $objPHPExcel->getActiveSheet()->getCell("B".$rows)->getValue();//获取B列的值
$c = $objPHPExcel->getActiveSheet()->getCell("C".$rows)->getValue();
$d = $objPHPExcel->getActiveSheet()->getCell("D".$rows)->getValue();
$e = $objPHPExcel->getActiveSheet()->getCell("E".$rows)->getValue();
$f = $objPHPExcel->getActiveSheet()->getCell("F".$rows)->getValue();
$g = $objPHPExcel->getActiveSheet()->getCell("G".$rows)->getValue();
$h = $objPHPExcel->getActiveSheet()->getCell("H".$rows)->getValue();
$i = $objPHPExcel->getActiveSheet()->getCell("I".$rows)->getValue();
$j = $objPHPExcel->getActiveSheet()->getCell("J".$rows)->getValue();
$k = $objPHPExcel->getActiveSheet()->getCell("K".$rows)->getValue();
$l = $objPHPExcel->getActiveSheet()->getCell("L".$rows)->getValue();
$m = $objPHPExcel->getActiveSheet()->getCell("M".$rows)->getValue();
$n = $objPHPExcel->getActiveSheet()->getCell("N".$rows)->getValue();
$o = $objPHPExcel->getActiveSheet()->getCell("O".$rows)->getValue();
$p = $objPHPExcel->getActiveSheet()->getCell("P".$rows)->getValue();

$sql="SELECT * FROM `t_namecard` WHERE name = '$b' AND campany = '$d'";
$result = mysqli_query($conn,$sql);
	if($result->num_rows == 0){
    mysqli_query($conn,"INSERT INTO `t_namecard`(`name`, `sex`, `campany`, `position`, `department`, `title`, `email`, `phone`, `tel`, `fax`, `address`, `post`, `web`, `remark`) VALUES ('$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i', '$k', '$l', '$m', '$n', '$o', '$p')");
	echo $b."添加成功<br>";
		}else{
			echo $b."已存在<br>";
		}
 
}

echo "<br>work end!"; 
$conn->close();

?>