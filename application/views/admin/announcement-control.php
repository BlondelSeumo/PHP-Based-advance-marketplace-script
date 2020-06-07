<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Announcements | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3><b>Announcements Manager</b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li>Announcements Manager</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0 panel-group" id="accordion" role="tablist" aria-multiselectable="true">

						<div class="row">
                    
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">           

                  <form method="post" name="announcementForm" id="announcementForm" class="login100-form announcementForm">  
                    <div class="card mb-3">
                      <div class="card-body">

                        <div class="form-row">

                          <div class="form-group col-md-12">
                            <label><b>Announcement Heading</b></label>
                            <input type="text" class="form-control" id="txt_announcement_heading" name = "txt_announcement_heading" placeholder="Announcement Heading" required="true">
                            <input type="hidden" class="form-control" id="txt_announcement_id" name = "txt_announcement_id">
                          </div>

                          <div class="form-group col-md-12">
                            <label><b>Announcement</b></label>
                            <textarea rows = "8" class="form-control" cols = "60" name = "txt_announcement" id="txt_announcement" maxlength="150" required="true"></textarea>
                          </div>

                        </div>

                        <div class="form-row">
                          
                          <div class="form-group col-md-4">
                            <label>Announcement Type</label>
                            <select name="announcement_type" id="announcement_type" class="form-control">
                              <option value="alert-info"> Info </option>
                              <option value="alert-warning"> Warning </option>
                              <option value="alert-success"> Success </option>
                              <option value="alert-error"> Error </option>
                            </select>
                          </div>

                          <div class="form-group col-md-4">
                            <label>Visibility</label>
                            <select name="visibility_group" id="visibility_group" class="form-control">
                              <option value="1">User</option> 
                            </select>
                          </div>
                                  
                          <div class="form-group col-md-4">
                            <label>Status</label>
                            <select name="visibility_status" id="visibility_status" class="form-control">
                              <option value="1"> Active </option>
                              <option value="0"> Disabled </option>
                            </select>
                          </div>

                        </div>  
                            
                        <div class="form-group">
                            <button type="submit" class="button ripple-effect big margin-top-30" style="float: right;" form="announcementForm"><i class="icon-feather-plus"></i> Save</button>
                            <div id="notification"></div>
                            <span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                        </div>

                        <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                   
                      </div>  
                      <!-- end card-body -->                
                      
                  </div>
                  <!-- end card --> 
                
                </form>
                    
                <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Announcements</h4>
                    <div class="card">
                    <div class="table-responsive">
                      <table id="tbl_announcementdata" class="table table-bordered table-hover display">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>HEADING</th>
                            <th>TYPE</th>
                            <th>VISIBILITY</th>
                            <th>STATUS</th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                    </div>
                  </div>
                </div>
                </div>
                                    
                </div>
                    <!-- end col -->  
                                  
              </div>
              <!-- end row -->  
						
					</div>
					<!--Full Tabs Ends-->
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
<script>loadAnnouncementData();</script>

</body>
</html>