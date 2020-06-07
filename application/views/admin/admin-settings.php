<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Admin Settings | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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


	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Admin Settings</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Admin Settings</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<form id="UserDetailsChangeForm" method="post" enctype="multipart/form-data"/>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-account-circle"></i> My Account</h3>
						</div>

						<div class="content with-padding padding-bottom-0">

							<div class="row">

								<div class="col-auto">
									<div class="avatar-wrapper" data-tippy-placement="bottom" title="Change Avatar">
										<img class="profile-pic" src="<?php if(!empty($userdata[0]['thumbnail'])) echo base_url().USER_UPLOAD.$userdata[0]['thumbnail']; else echo 'images/user-avatar-placeholder.png'; ?>" alt="" />
										<div class="upload-button"></div>
										<input id="uploadthumbnail" name="uploadthumbnail" class="file-upload" type="file" accept="image/*" value="<?php if(!empty($userdata[0]['thumbnail'])) echo realpath(USER_UPLOAD.$userdata[0]['thumbnail']); ?>" />
									</div>
								</div>

								<div class="col">
									<div class="row">

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>First Name</h5>
												<input id="firstname" name="firstname" type="text" class="with-border" value="<?php if(isset($userdata[0]['firstname'])) echo $userdata[0]['firstname']; ?>">
												<input id="user_id" name="user_id" type="hidden" value="<?php if(isset($userdata[0]['user_id'])) echo $userdata[0]['user_id']; ?>">
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Last Name</h5>
												<input id="lastname" name="lastname" type="text" class="with-border" value="<?php if(isset($userdata[0]['lastname'])) echo $userdata[0]['lastname']; ?>">
											</div>
										</div>

										<div class="col-xl-6">
											<!-- Account Type -->
											<div class="submit-field">
												<h5>Account Status</h5>
												<div class="account-type">
													<div>
														<?php if($userdata[0]['online'] === '1') { ?>
														<input type="radio" name="account-online-radio" id="seller-radio" class="account-type-radio" value="1" checked/>
														<?php } else {?>
														<input type="radio" name="account-online-radio" id="seller-radio" class="account-type-radio" value="1" />
														<?php }  ?>
														<label for="seller-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Online</label>
													</div>

													<div>
														<?php if($userdata[0]['online'] === '0') { ?>
														<input type="radio" name="account-online-radio" id="employer-radio" class="account-type-radio" value="0" checked/>
														<?php } else {?>
														<input type="radio" name="account-online-radio" id="employer-radio" class="account-type-radio" value="0" />
														<?php }  ?>
														<label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Offline</label>
													</div>
												</div>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Email</h5>
												<input type="email" class="with-border" value="<?php if(isset($userdata[0]['email'])) echo $userdata[0]['email']; ?>" readonly="true">
											</div>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-face"></i> My Profile</h3>
						</div>

						<div class="content">
							<ul class="fields-ul">
							<li>
								<div class="row">
									<div class="col-xl-6">
										<div class="submit-field">
											<h5>Meta Description</h5>
											<textarea id="user_metadescription" name="user_metadescription" cols="30" rows="2" class="with-border"><?php if(isset($userdata[0]['user_metadescription'])) echo $userdata[0]['user_metadescription']; ?></textarea>
										</div>
									</div>

									<div class="col-xl-6">
										<div class="submit-field">
											<h5>Nationality</h5>
											<select id="user_country" name="user_country" class="form-control" >
                                            	<option value="" selected>What is your country?</option>
                                        	</select>
										</div>
									</div>

									<div class="col-xl-12">
										<div class="submit-field">
											<h5>Introduce Yourself</h5>
											<textarea id="user_description" name="user_description" cols="30" rows="5" class="with-border"><?php if(isset($userdata[0]['user_description'])) echo $userdata[0]['user_description']; ?></textarea>
										</div>
									</div>

								</div>
							</li>
						</ul>
						</div>
					</div>
				</div>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-facebook"></i> Social Networks</h3>
						</div>

						<div class="content with-padding">
							<div class="row">
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Twitter</h5>
										<input id="social_twitter" name="social_twitter" type="text" class="with-border" value="<?php if(isset($userdata[0]['social_twitter'])) echo $userdata[0]['social_twitter']; ?>">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Facebook</h5>
										<input id="social_facebook" name="social_facebook" type="text" class="with-border" value="<?php if(isset($userdata[0]['social_facebook'])) echo $userdata[0]['social_facebook']; ?>">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Youtube</h5>
										<input id="social_youtube" name="social_youtube" type="text" value="<?php if(isset($userdata[0]['social_youtube'])) echo $userdata[0]['social_youtube']; ?>" class="with-border">
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>

				<input id="paypal_email" name="paypal_email" type="hidden" value="N/A">
				<input id="payoneer_email" name="payoneer_email" type="hidden" value="N/A">
				<input id="bank_details" name="bank_details" type="hidden" value="N/A">

				<!-- Button -->
				<div class="col-xl-12">
					<button type="submit" class="btn btn-success margin-top-30">Save Changes</button>
                   	<div id="validator"></div>
                   	<span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
				</div>

				<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

			</form>

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
<?php if(isset($userdata[0]['user_country']) && !empty($userdata[0]['user_country'])) {?>
<script>populateListOfCountries('user_country','<?php echo $userdata[0]['user_country']; ?>');</script>
<?php }else {?>
<script>populateListOfCountries('user_country');</script>
<?php } ?>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>