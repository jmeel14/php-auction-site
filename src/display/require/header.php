<header>
	<div class='headerSeg' id='headerTitle'>
		Aucti.on - <?PHP echo $pTitle; ?>
	</div>
	<div class='headerSeg' id='userHead'>
		<?PHP if(isset($_SESSION['loggedIn'])): ?>
			<div class='userDat' id='user_name_head'>
				<?PHP 
					if($_SESSION['currUser']->user_name != ''){
						echo $_SESSION['currUser']->user_name;
					}
					else{
						if($_SESSION['currUser']->user_email != '') {
							echo $_SESSION['currUser']->user_email;
						}
					}
				?>
				</div>
		<?PHP else: ?>
			<div class='userDat'>Visitor</div>
		<?PHP endif; ?>
		<div class='userControl'>
			<?PHP if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true): ?>
				<div><a class='btn btn-danger' href='../../control/process/login/user_logout_process.php'>Logout</a></div>
			<?PHP elseif(!isset($_SESSION['loggedIn']) and $pTitle != 'Login'): ?>
				<div><a class='btn btn-primary' href='./site_login.php'>Login</a></div>
			<?PHP endif; ?>
		</div>
	</div>
</header>