<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Email Setup | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3><b>Email Settings</b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li>Email Settings</li>
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

                <form method="post" name="EmailForm" id="EmailForm" class="login100-form EmailForm">  
                  <div class="card mb-3">
                    
                    <div class="card-header">
                    <h3><i class="mdi mdi-email"></i> Email settings</h3>               
                    </div>
                    <!-- end card-header -->  
                    
                    <div class="card-body">
                                
                        <div class="form-row">
                          <div class="form-group col-md-3">
                          <label><b>Notification Sending Email</b></label>
                          <input class="form-control" name="site_email" type="text" placeholder="office@website.com" value="<?php if(!empty($email_settings[0]['site_email'])) echo $email_settings[0]['site_email']; ?>" required>
                          </div>
                        
                          <div class="form-group col-md-3">
                          <label><b>Email name</b></label>
                          <input type="text" class="form-control" name="site_email_name" placeholder="Office" value="<?php if(!empty($email_settings[0]['site_email_name'])) echo $email_settings[0]['site_email_name']; ?>" required>    
                          </div>
                        </div>  
                                  
                        
                        <div class="form-row">    
                          <div class="form-group col-md-2">
                            <label><b>Mail Protocol</b></label>
                            <select name="mail_sending_option" class="form-control">
                            <?php if($email_settings[0]['mail_sending_option'] === 'php') { ?>              
                              <option value="php" selected="true">PHP (NOT recomended)</option>
                              <option value="smtp">SMTP(recomended)</option>
                            <?php } else {?>
                              <option value="php">PHP</option>
                              <option value="smtp" selected="true">SMTP (recomended)</option>
                            <?php }?>
                            </select>
                          </div>
                          
                          <div class="form-group col-md-2">
                            <label><b>SMTP server</b></label>
                            <input type="text" class="form-control" name="mail_smtp_server" value="<?php if(!empty($email_settings[0]['mail_smtp_server'])) echo $email_settings[0]['mail_smtp_server']; ?>" required>
                          </div>
                          
                          <div class="form-group col-md-2">
                            <label><b>SMTP user</b></label>
                            <input type="text" class="form-control" name="mail_smtp_user" value="<?php if(!empty($email_settings[0]['mail_smtp_user'])) echo $email_settings[0]['mail_smtp_user']; ?>" required>
                          </div>
                          
                          <div class="form-group col-md-2">
                            <label><b>SMTP password</b></label>
                            <input type="password" class="form-control" name="mail_smtp_password" value="<?php if(!empty($email_settings[0]['mail_smtp_password'])) echo $email_settings[0]['mail_smtp_password']; ?>" required> 
                          </div>
                          
                          <div class="form-group col-md-2">
                            <label><b>SMTP port</b></label>
                            <input type="text" class="form-control" name="mail_smtp_port" value="<?php if(!empty($email_settings[0]['mail_smtp_port'])) echo $email_settings[0]['mail_smtp_port']; ?>" required>
                          </div>
                          
                          <div class="form-group col-md-2">
                            <label><b>SMTP encryption</b></label>
                            <select name="mail_smtp_encryption" class="form-control" required>
                            <?php if($email_settings[0]['site_email_name'] === 'tls') { ?> 
                              <option value="tls" selected="true">TLS</option>
                              <option value="ssl">SSL</option>
                            <?php } else {?>
                              <option value="tls">TLS</option>
                              <option value="ssl" selected="true">SSL</option>
                            <?php }?>
                            </select>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Save settings</button>
                          <div id="notification"></div>
                          <span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                        </div>

                        <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                
                    </div>  
                    <!-- end card-body -->                
                      
                  </div>
                  <!-- end card --> 
                  
                </form>
                                    
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

</body>
</html>