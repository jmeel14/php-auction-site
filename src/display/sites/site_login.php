<?PHP
	require('../../control/objects/error/session_errors.php');
	session_start();
	
	$pTitle = "Login";
	
	require('../require/head.php');
		require('../require/header.php');
		require('../require/nav.php');
		
?>
	<?PHP if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] == true): ?>
		<?PHP if(isset($_SESSION['currPage'])): ?>
			<?PHP $nextPage = ["the previous page.",$_SESSION['currPage']]; unset($_SESSION['currPage']); ?>
		<?PHP else: ?>
			<?PHP $nextPage = ["the home page. ",'./site_index.php']; ?>
		<?PHP endif; ?>
		
		<?PHP echo "<div class='notif pass'>It looks like you have already signed in. Redirecting you to " . $nextPage[0] . "</div>"?>
		<?PHP echo "<script>setTimeout(function(){ window.location = '" . $nextPage[1] . "'; },5000);</script>"; ?>
		
	<?PHP else: ?>
		<?PHP if(isset($_SESSION['currPage'])): ?>
			<div class='notif info overhead'>Signing in will direct you back to <b><?PHP echo $_SESSION['currPage']; ?></b></div>
		<?PHP endif; ?>
		<div class='formContain' id='loginForm'>
			<form method='POST' action='../../control/process/login/user_login_process.php'>
				<div class='fBlock'>
					<div class='fBlockTitle'>Please fill in the following fields.</div>
					<?PHP checkErr('overhead fader'); ?>
					
					<div class='fBlockInner'>
					<?PHP if(isset($_SESSION['user'][0]) and $_SESSION['user'][0] != ''): ?>
						<input class='form-control' type='text' name='uNameL' placeholder='Username' value='<?PHP echo $_SESSION['user'][0]; ?>'/>
					<?PHP else: ?>
						<input class='form-control' type='text' name='uNameL' placeholder='Username' autofocus/>
					<?PHP endif; unset($_SESSION['user'][0]); ?>
					</div>
					
					<div class='fBlockInner'>
						<?PHP if(isset($_SESSION['user'][1])): ?>
							<input class='form-control' type='email' name='uEmailL' placeholder='Email' value='<?PHP echo $_SESSION['user'][1]; ?>'/>
						<?PHP else: ?>
							<input class='form-control' type='email' name='uEmailL' placeholder='Email' />
						<?PHP endif; unset($_SESSION['user']); ?>
					</div>
					
					<div class='fBlockInner'>
						<input class='form-control' type='password'name='uPWordL' placeholder='Password'/>
					</div>
					
					<div class='fBlockInner'>
						<input class='fSubmit btn btn-primary' type='submit' value='Login'/>
					</div>
				</div>
			</form>
		</div>
		
		<div class='formContain' id='regForm'>
			<form method='POST' action='../../control/process/login/user_register_process.php' id='reg_form'>
				<div class='fBlock'>
					<div class='fBlockTitle'>Alternatively, if you're new, or you need to create a new account, register here.</div>
					
					<div class='fBlockInner'>
						<input class='form-control' type='text' pattern='[a-zA-Z0-9]{5,18}' title='Your username should be at least 5 characters long, and no longer than 18.' name='uNameR' id='regUNameIn' placeholder='Username' />
					</div>
					
					<div class='fBlockInner'>
						<input class='form-control' type='email' name='uEmailR' id='regEmailIn' placeholder='Email' required />
					</div>
					
					<div class='fBlockInner'>
						<input class='form-control' type='password' name='uPWordR' id='regPassIn' placeholder='Password' />
					</div>
					
					<div class='fBlockInner'>
						<input type='submit' class='btn btn-default' id='regSubIn' value='Register' />
					</div>
				</div>
			</form>
			<script>
				function genErr(parElem,errStr){
					var errRect = document.createElement('div');
					errRect.setAttribute('class', 'notif fail under');
					
					errRect.innerHTML = errStr;
					
					parElem.appendChild(errRect);
					
					setTimeout(function(){
						errRect.setAttribute('class','notif fail under fader');
						
						setTimeout(function(){
							parElem.removeChild(errRect);
						},3000);
					},5000);
				}
				
				getElemID('regSubIn').addEventListener('click', function(ev){
					ev.preventDefault();
					
					var formElems = [getElemID('regUNameIn'),getElemID('regEmailIn'),getElemID('regPassIn')];
					
					var errState = 'OK';
					if(formElems[0].value.length > 0){
						if(formElems[0].value.length < 5 || formElems[0].value.length >= 18){
							genErr(formElems[0].parentElement,'Please ensure your username is at least 5 characters long, but shorter than 18.');
							errState = 'NO';
						}
					}
					if(formElems[1].value.length < 6){
						genErr(formElems[1].parentElement,'Please ensure that you have entered a valid email address.');
						errState = 'NO';
					}
					
					if(errState == 'OK'){
						getElemID('reg_form').submit();
					}
				});
			</script>
		</div>
	<?PHP endif; ?>
<?PHP
	require('../require/footer.php');
?>