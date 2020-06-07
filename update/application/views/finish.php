<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--------------------------------------HEADER SCRIPTS--------------------------------->
<?php $this->load->view('includes/head'); ?>
<!------------------------------------------------------------------------------------->
<title>Finish Update</title>
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
							<p>After updating the script please follow all the steps.</p>
							<ul>
								<li><strong>Please remove the update folder from your root diretory</strong></strong></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="form-group">
					<a href="<?php echo str_replace("/update","",base_url()); ?>" class="btn btn-theme btn-lg">Visit Website</a>
				</div>
				<div class="alert alert-info">
					<i class="fa fa-exclamation-circle fa-lg"></i> Slippa Script has been successfully updated to the latest version v1.2.
				</div>
				<p style="margin-top:10px">Note : Don't forget to delete the <strong>update</strong> directories.</p>
			</div>
		</div>
	</div>
</div>
<!--------------------------------------FOOTER --------------------------------------->
<?php $this->load->view('includes/footer') ?>
<!------------------------------------------------------------------------------------->