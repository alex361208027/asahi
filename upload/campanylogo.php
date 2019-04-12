<?php
// 允许上传的图片后缀
$allowedExts = array("jpeg", "jpg", "JPG", "png", "PNG");
$temp = explode(".", $_FILES["file"]["name"]);

$extension = end($temp);     // 获取文件后缀名
if (($_FILES["file"]["size"] < 54800)   // 小于 200 kb
&& in_array($extension, $allowedExts)){
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        //echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
       // echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
        //echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        //echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";

            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "campanylogo/".$_POST["campany"].".png");
           // echo "文件存储在: " . "campanylogo/" . $_POST["campany"].".png";
		   
		   echo "上传成功，请刷新页面。";
      //  }
    }
}else{
    echo "文件太大(要求小于50k) 或 非法的文件格式";
}
?>