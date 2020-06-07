<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>General Settings | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3><b>General Settings</b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li>General Settings</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0 panel-group" id="accordion" role="tablist" aria-multiselectable="true">

						<form id="upload_key_form" class="forms-sample" method="post" enctype="multipart/form-data"/>
						<div class="panel panel-default padding-bottom-10">

							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingOne">
							<!-- Headline -->
								<div class="headline">
									<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><span>GOOGLE JSON KEY FILE (IMPORTANT)</span><i class="help-icon" data-tippy-placement="right" title="Please go to google console to retrive this key. refer documenttationf or additional information"></i></a></h3>
								</div>
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">

							<div class="content with-padding padding-bottom-10">
							<div class="row">

							<!---UPLOAD GOOGLE JSON KEY FILE ----->
                        	<div class="col-xl-12">
                          	<div class="submit-field">
                            	<h5>UPLOAD GOOGLE JSON KEY FILE</h5>
                            	<div class="uploadButton margin-top-30">
                              		<input class="uploadButton-input-cover" type="file" accept="/*" id="uploadGoogleKey" name="uploadGoogleKey" required/>
                              		<label class="uploadButton-button ripple-effect" for="uploadGoogleKey">Google JSON key file</label>
                              		<span class="uploadButton-file-name-cover"><b>UPLOAD GOOGLE JSON KEY FILE</b></span>
                            	</div>
                          	</div>
                        	</div>

                        	<div class="col-xl-12">
								<button type="submit" class="button ripple-effect big margin-top-30" style="float: right;" form="upload_key_form"><i class="icon-feather-plus"></i> Upload</button>
								<div id="notificationkey"></div>
                    			<span id="loaderkey" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
							</div>

							<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                        	
                    		</div>
                			</div>
            				</div>
            				</div>
                        	
                        </div>                       
                      	</form>


						<form id="generalSettingsForm" name="generalSettingsForm" method="POST">
						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingOne">
							<!-- Headline -->
								<div class="headline">
									<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i> Listings Settings</a></h3>
								</div>
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">

							<div class="content with-padding padding-bottom-10">
							<div class="row">

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><span>One Listing Per Domain Mode</span><i class="help-icon" data-tippy-placement="right" title="if this is on user will not be allowed to add multiple listings per 1 domain"></i></h5>
										<select id="activate_one_listing_per_domain" name="activate_one_listing_per_domain" class="form-control">
										<?php if(isset($settings[0]['activate_one_listing_per_domain'])  && $settings[0]['activate_one_listing_per_domain'] === '1') { ?>
                                            <option value="1" selected="true">On</option>
                                            <option value="0">Off</option>
                                        <?php } else { ?>
                                            <option value="1">On</option>
                                            <option value="0" selected="true">Off</option>
                                        <?php } ?>
                                        </select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><span>Show Expired Records</span> <i class="help-icon" data-tippy-placement="right" title="if this is on expired records will blocked accessing."></i></h5>
                                        <select id="show_expired_records" name="show_expired_records" class="form-control">
										<?php if(isset($settings[0]['show_expired_records']) && $settings[0]['show_expired_records'] === '1') { ?>
                                            <option value="1" selected="true">On</option>
                                            <option value="0">Off</option>
                                        <?php } else { ?>
                                            <option value="1">On</option>
                                            <option value="0" selected="true">Off</option>
                                        <?php } ?>
                                        </select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><span>Default Currency</span>  <i class="help-icon" data-tippy-placement="right" title="Currently supports only USD more currency options will be added in future"></i></h5>
										<select id="default_currency" name="default_currency" class="form-control">
                                            <option value="USD" selected>USD</option>
                                        </select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Auction Period</h5>
										<input type="text" id="auction_period" name="auction_period" value="<?php if(isset($settings[0]['auction_period']) && !empty($settings[0]['auction_period'])) echo $settings[0]['auction_period']; ?>" class="with-border" onkeypress='validateInputNumbers(event)' required>
									</div>
								</div>


								<div class="col-xl-8">
									<div class="submit-field">
										<h5><b> Bid Value Gap : </b> Bid Value |<span> Sale Commission </span>  <i class="help-icon" data-tippy-placement="right" title="Commission for each success sale"></i></h5>
										<div class="row">

											<div class="col-xl-6">
												<div class="input-with-icon">
													<input type="text" id="bid_value_gap" name="bid_value_gap" value="<?php if(isset($settings[0]['bid_value_gap']) && !empty($settings[0]['bid_value_gap'])) echo $settings[0]['bid_value_gap']; ?>" class="with-border" placeholder="$20000" onkeypress='validateInputNumbers(event)' required>
													<i class="currency"><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?></i>
												</div>
											</div>

											<div class="col-xl-6">
												<div class="input-with-icon">
													<input type="text" id="sale_commission" name="sale_commission" value="<?php if(isset($settings[0]['sale_commission']) && !empty($settings[0]['sale_commission'])) echo $settings[0]['sale_commission']; ?>" class="with-border" placeholder="$20000" onkeypress='validateInputNumbers(event)' required>
													<i class="currency">%</i>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><span>Hold bid until approves </span><i class="help-icon" data-tippy-placement="right" title="if on 1st bid of the new bidder will be held untill seller approves it. Bid will be not displayed on te auction page untill approves"></i></h5>
										<select id="hold_bidding_until_approval" name="hold_bidding_until_approval" class="form-control">
										<?php if(isset($settings[0]['hold_bidding_until_approval'])  && $settings[0]['hold_bidding_until_approval'] === '1') { ?>
                                            <option value="1" selected="true">On</option>
                                            <option value="0">Off</option>
                                        <?php } else { ?>
                                            <option value="1">On</option>
                                            <option value="0" selected="true">Off</option>
                                        <?php } ?>
                                        </select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><span>Allow multiple bidding </span><i class="help-icon" data-tippy-placement="right" title="if on 1st bid of the new bidder will be held untill seller approves it. Bid will be not displayed on te auction page untill approves"></i></h5>
                                        <select id="allow_multiple_bidding" name="allow_multiple_bidding" class="form-control">
										<?php if(isset($settings[0]['allow_multiple_bidding']) && $settings[0]['allow_multiple_bidding'] === '1') { ?>
                                            <option value="1" selected="true">On</option>
                                            <option value="0">Off</option>
                                        <?php } else { ?>
                                            <option value="1">On</option>
                                            <option value="0" selected="true">Off</option>
                                        <?php } ?>
                                        </select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><span>Allow Approved Bidder to Bid </span><i class="help-icon" data-tippy-placement="right" title="Once Seller Approved the Bidder Same bidder will be able to place bids without approval of the seller"></i></h5>
                                        <select id="allow_approvedbidder_tobid" name="allow_approvedbidder_tobid" class="form-control">
										<?php if(isset($settings[0]['allow_approvedbidder_tobid']) && $settings[0]['allow_approvedbidder_tobid'] === '1') { ?>
                                            <option value="1" selected="true">On</option>
                                            <option value="0">Off</option>
                                        <?php } else { ?>
                                            <option value="1">On</option>
                                            <option value="0" selected="true">Off</option>
                                        <?php } ?>
                                        </select>
									</div>
								</div>

							</div>
							<!---1st Row ends-->

							<div class="row">

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><span>Mark As Completed</span><i class="help-icon" data-tippy-placement="right" title="if Delivery not accepted in No of Days mark this as delivered"></i></h5>
										<input type="text" id="mark_as_completed" name="mark_as_completed" value="<?php if(isset($settings[0]['mark_as_completed']) && !empty($settings[0]['mark_as_completed'])) echo $settings[0]['mark_as_completed']; ?>" class="with-border" placeholder="$20000" onkeypress='validateInputNumbers(event)' required>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Hide User email </h5>
										<select id="hide_useremail" name="hide_useremail" class="form-control">
										<?php if(isset($settings[0]['hide_useremail']) && $settings[0]['hide_useremail'] === '1') { ?>
                                            <option value="1" selected="true">On</option>
                                            <option value="0">Off</option>
                                        <?php } else { ?>
                                            <option value="1">On</option>
                                            <option value="0" selected="true">Off</option>
                                        <?php } ?>
                                        </select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Use Images for Homepage Thumbnails </h5>
										<select id="image_thumbnails" name="image_thumbnails" class="form-control">
										<?php if(isset($settings[0]['image_thumbnails']) && $settings[0]['image_thumbnails'] === '1') { ?>
                                            <option value="1" selected="true">On</option>
                                            <option value="0">Off</option>
                                        <?php } else { ?>
                                            <option value="1">On</option>
                                            <option value="0" selected="true">Off</option>
                                        <?php } ?>
                                        </select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>User Email Notifications </h5>
										<select id="email_notifications" name="email_notifications" class="form-control">
										<?php if(isset($settings[0]['email_notifications']) && $settings[0]['email_notifications'] === '1') { ?>
                                            <option value="1" selected="true">On</option>
                                            <option value="0">Off</option>
                                        <?php } else { ?>
                                            <option value="1">On</option>
                                            <option value="0" selected="true">Off</option>
                                        <?php } ?>
                                        </select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Activate Domain Verification </h5>
										<select id="active_domain_verification" name="active_domain_verification" class="form-control">
										<?php if(isset($settings[0]['active_domain_verification']) && $settings[0]['active_domain_verification'] === '1') { ?>
                                            <option value="1" selected="true">On</option>
                                            <option value="0">Off</option>
                                        <?php } else { ?>
                                            <option value="1">On</option>
                                            <option value="0" selected="true">Off</option>
                                        <?php } ?>
                                        </select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Processing Fee (%)<i class="help-icon" data-tippy-placement="right" title="Processing Fee Charge Percentage Enter (Leave Empty to disable)"></i></h5>
										<input type="text" id="processing_fee" name="processing_fee" value="<?php if(isset($settings[0]['processing_fee']) && !empty($settings[0]['processing_fee'])) echo $settings[0]['processing_fee']; ?>" class="with-border" onkeypress='validateInputNumbers(event)' required>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5><span>SITE SSL MODE ENABLE</span><i class="help-icon" data-tippy-placement="right" title="Please note that your site must have installed SSL certificate to activate this."></i></h5>
										<select id="ssl_enable" name="ssl_enable" class="form-control">
										<?php if(isset($settings[0]['ssl_enable'])  && $settings[0]['ssl_enable'] === '1') { ?>
                                            <option value="1" selected="true">On</option>
                                            <option value="0">Off</option>
                                        <?php } else { ?>
                                            <option value="1">On</option>
                                            <option value="0" selected="true">Off</option>
                                        <?php } ?>
                                        </select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Black Listed Domains</h5>
										<textarea type="text" id="blacklisted_domains" name="blacklisted_domains" value="" class="with-border"><?php if(isset($settings[0]['blacklisted_domains']) && !empty($settings[0]['blacklisted_domains'])) echo implode(',', json_decode(html_entity_decode($settings[0]['blacklisted_domains']),true)); ?></textarea>
									</div>
								</div>

							</div>

							<!------------->
							</div>
							</div>
							<!--Listing Tab Ends-->
						
							</div>

							<!---Listing Edit Form Tab2 ----->
							<div class="panel-heading" role="tab" id="headingTwo">
							<!-- Headline -->
								<div class="headline">
									<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i> Company profile Data</a></h3>
								</div>
							</div>

							<div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">

							<div class="content with-padding padding-bottom-10">
							<div class="row">

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Office Address Line 1</h5>
										<input type="text" id="office_add1" name="office_add1" value="<?php if(isset($settings[0]['office_add1']) && !empty($settings[0]['office_add1'])) echo $settings[0]['office_add1']; ?>" class="with-border">
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Office Address Line 2</h5>
										<input type="text" id="office_add2" name="office_add2" value="<?php if(isset($settings[0]['office_add2']) && !empty($settings[0]['office_add2'])) echo $settings[0]['office_add2']; ?>" class="with-border">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Office Telephone</h5>
										<input type="text" id="office_tel" name="office_tel" value="<?php if(isset($settings[0]['office_tel']) && !empty($settings[0]['office_tel'])) echo $settings[0]['office_tel']; ?>" class="with-border" onkeypress='validateInputNumbers(event)'>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Office Email</h5>
										<input type="email" id="office_email" name="office_email" value="<?php if(isset($settings[0]['office_email']) && !empty($settings[0]['office_email'])) echo $settings[0]['office_email']; ?>" class="with-border">
									</div>
								</div>

							</div>
							</div>
							</div>
							</div>

							<!---Listing Edit Form Tab3 ----->
							<div class="panel-heading" role="tab" id="headingThree">
							<!-- Headline -->
								<div class="headline">
									<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i> Social profile Data</a></h3>
								</div>
							</div>

							<div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">

							<div class="content with-padding padding-bottom-10">
							<div class="row">

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Facebook</h5>
										<input type="text" id="user_facebook" name="user_facebook" value="<?php if(isset($settings[0]['user_facebook']) && !empty($settings[0]['user_facebook'])) echo $settings[0]['user_facebook']; ?>" class="with-border">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Twitter</h5>
										<input type="text" id="user_twitter" name="user_twitter" value="<?php if(isset($settings[0]['user_twitter']) && !empty($settings[0]['user_twitter'])) echo $settings[0]['user_twitter']; ?>" class="with-border">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Instagram</h5>
										<input type="text" id="user_Instagram" name="user_Instagram" value="<?php if(isset($settings[0]['user_Instagram']) && !empty($settings[0]['user_Instagram'])) echo $settings[0]['user_Instagram']; ?>" class="with-border">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Github</h5>
										<input type="text" id="user_github" name="user_github" value="<?php if(isset($settings[0]['user_github']) && !empty($settings[0]['user_github'])) echo $settings[0]['user_github']; ?>" class="with-border">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Google Plus</h5>
										<input type="text" id="user_google" name="user_google" value="<?php if(isset($settings[0]['user_google']) && !empty($settings[0]['user_google'])) echo $settings[0]['user_google']; ?>" class="with-border">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Youtube</h5>
										<input type="text" id="user_youtube" name="user_youtube" value="<?php if(isset($settings[0]['user_youtube']) && !empty($settings[0]['user_youtube'])) echo $settings[0]['user_youtube']; ?>" class="with-border">
									</div>
								</div>

							</div>
							</div>
							</div>
							</div>

							<!---Listing Edit Form Tab4 ----->
							<div class="panel-heading" role="tab" id="headingFour">
							<!-- Headline -->
								<div class="headline">
									<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i> Google Analytics</a></h3>
								</div>
							</div>

							<div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">

							<div class="content with-padding padding-bottom-10">
							<div class="row">

								<div class="col-xl-8">
									<div class="submit-field">
										<h5>Google Analytics Tracking ID <code> (ex : UA-9962988-7)</code></h5>
										<input type="text" id="google_analytics" name="google_analytics" value="<?php if(isset($settings[0]['user_youtube']) && !empty($settings[0]['google_analytics'])) echo $settings[0]['google_analytics']; ?>" class="with-border">
									</div>
								</div>


							</div>
							</div>
							</div>
							</div>

						</div> <!--/Panel Ends--->

						<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						
						</form>
						
					</div>
					<!--Full Tabs Ends-->
				</div>

				<div class="col-xl-12">
					<button type="submit" class="button ripple-effect big margin-top-30" style="float: right;" form="generalSettingsForm"><i class="icon-feather-plus"></i> Update Settings</button>
					<div id="notification"></div>
                    <span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
				</div>

			</div>
			<!-- Row / End -->

			<!-- Footer -->
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
<script>$('.uploadButton-input-cover').next('label').text("<?php echo $settings[0]['json_key_file']; ?>");</script>

</body>
</html>