<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>About Developers | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3>About Developers</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">About Developers</a></li>
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
							<h3><b>About Developers</b></h3>
						</div>
						<!----- about us ---------------->
						<div class="card">
                        <div class="card-body">
                        <h4 class="card-title text-center"><u><b><a href="//onlinetoolhub.com"> Onlinetoolhub </a>   &nbsp;| &nbsp; <code> Property of Onlinetoolhub </code></b></u></h4><br>
                        <div class="row">
                        <div class="col-md-6">
                        <address>
                            <p class="font-weight-bold">Onlinetoolhub Solutions</p><p>No 139,</p>
                            <p>High Level Road, Nugegoda</p>
                           	<p>Sri Lanka,  10250</p>
                       	</address>
                       	</div>
                            
                        <div class="col-md-6">
                        <address class="text-primary">
                        	<p class="font-weight-bold">E-mail</p>
                        	<p class="mb-2">support@onlinetoolhub.com</p>
                        	<p class="font-weight-bold">Web Address</p>
                        	<p><a href="//onlinetoolhub.com"> www.onlinetoolhub.com </a></p>
                        </address>
                        </div>
                        </div>
                        </div>
                        </div>
        				<!----- /about us ---------------->
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