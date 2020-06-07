<!DOCTYPE html>
<html lang="en">
<head>

<!--User Page Meta Tags-->
<title>Invoices | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
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
				<h3>Invoices</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Invoices</li>
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
							<h3><i class="mdi mdi-fax"></i> <?php echo count($invoices).' No of Invoices'; ?></h3>
						</div>

						<div class="content">

							<!-- Row -->
							<?php if(!empty($invoices)) { ?>
							<div class="row">

							<!-- Dashboard Box -->
							<div class="col-xl-12">
							<div class="dashboard-box margin-top-0">

								<!-- Headline -->
								<div class="headline">
									<h3>Contract History</h3>
								</div>
								<div class="bs-example container" data-example-id="striped-table">
  									<table class="table table-striped table-bordered table-hover">
    								<thead>
      								<tr>
        								<th>#</th>
        								<th>Invoice</th>
        								<th>Status</th>
        								<th>Date</th>
      								</tr>
    								</thead>
    								<tbody>

    									<?php $i=1; foreach ($invoices as $invoice) { ?>
      									<tr>
        									<th scope="row"><?php echo $i; ?></th>
        									<th scope="row"><a href="<?php echo base_url().'user/invoice_get/'.$invoice['invoice_id'] ?>"><?php echo $invoice['invoice_id']; ?></a></th>
        									<td><?php if($invoice['status'] === '1') echo 'Paid'; else if($invoice['status'] === '0')
        									echo 'Pending'; else if($invoice['status'] === '3')
        									echo 'Canceled & Refunded'; else if($invoice['status'] === '4')
        									echo 'Completed';
        									?></td>
        									<td><?php if(isset($invoice['updated'])) echo date('Y-m-d',strtotime($invoice['updated'])); ?></td>
      									</tr>
      									<?php $i++; } ?>
    								</tbody>
  								</table>
								</div>
							</div>
							</div>

							</div>
							<!-- Row / End -->
							<?php } ?>
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