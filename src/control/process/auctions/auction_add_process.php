<?PHP
	require('../../objects/error/session_errors.php');
	require('../../objects/session_auction.php');
	
	require('../../dbConnect/dbLink.php');
	require('../../functions/auctions/auctions_fetch/auctions_fetch.php');
	session_start();
	
	$_SESSION['errState'] = ['fail','An error occurred processing your form. Please check and correct any issues.'];
	$errList = new err_auct_obj();
	
	if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] == true){
	
		if(isset($_POST['auctTitle']) and isset($_POST['auctDesc'])){
			if(isset($_POST['auctStartDate']) and isset($_POST['auctEndDate'])){
				$auctInfo = [
					$_POST['auctTitle'],
					$_POST['auctDesc'],
					$_POST['auctStartDate'],
					$_POST['auctEndDate'],
					$_POST['auctStartBid']
				];
				
				$aucObj = new auction_fill_obj();
				$aucObj->auc_title = $auctInfo[0];
				$aucObj->auc_desc = $auctInfo[1];
				$aucObj->auc_create_date = date('Y') . "-" . date('m') . "-" . date('d');
				$aucObj->auc_start_date = $auctInfo[2];
				$aucObj->auc_end_date = $auctInfo[3];
				$aucObj->auc_start_bid = $auctInfo[4];
				
				$_SESSION['auc_attempt'] = $aucObj;
				
				if(strlen($auctInfo[0]) < 5 or strlen($auctInfo[0]) > 35){
					$errList->aucTitleErr = "The title should be at least 5 characters long, but no longer than 95.";
				}
				if(strlen($auctInfo[1]) < 20 or strlen($auctInfo[1]) > 280){
					$errList->aucDescErr = "The description should be at least 20 characters long, but no longer than 280.";
				}
				
				$startDate = new DateTime($auctInfo[2]);
				$currDate = new DateTime(date('Ymd'));
				$endDate = new DateTime($auctInfo[3]);
				$dateDiffStart = $startDate ->diff($currDate)->format('%a');
				$dateDiffAuc = $startDate->diff($endDate)->format('%a');
				if($dateDiffStart < 14 or $dateDiffStart > 90){
					$errList->startDateErr = 'The starting date cannot be smaller than a week from now, nor bigger than 90 days (estimated 3 months).';
					$_SESSION['errList'] = $errList;
				}
				if($dateDiffAuc < 30 or $dateDiffAuc > 90){
					$errList->endDateErr = 'The duration cannot be smaller than a month from the starting date, nor bigger than 90 days (estimated 3 months).';
					$_SESSION['errList'] = $errList;
				}
				if($auctInfo[4] < 25 or $auctInfo[4] > 75000){
					$errList->startBidErr = "The starting bid should be at least $25, but smaller than $75000.";
					$_SESSION['errList'] = $errList;
				}
				
				
				if(isset($_FILES['auctAvatar']) and $_FILES['auctAvatar']['name'] != ''){
					$wait_file = $_FILES['auctAvatar'];
					$wait_file_ext = end(explode('.',$_FILES['auctAvatar']['name']));
					if($wait_file['size'] >= 2000000){
						$errList->aucAvErr = 'The size of the avatar should not be 2MB or larger.';
						$_SESSION['errList'] = $errList;
					}
					elseif(!in_array(strtolower($wait_file_ext),['jpg','jpeg','png','gif','webm'])) {
						$errList->aucAvErr = 'The avatar file must be a JPG/JPEG, PNG, GIF, or WebM.';
						$_SESSION['errList'] = $errList;
					}
					else{
						$wait_file_name = 'auc_av_' . rand(100,75800);
						$aucObj->auc_av_name = $wait_file_name . '.' . $wait_file_ext;
						$wait_up_loc = '../../../display/img/auctions/';
					}
				}
				
				if(isset($_SESSION['errList']) == false){
					$db_auc_add_arr = [];
					
					array_push($db_auc_add_arr,$aucObj->auc_title);
					array_push($db_auc_add_arr,$aucObj->auc_desc);
					array_push($db_auc_add_arr,$aucObj->auc_create_date);
					array_push($db_auc_add_arr,$aucObj->auc_start_date);
					array_push($db_auc_add_arr,$aucObj->auc_end_date);
					array_push($db_auc_add_arr,$aucObj->auc_start_bid);
					array_push($db_auc_add_arr,$aucObj->auc_av_name);
					
					$send_add = add_auction($db_auc_add_arr);
					
					if(isset($wait_file_name)){
						$wait_file_new_loc = $wait_up_loc . 'auction_' . $send_add[1] . '/';
						if(file_exists($wait_file_new_loc) != true){
							mkdir($wait_file_new_loc);
						}
						move_uploaded_file($wait_file['tmp_name'],$wait_file_new_loc . $wait_file_name . '.' . $wait_file_ext);
					}
					if($send_add[0]){
						$_SESSION['errState'] = ['pass','Successfully added an auction with the title <b>' . $auctInfo[0] . '</b>.'];
						unset($_SESSION['auc_attempt']);
					}
				}
				else  {
					$_SESSION['auc_attempt'] = $aucObj;
				}
			}
		}
		header('location:../../../display/sites/auctions_index.php?add');
		die();
	}
?>