<?PHP
	function check_auth($aucID,$aucTitle){
		if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] == true){
			echo "<div class=\"auct_controls\">";
				echo "<div class='btn btn-success' onClick='openBidForm(" . $aucID . ")'>Bid</div>";
				
				if(isset($_SESSION['isStaff']) and $_SESSION['isStaff'] == true){
					echo "
						<div class='btn btn-warning' onClick='open_form(); fill_form(" . $aucID . ")'>Edit</div>
						<div class='btn btn-danger' onClick='conf_del(event," . $aucID . ',"' . $aucTitle . "\")'>Delete</div>
					";
				}
			echo "</div>";
		}
	}
    function check_auth_form(){
        if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] == true){
            require('../require/auction_modify_form.php');
            require('../require/bid_add_Form.php');
        }
    }
?>