<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Languages Manager | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3>Language Setup</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Language Setup</a></li>
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
							<h3>Languages Manager</h3>
						</div>

						<!----- Content --->
						<form id="newLanguageFrom" method="post" enctype="multipart/form-data"/>
						<div class="content with-padding padding-bottom-10">
						<div class="row">

							<div class="col-xl-12">
								<div class="submit-field">
									<h5><b> Language Name</b></h5>
									<input class="form-control" type="text" name="language_name" id="language_name" placeholder="Language Name Ex: english " maxlength="10" required >
								</div>
							</div>

							<div class="col-xl-12">
								<div class="submit-field">
									<h5><b>Language Code </b>  <code>  ( Short Form <b> | Maximum 2 Chars  |</b> ex : en )</code></h5>
									 <input type="hidden" name="language_id" id="language_id" value="">
                            		<input class="form-control" type="text" name="language_code" id="language_code" placeholder="Language Name Ex: en " maxlength="2" required >
								</div>
							</div>

							<div class="col-xl-6">
								<div class="submit-field">
									<h5><b>Status</b></h5>
									<select name="language_active" id="language_active" class="form-control">
                            			<option value="1"> Active </option>
                            			<option value="0"> Inactive </option>
                          			</select>
								</div>
							</div>

							<div class="col-xl-12">
								<button type="submit" name="language_button" class="btn btn-success mr-2">Save</button>
                        		<div id="notification"></div>
                        		<span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                        	</div>

                        	<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

						</div>
						</div>
						</form>
						<!----- /Content --->

						<!----- BLOG ---------------->
        				<div class="row">
                    	<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">           
                        <div class="card mb-3">
                          <div class="card-body">
                            <div class="table-responsive">
                              <table id="tbl_languages" class="table table-bordered table-hover display">
                      			<thead>
                        		<tr>
                            		<th>LANGUAGE</th>
                            		<th>CODE</th>
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
        				<!----- /BLOG ---------------->
        				
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
<script>loadLanguageData();</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>