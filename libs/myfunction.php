<?php
function qukongge($str){
	$str = mb_ereg_replace('	', '', $str); 
	$str = mb_ereg_replace('^(　| )+', '', $str); 
	$str = mb_ereg_replace('(　| )+$', '', $str); 
	$str = mb_ereg_replace('　　', "\n　　", $str); 
	return $str;
}


function SHdate5($JPdate,$hopedate){
		$hopedate5 = date('Y-m-d',(strtotime('+6 days',strtotime($JPdate))));
		if($hopedate && $hopedate5<=$hopedate){
		$SHdate= date('Y-m-d',(strtotime('-2 days',strtotime($hopedate))));
		}else{
		$SHdate=$hopedate5;
		if($JPdate==0){$SHdate=0;}
		}
		$SHdate5[]=$hopedate5;
		$SHdate5[]=$SHdate;
		$SHdate5[]=$JPdate;
		$SHdate5[]=$hopedate;
		return $SHdate5;
}
?>