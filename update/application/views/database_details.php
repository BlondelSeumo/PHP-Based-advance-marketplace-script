<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!--------------------------------------HEADER SCRIPTS--------------------------------->
<?php $this->load->view('includes/head'); ?>
<!------------------------------------------------------------------------------------->
<title>Database Details</title>
<!--------------------------------------HEADER ---------------------------------------->
<?php $this->load->view('includes/header'); ?>
<!------------------------------------------------------------------------------------->
<!--------------------------------------SIDEBAR --------------------------------------->
<?php $this->load->view('includes/sidebar');?>
<!------------------------------------------------------------------------------------->
<div class="rightSide">
	<div class="col-xs-12">
		<div class="tab-content shadow-1">
			<div class="tab-pane active">
				<form class="form-horizontal" action="<?php echo base_url() ?>database_submit" method="post">
					<?php
					if(isset($_POST['submit']) && $error == true) {
						?>
						<div class="alert alert-danger alert-dismissable">
							<a class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Error!</strong> Unable to connect to database.
						</div>
						<?php
					}
					?>
					<div class="form-group">
						<label class="col-sm-3 control-label">Database Server</label>
						<div class="col-sm-9">
							<input type="text" name="server" placeholder="e.g: localhost" class="form-control" required value="<?php echo (isset($server) ? $server : ""); ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Database Name</label>
						<div class="col-sm-9">
							<input type="text" name="database" placeholder="Database Name" class="form-control" required value="<?php echo (isset($database) ? $database : ""); ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Database Username</label>
						<div class="col-sm-9">
							<input type="text" name="username" placeholder="Database Username" class="form-control" required value="<?php echo (isset($username) ? $username : ""); ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Database Password</label>
						<div class="col-sm-9">
							<input type="password" name="password" placeholder="Database Password" class="form-control"  value="<?php echo (isset($password) ? $password : ""); ?>" />
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-8">
							<button type="submit" name="submit" class="btn btn-theme btn-lg">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!--------------------------------------FOOTER --------------------------------------->
<?php $this->load->view('includes/footer') ?>
<!------------------------------------------------------------------------------------->