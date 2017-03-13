<?PHP
	session_start();
	require('../../dbConnect/dbLink.php');
	require('../../functions/no_go/users.php');

	  $userNameSet = '';

	if(isset($_POST['uEmailR'])){
		if(isset($_POST['uPWordR'])){
			$randSalt = rand(100,75800);
			$uPWord = hash('md5',$_POST['uPWordR']) . $randSalt;
			$uEmail = $_POST['uEmailR'];
			
			if(isset($_POST['uNameR'])){
				$uName = $_POST['uNameR'];  add_user_name([$uName,$uEmail,$uPWord,$randSalt]);
				$_SESSION['errState'] = ['pass','Registration successful. Please sign in.'];
				
				header('location:../../../display/sites/site_login.php');
				exit();
			}
			else{
				$uEmail = $_POST['uEmailR']; add_user_email([$uEmail,$uPWord,$randSalt]);
				$_SESSION['errState'] = ['pass','Registration successful. Please sign in.']; 
				
				header('location:../../../display/sites/site_login.php');
				exit();
			}
		}
	}
?>
