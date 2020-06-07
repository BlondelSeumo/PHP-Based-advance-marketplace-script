<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--------------------------------------HEADER SCRIPTS--------------------------------->
<?php $this->load->view('includes/head'); ?>
<!------------------------------------------------------------------------------------->
<title>Website Details And Settings</title>
<!--------------------------------------HEADER ---------------------------------------->
<?php $this->load->view('includes/header'); ?>
<!------------------------------------------------------------------------------------->
<!--------------------------------------SIDEBAR --------------------------------------->
<?php $this->load->view('includes/sidebar');?>
<!------------------------------------------------------------------------------------->
<div class="rightSide">
	<div class="col-xs-12">
		<div class="tab-content shadow-1">
			<div role="tabpanel" class="tab-pane active">
					<form method="post" name="WebsiteSettings" id="WebsiteSettings" class="form-horizontal WebsiteSettings">
					<?php
					if($error == true) {
						?>
						<div class="alert alert-danger alert-dismissable">
							<a class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Error!</strong> Some error occured settings could not be update.
						</div>
						<?php
					}
					?>
					<div class="form-group">
						<label class="col-sm-3 control-label">Base Path</label>
						<div class="col-sm-9">
							<input readonly type="text" name="basePath" placeholder="BasePath" value="<?php echo (isset($basePath) ? $basePath : $domain . str_replace("/install","",dirname($_SERVER['SCRIPT_NAME']))); ?>" class="form-control" />
							<?php
							if(isset($basePathError)) {
								?>
								<span class="text-danger"><?php echo $basePathError; ?></span>
								<?php
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Admin Email</label>
						<div class="col-sm-9">
							<input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Admin Email..." class="form-control" value="<?php echo (isset($email) ? $email : ""); ?>"  required/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Admin Username</label>
						<div class="col-sm-9">
							<input type="text" name="username"  placeholder="Admin Username..." class="form-control" value="<?php echo (isset($username) ? $username : ""); ?>"  required/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Admin Password</label>
						<div class="col-sm-9">
							<input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters' : ''); if(this.checkValidity()) form.confirmPassword.pattern = this.value;" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Admin Password..." class="form-control" value="<?php echo (isset($password) ? $password : ""); ?>" required/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Confirm Admin Password</label>
						<div class="col-sm-9">
							<input type="password" id="confirmPassword" name="confirmPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');"placeholder="Confirm Admin Password" class="form-control" value="<?php echo (isset($confirmPassword) ? $confirmPassword : ""); ?>"  required/>
						</div>
					</div>
					
					<div class="form-group">
						<div id="validationmsg"></div> <br>
						<div class="col-sm-offset-3 col-sm-8">
							<button id="website_settings_data" name="website_settings_data" class="btn btn-theme btn-lg">Submit </button>
						</div>
						<div id="loadingImage" align="center" style="display:none;"> <img src="<?php echo base_url();?>assets/images/loadingimage.gif"/> </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--------------------------------------FOOTER --------------------------------------->
<?php $this->load->view('includes/footer') ?>
<!------------------------------------------------------------------------------------->