<!DOCTYPE html>
<html lang="en">
<head>

<!--User Page Meta Tags-->
<title>View Bids | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
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
				<h3>View Bids</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Current Bids</li>
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
							<h3><i class="fa fa-users"></i> Auction Between you and <a href=""><?php if(isset($bids[0]['username'])) echo $bids[0]['username']; ?></a> for <a href="<?php echo base_url().'single_auction/'.$bids[0]['type'].'/'.$bids[0]['listing_id']; ?>"><?php if(isset($bids[0]['website_BusinessName'])) echo $bids[0]['website_BusinessName']; else echo $bids[0]['website_tagline']; ?></a> </h3>
						</div>
						<div id="negotiations_table" class="bs-example container" data-example-id="striped-table">
  							<table class="table table-striped table-bordered table-hover">
    							<thead>
      							<tr>
        							<th>#</th>
        							<th>Offer</th>
        							<th>Time</th>
        							<th>Status</th>
        							<th>Auction Ending</th>
      							</tr>
    							</thead>
    							<tbody>

    								<?php $i=1; foreach ($bids as $bid) { ?>
      								<tr>
        								<th scope="row"><?php echo $i; ?></th>
        								<td><?php if(isset($bid['bid_amount'])) echo $bid['bid_amount']; ?></td>
        								<td><?php if(isset($bid['ago'])) echo $bid['ago']; ?></td>
        								<td><?php if($bid['bid_status'] === '0') echo 'pending'; else if($bid['bid_status'] === '1')
        								echo 'Approved'; else if($bid['bid_status'] === '2')
        								echo 'Rejected'; else if($bid['bid_status'] === '3')
        								echo 'Won Auction'; else if($bid['bid_status'] === '4')
        								echo 'Bid Closed'; else if($bid['bid_status'] === '5')
        								echo 'Bid Closed'; else if($bid['bid_status'] === '6')
        								echo 'Opened a Contract ';
        								?></td>
        								<td><?php if(isset($bid['expire'])) echo $bid['expire']; ?></td>
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