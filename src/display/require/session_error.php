<?PHP
	function echoDivErr($style,$msg){
		echo '<div class="' . $style . '">' . $msg . '</div>';
	}
	
	function checkErr($errStyle){
		if(isset($_SESSION['errState'])){
			$errSess = $_SESSION['errState'];
			echo '<div class="' . $errSess[0] . ' ' . $errStyle . ' notif">' . $errSess[1] . '</div>';
			
			unset($_SESSION['errState']);
		}
	}
	
	function checkErrList($errStyle,$obj,$objArg){
		if(isset($_SESSION[$obj]->$objArg) and $_SESSION[$obj]->$objArg != ''){
			echoDivErr('notif fail ' . $errStyle,$_SESSION[$obj]->$objArg);
			
			unset($_SESSION[$obj]->$objArg);
		}
	}
?>