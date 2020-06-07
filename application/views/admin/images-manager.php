<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Images Manager | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
	<!-- Dashboard Content -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Images Manager</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Images Manager</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">
					<form id="Imageform" method="post" enctype="multipart/form-data"/>
						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-account-circle"></i> Images Manager</h3>
						</div>

						<div class="content with-padding padding-bottom-0">
						<div class="row">
							
							<div class="col-xl-3">
								<h5>SITE HEADER & FOOTER LOGO</h5>
								<div class="avatar-wrapper margin-top-10" data-tippy-placement="bottom" title="Change Site Logo">
									<img class="sitelogo" src="<?php if(!empty($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="" />
									<div class="image-upload-button"></div>
									<input id="sitelogo" name="sitelogo" class="image-upload" type="file" data-img='sitelogo' accept="image/*" value="<?php if(!empty($imagesData[0]['sitelogo'])) echo realpath(ADMIN_IMAGES.$imagesData[0]['sitelogo']); ?>" />
								</div>
							</div>

							<div class="col-xl-3">
								<h5>INVOICE HEADER LOGO</h5>
								<div class="avatar-wrapper margin-top-10" data-tippy-placement="bottom" title="Change Invoice Logo">
									<img class="invoice_logo" src="<?php if(!empty($imagesData[0]['invoice_logo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['invoice_logo'];?>" alt="" />
									<div class="image-upload-button"></div>
									<input id="invoice_logo" name="invoice_logo" class="image-upload" type="file" data-img='invoice_logo' accept="image/*" value="<?php if(!empty($imagesData[0]['invoice_logo'])) echo realpath(ADMIN_IMAGES.$imagesData[0]['invoice_logo']); ?>" />
								</div>
							</div>

							<div class="col-xl-3">
								<h5>SITE FAVICON</h5>
								<div class="avatar-wrapper margin-top-10" data-tippy-placement="bottom" title="Change Site Favicon">
									<img class="favicons" src="<?php if(!empty($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="" />
									<div class="image-upload-button"></div>
									<input id="favicons" name="favicons" class="image-upload" type="file" data-img='favicons' accept="image/*" value="<?php if(!empty($imagesData[0]['favicon'])) echo realpath(ADMIN_IMAGES.$imagesData[0]['favicon']); ?>" />
								</div>
							</div>

							<div class="col-xl-3">
								<h5>LOGIN/REGISTER BACKGROUND</h5>
								<div class="avatar-wrapper margin-top-10" data-tippy-placement="bottom" title="Change Login Background">
									<img class="mainback" src="<?php if(!empty($imagesData[0]['mainback'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['mainback'];?>" alt="" />
									<div class="image-upload-button"></div>
									<input id="mainback" name="mainback" class="image-upload" type="file" data-img='mainback' accept="image/*" value="<?php if(!empty($imagesData[0]['mainback'])) echo realpath(ADMIN_IMAGES.$imagesData[0]['mainback']); ?>" />
								</div>
							</div>

							<div class="col-xl-3">
								<h5>HEADER BACKGROUND</h5>
								<div class="avatar-wrapper margin-top-10" data-tippy-placement="bottom" title="Change Header Background">
									<img class="homepage" src="<?php if(!empty($imagesData[0]['homepage'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['homepage']; ?>" alt="" />
									<div class="image-upload-button"></div>
									<input id="homepage" name="homepage" class="image-upload" type="file" data-img='homepage' accept="image/*" value="<?php if(!empty($imagesData[0]['homepage'])) echo realpath(ADMIN_IMAGES.$imagesData[0]['homepage']); ?>" />
								</div>
							</div>

							<div class="col-xl-3">
								<h5>SCREEN LOADER GIF <code>  (filetype.gif)</code></h5>
								<div class="avatar-wrapper margin-top-10" data-tippy-placement="bottom" title="Change Loader Screen">
									<img class="loader" src="<?php if(!empty($imagesData[0]['loader'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['loader']; ?>" alt="" />
									<div class="image-upload-button"></div>
									<input id="loader" name="loader" class="image-upload" type="file" data-img='loader' accept="image/*" value="<?php if(!empty($imagesData[0]['loader'])) echo realpath(ADMIN_IMAGES.$imagesData[0]['loader']); ?>" />
								</div>
							</div>

							<div class="col-xl-3">
								<h5>OTHER BACKGROUNDS</h5>
								<div class="avatar-wrapper margin-top-10" data-tippy-placement="bottom" title="Change Backgrounds">
									<img class="backgrounds" src="<?php if(!empty($imagesData[0]['backgrounds'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['backgrounds']; ?>" alt="" />
									<div class="image-upload-button"></div>
									<input id="backgrounds" name="backgrounds" class="image-upload" type="file" data-img='backgrounds' accept="image/*" value="<?php if(!empty($imagesData[0]['backgrounds'])) echo realpath(ADMIN_IMAGES.$imagesData[0]['backgrounds']); ?>" />
								</div>
							</div>

						</div>
						</div>

						<!-- Button -->
						<div class="col-xl-12">
							<button type="submit" class="btn btn-success margin-top-30">Save Changes</button>
                   			<div id="validator"></div>
                   			<span id="loaderImage" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
						</div>

						<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

					</form>
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