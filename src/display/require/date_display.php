<?PHP
	function disp_date_set($dispDate){
		$dispStr = [];
		
		$rawDate = date_parse($dispDate);
		array_push($dispStr,$rawDate['day']);
		array_push($dispStr,$rawDate['month']);
		array_push($dispStr,$rawDate['year']);
		
		echo join('/',$dispStr);
	}