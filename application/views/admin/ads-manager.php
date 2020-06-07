<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Ads Manager | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3>Ads Manager</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Ads Manager</a></li>
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
							<h3>Ads Manager</h3>
						</div>

						<!----- Content --->
						<form id="AdsForm" method="post" enctype="multipart/form-data"/>
						<div class="content with-padding padding-bottom-10">
						<div class="row">

							<div class="col-xl-6">
								<div class="submit-field">
									<h5>Homepage Banner (720px x 90px) <code> (responsive)</code></h5>
									<textarea rows = "8" class="form-control" cols = "60" name = "homepage_banner_720x90" id="homepage_banner_720x90"><?php if(!empty($ads[0]['homepage_banner_720x90'])) echo $ads[0]['homepage_banner_720x90']; ?></textarea>
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<h5>Auction & Offer Pages Banner (720px x 90px) <code> (responsive)</code></h5>
									<textarea rows = "8" class="form-control" cols = "60" name = "webpage_banner_720x90" id="webpage_banner_720x90"><?php if(!empty($ads[0]['webpage_banner_720x90'])) echo $ads[0]['webpage_banner_720x90']; ?></textarea>
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<h5>Blog Top (720px x 90px) <code> (responsive)</code></h5>
									<textarea rows = "8" class="form-control" cols = "60" name = "blog_page_720x90" id="blog_page_720x90"><?php if(!empty($ads[0]['blog_page_720x90'])) echo $ads[0]['blog_page_720x90']; ?></textarea>
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<h5>Blog Sidebar (300px x 250px) <code> (responsive)</code></h5>
									<textarea rows = "8" class="form-control" cols = "60" name = "blog_300x250" id="blog_300x250" maxlength="150"><?php if(!empty($ads[0]['blog_300x250'])) echo $ads[0]['blog_300x250']; ?></textarea>
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<h5>Blog Post Bottom (720px x 90px) <code> (responsive)</code></h5>
									<textarea rows = "8" class="form-control" cols = "60" name = "blog__post_page_720x90" id="blog__post_page_720x90"><?php if(!empty($ads[0]['blog__post_page_720x90'])) echo $ads[0]['blog__post_page_720x90']; ?></textarea>
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<h5>Blog Post Sidebar (300px x 250px) <code> (responsive)</code></h5>
									<textarea rows = "8" class="form-control" cols = "60" name = "blog__post_page_300x250" id="blog__post_page_300x250"><?php if(!empty($ads[0]['blog__post_page_300x250'])) echo $ads[0]['blog__post_page_300x250']; ?></textarea>
								</div>
							</div>

			
							<div class="col-xl-12">
								<button type="submit" name="btn_adssave" class="btn btn-success mr-2">Save</button>
                        		<div id="notification"></div>
                        		<span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                        	</div>

                        	<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						</div>
						</div>
						</form>
						<!----- /Content --->

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