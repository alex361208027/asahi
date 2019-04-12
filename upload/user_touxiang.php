<?php
// 允许上传的图片后缀
$allowedExts = array("jpeg", "jpg", "JPG", "png", "PNG");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);     // 获取文件后缀名
if (($_FILES["file"]["size"] < 204800)   // 小于 100 kb
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
       // echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
       // echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
       // echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
       // echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
        
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "user_touxiang/".$_COOKIE['asahiuser'].".png");
            echo "<img src='upload/user_touxiang/".$_COOKIE['asahiuser'].".png' width='66px'/>";
      //  }
    }
}
else
{
    echo "文件太大(要求小于100k) 或 非法的文件格式";
}
?>