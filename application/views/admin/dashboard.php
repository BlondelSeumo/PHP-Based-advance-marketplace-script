<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Admin Dashboard | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<meta name="robots" content="noindex">
<!--/Admin Page Meta Tags-->

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
<?php $this->load->view('admin/includes/sidebar'); ?>
<!--------------------------------------------------------------------------------------------------------------->
	
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Admin Dashboard</h3>
				<span class="margin-top-7">Welcome <a href=""><?php if(isset($userdata[0]['username'])){echo $userdata[0]['username'];} ?> </a> !</span>

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

				<!-- Dashboard Box -->
				<div class="col-xl-12">

					<div class="row margin-bottom-10">
						<div class="col-md-12">
							<?php if(count($disputes) > 0) { ?>
							<div class="alert alert-info">
								<a href="#"><?php echo count($disputes) ?></a> Disputes waiting for review 
							</div>
							<?php }?>
						</div>
					</div>

					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3></h3>
						</div>

						<div class="content">

							<!-- Dashboard Container -->
							<div class="row">
							<div class="col-md-12">
							<!-- Dashboard Container -->
							<div class="fun-facts-container">
								<div class="fun-fact" data-fun-fact-color="#56bd78">
									<div class="fun-fact-text">
										<span>Total Users</span>
										<h4><?php if(isset($TU)) echo $TU; ?></h4>
									</div>
									<div class="fun-fact-icon"><i class="fa fa-users"></i></div>
								</div>

								<div class="fun-fact" data-fun-fact-color="#b91c7f">
									<div class="fun-fact-text">
										<span>Total Earnings</span>
										<h4><?php if(isset($TE)) echo number_format(floatval($TE),2);?></h4>
									</div>
									<div class="fun-fact-icon"><i class="fas fa-wallet"></i></div>
								</div>

								<div class="fun-fact" data-fun-fact-color="#b83b6f">
									<div class="fun-fact-text">
										<span>Monthly Earnings</span>
										<h4><?php if(isset($ME)) echo number_format(floatval($ME),2); ?></h4>
									</div>
									<div class="fun-fact-icon"><i class="fa fa-dollar"></i></div>
								</div>

							</div>

							<div class="fun-facts-container">
								<div class="fun-fact" data-fun-fact-color="#78bd79">
									<div class="fun-fact-text">
										<span>Open Contracts</span>
										<h4><?php if(isset($OC)) echo $OC; ?></h4>
									</div>
									<div class="fun-fact-icon"><i class="fas fa-handshake"></i></div>
								</div>

								<div class="fun-fact" data-fun-fact-color="#b91c7f">
									<div class="fun-fact-text">
										<span>Total Listings</span>
										<h4><?php if(isset($TL)) echo number_format(floatval($TL),2); ?></h4>
									</div>
									<div class="fun-fact-icon"><i class="fas fa-ad"></i></div>
								</div>

							</div>
							</div>
							</div>
							<!-- /Dashboard Container -->

						</div>
					</div>
				</div>
			</div>

			<!--Monthlywise Earnings--->
			<div class="row margin-bottom-10 margin-top-25">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">
				<div class="content">						
				<div class="card mb-3">
					<div class="card-header">
						<h3><i class="fa fa-line-chart"></i> MONTHLY WISE TOTAL EARNINGS </h3>
					</div>
												
					<div class="card-body">
						<div class="submit-field">
							<select class="form-control" id="year_drop" name="year_drop"></select>
						</div>
						
						<canvas id="monthlyearningschart"></canvas>
					</div>		

					<div class="card-footer small text-muted">Updated <?php echo date('Y-m-d H:i:s'); ?></div>
				</div><!-- end card-->	
				</div>				
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-6">						
					<div class="card mb-3">
						<div class="card-header">
							<h3><i class="fa fa-line-chart"></i> LISTINGS (CURRENT YEAR - PREVIOUS YEAR) </h3>
						</div>
												
						<div class="card-body">
							<div class="submit-field">
								<div class="row">
									<div class="col-md-6">
										<select class="form-control" id="year_cur_drop" name="year_cur_drop"></select>
									</div>
									<div class="col-md-6">
										<select class="form-control" id="year_prev_drop" name="year_prev_drop"></select>
									</div>
								</div>
							</div>
							<canvas id="lineChart"></canvas>
						</div>		

						<div class="card-footer small text-muted">Updated <?php echo date('Y-m-d H:i:s'); ?></div>
					</div><!-- end card-->								
				</div>
			</div>
			<!--/Monthlywise Earnings--->

			<div class="row">

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
				<div class="card mb-3">
					<div class="card-header">
						<h3><i class="fa fa-star-o"></i> RECENTLY COMPLETED CONTRACTS</h3>
					</div>
					
					<?php if(!empty($contracts)) {  foreach ($contracts as $contract) { ?>
					<div class="card-body">
						<p class="font-600 m-b-5"><b>CONTRACT ID: </b><?php echo $contract['contract_id'] ?> | <b>OWNER : </b><?php echo $contract['owner'] ?> | <b>CUSTOMER : </b><?php echo $contract['customer'] ?> | <span class="text-primary pull-right"><b>COMPLETED</b></span></p>
						<div class="progress">
							<div class="progress-bar progress-bar-striped progress-xs bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
												
						<div class="m-b-20"></div>						
					</div>
					<?php } } else { ?>
						<p> Sorry , No contracts were found </p>
					<?php } ?>

					<div class="card-footer small text-muted">Updated <?php echo date('Y-m-d H:i:s'); ?></div>
				</div><!-- end card-->					
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
<script>loadMonthlyWiseTotalEarnings('monthlyearningschart');loadYears('year_drop');ListingComparison('lineChart');loadYears('year_cur_drop');loadYears('year_prev_drop');</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>