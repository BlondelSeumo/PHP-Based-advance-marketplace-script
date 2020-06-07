<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Listings Manager | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3>Listing Header Manager</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Listing Header Manager</a></li>
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
							<h3>Listing Header Manager</h3>
						</div>

						<!----- Content --->
						<div class="card">
              <div class="card-body">
                <form id="ListingsSettingsForm" method="post" enctype="multipart/form-data"/>

                       	<div class="col-xl-12">
							             <div class="submit-field">
                          		  <label for="category_name">LISTING NAME</label>
                          		  <input type="text" class="with-border" id="listing_name" name = "listing_name" placeholder="Listing Name" required="true">
                                <input type="hidden" class="with-border" id="listing_id" name = "listing_id">
                       	  </div>
                        </div>

                        <div class="col-xl-12">
                             <div class="submit-field">
                                <label for="category_meta_description">LISTING DESCRIPTION</label>
                                <textarea type="text" class="with-border" id="listing_description" name = "listing_description" required="true"></textarea>
                             </div>
                        </div>

                        <div class="col-xl-12">
							               <div class="submit-field">
                          		  <label for="category_meta_description">LISTING PRICE</label>
                          		  <input type="text" class="with-border" id="listing_price" name = "listing_price" onkeypress='validateInputNumbers(event)' placeholder="Listing Price" required="true">
                          	 </div>
                        </div>

                        <div class="col-xl-12">
							               <div class="submit-field">
                          		<label for="category_meta_keywords">LISTING DURATION <code>  (No of Days)</code></label>
                          		<input type="text" class="with-border" id="listing_duration" name = "listing_duration" onkeypress='validateInputNumbers(event)' placeholder="Listing Duration" required="true">
                          	 </div>
                        </div>

                        <div class="col-xl-12">
                          <div class="submit-field">
                            <h5>LISTING IMAGE</h5>
                            <div class="uploadButton margin-top-30">
                              <input class="uploadButton-input-cover" type="file" accept="image/*" id="uploadListingImage" name="uploadListingImage"/>
                              <label class="uploadButton-button ripple-effect" for="uploadListingImage">Upload Icon Image</label>
                              <span class="uploadButton-file-name-cover"><b>ICON SVG image</b></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="submit-field">
                              <label for="category_meta_keywords">LISTING TYPE</label>
                              <select class="form-control form-control-lg" id="listing_type" name="listing_type">
                                <option value="website" selected="true"> Website </option>
                                <option value="domain"> Domain </option>
                                <option value="sponsored"> Sponsored </option>
                              </select>
                            </div>
                        </div>


                        <div class="col-xl-12">
                          <div class="submit-field">
                            <label for="category_meta_keywords">STATUS</label>
                            <select class="form-control form-control-lg" id="listing_status" name="listing_status">
                              <option value="1" selected="true"> Active </option>
                              <option value="0"> Inactive </option>
                            </select>
                          </div>
                        </div>

                        <button type="submit" name="btn_listingsave" class="btn btn-success mr-2">Save</button>
                        <div id="listingSettingsMsg"></div>
                        <span id="loadinglistings" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>

                        <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                  
                </form>
              </div>
          </div>
					<!----- /Content --->

					<!----- LISTING HEADERS ---------------->
					<div class="row">
            <div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">           
              <div class="card mb-3">
                  <div class="card-body">
                      <div class="table-responsive">
                          <table id="tbl_ListingsData" class="table table-striped table-hover responsive">
                            <thead>
                              <tr>
                              <th>NAME</th>
                              <th>TYPE</th>
                              <th>PRICE ($)</th>
                              <th>DURATION (DAYS)</th>
                              <th>STATUS</th>
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
        	<!----- /LISTING HEADERS ---------------->
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
<script>loadListingHeaderData();</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>