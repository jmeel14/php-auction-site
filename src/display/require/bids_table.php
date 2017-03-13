<?PHP if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn'] == true): ?>
    <?PHP
        require('../../control/dbConnect/dbLink.php');
        
        require('../../control/functions/auctions/auctions_fetch/auctions_fetch.php');
        require('../../control/functions/bids/bids_fetch/bids_fetch.php');
    ?>
    <div class='tblBidsContain'>
        <div class='bidsTbl'>
            <div class='tblRow tblHead'>
                <div class='tblDat tAucTitle'>Auction Title</div>
                <div class='tblDat tAucDesc'>Auction Description</div>
                <div class='tblDat tAucBid'>Bidded</div>
            </div>
            <?PHP 
				$rowCount = 0;
				forEach(get_user_bids($_SESSION['currUser']->user_ID) as $uBid): ?>
					<?PHP $rowCount = $rowCount + 1; ?>
					<div class='tblRow tBidRow <?PHP if($rowCount % 2 == 0){ echo 'rowLight'; }?>'>
						<div class='tblDat tAucTitle'><?PHP echo $uBid['auction_title']; ?></div>
						<div class='tblDat tAucDesc'><?PHP echo $uBid['auction_description']; ?></div>
						<div class='tblDat tAucBid'><b><?PHP echo $uBid['bid_amount']; ?></b></div>
						<div class='tblDat tBidRem'><button class='tBidRemBtn' id='<?PHP echo $uBid['bid_ID'];?>'>Delete</button></div>
					</div>
            <?PHP endforeach; ?>
        </div>
        
        <script>
            $('.tBidRemBtn').click(function(ev){
				if(confirm('Are you sure you want to delete this bid?')){
					$.ajax({
						url: '../../control/functions/bids/get_bids.php?del_biggest=' + ev.target.id,
						success: function(){
							ev.target.parentNode.parentNode.parentNode.removeChild(ev.target.parentNode.parentNode);
						}
					});
				}
			});
        </script>
    </div>
<?PHP endif; ?>