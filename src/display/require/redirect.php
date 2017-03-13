<?PHP
	function doRedirect($notifDesc, $urlDesc, $targURL){
		echo "
			<div class='notif info'>$notifDesc $urlDesc</div>
			<script>setTimeout(function(){ window.location = '" . $targURL . "'; },5000);</script>
		";
	}
?>