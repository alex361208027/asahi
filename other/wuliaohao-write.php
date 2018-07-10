<?php
$banngo=$_POST['banngo'];
$wuliaohao=$_POST['wuliaohao'];

//echo $banngo[13]."<br>";
//echo $wuliaohao[13]."<br>";

$c=count($banngo);

$i=0;$txt1="";
while($i<$c){
	if($banngo[$i]){
		if($i!=0){
			$txt1=$txt1.",";
		}
	$txt1=$txt1.'"'.$banngo[$i].'"';
	$i++;;
	}else{
		$i++;
	}
}
$txt1="var banngo=new Array(".$txt1.");";

$c=count($wuliaohao);
$i=0;$txt2="";
while($i<$c){
	if($wuliaohao[$i]){
		if($i!=0){
			$txt2=$txt2.",";
		}
	$txt2=$txt2.'"'.$wuliaohao[$i].'"';
	$i++;
	}else{
		$i++;
		$c--;
	}
	
}
$txt2="var wuliaohao=new Array(".$txt2.");";


$txt=$txt1.$txt2;
echo "已写入：<br>".$txt;
fwrite(fopen("wuliaohao.html", "w"), $txt);
?>
<br>
<a href="wuliaohao.php">返回</a>

