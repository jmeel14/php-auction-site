<?PHP
	function get_biggest_bid($aucID){
        global $conn;
		$sqlStr = 'SELECT MAX(bid_amount) AS bid_biggest FROM bids INNER JOIN auctions ON bids.bid_auction_ID = auctions.auction_ID WHERE bids.bid_auction_ID = :auc_ID';
		
		$prep = $conn->prepare($sqlStr);
		$prep->bindValue(':auc_ID',$aucID);
		$prep->execute();
		$result = $prep->fetch();
		$prep->closeCursor();
		
		return $result;
	}
	
	function get_bids($aucID){
        global $conn;
		$sqlStr = 'SELECT * FROM bids INNER JOIN auctions ON bids.bid_auction_ID = auctions.auction_ID WHERE bids.bid_auction_ID = :auc_ID';
		
		$prep = $conn->prepare($sqlStr);
		$prep->bindValue(':auc_ID',$aucID);
		$prep->execute();
		$result = $prep->fetch();
		$prep->closeCursor();
		
		return $result;
	}
    
    function get_user_bids($bidderID){
        global $conn;
		$sqlStr = 'SELECT auctions.auction_title,auctions.auction_description,bids.bid_ID,bids.bid_amount FROM bids INNER JOIN auctions ON bids.bid_auction_ID = auctions.auction_ID WHERE bids.bidder_ID = :bidder_ID ORDER BY bids.bid_amount DESC;';
		
		$prep = $conn->prepare($sqlStr);
		$prep->bindValue(':bidder_ID',$bidderID);
		$prep->execute();
		$result = $prep->fetchAll();
		$prep->closeCursor();
		
		return $result;
    }
	function get_bid($auctionID,$bidderID){
		global $conn;
		$sqlStr = 'SELECT * FROM bids WHERE bid_auction_ID = :bid_auction AND bidder_ID = :bidder_ID';
		
		$prep = $conn->prepare($sqlStr);
		$prep->bindValue(':bidder_ID',$bidderID);
		$prep->bindValue(':bid_auction',$auctionID);
		$prep->execute();
		$result = $prep->fetch();
		$prep->closeCursor();
		
		return $result;
	}
    
    function add_bid($aucID, $bidAmt,$bidderID){
        global $conn;
        $sqlStr = 'INSERT INTO bids (bid_amount, bid_auction_ID, bidder_ID) VALUES (:bid_amt, :bid_auc, :bidder_ID);';
		
        $prep = $conn->prepare($sqlStr);
        $prep->bindValue(':bid_amt',$bidAmt);
        $prep->bindValue(':bid_auc',$aucID);
        $prep->bindValue(':bidder_ID',$bidderID);
        $result = $prep->execute();
        $prep->closecursor();
        
        return $result;
    }
	function set_bid($aucID,$bidAmt,$bidderID){
		global $conn;
        $sqlStr = 'UPDATE bids SET bid_amount = :bid_amt WHERE bid_auction_ID = :bid_auc AND bidder_ID = :bidder_ID;';
        
        $prep = $conn->prepare($sqlStr);
        $prep->bindValue(':bid_amt',$bidAmt);
        $prep->bindValue(':bid_auc',$aucID);
		$prep->bindValue(':bidder_ID',$bidderID);
        $result = $prep->execute();
        $prep->closecursor();
        
        return $result;
	}
    
    function del_bid($bidID,$bidderID){
        global $conn;
        $sqlStr = 'DELETE FROM bids WHERE bid_ID = :bid_ID AND bidder_ID = :bidder_ID';
        
        $prep = $conn->prepare($sqlStr);
        $prep->bindValue(':bid_ID',$bidID);
        $prep->bindValue(':bidder_ID',$bidderID);
        $result = $prep->execute();
        $prep->closeCursor();
        
        return $result;
    }
?>