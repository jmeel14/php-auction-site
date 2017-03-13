<?PHP
    require('../../objects/session_user.php');
    session_start();
    
    require('../../dbConnect/dbLink.php');
    require('./bids_fetch/bids_fetch.php');
    require('../auctions/auctions_fetch/auctions_fetch.php');
    
    
    if(isset($_GET['get_biggest'])){
        if(isset($_GET['bid_auc'])){
            if(get_biggest_bid($_GET['bid_auc'])['bid_biggest'] != ''){ echo json_encode(get_biggest_bid($_GET['bid_auc'])); }
            else { echo '{ "bid_biggest": "' . get_auction($_GET['bid_auc'])['auction_bid_start'] . '" }'; }
        }
    }
	else{
		if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] == true){
			if(isset($_GET['set_biggest']) and $_GET['set_biggest'] != ''){
				if(isset($_GET['bid_amt']) and $_GET['bid_amt'] != ''){
					$currAuc = '';
					if(get_biggest_bid($_GET['set_biggest'])['bid_biggest'] != ''){
						$currAuc = get_biggest_bid($_GET['set_biggest'])['bid_biggest'];

						if($_GET['bid_amt'] <= $currAuc){ echo "That is too small!"; }
						else { 
							if(get_bid($_GET['set_biggest'],$_SESSION['currUser']->user_ID) != ''){
								set_bid($_GET['set_biggest'],$_GET['bid_amt'],$_SESSION['currUser']->user_ID);
								echo "success";
							}
							else {
								add_bid($_GET['set_biggest'],$_GET['bid_amt'],$_SESSION['currUser']->user_ID);
                                echo 'success';
							}
						}
					}
					else {
						$currAuc = get_auction($_GET['set_biggest'])['auction_bid_start'];
						
						if($_GET['bid_amt'] <= $currAuc){ echo "That is too small!"; }
						else { 
                            add_bid($_GET['set_biggest'],$_GET['bid_amt'],$_SESSION['currUser']->user_ID);
                            echo "success";
                        }
					}
				}
			}
			elseif(isset($_GET['del_biggest']) and $_GET['del_biggest'] != ''){
				try{
					del_bid($_GET['del_biggest'],$_SESSION['currUser']->user_ID);
					echo 'success';
				}
				catch(Exception $e){
					echo 'fail: Invalid login or method.';
				}
			}
		}
	}
?>