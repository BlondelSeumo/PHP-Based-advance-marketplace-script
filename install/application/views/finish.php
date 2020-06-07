<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--------------------------------------HEADER SCRIPTS--------------------------------->
<?php $this->load->view('includes/head'); ?>
<!------------------------------------------------------------------------------------->
<title>Finish Installation</title>
<!--------------------------------------HEADER ---------------------------------------->
<?php $this->load->view('includes/header'); ?>
<!------------------------------------------------------------------------------------->
<!--------------------------------------SIDEBAR --------------------------------------->
<?php $this->load->view('includes/sidebar');?>
<!------------------------------------------------------------------------------------->
<div class="rightSide">
	<div class="col-xs-12">
		<div class="tab-content shadow-1">
			<div role="tabpanel" class="tab-pane finish text-center active">
				<div class="row">
					<div style="margin:0 auto;float:none;" class="col-sm-10">
						<div style="text-align:left" class="well">	
							<p><strong>Important Note :</strong></p>
							<p>After installing the script please do all the steps below.</p>
							<ul>
								<li>Go to <strong><a target="_blank" href="<?php echo str_replace("/install","",base_url()); ?>admin"><?php echo str_replace("/install","",base_url()); ?>admin</strong></a> and update all the general settings and Google Analytics API key/Json Key. <strong> Good Luck !! </strong></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="form-group">
					<a href="<?php echo str_replace("/install","",base_url()); ?>" class="btn btn-theme btn-lg">Visit Website</a>
				</div>
				<div class="alert alert-info">
					<i class="fa fa-exclamation-circle fa-lg"></i> Slippa Script has been installed successfully.
				</div>
				<p style="margin-top:10px">Note : Don't forget to delete the <strong>install</strong> directories.</p>
			</div>
		</div>
	</div>
</div>
<!--------------------------------------FOOTER --------------------------------------->
<?php $this->load->view('includes/footer') ?>
<!------------------------------------------------------------------------------------->