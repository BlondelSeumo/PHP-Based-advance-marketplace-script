<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Payment Setup | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
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
				<h3><b>payments Setup</b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li>payments Setup</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">
				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0 panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="row"> 
          <div class="col-md-12">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link active" id="acc-info" data-toggle="tab" href="#info" role="tab" aria-controls="home" aria-selected="true">PAYPAL EXPRESS</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="acc-paypalpro" data-toggle="tab" href="#paypalpro" role="tab" aria-controls="home" aria-selected="true">PAYPAL PRO</a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" id="acc-stripe" data-toggle="tab" href="#stripe" role="tab" aria-controls="home" aria-selected="true">STRIPE</a>
                </li>

              </ul>
          </div>
          </div>
          <hr>

          <div class="row"> 
          <div class="col-xl-12">
          <div id="paymentContent" class="tab-content">
          <!--PAYPAL EXPRESS INFO -->
          <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="acc-info">
          <div class="col-xl-12 d-flex align-items-stretch grid-margin">
          <div class="col-12 col-md-6">
          <div class="card">
          <div class="card-body">
          <h4 class="card-title">PAYPAL EXPRESS SETUP</h4>

          <form id="paypal_setup_form" class="forms-sample" method="post" enctype="multipart/form-data"/>

            <div class="form-group">
                <label for="enable_paypal">ACTIVATE PAYPAL</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-paypal"></i></span>
                  </div>
                  <select class="form-control form-control-lg" id="paypal_status" name="paypal_status">
                    <?php if($payments[0]['status']=='1') {?>
                    <option selected="true" value="1">Yes</option>
                    <option value="0">No</option>
                    <?php } else{?>
                    <option value="1">Yes</option>
                    <option selected="true"  value="0">No</option>
                    <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="txt_user_mexpdate">PAYPAL STATUS : </label>
                <div id="defaultPaypalStatus">
                  <?php if(!empty($payments[0]['status']) && $payments[0]['status'] == '1'){ ?>
                  <label class='form-control badge badge-success'> ACTIVE </label>
                  <?php } else { ?>
                  <label class='form-control badge badge-danger'> INACTIVE </label>
                  <?php } ?>
                </div>
                <div id="paypalInactivity"></div>
            </div>

            <div class="form-group">
                <label for="paypal_username">PAYPAL USERNAME</label>
                <input type="text" class="form-control" id="paypal_username" name ="paypal_username" value="<?php if(isset($payments[0]['username'])) {echo $payments[0]['username']; } ?>">
            </div>

            <div class="form-group">
                <label for="paypal_password">PAYPAL PASSWORD</label>
                <input type="password" class="form-control" id="paypal_password" name ="paypal_password" value="<?php if(isset($payments[0]['password'])) {echo $payments[0]['password']; } ?>">
            </div>

            <div class="form-group">
                <label for="paypal_signature">ICON URL <code> (This has to be an icon URL)</code></label>
                <input type="text" class="form-control" id="icon_url" name ="icon_url" value="<?php if(isset($payments[0]['icon_url'])) {echo $payments[0]['icon_url']; } ?>">
            </div>

            <div class="form-group">
                <label for="paypal_signature">PAYPAL SIGNATURE</label>
                <input type="text" class="form-control" id="paypal_signature" name ="paypal_signature" value="<?php if(isset($payments[0]['signature'])) {echo $payments[0]['signature']; } ?>">
            </div>

            <div class="form-group">
                <label for="paypal_sandbox">SANDBOX MODE PAYPAL</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-question-circle"></i></span>
                  </div>

                  <select class="form-control form-control-lg" id="paypal_sandbox" name="paypal_sandbox">
                    <?php if($payments[0]['sandbox']=='true') {?>
                    <option selected="true" value="true">Enable</option>
                    <option value="false">Disable</option>
                    <?php } else{?>
                    <option value="true">Enable</option>
                    <option selected="false"  value="0">Disable</option>
                    <?php } ?>
                  </select>
                </div>
            </div>

            <button type="submit" name="btn_paypal" class="btn btn-success mr-2">Save</button>

            <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

          </form>
          </div>
          </div>
          </div>

          </div>
          </div>

          <!--PAYPAL PRO INFO -->
          <div class="tab-pane fade" id="paypalpro" role="tabpanel" aria-labelledby="acc-paypalpro">
          <div class="col-md-12 d-flex align-items-stretch grid-margin">
          <div class="col-12 col-md-6">
          <div class="card">
          <div class="card-body">
          <h4 class="card-title">PAYPAL PRO SETUP</h4>
          <form id="paypalpro_setup_form" class="forms-sample" method="post" enctype="multipart/form-data"/>
    
            <div class="form-group">
              <label for="paypalpro_status">Activate PAYPAL PRO</label>
              <div class="input-group">

                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fab fa-paypal"></i></span>
                </div>

                <select class="form-control form-control-lg" id="paypalpro_status" name="paypal_status">
                  <?php if($payments[1]['status']=='1') {?>
                  <option selected="true" value="1">Yes</option>
                  <option value="0">No</option>
                  <?php } else{?>
                  <option value="1">Yes</option>
                  <option selected="true"  value="0">No</option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="txt_user_mexpdate">PAYPAL PRO STATUS : </label>
              <div id="defaultPaypalProStatus">
                <?php if(!empty($payments[1]['status']) && $payments[1]['status'] == '1'){ ?>
                <label class='form-control badge badge-success'> ACTIVE </label>
                <?php } else { ?>
                <label class='form-control badge badge-danger'> INACTIVE </label>
                <?php } ?>
              </div>
              <div id="paypalInactivityPro"></div>
            </div>

            <div class="form-group">
              <label for="paypal_username">PAYPAL USERNAME</label>
              <input type="text" class="form-control" id="paypal_username" name ="paypal_username" value="<?php if(isset($payments[1]['username'])) {echo $payments[1]['username']; } ?>">
            </div>

            <div class="form-group">
              <label for="paypal_password">PAYPAL PASSWORD</label>
              <input type="password" class="form-control" id="paypal_password" name ="paypal_password" value="<?php if(isset($payments[1]['password'])) {echo $payments[1]['password']; } ?>">
            </div>

            <div class="form-group">
                <label for="paypal_signature">ICON URL <code> (This has to be an icon URL)</code></label>
                <input type="text" class="form-control" id="icon_url" name ="icon_url" value="<?php if(isset($payments[1]['icon_url'])) {echo $payments[1]['icon_url']; } ?>">
            </div>

            <div class="form-group">
              <label for="paypal_signature">PAYPAL SIGNATURE</label>
              <input type="text" class="form-control" id="paypal_signature" name ="paypal_signature" value="<?php if(isset($payments[1]['signature'])) {echo $payments[1]['signature']; } ?>">
            </div>

            <div class="form-group">
              <label for="paypal_sandbox">SANDBOX MODE PAYPAL</label>
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-question-circle"></i></span>
              </div>

              <select class="form-control form-control-lg" id="paypal_sandbox" name="paypal_sandbox">
                <?php if($payments[1]['sandbox']=='true') {?>
                <option selected="true" value="true">Enable</option>
                <option value="false">Disable</option>
                <?php } else{?>
                <option value="true">Enable</option>
                <option selected="false"  value="0">Disable</option>
                <?php } ?>
              </select>
              </div>
            </div>

            <button type="submit" name="btn_paypalpro" class="btn btn-success mr-2">Save</button>

            <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

          </form>
          </div>
          </div>
          </div>
          </div>
          </div>

          <!--STRIPE -->
          <div class="tab-pane fade" id="stripe" role="tabpanel" aria-labelledby="acc-stripe">
          <div class="col-xl-12 d-flex align-items-stretch grid-margin">
          <div class="col-12 col-md-6">
          <div class="card">
          <div class="card-body">
          <h4 class="card-title">STRIPE SETUP</h4>

          <form id="stripesetup_form" class="forms-sample" method="post" enctype="multipart/form-data"/>

            <div class="form-group">
                <label for="enable_paypal">ACTIVATE STRIPE</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-paypal"></i></span>
                  </div>
                  <select class="form-control form-control-lg" id="stripe_status" name="paypal_status">
                    <?php if($payments[2]['status']=='1') {?>
                    <option selected="true" value="1">Yes</option>
                    <option value="0">No</option>
                    <?php } else{?>
                    <option value="1">Yes</option>
                    <option selected="true"  value="0">No</option>
                    <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="txt_user_mexpdate">PAYPAL STATUS : </label>
                <div id="defaultPaypalStatus">
                  <?php if(!empty($payments[2]['status']) && $payments[2]['status'] == '1'){ ?>
                  <label class='form-control badge badge-success'> ACTIVE </label>
                  <?php } else { ?>
                  <label class='form-control badge badge-danger'> INACTIVE </label>
                  <?php } ?>
                </div>
                <div id="paypalInactivity"></div>
            </div>

            <input type="hidden" name="paypal_username" value="">
            <input type="hidden" name="paypal_password" value="">


            <div class="form-group">
                <label for="paypal_signature">ICON URL <code> (This has to be an icon URL)</code></label>
                <input type="text" class="form-control" id="stripe_icon_url" name ="icon_url" value="<?php if(isset($payments[2]['icon_url'])) {echo $payments[2]['icon_url']; } ?>">
            </div>

            <div class="form-group">
                <label for="paypal_signature">STRIPE SIGNATURE</label>
                <input type="text" class="form-control" id="stripe_signature" name ="paypal_signature" value="<?php if(isset($payments[2]['signature'])) {echo $payments[2]['signature']; } ?>">
            </div>

            <div class="form-group">
                <label for="paypal_sandbox">SANDBOX MODE STRIPE</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-question-circle"></i></span>
                  </div>

                  <select class="form-control form-control-lg" id="stripe_sandbox" name="paypal_sandbox">
                    <?php if($payments[2]['sandbox']=='true') {?>
                    <option selected="true" value="true">Enable</option>
                    <option value="false">Disable</option>
                    <?php } else{?>
                    <option value="true">Enable</option>
                    <option selected="false"  value="0">Disable</option>
                    <?php } ?>
                  </select>
                </div>
            </div>

            <button type="submit" name="btn_paypal" class="btn btn-success mr-2">Save</button>

            <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            
          </form>
          </div>
          </div>
          </div>

          </div>
          </div>



          </div>

            <div id="notification"></div>
            <span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
            
          </div>
                              
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