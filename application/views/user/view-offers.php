<!DOCTYPE html>
<html lang="en">
<head>

<!--User Page Meta Tags-->
<title>View Offers | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
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


<!--------------------------------------------------------------------------------------------------------------->
<div class="dashboard-container">
<?php $this->load->view('user/includes/sidebar'); ?>
<!--------------------------------------------------------------------------------------------------------------->


	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>View Offers</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Pending Offers</li>
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
							<h3><i class="fa fa-users"></i> Negotiation Between you and <a href=""><?php if(isset($Offers[0]['username'])) echo $Offers[0]['username']; ?></a></h3>
						</div>
						<div id="negotiations_table" class="bs-example container" data-example-id="striped-table">
  							<table class="table table-striped table-bordered table-hover">
    							<thead>
      							<tr>
        							<th>#</th>
        							<th>Offer</th>
        							<th>Time</th>
        							<th>Status</th>
        							<th>Ending</th>
        							<th></th>
      							</tr>
    							</thead>
    							<tbody>

    								<?php $i=1; foreach ($Offers as $Offer) { ?>
      								<tr>
        								<th scope="row"><?php echo $i; ?></th>
        								<td><?php if(isset($Offer['offer_amount'])) echo $Offer['offer_amount']; ?></td>
        								<td><?php if(isset($Offer['ago'])) echo $Offer['ago']; ?></td>
        								<td><?php if($Offer['offer_status'] === '0') echo 'pending'; else if($Offer['offer_status'] === '1')
        								echo 'Rejected'; else if($Offer['offer_status'] === '2')
        								echo 'Approved'; else if($Offer['offer_status'] === '3')
        								echo 'Canceled'; ?></td>
        								<td><?php if(isset($Offer['expire'])) echo $Offer['expire']; ?></td>
        								<td class="centerButtons">
        								<?php if($Offer['offer_status'] === '0') { ?>
        									<button type="button" class="btn btn-outline-dark btn-sm cancel_offer" data-offerid="<?php echo $Offer["offer_id"];?>">cancel</button> 
        									<?php } ?>
      									</td>
      								</tr>
      								<?php $i++; } ?>
    							</tbody>
  							</table>
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