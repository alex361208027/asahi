<?

$excel=$_POST["excel"];
//$php=$_POST["php"];
$ftp="moban/Excel_Download.xlsx";

$file=fopen($ftp, "w");
fwrite($file, $excel);
fclose($file);

echo $ftp;

?>