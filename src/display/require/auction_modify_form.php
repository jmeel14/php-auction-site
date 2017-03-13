 <?PHP
	if(isset($_SESSION['errModifList'])){
		echo '<div class=\'formContain open\' id=\'edit_form\'>';
	}
	else { echo '<div class=\'formContain default\' id=\'edit_form\'>'; }
?>
	<script>        
		function open_form(){
			getElemID('edit_form').setAttribute('class','formContain open');
		}
		
		function emptyForm(){
			getElemID('modif_auc_titleIn').value = '';
			getElemID('modif_auc_descIn').value = '';
			getElemID('modif_auc_dateSIn').value = '';
			getElemID('modif_auc_dateEIn').value = '';
			getElemID('modif_auc_bidSIn').value = '';
		}
		function close_form(ev){
			ev.preventDefault();
			getElemID('edit_form').setAttribute('class','formContain default');
		}
		function fill_form(auc_ID){
			open_form();
            var form_dat = '';
            
			if(XMLHttpRequest){ var auc_file_get_req = new XMLHttpRequest; var auc_bids_req = new XMLHttpRequest; }
			else { var auc_file_get_req = new ActiveXObject('MSXML2.XMLHTTP.3.0'); var auc_bids_req = new ActiveXObject('MSXML2.XMLHTTP.3.0'); }
			auc_file_get_req.open('GET',"../../control/functions/auctions/get_auction.php?get=" + auc_ID,true);
			auc_file_get_req.send();
            
            auc_file_get_req.onreadystatechange = function(){
                if(auc_file_get_req.status == '200' && auc_file_get_req.readyState == 4){
                    form_dat = JSON.parse(auc_file_get_req.responseText);
					
					getElemID('aucID_in').value = form_dat['auction_ID'];
                    getElemID('modif_auc_titleIn').value = form_dat['auction_title'];
                    getElemID('modif_auc_descIn').value = form_dat['auction_description'];
					
                    getElemID('modif_auc_dateSIn').value = form_dat['auction_start_date'];
                    getElemID('modif_auc_dateEIn').value = form_dat['auction_end_date'];
					setFormDate(getElemID('modif_auc_dateSIn'));
					setFormDate(getElemID('modif_auc_dateEIn'));
                }
            }
            
            auc_bids_req.open('GET','../../control/functions/bids/get_bids.php?get_biggest&bid_auc=' + auc_ID,true);
            auc_bids_req.send();
            
            auc_bids_req.onreadystatechange = function(){
                if(auc_bids_req.readyState == 4){
                    if(auc_bids_req.status == 200){
                        getElemID('modif_auc_bidSIn').value = JSON.parse(auc_bids_req.responseText).bid_biggest;
                    }
                }
            }
        }
        
		function conf_del(ev,aucID,aucTitle){
			sec_elem = ev.target.parentElement.parentElement.parentElement.parentElement;
			auc_elem = ev.target.parentElement.parentElement.parentElement;
			del_prompt = confirm('Are you sure you want to delete auction ' + aucTitle + '?');
			
			if(del_prompt == true){
				
				auc_file_del_req = $.ajax({
					url: "../../control/functions/auctions/del_auction.php?del=" + aucID,
					success: function(result){
						if(result == 'Pass'){
							$(auc_elem).hide();
						}
					}
				});
			}
		}
		
		dispDateStr = 'Format is YYYY-MM-DD';
		
		function checkTypeElem(parElem,targElem,targType,dispStr){
			if(targElem.type != targType){
				
				newElem = document.createElement('div');
				newElem.setAttribute('class', 'notif info under');
				newElem.innerHTML = dispStr;
			
				parElem.appendChild(newElem);
			}
		}
	</script>
	
	<form method='POST' action='../../control/process/auctions/auction_edit_process.php' enctype="multipart/form-data" id="editForm">
		<div class='fBlock'>
			<div class='fTitle'>Modify an auction</div>
			
			<input name='auc_ID' id='aucID_in' type='hidden' value='' />
			<?PHP checkErr('overhead'); ?>
			<div class='fBlockInner'>
				<?PHP if(isset($_SESSION['auc_modif_attempt'])): ?>
					<input class='form-control' type='text' name='modif_auc_title' placeholder='Name' id='modif_auc_titleIn'
						title='Must be at least 5 characters, but no bigger than 95
							Consider the following:
							-  Letters A - Z upper or lower-case,
							-  Numbers 0 - 9 in any order,
							-  Characters , . : &#39; !'
						pattern='[a-zA-Z0-9\s,\.;:()&#39;!]{5,95}' value='<?PHP echo htmlentities($_SESSION['auc_modif_attempt']->auc_title); ?>' />
				<?PHP else: ?>
					<input class='form-control' type='text' name='modif_auc_title' placeholder='Name' id='modif_auc_titleIn'
						title='Must be at least 5 characters, but no bigger than 95
							Consider the following:
							-  Letters A - Z upper or lower-case,
							-  Numbers 0 - 9 in any order,
							-  Characters , . : &#39; !'
						pattern='[a-zA-Z0-9\s,\.;:()&#39;!]{5,95}' value='' />
				<?PHP endif; ?>
				<?PHP  checkErrList('over','errModifList','aucTitleErr'); ?>
			</div>
			<?PHP echo "\f"; ?>
			<div class='fBlockInner'>
				<?PHP if(isset($_SESSION['auc_modif_attempt'])): ?>
					<input class='form-control' name='modif_auc_desc' id='modif_auc_descIn'
						title='Must be at least 20 characters, but no bigger than 280
							Consider the following:
							-  Letters A - Z upper or lower-case,
							-  Numbers 0 - 9 in any order,
							-  Characters , . : &#39; &quot; !'
						pattern='[a-zA-Z0-9\s,\.;:()&#39;&quot;!]{20,280}'  value='<?PHP echo htmlentities($_SESSION['auc_modif_attempt']->auc_desc); ?>' />
				<?PHP else: ?>
					<input class='form-control' name='modif_auc_desc' id='modif_auc_descIn' title='Must be at least 20 characters, but no bigger than 280
							Consider the following:
							-  Letters A - Z upper or lower-case,
							-  Numbers 0 - 9 in any order,
							-  Characters , . : &#39; &quot; !'
						pattern='[a-zA-Z0-9\s,\.;:()&#39;&quot;!]{20,280}' value='' />
				<?PHP endif; ?>
				<?PHP  checkErrList('over','errModifList','aucDescErr'); ?>
			</div>
			
			<div class='fBlockInner formDate' id='modif_auc_dateS_cont'>
				Start date:
				<?PHP if(isset($_SESSION['auc_modif_attempt'])): ?>
					<input  class='form-control' type='date' name='modif_auc_dateS' id='modif_auc_dateSIn' value='<?PHP echo $_SESSION['auc_modif_attempt']->auc_start_date; ?>' />
				<?PHP else: ?>
					<input  class='form-control' type='date' name='modif_auc_dateS' id='modif_auc_dateSIn' value='' />
				<?PHP endif; ?>
				<script>
					var dateS = $('#modif_auc_dateS').datepicker({dateFormat:'y-mm-dd'});
				</script>
				<?PHP  checkErrList('over','errModifList','startDateErr'); ?>
			</div>
			
			<div class='fBlockInner formDate' id='modif_auc_dateE_cont'>
				End date:
				<?PHP if(isset($_SESSION['auc_modif_attempt'])): ?>
					<input  class='form-control' type='date' name='modif_auc_dateE' id='modif_auc_dateEIn' value='<?PHP echo $_SESSION['auc_modif_attempt']->auc_end_date; ?>' />
				<?PHP else: ?>
					<input  class='form-control' type='date' name='modif_auc_dateE' id='modif_auc_dateEIn' value='' />
				<?PHP endif; ?>
				<script>
					dateE = $('#modif_auc_dateE').datepicker({dateFormat:'y-mm-dd'});
				</script>
				<?PHP  checkErrList('over','errModifList','endDateErr'); ?>
			</div>
			
			<div class='fBlockInner'>
				<?PHP if(isset($_SESSION['auc_modif_attempt'])): ?>
					<b>$</b><input class='form-control' type='number' name='modif_auc_startBid' id='modif_auc_bidSIn' placeholder='Starting...' value='<?PHP echo $_SESSION['auc_modif_attempt']->auc_start_bid; ?>' />
				<?PHP else: ?>
					<b>$</b><input class='form-control' type='number' name='modif_auc_startBid' id='modif_auc_bidSIn' placeholder='Starting...' value='' />
				<?PHP endif; ?>
				<?PHP  checkErrList('over','errModifList','startBidErr'); ?>
			</div>
			
			<div class='fBlockInner'>
				<input type='file' name='modif_auc_av' />
				<?PHP  checkErrList('over','errModifList','aucAvErr'); ?>
			</div>
			<div class='fBlockInner'>
				<input class='btn btn-primary' type='submit' value='Change' id='aucModifSubIn'/>
				<button class='btn btn-default' onclick ='close_form(event); emptyForm(this)'>Cancel</button>
			</div>

			<script>
			
				formReady = 'NO';
				function setFormDate(elem){
					if(elem.type != 'date'){
						var dateRaw = elem.value;
						var dateExpress =/([0-9][0-9][0-9][0-9])\b[^0-9]\b([0-9][0-9])\b[^0-9]\b([0-9][0-9])/.exec(dateRaw);
						
						elem.value = dateExpress[2] + '/' + dateExpress[2] + '/' + dateExpress[1];
					}
					else formReady = 'YES';
				}
				
				function getFormDate(elem){
					if(elem.type != 'date'){
						var dateRaw = elem.value;
						var dateExpress = /([0-9][0-9])\b[^0-9]\b([0-9][0-9])\b[^0-9]\b([0-9][0-9][0-9][0-9])/.exec(dateRaw);
						
						try{
							var dateStr = dateExpress[3] + '-' + dateExpress[1] + '-' + dateExpress[2];
							elem.value = dateStr;
							
							formReady = 'YES';
						}
						catch(err){
							var dateExpress = /([0-9][0-9][0-9][0-9])\b[^0-9]\b([0-9][0-9])\b[^0-9]\b([0-9][0-9])/.exec(dateRaw);
							
							try{
								var dateStr = dateExpress[1] + '-' + dateExpress[2] + '-' + dateExpress[3];
								elem.value = dateStr;
								
								formReady = 'NO';
							}
							catch(err2){
								elem.value = 'Please insert a valid date in the format MM/DD/YYYY';
								formReady = 'NO';
							}
						}
					}
					else {
						formReady = 'YES';
					}
				}
			
				getElemID('aucModifSubIn').addEventListener('click',function(ev){
					ev.preventDefault();
					
					getFormDate(getElemID('modif_auc_dateSIn'));
					getFormDate(getElemID('modif_auc_dateEIn'));
					
					if(formReady == 'YES'){
							setTimeout(function(){
								getElemID('editForm').submit();
							},150);
						}
				});				
			</script>
			
			<?PHP
				if(isset($_SESSION['errModifList'])){ unset($_SESSION['errModifList']); }
				if(isset($_SESSION['auc_modif_attempt'])){ unset($_SESSION['auc_modif_attempt']); }
			?>
		</div>
	</form>
</div>