<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Withdrawal Settings | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3><b>Withdrawal Settings</b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li>Withdrawal Settings</li>
					</ul>
				</nav>
			</div>

			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-20 margin-bottom-20">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">           
                        <form method="post" name="withdrawalsFrom" id="withdrawalsFrom" class="login100-form withdrawalsFrom">  
                        <div class="card mb-3">
                        <div class="card-body">
                        <div class="form-row">
                                  
                            <div class="form-group col-md-3">
                               	<label>WITHDRAWAL METHODS</label>
                                <select name="withdrawal_methods" id="withdrawal_methods" class="form-control">
                                   	<option value="1">PAYPAL</option>
                                   	<option value="2">PAYONEER</option>
                                   	<option value="3">BANK TRANSFER</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label><span>THRESHOLD</span> <i class="help-icon" data-tippy-placement="right" title="Minimum withdrawal limit"></i></label>
                                <input type="text" name="withdrawal_threshold" id="withdrawal_threshold" class="form-control" class="with-border" placeholder="$20000" onkeypress='validateInputNumbers(event)' required>
                            </div>

                           	<div class="form-group col-md-2">
                                <label><span>FEE METHOD</span> <i class="help-icon" data-tippy-placement="right" title="Fee calculation"></i></label>
                                <select name="fee_method" id="fee_method" class="form-control">
                                    <option value="1">PERCENTAGE</option>
                                    <option value="0">AMOUNT</option>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label>AMOUNT</label>
                                <input type="text" name="fee_amount" id="fee_amount" class="form-control" class="with-border" placeholder="$20000" onkeypress='validateInputNumbers(event)' required>
                            </div>

                            <div class="form-group col-md-2">
                                <label>STATUS</label>
                                <select id="withdrawal_status" name="withdrawal_status" class="form-control">
                                    <option value="1">ACTIVE</option>
                                    <option value="0">INACTIVE</option>
                                </select>
                            </div>

                        </div>  
                            
                        <div class="form-group">
                            <button type="submit" name="withdrawal_button" class="btn btn-primary">UPDATE</button>
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
					</div>
				</div>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3>WITHDRAWAL REQUESTS</h3>
						</div>

						<!----- PAGES ---------------->
						<div class="content with-padding padding-bottom-10">
						<div class="row">
						<div class="col-xl-12">

						<div class="col-xl-12">
						<div class="submit-field">
							<h5>FILTER REQUESTS</h5>
							<select class="form-control" id="filter_type_withdraw" name="filter_type_withdraw">
                  <option value="0"> PENDINGS FOR APPROVALS </option>
                  <option value="2"> PAID </option>
                  <option value="3"> REJECTED </option>
              </select>
						</div>
            <span id="loaderapp" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
						</div>

						<div class="row">
                    	<div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">           
                        <div class="card mb-3">
                          <div class="card-body">
                            <div class="table-responsive">
                              <table id="tbl_withdrawals" class="table table-bordered table-hover display">
                                <thead>
                                <tr>
                              		<th>ID</th>
                              		<th>USER</th>
                              		<th>METHOD</th>
                              		<th>AMOUNT($)</th>
                              		<th>FEE($)</th>
                              		<th>DATE</th>
                              		<th>STATUS</th>
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


        				</div>
        				</div>
        				</div>	
        				<!----- /PAGES ---------------->
					</div>
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

<!--- PAYMENT OPTION MODAL ---->
<div class="modal fade" id="modal-userpaymentinfo" tabindex="-1" role="dialog" aria-labelledby="modal-userpaymentinfo" aria-hidden="true">
  <div class="modal-dialog modal-danger modal-dialog-centered modal-sm" role="document">
    <div class="modal-content bg-gradient-danger">
      
      <div class="modal-header">
          <h6 class="modal-title" id="modal-title-notification">WITHDRAWAL DETAILS</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
      </div>

      <div class="card">
        <div class="card-body">
          <!---card--->
          <div class="modal-body">

            <div class="col-xl-12">
              <div class="submit-field">
                <h5>Paypal Email Address</h5>
                <input id="paypal_email" name="paypal_email" type="text" class="with-border" value="" readonly=true>
              </div>
            </div>

            <div class="col-xl-12">
              <div class="submit-field">
                <h5>Payoneer Email Address</h5>
                <input id="payoneer_email" name="payoneer_email" type="text" class="with-border" value="" readonly=true>
              </div>
            </div>

            <div class="col-xl-12">
              <div class="submit-field">
                <h5>Bank Account Details</h5>
                <textarea id="bank_accountname" name="bank_accountname" type="text" class="with-border" value="" readonly=true></textarea>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!--- /PAYMENT OPTION MODAL ---->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<script>loadWithdrawalsData(0);</script>
<!--------------------------------------------------------------------------------------------------------------->
</body>
</html>