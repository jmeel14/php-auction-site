<?PHP
	require('../../dbConnect/dbLink.php');
	require('./auctions_fetch/auctions_fetch.php');
	
	if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] == true){
		if(isset($_GET['del']) and $_GET['del'] != ''){
			try{
				del_auction($_GET['del']);
				$del_dir = '../../../display/img/auctions/auction_' . $_GET['del'];
				
				if(file_exists($del_dir)){
					array_map('unlink', glob("$del_dir/*.*"));
					rmdir($del_dir);
				}
				
				echo "Success";
			}
			catch(Exception $e){
				echo "Fail";
			}
		}
		else { echo 'Fail'; }
	}
	else{
		echo 'Fail';
	}
?>