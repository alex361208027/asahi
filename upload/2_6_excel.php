<?

$excel=$_POST["excel"];
//$php=$_POST["php"];
$ftp="moban/Excel_Download.xlsx";

fwrite(fopen($ftp, "w"), $excel);

echo $ftp;

?>