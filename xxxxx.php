$check_week=date("w",strtotime(date('Y-m-d',strtotime($moon))));



	while($plus<10){

	$pick_date=date('Y-m-d',strtotime("+".$plus." days",strtotime($moon)));
	echo $check_week=date("w",strtotime($pick_date));

	if($check_week){
		
	}else{
		
	}
	$plus++;
	}