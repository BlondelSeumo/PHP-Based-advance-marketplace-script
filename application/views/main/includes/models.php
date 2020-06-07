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
					<span>Rate <a href="#"><?php if(isset($userprofile[0]['firstname'])) echo $userprofile[0]['firstname'].' '.$userprofile[0]['lastname']; ?></a> </span>
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

				<!-- Avatar -->
				<a href="#"><img src="<?php if(isset($userprofile[0]['thumbnail'])) echo base_url().USER_UPLOAD.$userprofile[0]['thumbnail']; ?>" alt="" class="msgavatar centerButtons"></a>
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Direct Message To <?php if(isset($userprofile[0]['firstname'])) echo $userprofile[0]['firstname']; ?> <?php if(isset($userprofile[0]['lastname'])) echo $userprofile[0]['lastname']; ?></h3>
				</div>
					
				<!-- Form -->
				<form name="msgOwnerForm" class="msgOwnerForm" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="owner_id" class="owner_id" value="<?php if(isset($userprofile[0]['user_id'])) echo $userprofile[0]['user_id']; ?>">
					<textarea name="txt_msg" class="txt_msg" cols="10" placeholder="Message" class="with-border" required></textarea>

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

<!-- Place Bid popup  -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab">Place the Bid</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">
				
				<!-- Welcome Text -->
				<div id="bidDiv">
				<div class="welcome-text">
					<h3>Place Your Bid</h3>
					<br>
					<p align="left">By placing this bid, you are committing to buy <b><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?></b> from <b><?php if(isset($ownerData[0]['username'])) echo $ownerData[0]['username']; ?></b> as per our <a href="#">Terms and Conditions.</a> The Current Price is <b><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?><?php if(isset($currentPrice)) echo number_format(floatval($currentPrice)); ?></b></p>
					<br>
					<h3>Buyer Safety</h3>
					<br>
					<p align="left">Slippa recommends completing thorough due diligence before placing a bid on a listing. Make sure all claims (ownership, revenue, costs, traffic, etc.) are legitimate, and there are no hidden attributes associated to the asset. Ensure you ask all of your questions about the asset before bidding.As a safety measure and to protect your interest, please ensure all communication with the seller is conducted on Slippa.</p>
				</div>
					
				<!-- Form -->
				<form id="bid-now-form" method="post" enctype="multipart/form-data">

					<div class="input-with-icon-left">
						<i class="icon-feather-dollar-sign"></i>
						 <input type="text" id="bid_amount" name="bid_amount" value="" class="form-control required" placeholder="$ 2000" onkeypress='validateInputNumbers(event)' required>
						 <input type="hidden" name="bid_gap_value" id="bid_gap_value" value="<?php if(!empty($settings[0]['bid_value_gap'])) echo $settings[0]['bid_value_gap']; else echo 50;  ?>">
						 <input type="hidden" name="current_bid_value" id="current_bid_value" value="<?php if(isset($currentPrice)) echo ($currentPrice); ?>">
						 <input type="hidden" name="bid_owner_id" id="bid_owner_id" value="<?php if(isset($ownerData[0]['user_id'])) echo $ownerData[0]['user_id']; ?>">
						 <input type="hidden" name="bid_bidder_id" id="bid_bidder_id" value="<?php if(isset($userdata[0]['user_id'])) echo $userdata[0]['user_id']; ?>">
						 <input type="hidden" name="bid_listing_id" id="bid_listing_id" value="<?php if(isset($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
						 <input type="hidden" name="bid_listing_type" id="bid_listing_type" value="<?php if(isset($listing_data[0]['listing_type'])) echo $listing_data[0]['listing_type']; ?>">
					</div>

					<!-- Button -->
					<div id="bidValidation"></div>
					<button class="button margin-top-35 full-width button-sliding-icon ripple-effect margin-bottom-35" type="submit"><?php echo strtoupper('place the bid');  ?><i class="icon-material-outline-arrow-right-alt"></i></button>
					<span id="loader" style="display:none;" class="text-center"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>

					<?php if(!empty($listing_data[0]['website_buynowprice'])) { ?>

					<br><h2 class="centerButtons"><b>OR</b></h2>

					<a href="<?php echo base_url().'checkout/'.'buynow'.'/'.$listing_data[0]['id']; ?>" class="button full-width button-sliding-icon ripple-effect"><span>BUY IT NOW FOR $ <?php if(!empty($listing_data[0]['website_buynowprice'])) echo number_format($listing_data[0]['website_buynowprice']); ?></span></a>
					<?php } ?>

					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

				</form>

				</div>
				<!---/BidDiv---->
				

			</div>

		</div>
	</div>
