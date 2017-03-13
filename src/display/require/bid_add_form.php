<?PHP
    if(isset($_SESSION['errBidAdd'])){ echo "<div class='formContain open' id='bidFContain'>"; }
    else { echo "<div class='formContain default' id='bidFContain'>"; }
?>
	<form action='#' method='POST' id='bidForm'>
		<div id='bidAddErr'></div>
		<div class='fBlockInner'>
			<input type='hidden' value='<?PHP if(isset($_SESSION['errBidAdd'])){ echo $_SESSION['errBidAdd']->bid_auc_id; } ?>' id='bidAucID' />
			<input class='form-control' type='number' value='<?PHP if(isset($_SESSION['errBidAdd'])){ echo $_SESSION['errBidAdd']->bid_amt; } ?>' id='bidAddIn' />
			<button class='btn btn-primary' id='bidAddConf'>Submit</button>
			<button class='btn btn-default' id='bidAddCancel'>Cancel</button>
		</div>
	</form>
    
    <?PHP require('../js/bid_add_js.php'); ?>
</div>