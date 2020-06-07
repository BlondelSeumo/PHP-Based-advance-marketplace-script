<!-- Bid Acceptance Popup -->
<div id="small-dialog-1" class="zoom-anim-dialog mfp-hide dialog-with-tabs offer-accept">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab1">Accept Bids</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">

				

				<!-- Avatar -->
				<a id="avatarbids" href="#"></a>
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3 id="offer-from">Accept Bids From</h3>
				</div>

				<form name="acceptBidderForm" id="acceptBidderForm" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="o_bid_id" class="o_bid_id">
					<!-- Button -->
					<div id="acceptmsg"></div>
					<button class="margin-top-15 button full-width button-sliding-icon ripple-effect" type="submit">Accept <i class="icon-material-outline-arrow-right-alt"></i></button>
					<span id="loader" style="display:none;" class="text-center"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>

					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				</form>

			</div>

		</div>
	</div>
</div>
<!-- Bid Acceptance Popup / End -->


<!----Send message------------>
<div id="small-dialog-3" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab2">Send Message</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab2">

				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3 id="sendMessageh3"></h3>
				</div>
					
				<!-- Form -->
				<form name="msgOwnerForm" class="msgOwnerForm" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="owner_id" class="owner_id" value="<?php if(isset($userprofile[0]['user_id'])) echo $userprofile[0]['user_id']; ?>">
					<textarea name="txt_msg" class="txt_msg" cols="10" placeholder="Message" class="with-border" required></textarea>
					<input type="hidden" name="o_bid_id" class="o_bid_id">

					<!-- Button -->
					<div id="validationMsg"></div>
					<button class="button full-width button-sliding-icon ripple-effect" type="submit">Send <i class="icon-material-outline-arrow-right-alt"></i></button>

					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				</form>
				
			</div>

		</div>
	</div>
</div>
<!-- Send Direct Message Popup / End -->

<!-- Open Contract Popup-->
<div id="small-dialog-9" class="zoom-anim-dialog mfp-hide dialog-with-tabs offer-accept">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab1">Open Contract</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">

				<form id="openContractForm" name="openContractForm" action="<?php echo base_url().'user/open_contract'; ?>" method="POST">

					<input type="hidden" name="o_bid_id_cont" id="o_bid_id_cont">
					<input type="hidden" name="delivery_time" id="delivery_time">
					<!-- Welcome Text -->
					<div class="welcome-text">
						<h3 id="offer-from"></h3>
					</div>

					<div class="radio centerButtons">
						<input id="radio-1" name="radio" type="radio" required>
						<label for="radio-1"><span class="radio-label"></span>  I have read and agree to the Terms and Conditions</label>
					</div>

					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				</form>

				<!-- Button -->
				<button class="margin-top-15 button full-width button-sliding-icon ripple-effect" type="submit" form="openContractForm">Open Contract <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!-- Open Contract Popup / End -->


<!-- Offer Acceptance Popup-->
<div id="small-dialog-8" class="zoom-anim-dialog mfp-hide dialog-with-tabs offer-accept">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab1">Accept Offer</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">
				<form id="acceptOfferForm" name="acceptOfferForm" action="<?php echo base_url().'user/open_contract'; ?>" method="POST">
				
					<input type="hidden" name="offer_id" id="offer_id">
				
					<!-- Welcome Text -->
					<div class="welcome-text">
						<h3 class="offer-from">Accept Offer</h3>
						<div id="offer-amount" class="bid-acceptance margin-top-15">$3200</div>
						<br>
						<p align="left">By accepting this Offer, you are committing to sell <b> This Business </b> to <b><span id="customerName"></span></b> as per our <a href="<?php echo base_url() ?>page/terms-of-service">Terms and Conditions.</a> The Current Offer Price is <b><span id="bid_amount"></span></b>	</p>
						<br>
					</div>
					
					<div class="radio centerButtons">
						<div class="radio centerButtons">
						<input id="radio-1" name="radio" type="radio" required>
						<label for="radio-1"><span class="radio-label"></span>  I have read and agree to the <a href="<?php echo base_url() ?>page/terms-of-service">Terms and Conditions</a></label>
						</div>
					</div>

					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

				</form>

				<!-- Button -->
				<button class="margin-top-15 button full-width button-sliding-icon ripple-effect" type="submit" form="acceptOfferForm">Accept <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!-- Offer Acceptance Popup / End -->


<!----Deliver Popup------------>
<div id="small-dialog-7" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab2">Deliver</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab2">

				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Do you really want to deliver?</h3>
					<p>Once you deliver Buyer will be notified and waiting for his/her approval</p>
				</div>
					
				<!-- Form -->
				<form name="deliverForm" id="deliverForm" method="POST" enctype="multipart/form-data" action="<?php echo base_url().'main/markAsDelivered'; ?>">
					<input type="hidden" name="contract_id" value="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>">
					<textarea name="messagetoBuyer"></textarea>
					<div class="submit-field">
						<div class="uploadButton margin-top-30">
							<input class="uploadButton-input-visual" type="file" accept="image/*, application/pdf" id="uploadProof" name="uploadProof" />
							<label class="uploadButton-button ripple-effect" for="uploadProof">Upload Files</label>
							<span class="uploadButton-file-name-visual"><b>Visual Evidence of Revenue Screenshot or video walkthrough</b></span>
						</div>
					</div>

					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

				</form>
				
				<button class="button full-width button-sliding-icon ripple-effect" type="submit" form="deliverForm">Deliver Now <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!----Deliver Popup /Ends------------>

