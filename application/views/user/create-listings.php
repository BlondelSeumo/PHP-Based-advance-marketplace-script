<!DOCTYPE html>
<html lang="en">
<head>

<!--User Page Meta Tags-->
<title>Create Listings | <?php echo $this->lang->line('site_name') ?> | User Dashboard</title>
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
				<h3><b>Create a Listing </b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Create Listings</li>
					</ul>
				</nav>
			</div>

			<!-- Row -->
			<div id="listing_type_selection" class="row">
				<div class="col-xl-12">
					<form id="listingTypeForm" name="listingTypeForm" method="POST" enctype="multipart/form-data">

					<div class="row centerButtons">

						<?php
						if(!empty($platforms)) { 
						foreach ($platforms as $platform) { ?>
						<div class="col-xl-4">
							<div class="submit-field item">
                                <input id="answer_<?php echo $platform['id']; ?>" type="radio" name="branch_1_group_1" value="<?php echo $platform['radio']; ?>" class="required">
                                <label for="answer_<?php echo $platform['id']; ?>"><img src="<?php echo base_url().ICON_UPLOAD; ?><?php echo $platform['icon']; ?>" alt=""><strong><?php echo $platform['name']; ?></strong><?php echo $platform['description']; ?></label>
							</div>
						</div>
						<?php } } else { echo 'Sorry, No platforms are activated.';} ?>

					</div>
					<div class="row centerButtons">
						<button type="submit" value="NEXT" class="button ripple-effect big margin-top-30" style="float: right;">NEXT <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
					</div>

					</form>
				</div>
				
				<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				
			</div>

			<!-- Footer -->
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