<?PHP
	require('../../control/objects/error/session_errors.php');
	require('../../control/objects/session_user.php');
	session_start();
	
	$pTitle = 'Auctions';
	require('../require/head.php');
		require('../require/header.php');
		require('../require/nav.php');
		require('../require/redirect.php');
		
		checkErr('overhead fader');
		
		if(isset($_GET['view'])){
			if($_GET['view'] != ''){
				
			}
		}
		else{
			doRedirect('It doesn\'t look like you specified any ID for an auction.', 'Redirecting you to the previous page.', $_SESSION['currPage']);
		}
		require('../require/footer.php');
?>