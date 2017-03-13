<?PHP	
	function get_auctions_all(){
		global $conn;
		$sqlStr = 'SELECT * FROM auctions';
		
		$prep = $conn->prepare($sqlStr);
		$prep->execute();
		$result = $prep->fetchAll();
		$prep->closeCursor();
		
		return $result;
	}
	function get_auctions_min(){
		global $conn;
		$sqlStr = 'SELECT * FROM auctions LIMIT 5';
		
		$prep = $conn->prepare($sqlStr);
		$prep->execute();
		$result = $prep->fetchAll();
		$prep->closeCursor();
		
		return $result;
	}
	function get_auction($auctID){
		global $conn;
		$sqlStr = 'SELECT * FROM auctions WHERE auction_id = :auction_id;';
		
		$prep = $conn->prepare($sqlStr);
		$prep->bindValue(':auction_id', $auctID);
		$prep->execute();
		$result = $prep->fetch();
		$prep->closeCursor();
		
		return $result;
	}
	
	function del_auction($aucID){
		global $conn;
		$sqlStr = 'DELETE FROM auctions WHERE auction_ID = :auctionID';
		
		$prep = $conn->prepare($sqlStr);
		$prep->bindValue(':auctionID',$aucID);
		$prep->execute();
	}
	
	function add_auction($arr){
		global $conn;
		
		if(count($arr) == 7) {
			$sqlStr = "INSERT INTO auctions (
				auction_title,
				auction_description,
				auction_create_date,
				auction_start_date,
				auction_end_date,
				auction_bid_start,
				auction_avatar_name
			) VALUES (
				:auc_title,
				:auc_desc,
				:auc_CDate,
				:auc_SDate,
				:auc_EDate,
				:auc_bidStart,
				:auc_av_name
			);";
		}
		else{
			$sqlStr = "INSERT INTO auctions (
				auction_title,
				auction_description,
				auction_create_date,
				auction_start_date,
				auction_end_date,
				auction_bid_start
			) VALUES (
				:auc_title,
				:auc_desc,
				:auc_CDate,
				:auc_SDate,
				:auc_EDate,
				:auc_bidStart
			);";
		}
		
		$prep = $conn->prepare($sqlStr);
		$prep->bindValue(':auc_title',$arr[0]);
		$prep->bindValue(':auc_desc',$arr[1]);
		$prep->bindValue(':auc_CDate',$arr[2]);
		$prep->bindValue(':auc_SDate',$arr[3]);
		$prep->bindValue(':auc_EDate',$arr[4]);
		$prep->bindValue(':auc_bidStart',$arr[5]);
		if(count($arr) == 7){ $prep->bindValue(':auc_av_name',$arr[6]); }
		$result = $prep->execute();
		$prep->closeCursor();
		
		return [$result,$conn->lastInsertId()];
	}
	
	function modif_auction($arr){
		global $conn;
		
		if(count($arr) == 7) {
			$sqlStr = "UPDATE auctions SET
				auction_title= :auc_title,
				auction_description= :auc_desc,
				auction_start_date= :auc_SDate,
				auction_end_date= :auc_EDate,
				auction_bid_start= :auc_bidStart,
				auction_avatar_name= :auc_av_name
				WHERE auction_ID = :auc_ID
			;";
		}
		else{
			$sqlStr = "UPDATE auctions SET
				auction_title= :auc_title,
				auction_description= :auc_desc,
				auction_start_date= :auc_SDate,
				auction_end_date= :auc_EDate,
				auction_bid_start= :auc_bidStart
				WHERE auction_ID = :auc_ID
			;";
		}
		
		$prep = $conn->prepare($sqlStr);
		$prep->bindValue(':auc_title',$arr[0]);
		$prep->bindValue(':auc_desc',$arr[1]);
		$prep->bindValue(':auc_SDate',$arr[2]);
		$prep->bindValue(':auc_EDate',$arr[3]);
		$prep->bindValue(':auc_bidStart',$arr[4]);
		
		if(count($arr) == 7){
			$prep->bindValue(':auc_av_name',$arr[5]);
			$prep->bindValue(':auc_ID',$arr[6]);
		}
		else { $prep->bindValue(':auc_ID',$arr[5]);}
		$result = $prep->execute();
		$prep->closeCursor();
		
		return [$result,$conn->lastInsertId()];
	}
?>