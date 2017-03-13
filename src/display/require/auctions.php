<?PHP
	require('../../control/dbConnect/dbLink.php');
	require('../../control/functions/auctions/auctions_fetch/auctions_fetch.php');
    require('../../control/functions/bids/bids_fetch/bids_fetch.php');
	
	require('date_display.php');
	require('modify_auct_auth.php');
?>

<?PHP if(isset($dispMethod)): ?>
	<?PHP if($dispMethod == 'min'):?>
		<section id='aucMin' class='aucts'>
			<?PHP forEach(get_auctions_min() as $auction_get): ?>
                <?PHP
                    $auc_start_date = new DateTime($auction_get['auction_start_date']);
                    $auc_end_date = new DateTime($auction_get['auction_end_date']);
                    $curr_date = new DateTime(date('Ymd'));
                    $days_to_start =  ($curr_date->diff($auc_start_date))->format('%R%a') + 0;
                    if($auc_end_date > $curr_date and $days_to_start < 1): ?>
                        <div class='auction' id='<?PHP echo 'auction_' . $auction_get['auction_ID']; ?>'>
                            <div class='auctTitle'><a href='./auction.php?view=<?PHP echo $auction_get['auction_ID']; ?>'><?PHP echo $auction_get['auction_title']; ?></a></div>
                            <div class='auctDet'>
                                <?PHP if(isset($auction_get['auction_avatar_name']) and $auction_get['auction_avatar_name'] != ''): ?>
                                    <div class='auctImg'><img src='../img/auctions/auction_<?PHP echo $auction_get['auction_ID'] . '/' . $auction_get['auction_avatar_name']; ?>'></div>
                                <?PHP else: ?>
                                    <div class='auctImg'><img src='../img/auctions/generic.png' draggable=false/></div>
                                <?PHP endif; ?>
                                <div class='auctDesc'><?PHP echo $auction_get['auction_description']; ?></div>
                                <div class='auctStartDate'>Auction started: <?PHP disp_date_set($auction_get['auction_start_date']); ?></div>
                                <div class='auctEndDate'>Auction ends: <?PHP disp_date_set($auction_get['auction_end_date']); ?></div>
                                <div class='aucStartBid'><b>$</b>
                                <?PHP
                                    if(get_biggest_bid($auction_get['auction_ID'])['bid_biggest'] != ''){ echo get_biggest_bid($auction_get['auction_ID'])['bid_biggest'];}
                                    else { echo $auction_get['auction_bid_start']; }
                                ?></div>
                                <?PHP check_auth($auction_get['auction_ID'],$auction_get['auction_title']); ?>
                            </div>
                        </div>
                    <?PHP endif; ?>
			<?PHP endforeach; ?>
		</section>
	<?PHP elseif($dispMethod == 'main'): ?>
		<section id='aucMain' class='aucts'>
			<?PHP forEach(get_auctions_all() as $auction_get): ?>
                <?PHP
                    $auc_start_date = new DateTime($auction_get['auction_start_date']);
                    $auc_end_date = new DateTime($auction_get['auction_end_date']);
                    $curr_date = new DateTime(date('Ymd'));
                    $days_to_start =  ($curr_date->diff($auc_start_date))->format('%R%a') + 0;
                    if($auc_end_date > $curr_date and $days_to_start < 1): ?>
                        <div class='auction'  id='<?PHP echo 'auction_' . $auction_get['auction_ID']; ?>'>
                            <div class='auctTitle'><a href='./auction.php?view=<?PHP echo $auction_get['auction_ID']; ?>'><?PHP echo $auction_get['auction_title']; ?></a></div>
                            <div class='auctDet'>
                                <?PHP if(isset($auction_get['auction_avatar_name']) and $auction_get['auction_avatar_name'] != ''): ?>
                                    <div class='auctImg'><img src='../img/auctions/auction_<?PHP echo $auction_get['auction_ID'] . '/' . $auction_get['auction_avatar_name']; ?>' /></div>
                                <?PHP else: ?>
                                    <div class='auctImg'><img src='../img/auctions/generic.png' /></div>
                                <?PHP endif; ?>
                                <div class='auctDesc'><?PHP echo $auction_get['auction_description']; ?></div>
                                <div class='auctStartDate'>Auction started: <?PHP disp_date_set($auction_get['auction_start_date']); ?></div>
                                <div class='auctEndDate'>Auction ends: <?PHP disp_date_set($auction_get['auction_end_date']); ?></div>
                                <div class='aucStartBid'><b>$</b>
                                    <?PHP
                                        if(get_biggest_bid($auction_get['auction_ID'])['bid_biggest'] != ''){ echo get_biggest_bid($auction_get['auction_ID'])['bid_biggest'];}
                                        else { echo $auction_get['auction_bid_start']; }
                                    ?></div>
                                <?PHP check_auth($auction_get['auction_ID'],$auction_get['auction_title']); ?>
                            </div>
                        </div>
                <?PHP endif; ?>
			<?PHP endforeach; ?>
		</section>
	<?PHP endif; ?>
    
    <?PHP check_auth_form(); ?>
<?PHP endif; ?>