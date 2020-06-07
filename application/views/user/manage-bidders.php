<!DOCTYPE html>
<html lang="en">
<head>

<!--User Page Meta Tags-->
<title>Manage Bidders | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<meta name="robots" content="noindex">
<!--User Page Meta Tags-->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/headerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</head>

<body class="gray">

<!-- Wrapper -->
<div id="wrapper">

<!--------------------------------------------------------------------------------------------------------------->
<div class="clearfix"></div>
<!--------------------------------------------------------------------------------------------------------------->


<!-- Dashboard Container -->
<!--------------------------------------------------------------------------------------------------------------->
<div class="dashboard-container">
<?php $this->load->view('user/includes/sidebar'); ?>
<!--------------------------------------------------------------------------------------------------------------->
	
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Manage Bidders</h3>
				<span class="margin-top-7">Bids for <a href="<?php echo base_url().'single_auction/'.$listingType.'/'.$listing_data[0]['id']; ?>"><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; else if(isset($listing_data[0]['tagline'])) echo $listing_data[0]['tagline']; ?></a></span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Manage Bidders</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-supervisor-account"></i> <?php echo count($bids).' Bidders'; ?></h3>
							<div class="sort-by">
								<select class="selectpicker hide-tick">
									<option>Highest First</option>
									<option>Lowest First</option>
									<option>Fastest First</option>
								</select>
							</div>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
								<!----Starts----->
								<?php foreach ($bids as $bid) { ?>
								<li>
									<!-- Overview -->
									<div id="manage_bidders" class="seller-overview manage-candidates">
										<div class="seller-overview-inner">

											<!-- Avatar -->
											<div class="seller-avatar">
												<div class="verified-badge"></div>
												<a href="#"><img src="<?php if(isset($bid['thumbnail'])) echo base_url().USER_UPLOAD.$bid['thumbnail']; ?>" alt=""></a>
											</div>

											<!-- Name -->
											<div class="seller-name">
												<h4><a href="#"><?php if(isset($bid['firstname'])) echo $bid['firstname'].' '.$bid['lastname']; ?> <img class="flag" src="images/flags/de.svg" alt="" title="<?php if(isset($bid['user_country'])) echo $bid['user_country']; ?>" data-tippy-placement="top"></a><span id="FirstStep" class="badge badge-success">Completed </span></h4>

												<!-- Details -->
												<?php if($settings[0]['hide_useremail'] === '1') { ?>
												<span class="seller-detail-item"><a href="#"><i class="icon-feather-mail"></i> <span id="FirstStep" class="badge badge-warning">Hidden </span></a></span>
												<?php } else { ?>
												<span class="seller-detail-item"><a href="#"><i class="icon-feather-mail"></i> <?php if(isset($bid['email'])) echo $bid['email']; ?></a></span>
												<?php } ?>

												<!-- Rating -->
												<div class="seller-rating">
													<div class="star-rating" data-rating="<?php if(isset($bid['ratings'])) echo $bid['ratings']; ?>"></div>
												</div>

												<!-- Bid Details -->
												<ul class="dashboard-task-info bid-info">
													<li><strong><?php if(isset($default_currency)) echo $default_currency; ?><?php if(isset($bid['bid_amount'])) echo $bid['bid_amount']; ?></strong><span>Bid Amount</span></li>
													<li><strong><?php if(isset($bid['nfd'])) echo $bid['nfd']; ?> Days</strong><span>Ago</span></li>
												</ul>

												<!-- Buttons -->
												<div class="buttons-to-right always-visible margin-top-25 margin-bottom-0">
													<a href="#small-dialog-1" data-bidid="<?php if(isset($bid['id'])) echo $bid['id']; ?>" data-bidder="<?php if(isset($bid['firstname'])) echo $bid['firstname'].' '.$bid['lastname']; ?>" data-thumbnail="<?php if(isset($bid['thumbnail'])) echo base_url().USER_UPLOAD.$bid['thumbnail']; ?>" data-ratings="<?php if(isset($bid['ratings'])) echo $bid['ratings']; ?>" class="popup-with-accept-bidders button ripple-effect"><i class="icon-material-outline-check"></i> Accept Bidder</a>
													<a href="#small-dialog-3" data-bidid="<?php if(isset($bid['id'])) echo $bid['id']; ?>" data-bidder="<?php if(isset($bid['firstname'])) echo $bid['firstname'].' '.$bid['lastname']; ?>" data-ownerid="<?php if(isset($bid['bidder_id'])) echo $bid['bidder_id']; ?>" class="popup-with-send-message button dark ripple-effect"><i class="icon-feather-mail"></i> Send Message</a>
													<a href="<?php echo base_url().'user/reject_bid/'.$bid['id']; ?>" class="button gray ripple-effect ico" title="Reject Bid" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
												</div>
											</div>
										</div>
									</div>
								</li>
								<!-------EnDs---->
								<?php } ?>

							</ul>
						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->

			<!----------------------------------------------------------------------------------------------------------->
			<?php $this->load->view('user/includes/footer'); ?>
			<!----------------------------------------------------------------------------------------------------------->

		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->

<!-----------------Common Models -------------------------------------------------------------------------------->
<?php $this->load->view('user/includes/models'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>