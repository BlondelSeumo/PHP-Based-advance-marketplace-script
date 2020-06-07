<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--------------------------------------HEADER SCRIPTS--------------------------------->
<?php $this->load->view('includes/head'); ?>
<!------------------------------------------------------------------------------------->
<!--------------------------------------HEADER SCRIPTS--------------------------------->
<?php $error = false;
function success($text) {
	?>
	<div class="alert alert-success" role="alert">
		<i class="fa fa-smile-o fa-lg"></i><?php echo $text; ?>
	</div>
	<?php
}
function error($text) {
	?>
	<div class="alert alert-danger" role="alert">
		<i class="fa fa-frown-o fa-lg"></i><?php echo $text; ?>
	</div>
	<?php
}
?>
<!------------------------------------------------------------------------------------->
<title>Server Requirements</title>
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
				<form class="form-horizontal">
					<div class="form-group">
					</div>
					<?php 
					if($web_server_on=='1') { ?>
					<div class="form-group">
						<label class="col-sm-3 control-label">Web Server</label>
						<div class="col-sm-9">
							<?php
								if($web_server==$web_server_recom || (strpos($web_server, $web_server_recom) !== false))
								{
									success($web_server);
								}
								else 
								{
									error($web_server ."   : ".$web_server_recom." is recomended");
									$error = true;
								}
							?>
						</div>
					</div>
					<?php } ?>
					<?php 
					if($PhpVersion_on=='1') { ?>
					<div class="form-group">
						<label class="col-sm-3 control-label">PHP Version</label>
						<div class="col-sm-9">
							<?php

								if($PhpVersion >= $PhpVersion_recom) 
								{
									success($PhpVersion);
								}
								else 
								{
									error($PhpVersion." : Less Than ".$PhpVersion_recom." ");
									$error = true;
								}
							?>
						</div>
					</div>
					<?php } ?>
					<?php 
					if($r_Curl_On=='1') { ?>
					<div class="form-group">
						<label class="col-sm-3 control-label">PHP CURL</label>
						<div class="col-sm-9">
							<?php if($r_Curl != false) 
							{
								success("Installed");
							}
							else 
							{
								error("Not Installed");
								$error = true;
							}
							?>
						</div>
					</div>
					<?php } ?>
					<?php 
					if($r_Url_Fopen_on=='1') { ?>
					<div class="form-group">
						<label class="col-sm-3 control-label">PHP allow_url_fopen</label>
						<div class="col-sm-9">
							<?php
							if($r_UrlFopen != false) 
							{
								success("Open");
							}
							else 
							{
								error("Closed");
								$error = true;
							}
							?>
						</div>
					</div>
				    <?php } ?>
				    <?php if($r_Php_Lib_XML=='1') { ?>
					<div class="form-group">
						<label class="col-sm-3 control-label">PHP libxml</label>
						<div class="col-sm-9">
							<?php
							if($r_Php_Lib_XML_Status != false) {
								success("Enabled");
							}
							else {
								error("Not Enabled");
								$error = true;
							}
							?>
						</div>
					</div>
					<?php } ?>

					<?php if($r_Php_Exec_on=='1') { ?>
					<div class="form-group">
						<label class="col-sm-3 control-label">PHP exec</label>
						<div class="col-sm-9">
							<?php
							if($r_Php_Exec_Status != false) {
								success("Enabled");
							}
							else {
								error("Not Enabled");
								$error = true;
							}
							?>
						</div>
					</div>
					<?php } ?>

					<?php 
					/*if($r_Php_Ioncube=='1') { ?>
						<div class="form-group">
							<label class="col-sm-3 control-label">Ioncube Loader</label>
							<div class="col-sm-9">
								<?php
								if($r_Php_Ioncube_Status != 'false') {
									success("Enabled");
								}
								else {
									error("Not Enabled");
									$error = true;
								}
								?>
							</div>
						</div>
					<?php
					}*/ ?>

					<?php 
					if($r_Php_Mysqli=='1') { ?>
						<div class="form-group">
							<label class="col-sm-3 control-label">MYSQLi</label>
							<div class="col-sm-9">
								<?php
								if($r_Php_Mysqli_Status != 'false') {
									success("Enabled");
								}
								else {
									error("Not Enabled");
									$error = true;
								}
								?>
							</div>
						</div>
					<?php
					} ?>

					<?php 
					if($r_MySQL_on=='1') { ?>
						<div class="form-group">
							<label class="col-sm-3 control-label">MYSQL Version</label>
							<div class="col-sm-9">
								<?php
								if($mysql_version > $r_MySQL_Version) {
									success($mysql_version);
								}
								else {
									error($mysql_version . " : Should be ".$r_MySQL_Version."+");
									$error = true;
								}
								?>
							</div>
						</div>
					<?php
					} ?>

					<?php if($error == true) {
					?>
						<div class="row">
							<div class="col-sm-offset-3 col-sm-9">
								<div class="alert alert-danger">
									Server Does not meet all the requirements.
								</div>
							</div>
						</div>
						<!--<div class="form-group">
							<div class="col-sm-offset-3 col-sm-8">
								<a href="./requirements/DatabaseOperations_form_refresh" class="btn btn-theme btn-lg">Refresh</a>
							</div>
						</div>-->
					<?php } else { $_SESSION['install_step'] = 2; ?>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-8">
								<a href="<?php echo base_url();?>licence" class="btn btn-success btn-lg">Next</a>
							</div>
						</div>
					<?php } ?>
				</form>
			</div>
		</div>
	</div>
</div>
<!--------------------------------------FOOTER --------------------------------------->
<?php $this->load->view('includes/footer') ?>
<!------------------------------------------------------------------------------------->