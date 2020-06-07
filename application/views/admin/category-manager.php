<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Category Manager | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3>Category Manager</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Category Manager</a></li>
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
							<h3>Category Manager</h3>
						</div>

						<!----- Content --->
						<div class="card">
                    	<div class="card-body">
                       	<form id="CategorySettingsForm" method="post" enctype="multipart/form-data"/>

                       	<div class="col-xl-12">
							<div class="submit-field">
                          		<label for="category_name">CATEGORY NAME</label>
                          		<input type="text" class="with-border" id="category_name" name = "category_name" placeholder="Category Name" required="true">
                           		<input type="hidden" class="form-control" id="category_id" name = "category_id">
                       		</div>
                        </div>

                        <div class="col-xl-12">
							<div class="submit-field">
                          		<label for="category_meta_description">CATEGORY META DESCRIPTION</label>
                          		<textarea rows = "8" class="with-border" cols = "60" name = "category_meta_description" id="category_meta_description" maxlength="150" required="true"></textarea>
                          	</div>
                        </div>

                        <div class="col-xl-12">
							<div class="submit-field">
                          		<label for="category_meta_keywords">CATEGORY META KEYWORDS <code>  (each keyword should be seperated by a coma )</code></label>
                          		<textarea rows = "3" class="with-border" cols = "60" name = "category_meta_keywords" id="category_meta_keywords" maxlength="150" required="true"></textarea>
                          	</div>
                        </div>

                        <div class="col-xl-12">
                          <div class="submit-field">
                            <h5>CATEGORY IMAGE</h5>
                            <div class="uploadButton margin-top-30">
                              <input class="uploadButton-input-cover" type="file" accept="image/*" id="uploadListingImage" name="uploadListingImage"/>
                              <label class="uploadButton-button ripple-effect" for="uploadListingImage">Upload Icon Image</label>
                              <span class="uploadButton-file-name-cover"><b>ICON PNG image</b></span>
                            </div>
                          </div>
                        </div>

                        <div class="col-xl-12">
							<div class="submit-field">
                         		<label for="category_url_slug">URL SLUG</label>
                          		<input type="text" class="with-border" id="category_url_slug" name = "category_url_slug" placeholder="URL Slug" readonly="true" required="true">
                          	</div>
                        </div>

                        <div class="col-xl-12">
							<div class="submit-field">
                          		<label for="category_level">CATEGORY LEVEL</label>
                          		<select class="form-control" id="category_level" name="category_level">
                            		<option value="0"> Main </option>
                          		</select>
                          	</div>
                        </div>


                        <button type="submit" name="btn_categorysave" class="btn btn-success mr-2">Save</button>
                        <div id="categoriesSettingsMsg"></div>
                        <span id="loadingCategories" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>

                        <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                      </form>
                    </div>
                  	</div>
					<!----- /Content --->

					<!----- PAGES ---------------->
					<div class="row">
                    <div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">           
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="table-responsive">
                              	<table id="tbl_categoriesData" class="table table-striped table-hover responsive">
                      			<thead>
                        			<tr>
                          			<th>NAME</th>
                          			<th>DESCRIPTION</th>
                          			<th></th>
                          			<th></th>
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
<script>loadCategoryData();</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>