<!----Accept Delivery Popup------------>
<div id="small-dialog-4" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab2">Accept Delivery</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab2">

				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Do you really want to accept delivery?</h3>
					<p>Once you accept this deal will be closed and payment will be realsed to the Seller's account</p>
				</div>
					
				<!-- Form -->
				<form name="acceptDeliveryForm" id="acceptDeliveryForm" method="POST" enctype="multipart/form-data" action="<?php echo base_url().'main/markAsAccepted'; ?>">
					<input type="hidden" name="contract_id" value="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>">
					
					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				</form>
				
				<button class="button full-width button-sliding-icon ripple-effect" type="submit" form="acceptDeliveryForm">Accept Delivery <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!----Accept Delivery Popup /Ends------------>

<!----Request a revision Popup------------------------>
<div id="small-dialog-5" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab2">Request a Revision</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab2">

				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Do you really want to request a revision?</h3>
				</div>
					
				<!-- Form -->
				<form name="requestaRivisionForm" id="requestaRivisionForm" method="POST" enctype="multipart/form-data" action="<?php echo base_url().'main/requestaRivision'; ?>">
					<input type="hidden" name="contract_id" value="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>">
					<textarea name="messagetoBuyer"></textarea>

					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				</form>
				
				<button class="button full-width button-sliding-icon ripple-effect" type="submit" form="requestaRivisionForm">Request a Revision <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!----Request a revision /Ends------------>


<!------Leave a review Popup------>
<div id="small-dialog-2" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab2">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Leave a Review</h3>
					<span>Rate <a href="#"><?php if(isset($contract[0]['firstname'])) echo $contract[0]['firstname'] ?> <?php if(isset($contract[0]['lastname'])) echo $contract[0]['lastname']; ?></a> </span>
				</div>
					
				<!-- Form -->
				<form id="leave-review-form" name="leave-review-form" method="POST" enctype="multipart/form-data">

					<div class="feedback-yes-no">
						<strong>Your Rating</strong>
						<div class="leave-rating">
							<?php if(isset($reviewRatings[0]['id']) && $reviewRatings[0]['ratings'] === '5') { ?>
							<input type="radio" name="rating" id="rating-radio-1" value="5" required checked>
							<?php } else { ?>
							<input type="radio" name="rating" id="rating-radio-1" value="5" required>
							<?php }?>
							<label for="rating-radio-1" class="icon-material-outline-star"></label>
							<?php if(isset($reviewRatings[0]['id']) && $reviewRatings[0]['ratings'] === '4') { ?>
							<input type="radio" name="rating" id="rating-radio-2" value="4" required checked>
							<?php } else { ?>
							<input type="radio" name="rating" id="rating-radio-2" value="4" required>
							<?php }?>
							<label for="rating-radio-2" class="icon-material-outline-star"></label>
							<?php if(isset($reviewRatings[0]['id']) && $reviewRatings[0]['ratings'] === '3') { ?>
							<input type="radio" name="rating" id="rating-radio-3" value="3" required checked>
							<?php } else { ?>
							<input type="radio" name="rating" id="rating-radio-3" value="3" required>
							<?php }?>
							<label for="rating-radio-3" class="icon-material-outline-star"></label>
							<?php if(isset($reviewRatings[0]['id']) && $reviewRatings[0]['ratings'] === '2') { ?>
							<input type="radio" name="rating" id="rating-radio-4" value="2" required checked>
							<?php } else { ?>
							<input type="radio" name="rating" id="rating-radio-4" value="2" required>
							<?php }?>
							<label for="rating-radio-4" class="icon-material-outline-star"></label>
							<?php if(isset($reviewRatings[0]['id']) && $reviewRatings[0]['ratings'] === '1') { ?>
							<input type="radio" name="rating" id="rating-radio-5" value="1" required checked>
							<?php } else { ?>
							<input type="radio" name="rating" id="rating-radio-5" value="1" required>
							<?php }?>	
							<label for="rating-radio-5" class="icon-material-outline-star"></label>
						</div><div class="clearfix"></div>
					</div>

					<textarea class="with-border" placeholder="Comment" name="review_msg" id="review_msg" cols="7" required><?php if(isset($reviewRatings[0]['review'])) echo $reviewRatings[0]['review']; ?></textarea>
					<input type="hidden" name="review_user_id" id="review_user_id" value="<?php if(isset($userprofile[0]['user_id'])) echo $userprofile[0]['user_id']; ?>">
					<input type="hidden" name="review_id" id="review_id" value="<?php if(isset($reviewRatings[0]['id'])) echo $reviewRatings[0]['id']; ?>">
					<input type="hidden" name="review_type" id="review_type" value="user">

					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

				</form>
				
				<!-- Button -->
				<div id="reviewVal"></div>
				<button class="button full-width button-sliding-icon ripple-effect" type="submit" form="leave-review-form">Leave a Review <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!-- Leave a Review Popup / End -->

<!----Cancel Contract Popup------------>
<div id="small-dialog-6" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab2">Cancel Contract</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab2">

				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Do you really want to cancel this contract?</h3>
				</div>
					
				<!-- Form -->
				<?php if($this->session->userdata('user_level') !== '0') { ?>
				<form name="cancelcontractForm" id="cancelcontractForm" method="POST" enctype="multipart/form-data" action="<?php echo base_url().'main/requestaCancel'; ?>">
				<?php } else { ?>
				<form name="cancelcontractForm" id="cancelcontractForm" method="POST" enctype="multipart/form-data" action="<?php echo base_url().'main/requestaCanceladmin'; ?>">
				<?php } ?>
					<input type="hidden" name="contract_id" value="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>">
					<textarea name="messagetoBuyer"></textarea>
					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				</form>
				
				<button class="button full-width button-sliding-icon ripple-effect" type="submit" form="cancelcontractForm"> Cancel Contract<i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!----Cancel Contract Popup /Ends------------>