</div>
<!-- Apply for a domains popup / End -->

<!---Bid Confirmation Popup -->
<div id="BidSuccessfull" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header text-center">
				<div class="icon-box">
					<!--<i class="material-icons">&#xE876;</i>-->
					<i class="fa fa-check"></i>
				</div>				
				<h4 class="modal-title centerButtons text-center">Awesome!</h4>	
			</div>
			<div class="modal-body">
				<p class="text-center">Your Bid has been sent to Owner. Once it's approved it will be listed on the page.</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>
<!---/Bid Confirmation Popup --> 

<!-- Bidding History popup  -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#bids">Bids History</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="bids">

				<!-----Bidding History ---->
				<div class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-group"></i> Bidding History</h3>
				</div>
				<?php if(!empty($validBids)) {
				foreach ($validBids as $bid) { ?>
				<ul class="boxed-list-ul">
					<li>
						<div class="bid">
							<!-- Avatar -->
							<div class="bids-avatar">
								<div class="seller-avatar">
									<div class="verified-badge"></div>
									<a href="single-seller-profile.html"><img src="<?php if(isset($bid['thumbnail'])) echo base_url().USER_UPLOAD.$bid['thumbnail']; ?>" alt=""></a>
								</div>
							</div>
							
							<!-- Content -->
							<div class="bids-content">
								<!-- Name -->
								<div class="seller-name">
									<h4><a href="#"><?php if(isset($bid['bidder_id'])) echo 'bidder_'.$bid['bidder_id'] ?> <img class="flag" src="<?php echo base_url().ICON_FLAGS ?><?php if(isset($bid['user_country'])) echo strtolower($bid['user_country']); ?>.svg" alt="" title="<?php if(isset($bid['user_country'])) echo strtoupper($bid['user_country']); ?>" data-tippy-placement="top"></a></h4>
									<div class="star-rating" data-rating="<?php if(isset($bid['ratings'])) echo $bid['ratings']; ?>"></div>
									<br>
									<?php if($currentPrice === $bid['bid_amount']) { ?>
									<span class="not-rated">HIGHEST</span>
									<?php }?>
								</div>
							</div>
							
							<!-- Bid -->
							<div class="bids-bid">
								<div class="bid-rate">
									<div class="rate"><?php echo $default_currency; ?> <?php if(isset($bid['bidder_id'])) echo number_format($bid['bid_amount']); ?></div>
									<span><?php if(isset($bid['ago'])) echo $bid['ago']; ?> </span>
								</div>
							</div>
						</div>
					</li>
				</ul>
				<?php } } ?>
				</div>
				</div>
				<!-----/END Bidding History ---->

			</div>

		</div>
</div>
<!--</div>-->
<!-- Bidding History / End -->

<!----Send message------------>
<div id="small-dialog-4" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab2">Send Message</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab2">

				<!-- Avatar -->
				<a href="#"><img src="<?php if(isset($ownerData[0]['thumbnail'])) echo base_url().USER_UPLOAD.$ownerData[0]['thumbnail']; ?>" alt="" class="msgavatar centerButtons"></a>
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Direct Message To <?php if(isset($ownerData[0]['firstname'])) echo $ownerData[0]['firstname']; ?> <?php if(isset($ownerData[0]['lastname'])) echo $ownerData[0]['lastname']; ?></h3>
				</div>
					
				<!-- Form -->
				<form name="msgOwnerForm" class="msgOwnerForm" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="owner_id" class="owner_id" value="<?php if(isset($ownerData[0]['user_id'])) echo $ownerData[0]['user_id']; ?>">
					<textarea name="txt_msg" class="txt_msg" cols="10" placeholder="Message" class="with-border" required></textarea>

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



<!----Report Listing------------>
<div id="small-dialog-5" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab2">Report Listing</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab2">

				<!-- Avatar Listing -->
				<a href="#"><img src="<?php if(isset($listing_data[0]['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$listing_data[0]['website_thumbnail']; ?>" alt="" class="msgavatar centerButtons"></a>
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Report Listing <?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?></h3>
				</div>
					
				<!-- Form -->
				<form name="ReportForm" id="ReportForm" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="listing_id" id="listing_id" value="<?php if(isset($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
					<textarea name="txt_reason" id="txt_reason" cols="10" placeholder="Why do you think this should be removed?" class="with-border" required></textarea>
					
					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				</form>
				
				<!-- Button -->
				<div id="validationMsg"></div>
				<button class="button full-width button-sliding-icon ripple-effect" type="submit" form="ReportForm">Send <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!----/Report Listing------------>

