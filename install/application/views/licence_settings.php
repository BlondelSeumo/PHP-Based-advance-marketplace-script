<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--------------------------------------HEADER SCRIPTS--------------------------------->
<?php $this->load->view('includes/head'); ?>
<!------------------------------------------------------------------------------------->
<title>Licence Details And Settings</title>
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
             <div class="<?php echo $demo_page_class; ?>">
                <?php echo $demo_page_message; ?>
            </div>
				<form id="licensefrom" class="form-horizontal" action="<?php echo base_url() ?>submitlicenced_data" method="post">					
					<div class="form-group">
						<label class="col-sm-3 control-label">BASE URL</label>
						<div class="col-sm-9">
							<input readonly type="text" name="ROOT_URL" placeholder="BasePath" value="<?php echo $ROOT_URL ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">PURCHASED EMAIL</label>
						<div class="col-sm-9">
                             <input type="email" class="form-control" name="CLIENT_EMAIL" placeholder="Licensed email address (for personal license)" value="<?php if (isset($CLIENT_EMAIL)) {echo $CLIENT_EMAIL;} ?>">
							
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">LICENSE CODE</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="LICENSE_CODE" name="LICENSE_CODE" placeholder="License code (for anonymous license)" value="<?php if (isset($LICENSE_CODE)) {echo $LICENSE_CODE;} ?>">
							
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

