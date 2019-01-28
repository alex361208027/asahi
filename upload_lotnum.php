<html>
<head>
<meta charset="utf-8">
<title>Lotnum</title>
</head>
<body>
<form action="upload_lotnum.php" method="post" enctype="multipart/form-data">
   请使用模板文件：
	<input type="file" name="file" id="file">
    <input type="submit" name="submit" value="提交">
</form>
<a href="upload/moban/lotnum.xlsx">模板下载</a><br>


<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

date_default_timezone_set('PRC');
$todaytime=date('Y-m-d H:i:s');


$checkbox=$_GET['checkbox'];
if($checkbox){

	?>	
	<table>
<?
foreach($checkbox as $_id){
	$result=mysqli_query($conn,"SELECT * FROM `t_poteacher` WHERE _id='$_id'");
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
<?
}

if($_FILES["file"]){
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
}
else
{
    echo "非法的文件格式";
}




echo "<br>work:<br>";

require_once("./libs/PHPExcel-1.8/Classes/PHPExcel.php");
require_once("./libs/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");
require_once("./libs/PHPExcel-1.8/Classes/PHPExcel/Reader/Excel5.php");



$objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2007 for 2007 format 
$objPHPExcel = $objReader->load("./upload/".$_FILES['file']['name']); //$filename可以是上传的文件，或者是指定的文件
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); // 取得总行数 
$highestColumn = $sheet->getHighestColumn(); // 取得总列数
 
//循环读取excel文件,读取一条,插入一条
for($rows=2;$rows<=$highestRow;$rows++){

$a = $objPHPExcel->getActiveSheet()->getCell("A".$rows)->getValue();//TIME
$b = $objPHPExcel->getActiveSheet()->getCell("B".$rows)->getValue();//BANNGO
$c = $objPHPExcel->getActiveSheet()->getCell("C".$rows)->getValue();//PO
$d = $objPHPExcel->getActiveSheet()->getCell("D".$rows)->getValue();//Lotnum
$e = $objPHPExcel->getActiveSheet()->getCell("E".$rows)->getValue();//QUANTITY








//$lot_quantity=$e;
//$sql="SELECT * FROM `t_poteacher` WHERE JPdate='$a' AND banngo='$b' AND asahiorder='$c'";
//$result = mysqli_query($conn,$sql);

//while($row=$result->fetch_row()){
//	if($row[2]==$lot_quantity&&$a==$row[3]){
//		$campany=$row[5]."<br>".$row[6];
//		mysqli_query($conn,"INSERT INTO `t_inout`(`lotnum`, `banngo`, `quantity`, `intime`, `campany`, `asahipo` ) VALUES ('$d','$b','$e','$today','$campany','$row[0]')");
//		echo $d.$b.$e.$today.$row[5].$row[0];
//	    echo $d."录入成功\r";	
//	   
//	   mysqli_query($conn,"UPDATE `t_poteacher` SET state='已入库' WHERE _id='$row[9]'");
//	   mysqli_query($conn,"UPDATE `t_teacher` SET asahiorder2='已入库' WHERE po_id='$row[9]'");
//	   
//	}else{
//		
//	}
//}

}

echo "<br>work end!"; 

$conn->close();

unlink("./upload/".$_FILES['file']['name']);
}
?>

</body>
</html>