<!-- Place an Offer popup  -->
<div id="small-dialog-6" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab">Place the Offer</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">
				
				<!-- Welcome Text -->
				<div id="bidDiv">
				<div class="welcome-text">
					<h3>Place Your Offer</h3>
					<br>
					<p align="left">By placing this offer, you are committing to buy <b><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?></b> from <b><?php if(isset($ownerData[0]['username'])) echo $ownerData[0]['username']; ?></b> as per our <a href="#">Terms and Conditions.</a> The Minimum Offer that you can place is <b><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?><?php if(!empty($listing_data[0]['website_minimumoffer'])) echo number_format($listing_data[0]['website_minimumoffer']); else echo 0; ?></b></p>
					<br>
					<h3>Buyer Safety</h3>
					<br>
					<p align="left">Flippa recommends completing thorough due diligence before placing a bid on a listing. Make sure all claims (ownership, revenue, costs, traffic, etc.) are legitimate, and there are no hidden attributes associated to the asset. Ensure you ask all of your questions about the asset before bidding.As a safety measure and to protect your interest, please ensure all communication with the seller is conducted on Flippa.</p>
				</div>
					
				<!-- Form -->
				<form class="offer-now-form" method="post" enctype="multipart/form-data">

					<div class="input-with-icon-left">
						<i class="icon-feather-dollar-sign"></i>
						 <input type="text" name="offer_amount" value="" class="form-control required offer_amount" placeholder="$ 2000" onkeypress='validateInputNumbers(event)' required>
						 <input type="hidden" name="offer_min_value" class="offer_min_value" value="<?php if(!empty($listing_data[0]['website_minimumoffer'])) echo $listing_data[0]['website_minimumoffer'];  ?>">
						 <input type="hidden" name="listing_owner_id" value="<?php if(isset($ownerData[0]['user_id'])) echo $ownerData[0]['user_id']; ?>">
						 <input type="hidden" name="customer_id" value="<?php if(isset($userdata[0]['user_id'])) echo $userdata[0]['user_id']; ?>">
						 <input type="hidden" name="offer_listing_id" value="<?php if(isset($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
						 <input type="hidden" name="offer_listing_type" value="<?php if(isset($listing_data[0]['listing_type'])) echo $listing_data[0]['listing_type'] ?>">
					</div>

					<div class="input-with-icon-left">
						<h5>Leave a message to the owner (Optional) </h5>
						<textarea name="offer_msg" rows = "5" cols = "60" class="required with-border offer_msg"></textarea>
					</div>

					<!-- Button -->
					<div id="offerValidation"></div>
					<button class="button margin-top-35 full-width button-sliding-icon ripple-effect margin-bottom-35" type="submit"><?php echo strtoupper('Make the offer');  ?><i class="icon-material-outline-arrow-right-alt"></i></button>
					<span id="loaderoffer" style="display:none;" class="text-center"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>

					<?php if(!empty($listing_data[0]['website_buynowprice'])) { ?>

					<br><h2 class="centerButtons"><b>OR</b></h2>

					<!-- Button -->
					<a href="<?php echo base_url().'checkout/'.'buynow'.'/'.$listing_data[0]['id']; ?>" class="button margin-top-35 full-width button-sliding-icon ripple-effect"><span>BUY IT NOW FOR $ <?php if(!empty($listing_data[0]['website_buynowprice'])) echo number_format($listing_data[0]['website_buynowprice']); ?></span></a>
					<?php } ?>

					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

				</form>

				</div>
				<!---/BidDiv---->
				

			</div>

		</div>
	</div>
</div>
<!-- /Place an Offer popup  -->

<!---Bid Confirmation Popup -->
<div id="OfferSuccessfull" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<i class="fa fa-check"></i>
				</div>				
				<h4 class="modal-title centerButtons text-center">Awesome!</h4>	
			</div>
			<div class="modal-body">
				<p class="text-center">Your Offer has been sent to Owner.</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>
<!---/Bid Confirmation Popup --> 