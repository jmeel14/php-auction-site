		<nav>
			<div class='navElem'><a class='navLink' href='./site_index.php'>Home</a></div>
			<div class='navElem'>
				<div class='navLink'>Auctions</div>
				<div class='navDrop'>
					<div class='subNav'><a class='navLink' href='./auctions_index.php'>View</a></div>
					<?PHP if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true): ?>
						<div class='subNav'><a class='navLink' href='./auctions_index.php?add'>Add</a></div>
					<?PHP endif; ?>
				</div>
			</div>
			
			<?PHP if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true): ?>
				<div class='navElem'><a class='navLink' href='./user_config.php'>Settings</a></div>
			<?PHP endif; ?>
		</nav>