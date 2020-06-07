<!DOCTYPE html>
<html lang="en">
<head>

<!--User Page Meta Tags-->
<title>Create Website Listings | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
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
				<h3><b>Create Website Listing </b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Create Website Listings</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div  id="create_listing_sesction" class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">

					<form id="createListingForm" name="createListingForm" method="POST" enctype="multipart/form-data">
					<!---Sell Websites --->
					<div class="dashboard-box margin-top-0 panel-group" id="accordion" role="tablist" aria-multiselectable="true">

						<input type="hidden" id="listing_type" name="listing_type" value="<?php if(isset($listing_data[0]['listing_type'])) echo $listing_data[0]['listing_type']; else echo 'website'; ?>">

						<!--------------------------------------------1st Panel -------------------------------------------------->
						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingOne">
							<!-- Headline -->
								<?php if(isset($domainData[0]['domain']) && !empty($domainData[0]['domain'])) { ?>
								<div class="headline">
									<h3><a id="FirstTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseOne">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i> <b>Step 1: </b> Domain Verification</a> <span id="FirstStep" class="badge badge-success">Completed </span></h3>
								</div>
								<?php } else { ?>
								<div class="headline">
									<h3><a id="FirstTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i> <b>Step 1: </b> Domain Verification</a> <span id="FirstStep" class="badge badge-success" style="display: none;">Completed </span></h3>
								</div>
								<?php }?>
							</div>

							<?php if(isset($domainData[0]['domain']) && !empty($domainData[0]['domain'])) { ?>
								<!---Listing Edit Form Tab ----->
								<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
							<?php } else { ?>
								<div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
							<?php }?>

							<div class="panel-body">

								<div class="content with-padding padding-bottom-10">
									<div class="row">
										<div class="col-xl-12">
											<div class="submit-field">
											<div id="DomainValMsg"></div>
											<h5>Enter your URL <span>(Important)</span>  <i class="help-icon" data-tippy-placement="right" title="Please enter a URL and verify"></i></h5>
											<div class="keywords-container">
												<div class="keyword-input-container">
													<input type="text" id="siteURL" name="siteURL" class="with-border" placeholder="http://doonlinejobs.com" required>
													<button class="keyword-input-button ripple-effect button-verify-url"><i class="fa fa-check" aria-hidden="true"></i></button>
												</div>
												<div class="clearfix"></div>
											</div>
											</div>

											<div id="domainVerificationDiv" style="display:none;" class="alert alert-dark">
                                        		<input type="hidden" name="savedDataInfo" id="savedDataInfo">
                                        		<p><b>Please download the following file, extract then upload it's content to your domain's root folder and click on the button verify.</b></p>
                                        		<span id="loadingImageVerify" style="display:none;" class="centerButtons"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                                        		<div id="verificationFile"></div>
                                    		</div>
                                    		<div id="ContinueVal"></div>
										</div>
									</div>
								</div>

							</div>
							</div>
						</div><!--------------------------------/ Ends 1st Panel -------------------------------------------------->

						<!--------------------------------------------2nd Panel -------------------------------------------------->
						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingTwo">
							<!-- Headline -->
								<?php if(isset($listing_data[0]['website_BusinessName']) && !empty($listing_data[0]['website_BusinessName'])) { ?>
								<div class="headline">
									<h3><a id="secondTab" role="button" data-toggle="collapse" data-parent="" href="#" aria-expanded="true" aria-controls="collapseTwo">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b>Step 2: </b> Let's get started | Provide accurate information about your business</a> <span id="SecondStep" class="badge badge-success">Completed </span></h3>
								</div>
								<?php } else { ?>
								<div class="headline">
									<h3><a id="secondTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseTwo">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b>Step 2: </b> Let's get started | Provide accurate information about your business</a> <span id="SecondStep" class="badge badge-success" style="display: none;">Completed </span></h3>
								</div>
								<?php }?>

							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							<div class="panel-body">

							<div class="content with-padding padding-bottom-10">
							<div class="row">

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Business Name</h5>
										<input type="text" id="website_BusinessName" name="website_BusinessName" value="<?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?>" class="with-border" placeholder="Business Name" readonly="true" required>
										<input type="hidden" id="listing_id" name="listing_id" value="<?php if(isset($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
										<input type="hidden" id="domain_id" name="domain_id" value="<?php if(isset($listing_data[0]['domain_id'])) echo $listing_data[0]['domain_id']; ?>">
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Bussiness Age <span>(Years)</span>  <i class="help-icon" data-tippy-placement="right" title="Should be add in years"></i></h5>
										<input type="text" id="website_age" name="website_age" value="<?php if(isset($listing_data[0]['website_age'])) echo $listing_data[0]['website_age']; ?>" class="with-border" placeholder="2 Years" onkeypress='validateInputNumbers(event)' required>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Business Registered</h5>
										<select class="required" id="business_registeredCountry" name="business_registeredCountry" class="selectpicker with-border">
                                            <option value="" selected>Where is your business registered?</option>
                                        </select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Website Category</h5>
										<?php if(isset($listing_data[0]['website_industry']) && !empty($listing_data[0]['website_industry'])) ?>
                                        <select class="required" name="website_industry" id="website_industry" class="selectpicker with-border">
                                            <option value="">Select Your Website Industry</option>
                                                <?php foreach ($categoriesData as $key) { 
                                                    if( !empty($listing_data[0]['website_industry'])) { if($key['c_id'] == $listing_data[0]['website_industry']) {
                                                ?>
                                            <option value="<?php echo $key['c_id']; ?>"selected><?php echo $key['c_name']; ?></option>
                                                <?php } else { ?>
                                            <option value="<?php echo $key['c_id']; ?>"><?php echo $key['c_name']; ?></option>
                                                <?php } }else { ?>
                                            <option value="<?php echo $key['c_id']; ?>"><?php echo $key['c_name']; ?></option>
                                                <?php } }?>
                                        </select>
									</div>
								</div>


								<div class="col-xl-8">
									<div class="submit-field">
										<h5><b> Financial Overview : </b> Revenue | Expenses | <span>(Net Profit)</span>  <i class="help-icon" data-tippy-placement="right" title="Net Profit will be automatically calculated"></i></h5>
										<div class="row">
											<div class="col-xl-4">
												<div class="input-with-icon">
													<input type="text" id="last12_monthsrevenue" name="last12_monthsrevenue" value="<?php if(isset($listing_data[0]['last12_monthsrevenue'])) echo $listing_data[0]['last12_monthsrevenue']; ?>" class="with-border" placeholder="$20000" onkeypress='validateInputNumbers(event)' required>
													<i class="currency"><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?></i>
												</div>
											</div>
											<div class="col-xl-4">
												<div class="input-with-icon">
													<input type="text" id="last12_monthsexpenses" name="last12_monthsexpenses" value="<?php if(isset($listing_data[0]['last12_monthsexpenses'])) echo $listing_data[0]['last12_monthsexpenses']; ?>" class="with-border" placeholder="$20000" onkeypress='validateInputNumbers(event)' required>
													<i class="currency"><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?></i>
												</div>
											</div>
											<div class="col-xl-4">
												<div class="input-with-icon">
													<input type="text" id="annual_profit" name="annual_profit" value="<?php if(isset($listing_data[0]['annual_profit'])) echo $listing_data[0]['annual_profit']; ?>" class="with-border" placeholder="" readonly="true" required>
													<i class="currency"><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?></i>
												</div>
											</div>
										</div>
									</div>
								</div>


								
								<div class="col-xl-12">
									<h5><b> Financial Evidences </b> <span>(Optional)</span>  <i class="help-icon" data-tippy-placement="right" title="Net Profit will be automatically calculated"></i></h5>
									<div class="row">
										<div class="col-xl-6">
										<div class="submit-field">
											<div class="uploadButton margin-top-30">
												<input class="uploadButton-input-visual" type="file" accept="image/*, application/pdf" id="uploadVisual" name="uploadVisual" />
												<label class="uploadButton-button ripple-effect" for="uploadVisual">Upload Files</label>
												<span class="uploadButton-file-name-visual"><b>Visual Evidence of Revenue Screenshot or video walkthrough. Can be from Quickbooks, AdSense, Shopify, Amazon, PayPal, etc.</b></span>
											</div>
										</div>
										</div>

										<div class="col-xl-6">
										<div class="submit-field">
											<div class="uploadButton margin-top-30">
												<input class="uploadButton-input-profit" type="file" accept="image/*, application/pdf" id="uploadProfitLoss" name="uploadProfitLoss" />
												<label class="uploadButton-button ripple-effect" for="uploadProfitLoss">Upload Files</label>
												<span class="uploadButton-file-name-profit"><b>P&L (Profit and Loss Statement), Please ensure this is up to date to gain customer trust towards your listings.Ignore if you don't have this</b></span>
											</div>
										</div>
										</div>
									
									</div>

								</div>

							</div>
							<!---1st Row ends-->

							<div class="row">

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Tagline</h5>
										<input type="text" id="website_tagline" name="website_tagline" class="with-border" placeholder="Tag Line" value="<?php if(isset($listing_data[0]['website_tagline'])) echo $listing_data[0]['website_tagline']; ?>" required>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Meta Description of the website</h5>
										<textarea id="website_metadescription" name="website_metadescription" rows = "5" cols = "60" class="required with-border"><?php if(isset($listing_data[0]['website_metadescription'])) echo $listing_data[0]['website_metadescription']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-12">
									<div class="submit-field">
										<h5>Meta Keywords<span>(important)</span>  <i class="help-icon" data-tippy-placement="right" title="Seperate each word by a ,"></i></h5>
										<textarea id="website_metakeywords" name="website_metakeywords" rows = "3" cols = "60" class="required with-border"><?php if(isset($listing_data[0]['website_metakeywords'])) echo $listing_data[0]['website_metakeywords']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-12">
									<div class="submit-field">
										<h5>Tell us about your business so potential buyers get excited. What does your business do?<span>(Important)</span>  <i class="help-icon" data-tippy-placement="right" title="Be Descriptive. Add everything you think which is important"></i></h5>
										<textarea id="summernote" name="editordata" rows = "5" cols = "60" class="form-control"><?php if(isset($listing_data[0]['description'])) echo $listing_data[0]['description']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>How does your business make money?</h5>
										<textarea id="website_how_make_money" name="website_how_make_money" rows = "3" cols = "60" class="required form-control"><?php if(isset($listing_data[0]['website_how_make_money'])) echo $listing_data[0]['website_how_make_money']; ?></textarea>
									</div>
								</div>


								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Describe your purchasing and order fulfilment process</h5>
										<textarea id="website_purchasing_fulfilment" name="website_purchasing_fulfilment" rows = "3" cols = "60" class="required form-control"><?php if(isset($listing_data[0]['website_purchasing_fulfilment'])) echo $listing_data[0]['website_purchasing_fulfilment']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Why are you selling this business?</h5>
										<textarea id="website_whyselling" name="website_whyselling" rows = "3" cols = "60" class="required form-control"><?php if(isset($listing_data[0]['website_whyselling'])) echo $listing_data[0]['website_whyselling']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Who would this business be perfect for?</h5>
										<textarea id="website_suitsfor" name="website_suitsfor" rows = "3" cols = "60" class="required form-control"><?php if(isset($listing_data[0]['website_suitsfor'])) echo $listing_data[0]['website_suitsfor']; ?></textarea>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Facebook</h5>
										<input type="text" id="website_facebook" name="website_facebook" value="<?php if(isset($listing_data[0]['website_facebook'])) echo $listing_data[0]['website_facebook']; ?>" class="qty form-control required" placeholder="No of Likes" onkeypress='validateInputNumbers(event)'>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Twitter</h5>
										<input type="text" id="website_twitter" name="website_twitter" value="<?php if(isset($listing_data[0]['website_twitter'])) echo $listing_data[0]['website_twitter']; ?>" class="qty form-control required" placeholder="No of followers" onkeypress='validateInputNumbers(event)'>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Instagram</h5>
										<input type="text" id="website_instagram" name="website_instagram" value="<?php if(isset($listing_data[0]['website_instagram'])) echo $listing_data[0]['website_instagram']; ?>" class="qty form-control required" placeholder="No of followers" onkeypress='validateInputNumbers(event)'>
									</div>
								</div>

								<div class="col-xl-12">
									<div class="submit-field">
										<h5>Will deliver in No of Days</h5>
										<select id="deliver_in" name="deliver_in" class="required" class="selectpicker with-border">
                        					<option value="1" selected>1 day</option>
                        					<option value="2" selected>2 days</option>
                        					<option value="3" selected>3 days</option>
                        					<option value="4" selected>4 days</option>
                        					<option value="5" selected>5 days</option>
                        					<option value="6" selected>6 days</option>
                        					<option value="7" selected>7 days</option>
                        					<option value="8" selected>8 days</option>
                        					<option value="9" selected>9 days</option>
                        					<option value="10" selected>10 days</option>
                        					<option value="11" selected>11 days</option>
                        					<option value="12" selected>12 days</option>
                        					<option value="13" selected>13 days</option>
                        					<option value="14" selected>14 days</option>
                        					<option value="15" selected>15 days</option>
                        					<option value="16" selected>16 days</option>
                        					<option value="17" selected>17 days</option>
                        					<option value="18" selected>18 days</option>
                        					<option value="19" selected>19 days</option>
                        					<option value="20" selected>20 days</option>
                        					<option value="21" selected>21 days</option>
                        					<option value="22" selected>22 days</option>
                        					<option value="23" selected>23 days</option>
                        					<option value="24" selected>24 days</option>
                        					<option value="25" selected>25 days</option>
                        					<option value="26" selected>26 days</option>
                        					<option value="27" selected>27 days</option>
                        					<option value="28" selected>28 days</option>
                        					<option value="29" selected>29 days</option>
                        					<option value="30" selected>30 days</option>
                       					</select>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<div class="uploadButton margin-top-30">
											<input class="uploadButton-input-cover" type="file" accept="image/*, application/pdf" id="uploadListingImage" name="uploadListingImage" required/>
											<label class="uploadButton-button ripple-effect" for="uploadListingImage">Upload Cover Image</label>
											<span class="uploadButton-file-name-cover"><b>Listing ImageAn eye-catching image goes a long way.Upload a photograph of your site, product, or service (min 550px x 300px)</b></span>
										</div>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<div class="uploadButton margin-top-30">
											<input class="uploadButton-input-thumb" type="file" accept="image/*, application/pdf" id="uploadThumbnailImage" name="uploadThumbnailImage" required/>
											<label class="uploadButton-button ripple-effect" for="uploadThumbnailImage">Upload Image</label>
											<span class="uploadButton-file-name-thumb"><b>Listing Thumbnail Image ,An eye-catching image goes a long way.Upload a photograph of your site, product, or service (min 200px x 200px)</b></span>
										</div>
									</div>
								</div>


							</div>

							<div class="row">
								<div class="col-xl-12">
									<button type="button" id="BtnNext" name="BtnNext" value="NEXT" class="button ripple-effect big margin-top-30" style="float: right;">NEXT <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
								</div>
							</div>

							<!------------->
							</div>
							</div>
							<!--Listing Tab Ends-->
						
							</div>

						</div> <!--/ 2nd Panel Ends------------------------------------------------------------------------------->

						<!--------------------------------------------3Rd Panel -------------------------------------------------->
						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingThree">
								<?php if(isset($listing_data[0]['listing_option']) && !empty($listing_data[0]['listing_option'])) { ?>
								<!-- Headline -->
								<div class="headline">
									<h3><a id="ThirdTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseThree">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b>Step 3: </b> How would like to sell | How much would you like to sell it for </a> <span id="ThirdStep" class="badge badge-success">Completed </span></h3>
								</div>
							<?php } else { ?>
								<div class="headline">
									<h3><a id="ThirdTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseThree">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b>Step 3: </b> How would like to sell | How much would you like to sell it for </a> <span id="ThirdStep" class="badge badge-success" style="display: none;">Completed </span></h3>
								</div>
							<?php }?>
						
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
							<div class="panel-body">

								<div class="content with-padding padding-bottom-10">
									<div class="row centerButtons">
										<?php if(!empty($options)) { 
										foreach ($options as $option) { ?>
										<div class="col-xl-4">
											<div class="submit-field item">
												<input id="website_1_<?php echo $option['radio']; ?>" type="radio" name="website_1_group_2" value="<?php echo $option['radio']; ?>" class="required">
                                            	<label for="website_1_<?php echo $option['radio']; ?>"><img src="<?php echo base_url().ICON_UPLOAD; ?><?php echo $option['icon']; ?>" alt=""><strong><?php echo $option['name']; ?></strong><?php echo $option['description']; ?></label>
											</div>
										</div>
										<?php } } else {echo 'Sorry, No selling options are activated.';}   ?>
										
									</div>

									<div id="Sell-Auction-Website" style="display:none;" class="row">

										<div class="col-xl-4">
											<div class="submit-field">
												<h5>Starting Price ($)</h5>
												<input type="text" id="website_startingprice" name="website_startingprice" class="required form-control with-border" placeholder="20" onkeypress='validateInputNumbers(event)'>
											</div>
										</div>

										<div class="col-xl-4">
											<div class="submit-field">
												<h5>Reserve ($)</h5>
												<input type="text" id="website_reserveprice" name="website_reserveprice" class="required form-control with-border" placeholder="20" onkeypress='validateInputNumbers(event)'><small id="reservredPriceWebsite" class="text-danger"></small>
											</div>
										</div>

										<div class="col-xl-4">
											<div class="submit-field">
												<h5>Buy It Now ($)</h5>
												<input type="text" id="website_buynowpriceauc" name="website_buynowprice" class=" form-control with-border" placeholder="20" onkeypress='validateInputNumbers(event)'><small class="text-info"> Leave Empty to disable</small>
											</div>
										</div>
					
									</div>


									<div id="Sell-Classified-Website" style="display:none;" class="row">

										<div class="col-xl-4">
											<div class="submit-field">
												<h5>Minimum Offer ($)</h5>
												<input type="text" id="website_minimumoffer" name="website_minimumoffer" class="required form-control with-border" placeholder="20" onkeypress='validateInputNumbers(event)'>
											</div>
										</div>

										<div class="col-xl-4">
											<div class="submit-field">
												<h5>Buy Now Price ($)</h5>
												<input type="text" id="website_buynowpriceclas" name="website_buynowprice" class="form-control with-border" placeholder="20" onkeypress='validateInputNumbers(event)'><small class="text-info"> Leave Empty to disable</small>
											</div>
										</div>
					
									</div>

									<div class="row">
										<div class="col-xl-12">
											<span id="loadingImageSubmit" style="display:none;" class="centerButtons"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                                    		<div id="submitValidaton"></div>
											<button type="submit" value="NEXT" class="button ripple-effect big margin-top-30" style="float: right;">NEXT <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
										</div>
									</div>

								</div>

							</div>
							</div>
						</div><!--------------------------------/ Ends 3rd Panel -------------------------------------------------->
						
						

						<!--------------------------------------------4th Panel -------------------------------------------------->
						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingFour">
							<!-- Headline -->
								<?php if(!isset($listing_data)) { ?>
								<div class="headline">
									<h3><a id="FourthTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseFour">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b>Step 4: </b> Link With Google Analytics</a> <span id="FourthStep" class="badge badge-success" style="display: none;">Completed </span></h3>
								</div>
								<?php } else { if( isset($listing_data[0]['google_verified']) && $listing_data[0]['google_verified'] ==='1') { ?>
								<div class="headline">
									<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="true" aria-controls="collapseFour">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b>Step 4: </b> Link With Google Analytics</a> <span id="FourthStep" class="badge badge-success">Completed </span></h3>
								</div>
								<?php } else { ?>
								<div class="headline">
									<h3><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b>Step 4: </b> Link With Google Analytics</a> <span id="FourthStep" class="badge badge-success" style="display: none;">Completed </span></h3>
								</div>
								<?php } }?>
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
							<div class="panel-body">

								<div class="content with-padding padding-bottom-10">
									<div class="row">
										<div class="col-xl-12">
											<div class="submit-field">
												<h5>Google Analytics <span>(Recommend)</span>  <i class="help-icon" data-tippy-placement="right" title="Link your site with google analytics"></i></h5>
										 		<input type="hidden" name="verifiedGA" id="verifiedGA" value="">
										 		<?php if(!isset($listing_data)) { ?>
										 		<a id="linkAnalyticsAdd" href="" role='button' class="button ripple-effect big text-center" style="width: 100%;"> Link Google Analytics</a>
                                        		<?php  } else { if(isset($listing_data[0]['google_verified']) && $listing_data[0]['google_verified'] ==='1') { ?>
                                        		<a href="<?php echo base_url()."analytics/unlink/".$listing_data[0]['domain_id'].'/'.$listing_data[0]['id']; ?>" role='button' class="button ripple-effect big text-center" style="width: 100%;">Unlink Google Analytics </a>
                                        		<?php } else {?>
                                        		<a href="<?php echo base_url()."analytics/index/".$listing_data[0]['domain_id'].'/'.$listing_data[0]['id'].'/123'; ?>" role='button' class="button ripple-effect big text-center" style="width: 100%;"> Link Google Analytics</a>
                                        		<?php }	}?>
                                        	</div>
                                        </div>
									</div>

									<div class="row">
										<div class="col-xl-12">
											<button id="BtnSkip" type="button" value="SKIP" class="button ripple-effect big margin-top-30" style="float: right;">SKIP <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
										</div>
									</div>

								</div>

							</div>
							</div>
						</div><!--------------------------------/ Ends 4th Panel -------------------------------------------------->

						<!--------------------------------------------5th Panel -------------------------------------------------->
						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingFive">
							<!-- Headline -->
								<div class="headline">
									<h3><a id="FifthTab" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b>Step 5: </b> Pay & Start Selling</a> <span id="FifthStep" class="badge badge-success" style="display: none;">Completed </span></h3>
								</div>
						
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
							<div class="panel-body">

								<div class="content with-padding padding-bottom-10">
									<div class="row centerButtons">

										<?php if(isset($listingOptions))  { 

                                		foreach ($listingOptions as $option) { ?>

										<div class="col-xl-4">
											<div class="submit-field item">
												<input id="answer_<?php echo $option['listing_id']; ?>" type="radio" name="listing_group_1" value="<?php echo $option['listing_id'] ?>" class="required listings">
                                            	<label for="answer_<?php echo $option['listing_id']; ?>"><img src="<?php echo base_url().ICON_UPLOAD.$option['listing_icon']; ?>" alt=""><h2><b><?php echo $default_currency; ?><?php if(isset($option['listing_price'])) echo $option['listing_price']; ?></b></h2><strong><?php if(isset($option['listing_name'])) echo $option['listing_name']; ?></strong><?php if(isset($option['listing_description'])) echo $option['listing_description']; ?><br><h4><b> Listing Duraton : <?php if(isset($option['listing_duration'])) echo $option['listing_duration']; ?> Days </b></h4></label>
                                            	<input type="hidden" name="txt_listamount" class="txt_listamount" value="<?php if(isset($option['listing_price'])) echo $option['listing_price']; ?>">
                                            	<input type="hidden" name="txt_listingname" class="txt_listingname" value="<?php if(isset($option['listing_name'])) echo $option['listing_name']; ?>">
											</div>
										</div>
										
										<?php } }?>

									</div>

									<div class="row">
										<div class="col-xl-12">
											<button id="BtnNextPay" type="button" value="NEXT" class="button ripple-effect big margin-top-30" style="float: right;">NEXT <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
										</div>
									</div>
								</div>

							</div>
							</div>
						</div><!--------------------------------/ Ends 5th Panel -------------------------------------------------->

						<!--------------------------------------------6th Panel -------------------------------------------------->
						<div class="panel panel-default">
						
							<!---Listing Edit Form Tab ----->
							<div class="panel-heading" role="tab" id="headingSix">
							<!-- Headline -->
								<div class="headline">
									<h3><a id="SixthTab" role="button" data-toggle="collapse" data-parent="#accordion" href="" aria-expanded="true" aria-controls="collapseSix">
									<i class="more-less glyphicon glyphicon-plus"></i><i class="icon-feather-folder-plus panel-title"></i><b>Step 6: </b> Sponsor Your Listings</a> <span id="SixthStep" class="badge badge-success" style="display: none;">Completed </span></h3>
								</div>
						
							</div>

							<!---Listing Edit Form Tab ----->
							<div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
							<div class="panel-body">

								<div class="content with-padding padding-bottom-10">
									<div class="row centerButtons">

										<?php if(isset($sponsorOptions))  { 

                                		foreach ($sponsorOptions as $option) { ?>

										<div class="col-xl-4">
											<div class="submit-field item">
												<input id="answer_<?php echo $option['listing_id']; ?>" type="radio" name="sponsor_group_1" value="<?php echo $option['listing_id'] ?>" class='sponsored'>
                                            	<label for="answer_<?php echo $option['listing_id']; ?>"><img src="<?php echo base_url().ICON_UPLOAD.$option['listing_icon']; ?>" alt=""><h2><b><?php echo $default_currency; ?><?php if(isset($option['listing_price'])) echo $option['listing_price']; ?></b></h2><strong><?php if(isset($option['listing_name'])) echo $option['listing_name']; ?></strong><?php if(isset($option['listing_description'])) echo $option['listing_description']; ?><br><h4><b> Listing Duraton : <?php if(isset($option['listing_duration'])) echo $option['listing_duration']; ?> Days </b></h4></label>
											</div>
										</div>
										
										<?php } }?>

									</div>

									<div class="row">
										<div class="col-xl-12">
											<button id="BtnNextFinal" type="button" value="NEXT" class="button ripple-effect big margin-top-30" style="float: right;">NEXT <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
										</div>
									</div>
								</div>

							</div>
							</div>
						</div><!--------------------------------/ Ends 6th Panel -------------------------------------------------->
						
					</div>
					<!--Full Tabs Ends-->
					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					</form>
				</div>

			</div>
			<!-- Row / End -->

			<!-- Row -->
			<div id="pay_listing" class="row" style="display: none;">

				<!-- Dashboard Box -->
				<div class="col-xl-12">

					<form id="payWrapper" method="POST" enctype="multipart/form-data" class="creditly-card-form agileinfo_form" action="<?php echo site_url("payments/proceedtoPayment")?>">
						
						<div class="question_title">
                            <h3>Pay & Start Selling</h3>
                        </div>


						<?php if(!empty($error)) {?>
							<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><span><?php print_r($error); ?></span></div>
						<?php } ?>

						<!-- Payment Methods Accordion -->

                        <div class="row centerButtons">
                        <?php if(!empty($payments)) { ?>
                            <?php foreach ($payments as $key) {

								if($key['id'] === '2') { ?>
                                <div class="col-lg-3">
                                    <div class="item">
                                        <input id="answer_1_payvia_card" type="radio" name="branch_1_pay_1" value="payvia_card" class="required">
                                        <label for="answer_1_payvia_card"><img src="<?php echo base_url().ICON_UPLOAD?>pay.svg" alt=""><strong>Credit Card</strong></label>
                                    </div>
                                </div>
                                <?php } else if($key['id'] === '1') { ?>
                                <div class="col-lg-3">
                                    <div class="item">
                                        <input id="answer_2_payvia_paypal" name="branch_1_pay_1" type="radio" value="payvia_paypal" class="required">
                                        <label for="answer_2_payvia_paypal"><img src="<?php echo base_url().ICON_UPLOAD?>paypal.svg" alt=""><strong>Via PayPal</strong></label>
                                    </div>
                                </div>
                            	<?php } else if($key['id'] === '3') { ?>
                                <div class="col-lg-3">
                                    <div class="item">
                                        <input id="answer_4_payvia_paypal" name="branch_1_pay_1" type="radio" value="payvia_stripe" class="required">
                                        <label for="answer_4_payvia_paypal"><img src="<?php echo base_url().ICON_UPLOAD?>stripe.png" alt=""><strong>Via Stripe</strong></label>
                                    </div>
                                </div>
                               	<?php } } } ?>
                                <div id="freecheckout_select" class="col-lg-3">
                                    <div class="item">
                                       	<input id="answer_3_freecheckout" name="branch_1_pay_1" type="radio" value="free_checkout" class="required">
                                        <label for="answer_3_freecheckout"><img src="<?php echo base_url().ICON_UPLOAD?>bonus.svg" alt=""><strong>Free Checkout</strong></label>
                                    </div>
                                </div>
                        </div>
                        <!-- /row-->

                        <div class="row justify-content-center p-3">
                            <div class="col-lg-8">
                                <div class="box_general">
                                    <div class="boxed-widget-headline">
                                        <h3>Summary  <span class="noofitems-summary"></span></h3>
                                    </div>

                                    <div class="boxed-widget-inner">
                                        <ul class="checkout-items"></ul>
                                        <ul id="listings"></ul>
                                        <h2 style="float: right;" id="total"></h2>
                                    </div>
                                </div>
                                <div id="paymentValidations"></div>
                            </div>
                        </div>

                        <?php foreach ($payments as $key) {
                        if($key['id'] === '2') { ?>
                        <div id="Pay_Credit_Card" class="row justify-content-center p-3 creditly-wrapper gray-theme" style="display:none;">
                            <div class="col-lg-8">

                                <div class="box_general paypal">

                                    <label for="creditCart"><strong>Credit / Debit Card (Paypal Pro)</strong></label>
                                    <img class="payment-logo" src="<?php if(!empty($key['icon_url'])) echo $key['icon_url'] ?>" alt="" hspace="20">

                                    <div class="row payment-form-row credit-card-wrapper">

                                        <div class="col-md-6">
											<div class="card-label">
												<input name="nameOnCard" type="text" class="required" placeholder="Cardholder Name">
											</div>
										</div>

										<div class="col-md-6">
											<div class="card-label">
												<input class="number credit-card-number form-control required" type="text" name="number"
													inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number" placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;"  onkeypress='validateInputNumbers(event)'>
											</div>
										</div>

										<div class="col-md-4">
											<div class="card-label">
												<label class="control-label">Expiration Date</label>
												<input class="expiration-month-and-year form-control required" type="text" name="expiration-month-and-year" placeholder="MM / YY"  onkeypress='validateInputNumbers(event)'>
												<input type="hidden" name="txt_month" class="txt_month"/>
												<input type="hidden" name="txt_year" class="txt_year"/>
											</div>
										</div>

										<div class="col-md-4">
											<div class="card-label">
												<input class="security-code form-control required"Â·inputmode="numeric"type="text" name="security-code"placeholder="&#149;&#149;&#149;">
											</div>
										</div>

                                    </div>

                                </div>
                                <!-- /box_general -->
                            </div>
                        </div>
                        <!-- /row-->
                        <?php } else if($key['id'] === '3') { ?>
                        <div id="Pay_stripe" class="row justify-content-center p-3 creditly-wrapper gray-theme" style="display:none;">
                            <div class="col-lg-8">

                                <div class="box_general stripe">

                                    <label for="creditCart"><strong>Credit / Debit Card (Stripe)</strong></label>
                                    <img class="payment-logo" src="<?php if(!empty($key['icon_url'])) echo $key['icon_url'] ?>" alt="" hspace="20">

                                    <div class="row payment-form-row credit-card-wrapper">

                                        <div class="col-md-6">
											<div class="card-label">
												<input name="nameOnCard" type="text" class="required" placeholder="Cardholder Name">
											</div>
										</div>

										<div class="col-md-6">
											<div class="card-label">
												<input class="number credit-card-number form-control required" type="text" name="number"
													inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number" placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;"  onkeypress='validateInputNumbers(event)'>
											</div>
										</div>

										<div class="col-md-4">
											<div class="card-label">
												<label class="control-label">Expiration Date</label>
												<input class="expiration-month-and-year form-control required" type="text" name="expiration-month-and-year" placeholder="MM / YY"  onkeypress='validateInputNumbers(event)'>
												<input type="hidden" name="txt_month" class="txt_month"/>
												<input type="hidden" name="txt_year" class="txt_year"/>
											</div>
										</div>

										<div class="col-md-4">
											<div class="card-label">
												<input class="security-code form-control required"Â·inputmode="numeric"type="text" name="security-code"placeholder="&#149;&#149;&#149;">
											</div>
										</div>

                                    </div>

                                </div>
                                <!-- /box_general -->
                            </div>
                        </div>
                        <!-- /row-->
                        <?php } else if($key['id'] === '1') { ?>
                        <div id="Pay_paypal" class="row justify-content-center p-3" style="display:none;">
                            <div class="col-lg-8">
                                <div class="box_general">
                                    <label for="paypal"><strong>PayPal</strong></label>
                                    <img class="payment-logo paypal" src="<?php if(!empty($key['icon_url'])) echo $key['icon_url'] ?>" alt="" hspace="20">
                                        <p>You will be redirected to PayPal to complete payment.</p>
                                </div>
                                <!-- /box_general -->
                            </div>
                        </div>
                        <?php } } ?>
                       	<div id="Pay_free" class="row justify-content-center p-3" style="display:none;">
                            <div class="col-lg-8">
                                <div class="box_general">
                                    <label for="paypal"><strong>Free Checkout</strong></label>
                                    <img class="payment-logo paypal" src="https://i.imgur.com/ApBxkXU.png" alt="" hspace="20">
                                    <p>Your Listing will be activated free of charge for selected period of time</p>
                                </div>
                                <!-- /box_general -->
                            </div>
                        </div>

                        <input type="hidden" name="txt_payid" id="txt_payid">
                        <input type="hidden" name="txt_payamount" id="txt_payamount">
                        <input type="hidden" name="txt_listingid" id="txt_listingid" value="<?php if(!empty($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
                        <input type="hidden" name="txt_sponsored_id" id="txt_sponsored_id">
                        <input id="button_pay" name="button_pay" type="submit" class="button big ripple-effect margin-top-40 margin-bottom-65 submit" style="float: right; display: none;" value="Proceed Payment">
                        <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
					</form>
				</div>
			</div>

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
<script>checkoutlistingspage();</script>
<!--------------------------------------------------------------------------------------------------------------->
<script>
    $(document).ready(function() {
        $('#summernote,#summernoteDomain').summernote({
                height: 300,
                dialogsInBody: true

            });
        });
</script>

<script>populateListOfCountries('business_registeredCountry');</script>

</body>
</html>