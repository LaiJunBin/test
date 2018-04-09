<?php


	$arr = array();

	
	// a-z A-z 0-9
	//ascii:
	//97-122 65-90 48-57

	fill(97,122);
	fill(65,90);
	fill(48,57);
	
	function fill($min,$max){
		global $arr;
		for($i=$min;$i<=$max;$i++){
			$index = count($arr);
			$arr[$index] = chr($i);
		}	
	}
	
	
	$count = count($arr);
	
	$index = mt_rand(0,$count-1);
	

	echo $arr[$index];
	


?>