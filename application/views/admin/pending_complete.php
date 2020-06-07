<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Pending to complete | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3>Pending to complete</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Pending to Complete</a></li>
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
							<h3>Pending Tasks To be Marked as Completed within <?php if(isset($settingsData[0]['mark_as_completed'])) echo $settingsData[0]['mark_as_completed']; ?> days</h3>
						</div>

						<div id="negotiations_table" class="bs-example container" data-example-id="striped-table">
  							<table class="table table-striped table-bordered table-hover">
    							<thead>
      							<tr>
        							<th>#</th>
        							<th>Contrat ID</th>
        							<th>Owner</th>
        							<th>Customer</th>
        							<th>Days Pass</th>
      							</tr>
    							</thead>
    							<tbody>

    								<?php $i=1; foreach ($pendings as $pending) { ?>
      								<tr>
        								<th scope="row"><?php echo $i; ?></th>
        								<td><?php if(isset($pending['contract_id'])) echo $pending['contract_id']; ?></td>
        								<td><?php if(isset($pending['owner_id'])) echo $pending['owner_id']; ?></td>
        								<td><?php if(isset($pending['customer_id'])) echo $pending['customer_id']; ?></td>
        								<td><?php if(isset($pending['diff'])) echo 'Pass days '.$pending['diff']; ?></td>
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
<script>loadMonthlyWiseTotalEarnings('monthlyearningschart');</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>