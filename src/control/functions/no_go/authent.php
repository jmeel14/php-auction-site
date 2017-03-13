<?PHP
	$_SESSION['currPage'] = "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	
	if(isset($_SESSION['loggedIn']) == false or $_SESSION['loggedIn'] == false){
		header('location:../../display/sites/site_login.php');
		die();
	}
?>
	