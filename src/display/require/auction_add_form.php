<div class='formContain' id='add_form'>
	<form method='POST' action='../../control/process/auctions/auction_add_process.php' enctype="multipart/form-data" id='addForm'>
		<div class='fBlock'>
			<div class='fTitle'>Add an auction</div>
			<script>
				dispDateStr = 'Format is YYYY-MM-DD';
				
				function checkTypeElem(parElem,targElem,targType,dispStr,defDate){
					if(targElem.type != targType){
						
						newElem = document.createElement('div');
						newElem.setAttribute('class', 'notif info under');
						newElem.innerHTML = dispStr;
						
						parElem.appendChild(newElem);
						
						switch(targType){
							case 'date':
								if(targElem.type != targType){
									$('#' + targElem.id).datepicker({dateFormat:'yy-mm-dd',defaultDate: defDate});
								}
						}
					}
				}
			</script>
			
			<div class='fBlockInner'>
				<?PHP  checkErrList('over','errList','aucTitleErr'); ?>
				<?PHP if(isset($_SESSION['auc_attempt']->auc_title)): ?>
					<input class='form-control' type='text' name='auctTitle' placeholder='Name' id='auctTitleIn' value='<?PHP echo $_SESSION['auc_attempt']->auc_title; ?>' 
					title='Must be at least 5 characters, but no bigger than 95
					Consider the following:
					-  Letters A - Z upper or lower-case,
					-  Numbers 0 - 9 in any order,
					-  Characters , . : &#39;' pattern='[a-zA-Z0-9\s,.;:()&#39;]{5,95}'/>
					<?PHP unset($_SESSION['auc_attempt']->auction_title); ?>
				<?PHP else: ?>
					<input class='form-control' type='text' name='auctTitle' placeholder='Name' id='auctTitleIn' 
					title='Must be at least 5 characters, but no bigger than 95
					Consider the following:
					-  Letters A - Z upper or lower-case,
					-  Numbers 0 - 9 in any order,
					-  Characters , . : &#39;' pattern='[a-zA-Z0-9\s,.;:()&#39;]{5,95}' required/>
				<?PHP endif; ?>
			</div>
			
			<div class='fBlockInner'>
				<?PHP  checkErrList('over','errList','aucDescErr'); ?>
				<?PHP if(isset($_SESSION['auc_attempt']->auc_desc)): ?>
					<input class='form-control' type='text' name='auctDesc' placeholder='Description' id='auctDescIn'
					title='Must be at least 20 characters, but no bigger than 280
					Consider the following:
					-  Letters A - Z upper or lower-case,
					-  Numbers 0 - 9 in any order,
					-  Characters , . : &#39; &quot; !' pattern='[a-zA-Z0-9\s,.;:()&#39;&quot;!]{20,280}' value='<?PHP echo $_SESSION['auc_attempt']->auc_desc; ?>'/>
					<?PHP unset($_SESSION['auc_attempt']->auction_desc); ?>
				<?PHP else: ?>
					<input class='form-control' type='text' name='auctDesc' placeholder='Description' id='auctDescIn' 
					title='Must be at least 20 characters, but no bigger than 280
					Consider the following:
					-  Letters A - Z upper or lower-case,
					-  Numbers 0 - 9 in any order,
					-  Characters , . : &#39; &quot; !' pattern='[a-zA-Z0-9\s,.;:()&#39;&quot;!]{20,280}' required />
				<?PHP endif; ?>
			</div>
			<div class='fDateContain'>
				<div class='fBlockInner formDate' id='aucStartDateInCont'>
					<?PHP checkErrList('over','errList','startDateErr'); ?>
					Start date:
					<?PHP if(isset($_SESSION['auc_attempt']->auc_start_date)): ?>
						<input class='form-control' type='date' name='auctStartDate' id='auctStartDateIn' />
						<script> 
							checkTypeElem(getElemID('aucStartDateInCont'),getElemID('auctStartDateIn'),'date',dispDateStr, new Date(<?PHP echo "'" . $_SESSION['auc_attempt']->auc_start_date . "'"; ?>));
						</script>
						<?PHP unset($_SESSION['auc_attempt']->auc_start_date); ?>
					<?PHP else: ?>
						<input class='form-control' type='date' name='auctStartDate' id='auctStartDateIn' required />
						<script> 
							checkTypeElem(getElemID('aucStartDateInCont'),getElemID('auctStartDateIn'),'date',dispDateStr, new Date());
						</script>
					<?PHP endif; ?>
					
				</div>
				<div class='fBlockInner formDate' id='aucEndDateInCont'>
					<?PHP checkErrList('over','errList','endDateErr');?>
					End date:
					<?PHP if(isset($_SESSION['auc_attempt']->auc_end_date)): ?>
						<input class='form-control' type='date' name='auctEndDate'  id='auctEndDateIn'/>
						
						<script>
							checkTypeElem(getElemID('aucEndDateInCont'),getElemID('auctEndDateIn'),'date',dispDateStr, new Date(<?PHP echo "'" . $_SESSION['auc_attempt']->auc_end_date . "'"; ?>));
						</script>
						<?PHP unset($_SESSION['auc_attempt']->auc_end_date); ?>
					<?PHP else: ?>
						<input class='form-control' type='date' name='auctEndDate'  id='auctEndDateIn' required />
						
						<script>
							checkTypeElem(getElemID('aucEndDateInCont'),getElemID('auctEndDateIn'),'date',dispDateStr, new Date());
						</script>
					<?PHP endif; ?>
				</div>
			</div>
			<div class='fBlockInner'>
				<?PHP  checkErrList('over','errList','startBidErr'); ?>
				<?PHP if(isset($_SESSION['auc_attempt']->auc_start_bid)): ?>
				<b>$</b><input class='form-control' type='number' name='auctStartBid' placeholder='Starting...' id='aucStartBidIn' value='<?PHP echo $_SESSION['auc_attempt']->auc_start_bid; ?>'/>
				<?PHP unset($_SESSION['auc_attempt']->auc_start_bid); ?>
				<?PHP else: ?>
					<b>$</b><input class='form-control' type='number' name='auctStartBid' placeholder='Starting...' min="15" maximum='75000' id='aucStartBidIn' required/>
				<?PHP endif; ?>
			</div>
			<div class='fBlockInner'>
				<?PHP checkErrList('over','errList','aucAvErr');?>
				<?PHP if(isset($_SESSION['auc_attempt']->auc_image)): ?>
					<input class='form-control' type='file' name='auctAvatar' value='<?PHP echo $_FILES['file']['name']; ?>'>
				<?PHP else: ?>
					<input class='form-control' type='file' name='auctAvatar'/>
				<?PHP endif; ?>
			</div>
			<?PHP 
				if(isset($_SESSION['errList'])){ unset($_SESSION['errList']); }
				if(isset($_SESSION['auc_attempt'])){ unset($_SESSION['auc_attempt']); }
			?>
			
			<div class='fBlockInner'>
				<input type='submit' value='Add' class='btn btn-default' id='aucAddSubIn'/>
			</div>
			
			<script>
				var formReady = 'NO';
				getElemID('aucAddSubIn').addEventListener('click',function(ev){
						ev.preventDefault();
						
						setTimeout(function(){
							getElemID('addForm').submit();
						},150);
					});
			</script>
		</div>
	</form>
</div>