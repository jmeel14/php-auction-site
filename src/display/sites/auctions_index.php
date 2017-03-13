<?PHP
	require('../../control/objects/error/session_errors.php');
	require('../../control/objects/session_user.php');
	require('../../control/objects/session_auction.php');
	
	session_start();
	
	if(isset($_GET['add'])){
		require('../../control/functions/no_go/authent.php');
	}
	
	$pTitle = 'Auctions';
	require('../require/head.php');
		require('../require/header.php');
		require('../require/nav.php');
		checkErr('overhead fader');
		
		$dispMethod = 'main';
		require('../require/auctions.php');
		
		if(isset($_GET['add'])){
			require('../require/auction_add_form.php');
		}
		require('../require/footer.php');
?>