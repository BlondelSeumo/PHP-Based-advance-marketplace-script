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
  <meta name="robots" content="index,follow" />
  <meta name="url" content="<?php echo base_url(); ?>">
  <title><?php echo $this->lang->line('register_meta_title'); ?>|<?php echo $this->lang->line('site_title'); ?></title>
  <meta name="og:title" content="<?php echo $this->lang->line('register_meta_title'); ?> | <?php echo $this->lang->line('site_title'); ?>"/>
  <meta name="og:type" content="music"/>
  <meta name="og:url" content="<?php echo base_url(); ?>"/>
  <meta name="og:image" content="<?php if(isset($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="logo" />
  <meta name="og:site_name" content="<?php echo $this->lang->line('login_meta_title'); ?> | <?php echo $this->lang->line('site_title'); ?>"/>
  <meta name="og:description" content="<?php echo $this->lang->line('site_metadescription'); ?>"/>
  <link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="logo" />
  <!------------------------------------------------------------------------------------------------------------------>
  <?php $this->load->view('main/includes/headerscripts'); ?>
  <!------------------------------------------------------------------------------------------------------------------>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one" style="background-image: url('<?php if(isset($imagesData[0]['mainback'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['mainback']; ?>'); ">
        <div class="row w-100">

          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper-register">
            <div class="row">
            <div class="col-xl-12">
            <div class="login-register-page">

              <div class="welcome-text">
                  <a href="<?php echo base_url(); ?>">
                      <img src="<?php if(!empty($imagesData[0]['invoice_logo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['invoice_logo']; ?>" data-holder-rendered="true" width="30%" height="30%" />
                  </a>
                  <h3>Welcome to <?php echo $this->lang->line('site_name'); ?> !</h3>
                  <span><?php echo $this->lang->line('lang_txt_alreadyhaveanaccount'); ?> <a href="<?php echo base_url();?>login"><?php echo $this->lang->line('lang_btn_login'); ?></a></span>
              </div>
              
              <form id="UserRegistrationForm" class="forms-sample" method="post" enctype="multipart/form-data"/>

                <div class="form-group">
                  <div class="input-group">
                    <input type="text" id="register_firstname" name="register_firstname" class="form-control" placeholder="<?php echo $this->lang->line('lang_txt_firstname'); ?>" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i id="" class="fas fa-check-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <input type="text" id="register_lastname" name="register_lastname" class="form-control" placeholder="<?php echo $this->lang->line('lang_txt_lastname'); ?>" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i id="" class="fas fa-check-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <input type="text" id="register_username" name="register_username" class="form-control" placeholder="<?php echo $this->lang->line('lang_txt_username'); ?>" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i id="i_usernamecheck" class="fas fa-check-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <input type="text" id="register_email" name="register_email" class="form-control" placeholder="<?php echo $this->lang->line('lang_txt_email'); ?>" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i id="i_emailcheck" class="fas fa-check-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <input type="password" id="register_password" name="register_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters' : ''); if(this.checkValidity()) form.confirmPassword.pattern = this.value;" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" required data-toggle="popover" title="Password Strength" data-content="Enter Password..." placeholder="<?php echo $this->lang->line('lang_txt_password'); ?>" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i id="i_passwordcheck" class="fas fa-check-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <input type="password" id="register_repassword" name="register_repassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" class="form-control" placeholder="<?php echo $this->lang->line('lang_txt_retypepassword'); ?>" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i id="i_retypepasswordcheck" class="fas fa-check-circle"></i>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group d-flex justify-content-center">
                  <div class="radio centerButtons">
                    <input id="radio-1" name="radio" type="radio" required>
                      <label for="radio-1"><span class="radio-label"></span>  <?php echo $this->lang->line('lang_check_termsandconditions'); ?> <a href="<?php echo base_url() ?>page/terms-of-service"><?php echo $this->lang->line('lang_termsandconditions'); ?></a></label>
                  </div>
                </div>

                <div class="form-group">
                  <span id="loadingImageRegister" style="display:none;" class="centerButtons"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/></span>
                  <div id="registrationStatus"></div>
                  <button id="register_submit" name="register_submit" class="button full-width button-sliding-icon ripple-effect margin-top-10 btn-block" disabled="true" type="submit"><?php echo $this->lang->line('lang_btn_register'); ?></button>
                </div>

                <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

              </form>


              </div>
              </div>
              </div>

            </div>
            <br>
            <p class="footer-text text-center">copyright © <?php echo date('Y'); ?> <a href="<?php echo base_url(); ?>" target="_blank"> <?php echo $this->lang->line('site_name'); ?> </a> | Powered By <a href="https://www.onlinetoolhub.com" target="_blank"> Onlinetoolhub</a>. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!------------------------------------------------------------------------------------------------------------------------->
  <?php $this->load->view('main/includes/footerscripts'); ?>
  <?php $this->session->set_userdata('url',""); ?>
  <!------------------------------------------------------------------------------------------------------------------------->
</body>

</html>