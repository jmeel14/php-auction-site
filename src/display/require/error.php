<?PHP 
	function checkErr($errType){
		if(isset($_SESSION['errState'])){
			echo "<div class='" . $_SESSION['errState'][0] . "$errType notif'>" . $_SESSION['errState'][1] . "</div>";
			
			unset($_SESSION['errState']);
		}
	}
?>