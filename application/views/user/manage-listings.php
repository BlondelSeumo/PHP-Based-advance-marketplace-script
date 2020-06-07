<!DOCTYPE html>
<html lang="en">
<head>

<!--User Page Meta Tags-->
<title>Manage Listings | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
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
				<h3>Manage Auction Listings</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Manage Listings</li>
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
							<h3><i class="icon-material-outline-assignment"></i> My Listings</h3>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
								<?php if(!empty($websitelistings)) { foreach ($websitelistings as $listing) { 

								if(in_array($listing['listingType'],array_column($platforms,'platform'))) { 
								
								?>
								
								<?php if($listing['sold_status'] === '1') { ?>	
								<li class="disabledBox">
								<?php } else { ?>
								<li>
								<?php } ?>
									<!-- Listing -->
									<div class="domains-listing width-adjustment">

										<!-- Listing Details -->
										<div class="domains-listing-details">

											<!-- Details -->
											<div class="domains-listing-description">
												<h3 class="domains-listing-title"><a href="<?php echo base_url().'single_auction/'.$listing['listingType'].'/'.$listing['id']; ?>"><?php if(isset($listing['website_BusinessName'])) echo $listing['website_BusinessName']; else if(isset($listing['tagline'])) echo $listing['tagline']; ?></a> <span class="dashboard-status-button green"><?php if(isset($listing['listingType'])) echo strtoupper($listing['listingType']); ?></span> <?php if($listing['sold_status'] === '0') { if($listing['status'] === '1')  { ?> <span class="dashboard-status-button green">ACTIVE</span></h3> <?php } else if ($listing['status'] === '3') { ?> <span class="dashboard-status-button yellow">EXPIRED</span> <?php } else if ($listing['status'] === '2') {?> <span class="dashboard-status-button red">SUSPENDED</span> <?php } } else { ?> <span class="dashboard-status-button yellow">SOLD</span> <?php } ?>

												<!-- domains Listing Footer -->
												<div class="domains-listing-footer">
													<ul>
														<li><i class="icon-material-outline-access-time"></i> <?php if(!empty($listing['endingdays'])) echo $listing['endingdays']; ?> days, <?php if(!empty($listing['endinghours'])) echo $listing['endinghours']; ?> hours left</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									
									<!-- Task Details -->
									<ul class="dashboard-task-info">
										<li><strong><?php echo $listing['activecount']; ?></strong><span>Active Bids</span></li>
										<li><strong><?php if(!empty($default_currency)) echo $default_currency; else echo '$ '; ?> <?php if(isset($listing['averageBid'])) echo ($listing['averageBid']); else echo '0'; ?></strong><span>Avg. Bid</span></li>
										<li><strong><?php echo $listing['inactivecount']; ?></strong><span>Inactive Bids</span></li>
										<li><strong><?php echo $listing['rejectedcount']; ?></strong><span>Rejected Bids</span></li>
										<li><strong><?php if(!empty($default_currency)) echo $default_currency; else echo '$ '; ?> <?php echo $listing['highestbid']; ?></strong><span>Highest Bid</span></li>
										<li><strong><?php echo $listing['highestbidder']; ?></strong><span>Highest Bidder</span></li>
										<?php if($listing['highestbidrow'] > $listing['reservedprice']) { ?>
										<li><strong> YES </strong><span>Reserve Met</span></li>
										<?php } else { ?>
										<li><strong> NO </strong><span>Reserve Met</span></li>	
										<?php }?>
									</ul>
									<!-- Buttons -->
									<div class="buttons-to-right always-visible margin-top-60">
										<a href="<?php echo base_url().'/user/manage_bidders/'.$listing['listingType'].'/'.$listing['id'] ?>" class="button ripple-effect"><i class="icon-material-outline-supervisor-account"></i> Approve Bidders <span class="button-info"><?php if(isset($listing['totalBidders'])) echo $listing['totalBidders'];?></span></a>
										<a href="<?php echo base_url().'/user/manage_bids/'.$listing['listingType'].'/'.$listing['id'] ?>" class="button ripple-effect"><i class="icon-material-outline-supervisor-account"></i> Manage Bids <span class="button-info"><?php if(isset($listing['totalBids'])) echo $listing['totalBids'];?></span></a>
										<a href="<?php echo base_url().'user/edit_listings/'.$listing['listingType'].'/'.$listing['id']; ?>" class="button gray ripple-effect ico" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
										<?php if($listing['totalBids'] === '0' && $listing['totalBidders'] === '0') { ?>
											<a href="<?php echo base_url().'user/remove_listing/'.$listing['id']; ?>" class="button gray ripple-effect ico" title="Remove Listing" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
										<?php }?>
									</div>
								</li>
								<?php  } } } else echo '<li>Sorry !! No Listings are available</li>'; ?>

								<!-- End Listing -->

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


<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>