<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Current Listings | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3>Current Listings</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Current Listings</a></li>
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
							<h3>CURRENT LISTINGS</h3>
						</div>

						<!----- PAGES ---------------->
						<div class="content with-padding padding-bottom-10">
						<div class="row">
						<div class="col-xl-12">

						<div class="col-xl-12">
						<div class="submit-field">
							<h5>Filter Listings</h5>
							<select class="form-control" id="filter_type" name="filter_type">
                            	<option value=""> ALL </option>
                            	<option value="0"> PAYMENT PENDINGS </option>
                            	<option value="1"> ACTIVE </option>
                            	<option value="2"> SUSPENDED </option>
                            	<option value="4"> EXPIRED </option>
                            	<option value="5"> UNVERIFIED DOMAIN REMOVALS </option>
                            	<option value="6"> DELETED BY SELLER </option>
                            	<option value="7"> AVAILABLE LISTINGS </option>
                            	<option value="8"> SOLD LISTINGS </option>
                          	</select>
						</div>
						</div>


						<div class="row">
                    	<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">           
                        <div class="card mb-3">
                          <div class="card-body">
                            <div class="table-responsive">
                              <table id="tbl_ListingsData" class="table table-bordered table-hover display">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                          			<th>TYPE</th>
                          			<th>NAME</th>
                          			<th>OPTION</th>
                          			<th>STATUS</th>
                          			<th>AVAILABILITY</th>
                          			<th></th>
                          			<th></th>
                                  </tr>
                                </thead>
                              </table>
                            </div>
                          </div>              
                        </div><!-- end card-->          
                    	</div>
                  		</div>


        				</div>
        				</div>
        				</div>	
        				<!----- /PAGES ---------------->
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
<script>loadListingsData('');</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>