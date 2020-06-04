<?
$txt=$_POST['calendar'];
$date=$_POST['date'];

date_default_timezone_set('PRC');
$user=date("Y-m-d H:i:s");

if($date){
$file = fopen("month/".$date.".html","w");
fwrite($file,$txt);
fclose($file);
}

if($user){
$file = fopen("user.html","w");
fwrite($file,$user);
fclose($file);
}

echo $user;
?>