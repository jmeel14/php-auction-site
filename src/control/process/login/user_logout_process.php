<?PHP
	session_start();
	
	$siteHost = $_SERVER['HTTP_HOST'];
	
	if(isset($_SESSION['loggedIn'])){
		unset($_SESSION['loggedIn']); unset($_SESSION['currUser']);
		echo "<div style='text-align:center; border:bold 1px green; color:green; background:rgb(235,245,235);'>Log-out successful. Redirecting you to the home page...</div>";
		echo "<script>setTimeout(function(){ window.location = 'http://$siteHost/prototypesite/display/sites/site_index.php'; },5000);</script>";
		if(isset($_SESSION['isStaff'])){ unset($_SESSION['isStaff']); session_destroy(); }
		die();
	}
	else {
		echo "<div style='text-align:center; border:bold 1px green; color:red; background:rgb(245,235,235);'>Unknown error occurred. Redirecting you to the home page...</div>";
		echo "<script>setTimeout(function(){ window.location = 'http://$siteHost/prototypesite/display/sites/site_index.php'; },5000);</script>";
	}