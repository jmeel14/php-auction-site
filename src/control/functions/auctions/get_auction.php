<?PHP
	require('../../dbConnect/dbLink.php');
	require('./auctions_fetch/auctions_fetch.php');
	
	if(isset($_GET['get']) and $_GET['get'] != ''){
		try{
			$got_auc = get_auction($_GET['get']);
			
			header('Item-Found: Pass');
			echo json_encode($got_auc);
		}
		catch(Exception $e){
			header('Item-Found: Fail');
			echo 'fail';
		}
	}
	else{
		header('Item-Req: INVALID REQUEST');
		echo 'Fatal error occurred.';
	}
?>