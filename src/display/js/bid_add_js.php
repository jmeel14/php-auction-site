<?PHP
    echo "
    <script>
        function openBidForm(auc_ID){
            if(window.XMLHttpRequest){ var getXHR = new XMLHttpRequest; }
            else { var getXHR = new ActiveXObject('Microsoft.XMLHTTP'); }
            
            getXHR.open('GET', '../../control/functions/bids/get_bids.php?get_biggest&bid_auc=' + auc_ID, true);
            getXHR.send();
            
            getXHR.onreadystatechange = function() { 
                if(getXHR.readyState == 4){
                    if(getXHR.status == 200){
                        getElemID('bidAucID').value = auc_ID;
                        getElemID('bidAddIn').value = JSON.parse(getXHR.responseText).bid_biggest;
                        
                        getElemID('bidFContain').setAttribute('class','formContain open');
                    }
                }
            }
        }
    
        getElemID('bidAddConf').onclick = function(ev){
            ev.preventDefault();
            
            if(confirm('Are you sure you want to bid for this item?') == true){
                $.ajax({
                    url: '../../control/functions/bids/get_bids.php?set_biggest=' + getElemID('bidAucID').value + '&bid_amt=' + getElemID('bidAddIn').value,
                    success: function(result){
						if(result == 'success'){
							
							$('#auction_' + getElemID('bidAucID').value.toString()).find('.aucStartBid').html('<b>$</b> ' + getElemID('bidAddIn').value);
							console.log(result);
							
							getElemID('bidAucID').value = '';
							getElemID('bidAddIn').value = '';
                            
                            genErr(getElemID('bidAddErr'), 'pass', 'Your bid has been successfully added.');
							
							setTimeout(function(){
								getElemID('bidAddErr').innerHTML = '';
                                getElemID('bidFContain').setAttribute('class','formContain default');
							},5000);
						}
						else {
							genErr(getElemID('bidAddErr'), 'fail', 'Unfortunately, your bid was not added. Please ensure you have entered a value higher than the current bid.');
							
							setTimeout(function(){
								getElemID('bidAddErr').innerHTML = '';
							},5000);
						}
                    }
                });
            }
        }
        
        getElemID('bidAddCancel').onclick = function(ev){
            ev.preventDefault();
            
            getElemID('bidAucID').value = '';
            getElemID('bidAddIn').value = '';
            
            getElemID('bidFContain').setAttribute('class','formContain default');
        }
    </script>";
?>