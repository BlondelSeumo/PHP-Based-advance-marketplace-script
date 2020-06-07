<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Pages Manager | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3>Create Pages</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Create Pages</a></li>
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
							<h3>Pages Manager</h3>
						</div>

						<!----- Content --->
						<form id="pageSettingsForm" method="post" enctype="multipart/form-data"/>
						<div class="content with-padding padding-bottom-10">
						<div class="row">

							<div class="col-xl-12">
								<div class="submit-field">
									<h5>Page Title</h5>
									<input type="text" id="txt_page_title" name="txt_page_title" class="required form-control" placeholder="Page Title" required>
									<input type="hidden" id="txt_page_id" name = "txt_page_id">
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<h5>Meta Description</h5>
									<textarea rows = "8" class="form-control" cols = "60" name = "txt_page_meta_description" id="txt_page_meta_description" maxlength="150" required="true"></textarea>
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<h5>Meta Keywords <code>(Seperate by a ",")</code></h5>
									<textarea rows = "6" class="form-control" cols = "60" name = "txt_page_meta_keywords" id="txt_page_meta_keywords" maxlength="150" required="true"></textarea>
								</div>
							</div>

							<div class="col-xl-12">
								<div class="submit-field">
									<h5>Slug</h5>
									<input type="text" class="form-control" id="txt_page_url_slug" name = "txt_page_url_slug" placeholder="URL Slug" readonly="true" required="true">
								</div>
							</div>

							<div class="col-xl-12">
								<div class="submit-field">
									<h5>Description</h5>
									<textarea rows = "50" class="form-control" cols ="100" name ="txt_page_description" id="txt_page_description" maxlength="5000" required="true"></textarea>
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<h5>Visibility</h5>
									<select class="form-control form-control-lg" id="page_visibility_group" name="page_visibility_group">
                              			<option value="all">All</option>
                            		</select>
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<h5>Status</h5>
									<select class="form-control form-control-lg" id="page_visibility_status" name="page_visibility_status">
                            			<option value="1"> Active </option>
                            			<option value="0"> Disabled </option>
                          			</select>
								</div>
							</div>

							<div class="col-xl-12">
								<button type="submit" name="btn_pagesave" class="btn btn-success mr-2">Save</button>
                        		<div id="notification"></div>
                        		<span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                        	</div>

                        	<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						</div>
						</div>
						</form>
						<!----- /Content --->

						<!----- PAGES ---------------->
						<div class="row">
                    	<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">           
                        <div class="card mb-3">
                          <div class="card-body">
                            <div class="table-responsive">
                              <table id="tbl_pageData" class="table table-bordered table-hover display">
                      			<thead>
                        			<tr>
                          				<th>ID</th>
                          				<th>TITLE</th>
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
<script>
    $(document).ready(function() {
        $('#txt_page_description').summernote({
            height: 300,
            dialogsInBody: true

        });
    });
</script>
<script>loadPageData();</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>