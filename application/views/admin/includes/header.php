  <!-- admin/user header -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <!-------------------------------------------------------------------------------------------------------------->
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="<?php echo base_url().'user' ?>">
          <img src="<?php if(isset($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo base_url().'user' ?>">
          <img src="<?php if(isset($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="logo" />
        </a>
      </div>
      <!-------------------------------------------------------------------------------------------------------------->
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <?php if(isset($settingsData[0]['enable_pricing']) && $settingsData[0]['enable_pricing'] == '1' ) {?>
          <li class="nav-item">
            <a href="<?php echo base_url().'user/membership_plans' ?>" class="nav-link">
              <i class="mdi mdi-cash-usd"></i><?php echo $this->lang->line('user_header_pricing'); ?></a>
          </li>
          <?php } ?>
        </ul>
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <?php if(isset($settingsData[0]['activated_mode']) && $settingsData[0]['activated_mode'] == '2' ) {?>
          <li class="nav-item">
            <a href="<?php echo base_url().'/tutorials' ?>" class="nav-link">
              <i class="mdi mdi-web"></i><?php echo $this->lang->line('user_header_api'); ?></a>
          </li>
          <?php } ?>
        </ul>
        
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <?php if(isset($languages[0]['language_code']) && !empty($languages[0]['language_code'])) { 
          if(!empty($selectedLanguage)){ foreach ($languages as $item) {

            if ($selectedLanguage == $item['language']) { ?>
              <a href="<?php echo base_url(); ?>language/<?php echo $item['language']; ?>" class="btn btn-default dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
                <i class="flag-icon <?php echo $item['icon'] ?>"></i> <?php echo ' '.strtoupper($item['language']) ?>
              </a>
          <?php } } } else {  ?>
              <a href="<?php echo base_url(); ?>language/<?php echo $this->lang->line('lang_txt_english'); ?>" class="btn btn-default dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2">
                <i class="flag-icon flag-icon-us"></i> <?php echo $this->lang->line('lang_txt_english'); ?>
              </a>
          <?php } ?>
          <ul class="dropdown-menu navbar-dropdown" aria-labelledby="navbarDropdownMenuLink2">
            <?php foreach ($languages as $item) { 
            if ($selectedLanguage!= $item['language']) { ?>
              <li>
                <a class="dropdown-item" href="<?php echo base_url(); ?>language/<?php echo $item['language'];?>">
                  <i class="flag-icon <?php echo $item['icon'] ?>"></i> <?php echo ' '.strtoupper($item['language']) ?>
                </a>
              </li>
              <?php } } }?>
          </ul>
        </ul>
        <!-------------------------------------------------------------------------------------------------------------->
        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text"><?php echo $this->lang->line('user_header_hello'); ?>, <?php if(isset($USERDATA[0]['username'])){echo $USERDATA[0]['username'];} ?> !</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
              </a>

              <?php if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_level') == 0) { ?>
              <a href="<?php echo base_url(); ?>" class="dropdown-item mt-2">
                Visit Site
              </a>
              <?php } ?>
              <?php if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_level') != 0) { ?>
              <a href="<?php echo base_url().'user/user_account' ?>" class="dropdown-item mt-2">
                <?php echo $this->lang->line('user_header_drop_manageaccount'); ?>
              </a>
              <?php } ?>
              <?php if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_level') == 0) { ?>
              <a href="<?php echo base_url().'admin/change_password' ?>" class="dropdown-item">
                Change Password
              </a>
              <?php } else { ?>
              <a href="<?php echo base_url().'user/change_password' ?>" class="dropdown-item">
                <?php echo $this->lang->line('user_header_drop_changepassword'); ?>
              </a>
              <?php } ?>
              <?php if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_level') == 0) { ?>
              <a href="<?php echo base_url().'admin/signout' ?>" class="dropdown-item">
                Sign Out
              </a>
              <?php } else { ?>
              <a href="<?php echo base_url().'user/signout' ?>" class="dropdown-item">
                <?php echo $this->lang->line('user_header_drop_signout'); ?>
              </a>
              <?php } ?>
            </div>
          </li>
        </ul>
        <!-------------------------------------------------------------------------------------------------------------->
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
        <!-------------------------------------------------------------------------------------------------------------->
      </div>
    </nav>
   <!-- /admin/user header -->