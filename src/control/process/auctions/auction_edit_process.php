<?PHP
	require('../../objects/error/session_errors.php');
	require('../../objects/session_auction.php');
	
	session_start();
	
	require('../../dbConnect/dbLink.php');
	require('../../functions/auctions/auctions_fetch/auctions_fetch.php');
	
	if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] == true){
		
		$errList = new err_modif_auct_obj();
		$aucObj = new auction_modif_obj();
		
		$currAuc = get_auction($_POST['auc_ID']);
		
		if(isset($_POST['modif_auc_title']) and $_POST['modif_auc_title'] != ''){
			$aucObj->auc_title = $aucTitle = $_POST['modif_auc_title'];
			if(strlen($aucTitle) < 5 or strlen($aucTitle) > 35){
				$errList->aucTitleErr = "The title should be at least 5 characters long, but no longer than 95.";
				$_SESSION['errModifList'] = $errList;
			}
		}
		else { $aucObj->auc_title = $currAuc['auction_title']; }
		if(isset($_POST['modif_auc_desc']) and $_POST['modif_auc_desc'] != ''){
			$aucObj->auc_desc = $aucDesc = $_POST['modif_auc_desc'];
			if(strlen($aucDesc) < 20 or strlen($aucDesc) > 280){
				$errList->aucDescErr = "The description should be at least 20 characters long, but no longer than 280.";
				$_SESSION['errModifList'] = $errList;
			}
		}
		else { $aucObj->auc_desc = $currAuc['auction_description']; }
		if(isset($_POST['modif_auc_dateS']) and $_POST['modif_auc_dateS'] != ''){
			$aucObj->auc_start_date = $aucStartDate = $_POST['modif_auc_dateS'];
			
			$startDate = new DateTime($aucStartDate);
			$currDate = new DateTime(date('Ymd'));
			
			$dateDiffStart = $startDate ->diff($currDate)->format('%a');
			
			if($dateDiffStart < 14 or $dateDiffStart > 90){
				$errList->startDateErr = 'The starting date cannot be smaller than a week from now, nor bigger than 90 days (estimated 3 months).';
				$_SESSION['errModifList'] = $errList;
			}
		}
		else { $aucObj->auc_start_date = $currAuc['auction_start_date']; }
		if(isset($_POST['modif_auc_dateE']) and $_POST['modif_auc_dateE'] != ''){
			$aucObj->auc_end_date = $aucEndDate = $_POST['modif_auc_dateE'];
			
			$startDate = new DateTime($_POST['modif_auc_dateS']);
			$endDate = new DateTime($aucEndDate);
			$dateDiff = $startDate ->diff($endDate)->format('%a');
			
			if($dateDiff < 14 or $dateDiff > 90){
				$errList->startDateErr = 'The duration cannot be smaller than a month from the starting date, nor bigger than 90 days (estimated 3 months).';
				$_SESSION['errModifList'] = $errList;
			}
		}
		else { $aucObj->auc_end_date = $currAuc['auction_end_date']; }
		if(isset($_POST['modif_auc_startBid']) and $_POST['modif_auc_startBid'] != ''){
			$aucObj->auc_start_bid = $aucBidStart = $_POST['modif_auc_startBid'];
			
			if($aucBidStart < 35 or $aucBidStart > 75000){
				$errList->startBidErr = "The starting bid should be at least $25, but smaller than $75000.";
				$_SESSION['errModifList'] = $errList;
			}
		}
		else { $aucObj->auc_bid_start = $currAuc['auction_bid_start']; }
		if(isset($_FILES['modif_auc_av']) and $_FILES['modif_auc_av']['name'] != ''){
			$wait_file = $_FILES['modif_auc_av'];
			$wait_file_ext = end(explode('.',$_FILES['modif_auc_av']['name']));
			if($wait_file['size'] >= 2000000){
				$errList->aucAvErr = 'The size of the avatar should not be 2MB or larger.';
				$_SESSION['errModifList'] = $errList;
			}
			elseif(!in_array(strtolower($wait_file_ext),['jpg','jpeg','png','gif','webm'])) {
				$errList->aucAvErr = 'The avatar file must be a JPG/JPEG, PNG, GIF, or WebM.';
				$_SESSION['errModifList'] = $errList;
			}
			else{
				$wait_file_name = 'auc_av_' . rand(100,75800);
				$aucObj->auc_av_name = $wait_file_name . '.' . $wait_file_ext;
				$wait_up_loc = '../../../display/img/auctions/';
			}
		}
		
		if(isset($_SESSION['errModifList']) == false){
			$db_auc_modif_arr = [];
			
			if($aucObj->auc_title != ''){ array_push($db_auc_modif_arr,$aucObj->auc_title); }
			else { array_push($db_auc_modif_arr,$currAuc['auction_title']);}
			if($aucObj->auc_desc != ''){ array_push($db_auc_modif_arr,$aucObj->auc_desc); }
			else { array_push($db_auc_modif_arr,$currAuc['auction_description']);}
			if($aucObj->auc_start_date != ''){ array_push($db_auc_modif_arr,$aucObj->auc_start_date); }
			else { array_push($db_auc_modif_arr,$currAuc['auction_start_date']);}
			if($aucObj->auc_end_date != ''){ array_push($db_auc_modif_arr,$aucObj->auc_end_date); }
			else { array_push($db_auc_modif_arr,$currAuc['auction_end_date']);}
			if($aucObj->auc_start_bid != ''){ array_push($db_auc_modif_arr,$aucObj->auc_start_bid); }
			else { array_push($db_auc_modif_arr,$currAuc['auction_bid_start']);}
			if($aucObj->auc_av_name != ''){ array_push($db_auc_modif_arr,$aucObj->auc_av_name); }
			array_push($db_auc_modif_arr,$_POST['auc_ID']);
			
			
			$send_modif = modif_auction($db_auc_modif_arr);
			
			if(isset($wait_file_name)){
				$wait_file_new_loc = $wait_up_loc . 'auction_' . $_POST['auc_ID'] . '/';
				if(file_exists($wait_file_new_loc) != true){
					mkdir($wait_file_new_loc);
				}
				move_uploaded_file($wait_file['tmp_name'],$wait_file_new_loc . $wait_file_name . '.' . $wait_file_ext);
			}
			
			if($send_modif[0]){
				$_SESSION['errState'] = ['pass','Successfully modified auction with the title <b>' . $aucObj->auc_title . '</b>.'];
				if(isset($_SESSION['auc_modif_attempt'])){ unset($_SESSION['auc_modif_attempt']); }
			}
			else {
				$_SESSION['auc_modif_attempt'] = $aucObj;
				$_SESSION['auc_modif_attempt']->auc_ID = $_POST['auc_ID'];
			}
		}
		else {
			$_SESSION['auc_modif_attempt'] = $aucObj;
			$_SESSION['auc_modif_attempt']->auc_ID = $_POST['auc_ID'];
		}
	}
	header('location:../../../display/sites/auctions_index.php');
	die();
?>