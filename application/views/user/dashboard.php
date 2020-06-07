<!DOCTYPE html>
<html lang="en">
<head>

<!--User Page Meta Tags-->
<title>User Dashboard | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
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
				<h3>Dashboard</h3>
				<span class="margin-top-7">Welcome <a href=""><?php if(isset($userdata[0]['username'])){echo $userdata[0]['username'];} ?></a> !</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">
				<div class="col-xl-12">
            	<!--------Announcement ----------------------------------------------------------------------------------->
            	<?php $this->load->view('user/includes/announcements'); ?>
            	<!--------------------------------------------------------------------------------------------------------->
            	</div>
            </div>

            	<!-- Dashboard Container -->
			<div class="row margin-top-10">
			<div class="col-xl-12">
				<!-- Dashboard Container -->
				<div class="fun-facts-container">
					<div class="fun-fact" data-fun-fact-color="#56bd78">
						<div class="fun-fact-text">
							<span>Total Listings</span>
							<h4><?php if(isset($TL)) echo $TL; ?></h4>
						</div>
						<div class="fun-fact-icon"><i class="fa fa-users"></i></div>
					</div>

					<div class="fun-fact" data-fun-fact-color="#b91c7f">
						<div class="fun-fact-text">
							<span>Total Earnings</span>
							<h4><?php if(isset($TE)) echo number_format(floatval($TE),2); ?></h4>
						</div>
						<div class="fun-fact-icon"><i class="fas fa-wallet"></i></div>
					</div>

				</div>

			</div>
			</div>
			<!-- Dashboard Box -->
			<!-- Row / End -->

			<div class="row margin-top-10">	
			<div class="col-md-12 col-lg-12 col-xl-12">
			<div class="content">						
			<div class="card mb-3">
				<div class="card-header">
					<h3><i class="fa fa-line-chart"></i> MONTHLY WISE TOTAL EARNINGS </h3>
				</div>
												
				<div class="card-body">
					<div class="submit-field">
						<select class="form-control" id="years_drop" name="years_drop"></select>
					</div>
						
					<canvas id="monthluserwisechart"></canvas>
				</div>		

				<div class="card-footer small text-muted">Updated <?php echo date('Y-m-d H:i:s'); ?></div>
			</div><!-- end card-->	
			</div>				
			</div>
			</div>
			<!--/Monthlywise Earnings--->

			<!-- open contracts -->
			<div class="row margin-top-7">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
			<div class="card mb-3">

			<div class="card-header">
				<h3> YOUR OPEN CONTRACTS</h3>
			</div>
					
			<?php if(!empty($contracts)) { foreach ($contracts as $contract) { ?>
			<div class="card-body">
				<p class="font-600 m-b-5"><b>CONTRACT ID: </b><?php echo $contract['contract_id'] ?> <b> | CONTRACT BETWEEN </b><?php echo $contract['owner'] ?> <b> & </b><?php echo $contract['customer'] ?> <?php if ($contract['status'] === '0' ){?>
                <div class="badge badge-info"> Pending for payment</div>
                <?php } else if ($contract['status'] === '1' ) { ?>
                <div class="badge badge-success"> Paid Contract</div>
                <?php } else if ($contract['status'] === '2' ) { ?>
                <div class="badge badge-danger"> In Reolution Manager</div>
                <?php } else if ($contract['status'] === '3' ) { ?>
                <div class="badge badge-danger"> Canceled By Buyer</div>
                <?php } else if ($contract['status'] === '4' ) { ?>
                <div class="badge badge-warning"> Sale Completed</div>	
                <?php } else if ($contract['status'] === '5' ) { ?>
                <div class="badge badge-dark"> Delivered</div>
                <?php } else if ($contract['status'] === '6' ) { ?>
                <div class="badge badge-warning"> On Revision</div>
            	<?php } else if ($contract['status'] === '8' ) { ?>
                <div class="badge badge-warning"> Reject Cancel Request</div>
            	<?php } else if ($contract['status'] === '9' ) { ?>
                <div class="badge badge-warning"> Raised a Dispute</div>
            	<?php } else if ($contract['status'] === '7' ) { ?>
                <div class="badge badge-warning"> Canceled Contract & Refunded</div>
                <?php } ?> <span class="text-primary pull-right"><b>IN PROGRESS (<?php echo $contract['percentage'] ?>%)</b></span></p>
				<div class="progress">
					<div class="progress-bar progress-bar-striped progress-xs bg-warning" role="progressbar" style="width: <?php echo $contract['percentage'] ?>%" aria-valuenow="<?php echo $contract['percentage'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
												
				<div class="m-b-20"></div>						
			</div>
			<?php } } else { ?>
			<p class="m-b-5"> Sorry , No contracts were found </p>
			<?php } ?>

			<div class="card-footer small text-muted">Updated <?php echo date('Y-m-d H:i:s'); ?></div>
			</div><!-- end card-->					
			</div>
			</div>	
			<!-- Row / End -->
			<!-- /open contracts -->

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
<script>loadUserwiseMonthlyWiseTotalEarnings('monthluserwisechart','<?php echo date('Y') ?>');loadYears('years_drop');</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>