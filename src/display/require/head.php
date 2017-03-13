<!DOCTYPE html>
<?PHP require('../require/session_error.php'); ?>
<html>
	<head>
		<title><?PHP echo $pTitle; ?></title>
		
		<meta http-equiv="Content-Type" content="text/html;" charset='UTF-8' />
		
		<script>
			function getElemID(elemID){ return document.getElementById(elemID);}
			function genErr(parElem, errType, errStr){
				parElem.innerHTML = '';
				
				var newElem = document.createElement('div');
				newElem.setAttribute('class', 'notif ' + errType);
				newElem.innerHTML = errStr;
				
				parElem.appendChild(newElem);
			}
		</script>
		
		<link rel="stylesheet" href="../bootstrap-3.3.7-dist/css/bootstrap.css"/>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />
		
		<link href="../css/main.css" rel="stylesheet"/>		
	</head>
	
	<body>