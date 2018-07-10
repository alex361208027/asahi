<?php
function qukongge($str){
	$str = mb_ereg_replace('	', '', $str); 
	$str = mb_ereg_replace('^(　| )+', '', $str); 
	$str = mb_ereg_replace('(　| )+$', '', $str); 
	$str = mb_ereg_replace('　　', "\n　　", $str); 
	return $str;
}

?>