<!DOCTYPE html>
<html lang="en">
<head>

<!--User Page Meta Tags-->
<title>Change Password | <?php echo $this->lang->line('site_name') ?> | User Dashboard</title>
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


	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Password Change</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Password Change</li>
					</ul>
				</nav>
			</div>
	
			
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">

					<form id="ChangePasswordForm" method="post" enctype="multipart/form-data"/>

						<div class="dashboard-box">

							<!-- Headline -->
							<div class="headline">
								<h3><i class="icon-material-outline-lock"></i> Password & Security</h3>
							</div>

							<div class="content with-padding">
								<div class="row">
									<div class="col-xl-4">
										<div class="submit-field">
											<h5>Username</h5>
											<input type="text" class="with-border" id="txt_username" name ="txt_username" value="<?php echo $userdata[0]['username'] ?>" disabled="true">
                          					<input type="hidden" class="form-control" id="txt_user_id" name ="txt_user_id" value="<?php echo $userdata[0]['user_id'] ?>">
										</div>
									</div>

									<div class="col-xl-4">
										<div class="submit-field">
											<h5>Email</h5>
											<input type="text" class="with-border" id="txt_user_email" name ="txt_user_email" value="<?php echo $userdata[0]['email'] ?>" disabled="true">
										</div>
									</div>

									<div class="col-xl-4">
										<div class="submit-field">
											<h5>Password</h5>
											<input type="password" id="txt_user_password" name="txt_user_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters' : ''); if(this.checkValidity()) form.confirmPassword.pattern = this.value;" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" required data-toggle="popover" title="Password Strength" data-content="Enter Password..." class="with-border" required data-toggle="popover" title="Password Strength" value="<?php echo $userdata[0]['password'] ?>" required>
										</div>
									</div>

								</div>

								<div class="row">
									<button type="submit" class="btn btn-success margin-top-30"><?php echo $this->lang->line('lang_btn_change_password'); ?></button>
                    				<div id="buttonChangePassword"></div>
                    				<span id="loadingImageChangePassword" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
								</div>

								<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
								
							</div>
						</div>
					</form>
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