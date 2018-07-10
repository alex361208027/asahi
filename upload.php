<html>
<head>
<meta charset="utf-8">
<title>菜鸟教程(runoob.com)</title>
</head>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
   请使用模板文件：
	<input type="file" name="file" id="file">
    <input type="submit" name="submit" value="提交">
</form>
<a href="upload/moban/namecard.xlsx">名片模板下载</a><br>


<?php
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


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "asahi";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset ($conn,utf8);

$objReader = PHPExcel_IOFactory::createReader('Excel2007');//use excel2007 for 2007 format 
$objPHPExcel = $objReader->load("./upload/".$_FILES['file']['name']); //$filename可以是上传的文件，或者是指定的文件
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
//$p = $objPHPExcel->getActiveSheet()->getCell("P".$rows)->getValue();

$sql="SELECT * FROM `t_namecard` WHERE name = '$a' AND campany = '$b'";
$result = mysqli_query($conn,$sql);
	if($result->num_rows == 0){
    mysqli_query($conn,"INSERT INTO `t_namecard`(`name`, `sex`, `campany`, `position`, `department`, `title`, `email`, `phone`, `tel`, `tel2`, `fax`, `address`, `post`, `web`, `remark`) VALUES ('$a', '$b', '$c', '$d', '$e', '$f', '$g', '$h', '$i', '$j', '$k', '$l', '$m', '$n', '$o')");
	echo $a."添加成功<br>";
		}else{
			echo $a."已存在<br>";
		}
 
}

echo "<br>work end!"; 

$conn->close();

unlink("./upload/".$_FILES['file']['name']);
}
?>

</body>
</html>