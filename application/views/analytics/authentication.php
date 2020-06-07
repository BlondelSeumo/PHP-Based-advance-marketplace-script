<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Anayltics Verification | <?php echo $this->lang->line('site_title'); ?></title>
  <meta name="robots" content="noindex">
  <!-------------------------------------------------------------------------------------------------------------------->
  <?php $this->load->view('main/includes/headerscripts'); ?>
  <!-------------------------------------------------------------------------------------------------------------------->
</head>

<body>

    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one" style="background-image: url('<?php if(isset($imagesData[0]['mainback'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['mainback']; ?>'); ">
        <div class="row w-100">
        <div class="col-lg-4 mx-auto">
          <div class="auto-form-wrapper-reset">
          <div class="row">
          <div class="col-xl-12">
            <div class="login-register-page">
              <form id="AdminLoginForm" class="forms-sample" method="post" enctype="multipart/form-data"/>
    
                <!-- Welcome Text -->
                <div class="welcome-text">
                  <a href="#">
                      <img src="<?php if(!empty($imagesData[0]['invoice_logo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['invoice_logo']; ?>" data-holder-rendered="true" width="30%" height="30%" />
                  </a>
                  <br>
                  <h3>Analytics Verification</h3>
                  <span>Please select Google Analytics information that you weould like to link with this application</span>
                </div>
                
                <div class="form-group">
                  <label class="label"><b>GOOGLE ANALYTICS ACCOUNT</b></label>
                  <div>
                      <select id="analyticsAccountDrop" name="analyticsAccountDrop" class="form-control">
                          <option value="false">Select User Account</option>
                        <?php foreach ($AccountsList as $account) { ?>
                          <option value="<?php echo $account['id'] ?>"><?php echo $account['name']; ?></option>
                        <?php } ?>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="label"><b>ANALYTICS PROPERTY</b></label>
                  <div>
                      <select id="analyticsPropertyDrop" name="analyticsPropertyDrop" class="form-control" disabled="true">
                        <option value="false">Select a Property</option>
                      </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="label"><b>PROPERTY VIEW</b></label>
                  <div>
                      <select id="analyticsViewDrop" name="analyticsViewDrop" class="form-control" disabled="true">
                        <option value="false">Select Property View</option>
                      </select>
                  </div>
                </div>

                <div class="form-group d-flex justify-content-center">
                  <div class="radio centerButtons">
                    <input id="radio-1" name="radio" type="radio" required>
                      <label for="radio-1"><span class="radio-label"></span> <?php echo $this->lang->line('lang_check_termsandconditions'); ?> <a href="<?php echo base_url() ?>page/terms-of-service"><?php echo $this->lang->line('lang_termsandconditions'); ?></a>
                      <input type="hidden" id="domainID" name="domainID" value="<?php if(!empty($domainId)) echo $domainId; ?>">
                    </label>
                  </div>
                </div>

                <div class="form-group">
                    <div id="authenticationStatus"></div>
                    <a id="authenticationBtn" name="authenticationBtn" href="#" class="btn btn-primary submit-btn btn-block">Verify & Confirm</a>
                    <span id="loadingImageAuthentication" style="display:none;" class="centerButtons"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                </div>
                
                <div class="text-block text-center my-3"></div>
              </form>
            
            </div>

          </div>
          </div>
          </div>

          <ul class="auth-footer">
            <li>
              <a href="<?php echo base_url().'page/privacy-policy'; ?>"><?php echo $this->lang->line('lang_privacy_policy'); ?></a>
            </li>
            <li>
              <a href="<?php echo base_url();?>contact"><?php echo $this->lang->line('lang_txt_contact_us'); ?></a>
            </li>
            <li>
              <a href="<?php echo base_url().'page/terms-of-service'; ?>"><?php echo $this->lang->line('lang_terms_ofservice'); ?></a>
            </li>
          </ul>

          <p class="footer-text text-center">copyright © <?php echo date('Y'); ?> <a href="<?php echo base_url(); ?>"> <?php echo $this->lang->line('site_name'); ?> </a> | Powered By <a href="https://www.onlinetoolhub.com" target="_blank"> Onlinetoolhub</a>. All rights reserved.</p>

        </div>
        </div>
        </div>
      <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    <!------------------------------------------------------------------------------------------------------------------------->
    <?php $this->load->view('main/includes/footerscripts'); ?>
    <!------------------------------------------------------------------------------------------------------------------------->
    <!-- endinject -->
</body>

</html>