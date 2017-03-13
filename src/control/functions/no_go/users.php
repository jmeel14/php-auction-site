<?PHP
	function get_users(){
		global $conn;
		$sqlSel = "SELECT * FROM users";

		$result = $conn->query($sqlSel);

		if($result){ return $result; }
			else { echo "An error occurred in the attempt to connect to the database. Please try again later."; }
	}

	function get_user_name($userName){
		global $conn;
		$sqlSel = "SELECT * FROM users WHERE user_name = :userName";

		$prepSql = $conn->prepare($sqlSel);
		$prepSql->bindValue(':userName',$userName);
		$prepSql->execute();
		$result = $prepSql->fetch();
		$prepSql->closeCursor();

		return $result;
	}
	
	
	function get_user_email($userEmail){
		global $conn;
		$sqlSel = "SELECT * FROM users WHERE user_email = :userEmail";

		$prepSql = $conn->prepare($sqlSel);
		$prepSql->bindValue(':userEmail',$userEmail);
		$prepSql->execute();
		$result = $prepSql->fetch();
		$prepSql->closeCursor();

		return $result;
	}
	
	function add_user_name($userDat){
		global $conn;
		$sqlStr = 'INSERT INTO users (user_rank_ID, user_name,user_email,user_pass_hash_salt,user_salt) VALUES (2,:userName, :userEmail, :userPWHashSalt,:userSalt)';
		$prepSql = $conn->prepare($sqlStr);
		$prepSql->bindValue(':userName',$userDat[0]);
		$prepSql->bindValue('userEmail',$userDat[1]);
		$prepSql->bindValue(':userPWHashSalt',$userDat[2]);
		$prepSql->bindValue(':userSalt',$userDat[3]);
		$prepSql->execute();
		$prepSql->closeCursor();
	}
	
	function add_user_email($userDat){
		global $conn;
		$sqlStr = 'INSERT INTO users (user_rank_ID,user_email,user_pass_hash_salt,user_salt) VALUES (2,:userEmail,:userPWHashSalt,:userSalt)';
		
		$prepSql = $conn->prepare($sqlStr);
		$prepSql->bindValue(':userEmail',$userDat[0]);
		$prepSql->bindValue(':userPWHashSalt',$userDat[1]);
		$prepSql->bindValue(':userSalt',$userDat[2]);
		$prepSql->execute();
		$prepSql->closeCursor();
	}
?>
