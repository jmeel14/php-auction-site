<?PHP
	require('../../objects/session_user.php');
	session_start();
	
	require('../../dbConnect/dbLink.php');
	require('../../functions/no_go/users.php');

	if(isset($_POST['uNameL']) and $_POST['uNameL'] != ''){
		$uDet = [$_POST['uNameL'],$_POST['uPWordL']];
		$targUser = get_user_name($uDet[0]);
		if($uDet[0] == $targUser['user_name']){
			if($targUser['user_pass_hash_salt'] == (hash('md5',$uDet[1]) . $targUser['user_salt'])){
				$_SESSION['errState'] = ['pass','Login successful. Welcome.'];
				$_SESSION['loggedIn'] = true;
				$_SESSION['currUser'] = new active_user_obj();
				$_SESSION['currUser']->user_name = $targUser['user_name'];
                $_SESSION['currUser']->user_ID = $targUser['user_ID'];
				if($targUser['user_rank_ID'] == 0 or $targUser['user_rank_ID'] == 1){
					$_SESSION['isStaff'] = true;
				}
				switch($targUser['user_rank_ID']){
					case 0:
						$_SESSION['currUser']->user_rank = "Admin";
						break;
					case 1:
						$_SESSION['currUser']->user_rank = "Content Moderator";
						break;
					case 2:
						$_SESSION['currUser']->user_rank = "Customer";
						break;
					default:
						$_SESSION['currUser']->user_rank = "Unknown";
				}
				
				if(isset($_SESSION['currPage'])){
					$nextPage = $_SESSION['currPage'];
					unset($_SESSION['currPage']);
					
					
					header('location:' . "http://$nextPage");
					die();
				}
				else{
					header('location:../../../display/sites/site_index.php');
					die();
				}
			}
			else {
				$_SESSION['errState'] = ['fail','Incorrect credentials, please try again.'];
				$_SESSION['user'] = [$targUser['user_name'],$targUser['user_email']];
				
				header('location:../../../display/sites/site_login.php');
				die();
			}
		}
		else {
			$_SESSION['errState'] = ['fail','Those credentials were not found in the database. Try again.'];
			
			header('location:../../../display/sites/site_login.php');
			die();
		}
	}

	elseif(isset($_POST['uEmailL']) and $_POST['uEmailL'] != ''){
		$uDet = [$_POST['uEmailL'],$_POST['uPWordL']];
		$targUser = get_user_email($uDet[0]);
		if($uDet[0] == $targUser['user_email']){
			if($targUser['user_pass_hash_salt'] == (hash('md5',$uDet[1]) . $targUser['user_salt'])){
				$_SESSION['errState'] = ['pass','Login successful. Welcome.'];
				$_SESSION['loggedIn'] = true;
				$_SESSION['currUser'] = new active_user_obj();
				try { $_SESSION['currUser']->user_name = $targUser['user_name']; } catch(Exception $e){ ''; }
				$_SESSION['currUser']->user_email = $targUser['user_email'];
				$_SESSION['currUser']->user_ID = $targUser['user_ID'];
				if($targUser['user_rank_ID'] == 0 or $targUser['user_rank_ID'] == 0){
					$_SESSION['isStaff'] = true;
				}
				
				if(isset($_SESSION['currPage'])){
					$nextPage = $_SESSION['currPage'];
					unset($_SESSION['currPage']);
					
					header('location:' . $nextPage);
					die();
				}
				else{
					header('location:../../../display/sites/site_index.php');
					die();
				}
			}
			else {
				$_SESSION['errState'] = ['fail','Incorrect credentials, please try again.'];
				try{
					$_SESSION['user'] = [$targUser['user_name'],$targUser['user_email']];
				}
				catch (Exception $e){
					$_SESSION['user'] = ['',$targUser['user_email']];
				}
				$_SESSION['currUser'] = new active_user_obj();
				try{ $_SESSION['currUser']->user_name = $targUser['user_name']; } catch(Exception $e){ ''; }
				$_SESSION['currUser']->user_email = $targUser['user_email'];
				
				try{
					array_unshift($_SESSION['user'],$targUser['user_name']);
				}
				catch (Exception $e){
					'';
				}
				
				header('location:../../../display/sites/site_login.php');
				die();
			}
		}
		else{
			$_SESSION['errState'] = ['fail','Could not find those credentials in the database.'];
			$_SESSION['user'] = ['',$uDet[0]];
			
			header('location:../../../display/sites/site_login.php');
			die();
		}
	}
?>
