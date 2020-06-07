<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="onlinetoolhub.com">
  <meta name="keywords" content="<?php echo $this->lang->line('site_keywords'); ?>"/>
  <meta name="description" content="<?php echo $this->lang->line('site_metadescription'); ?>"/>
  <meta name="copyright"content="onlinetoolhub">
  <meta name="robots" content="noindex" />
  <meta name="url" content="<?php echo base_url(); ?>">
  <title><?php echo $this->lang->line('reset_meta_title'); ?> | <?php echo $this->lang->line('site_title'); ?></title>
  <meta name="og:title" content="<?php echo $this->lang->line('reset_meta_title'); ?> | <?php echo $this->lang->line('site_title'); ?>"/>
  <meta name="og:type" content="music"/>
  <meta name="og:url" content="<?php echo base_url(); ?>"/>
  <meta name="og:image" content="<?php if(isset($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="logo" />
  <meta name="og:site_name" content="<?php echo $this->lang->line('reset_meta_title'); ?> | <?php echo $this->lang->line('site_title'); ?>"/>
  <meta name="og:description" content="<?php echo $this->lang->line('site_metadescription'); ?>"/>
  <link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="logo" />
  <!-------------------------------------------------------------------------------------------------------------------->
  <?php $this->load->view('main/includes/headerscripts'); ?>
  <!-------------------------------------------------------------------------------------------------------------------->
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one" style="background-image: url('<?php if(isset($imagesData[0]['mainback'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['mainback']; ?>'); ">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper-reset">
              <div class="row">
              <div class="col-xl-12">
              <div class="login-register-page">
      
              <!-- Welcome Text -->
              <div class="welcome-text">
                <a href="<?php echo base_url(); ?>">
                  <img src="<?php if(!empty($imagesData[0]['invoice_logo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['invoice_logo']; ?>" data-holder-rendered="true" width="30%" height="30%" />
                </a>
                <h3>Reset Password !</h3>
                <span>Please enter your email. Password reset email will be sent to your email.</span>
              </div>

              <form id="ResetPasswordForm" class="forms-sample" method="post" enctype="multipart/form-data"/>
                <div class="form-group">
                  <div class="input-group">
                    <input id="reset_email" name="reset_email" type="text" class="form-control" placeholder="<?php echo $this->lang->line('lang_txt_email'); ?>" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i id="i_emailcheckReset" class="fas fa-check-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <span id="loadingImageReset" style="display:none;" class="centerButtons"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                  <div id="ResetStatus"></div>
                  <button id="button_reset" name="button_reset" class="button full-width button-sliding-icon ripple-effect margin-top-10" disabled="true">Reset Password</button>
                </div>

                <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

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
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
 <!------------------------------------------------------------------------------------------------------------------------->
  <?php $this->load->view('main/includes/footerscripts'); ?>
  <?php $this->session->set_userdata('url',""); ?>
  <!------------------------------------------------------------------------------------------------------------------------->
  <!-- endinject -->
</body>

</html>