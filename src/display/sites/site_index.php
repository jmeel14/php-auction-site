<?PHP
	require('../../control/objects/session_user.php');
	session_start();
	
	$pTitle = 'Home';
	require ('../require/head.php');
		require('../require/header.php');
		require ('../require/nav.php');
		
		checkErr('overhead fader');
		
		$dispMethod = 'min';
		require('../require/auctions.php');
		
		require('../require/footer.php');
?>