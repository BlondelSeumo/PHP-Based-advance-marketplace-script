 	<!------------------------------------------------------------------------------------------------------------------------------>
  <script src="<?php echo base_url(); ?>assets/vendor/js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/jquery-migrate-3.0.0.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/mmenu.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/popper/popper.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/tippy.all.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/simplebar.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/bootstrap-slider.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/bootstrap-select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/bootstrap-notify.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/snackbar.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/clipboard/clipboard.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/counterup.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/magnific-popup.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/slick.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/creditly.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/jquery.validate.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/bootstrap-tagsinput.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/iconfonts/font-awesome/js/cff349f370.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/select2.min.js"></script>
  <!-- include summernote css/js -->
  <script src="<?php echo base_url(); ?>assets/vendor/summernote/summernote.min.js"></script>
  
  <!---------------------------------DATA TABLES -------------------------------------------------------------------------------->
  <script src="<?php echo base_url(); ?>assets/vendor/js/datatable/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/datatable/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/datatable/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/datatable/js/pdfmake.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/datatable/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/datatable/js/buttons.flash.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/js/datatable/js/buttons.html5.min.js"></script>
  <!------------------------------------------------------------------------------------------------------------------------------>
  <script src="<?php echo base_url(); ?>assets/js/plugins.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/custom.js?v=1.2"></script>
  <script src="<?php echo base_url(); ?>assets/js/cart.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/chart.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/chat.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/tables.js"></script>
 	<!-----------------------------------------Data Passing Jquery------------------------------------------------------------------>
  <script type="text/javascript"> var baseUrl                   = '<?php echo base_url(); ?>'; </script>  
  <script type="text/javascript"> var basemethod                = '<?php echo $this->router->fetch_class(); ?>'; </script> 
  <script type="text/javascript"> var baseclass                 = '<?php echo $this->router->fetch_method(); ?>'; </script>  
  <script type="text/javascript"> var currentUrl                = '<?php echo current_url(); ?>'; </script>
  <script type="text/javascript"> var userID                    = '<?php echo $this->session->userdata('user_id'); ?>'; </script>
  <script type="text/javascript"> var referrer                  = '<?php echo $this->session->userdata('url'); ?>'; </script>
  <?php $this->session->set_userdata('url',current_url()); ?>
  <!------------------------------------------------------------------------------------------------------------------------------>
  
  <!------------------------------------------------------------------------------------------------------------------------------>
  <script>populateLanguages('ot-languages','<?php if(!empty($this->session->userdata('site_lang'))) echo $this->session->userdata('site_lang');  ?>');</script>
  <!-----------------------------------------Language Files----------------------------------------------------------------------->
  <script type="text/javascript"> var errorEmptyFields          = '<?php echo $this->lang->line('errorEmptyFields'); ?>'; </script>
  <script type="text/javascript"> var errorSelectCategory       = 'Please select a Category to continue'; </script>
  <script type="text/javascript"> var errorBlankDomain          = 'Please enter a domain'; </script>
  <script type="text/javascript"> var errorinvalidUrl           = 'Please enter a valid URL'; </script>
  <script type="text/javascript"> var errorBlacklistedDomain    = 'This domain has been blacklisted'; </script>
  <script type="text/javascript"> var sucessfullySaved          = '<?php echo 'Records Saved Sucessfully' ?>'; </script> 
  <script type="text/javascript"> var sucessfullyupdated        = '<?php echo 'Updated Sucessfully' ?>'; </script>
  <script type="text/javascript"> var updateError               = '<?php echo 'Something Went Wrong. Please try again !' ?>'; </script> 
  <script type="text/javascript"> var errorEmptyFields          = '<?php echo $this->lang->line('errorEmptyFields'); ?>'; </script>
  <script type="text/javascript"> var errorinvalidUrl           = '<?php echo $this->lang->line('errorinvalidUrl'); ?>'; </script>
  <script type="text/javascript"> var successRegistration         = '<?php echo $this->lang->line('successRegistration'); ?>'; </script>
  <script type="text/javascript"> var errorRegistration           = '<?php echo $this->lang->line('errorRegistration'); ?>'; </script>
  <script type="text/javascript"> var errorUsernameBlank          = '<?php echo $this->lang->line('errorUsernameBlank'); ?>'; </script>
  <script type="text/javascript"> var errorPasswordBlank          = '<?php echo $this->lang->line('errorPasswordBlank'); ?>'; </script>
  <script type="text/javascript"> var errorAccountBanned          = '<?php echo $this->lang->line('errorAccountBanned'); ?>'; </script>
  <script type="text/javascript"> var errorAccountLogin           = '<?php echo $this->lang->line('errorAccountLogin'); ?>'; </script>
  <script type="text/javascript"> var errorAccountDisabled        = '<?php echo $this->lang->line('errorAccountDisabled'); ?>'; </script>
  <script type="text/javascript"> var errorInvalidLogin           = '<?php echo $this->lang->line('errorInvalidLogin'); ?>'; </script>
  <script type="text/javascript"> var errorAccountActivation      = '<?php echo $this->lang->line('errorAccountActivation'); ?>'; </script>
  <script type="text/javascript"> var errorNoPermissions          = '<?php echo $this->lang->line('errorNoPermissions'); ?>'; </script>
  <script type="text/javascript"> var successLogin                = '<?php echo $this->lang->line('successLogin'); ?>'; </script>
  <script type="text/javascript"> var successReset                = '<?php echo $this->lang->line('successReset'); ?>'; </script>
  <script type="text/javascript"> var successApikeyReset          = '<?php echo $this->lang->line('successApikeyReset'); ?>'; </script>
  <script type="text/javascript"> var errorResetEmail             = '<?php echo $this->lang->line('errorResetEmail'); ?>'; </script>
  <script type="text/javascript"> var errorReset                  = '<?php echo $this->lang->line('errorReset'); ?>'; </script>
  <script type="text/javascript"> var invlidMembershiPlan         = '<?php echo $this->lang->line('invlidMembershiPlan'); ?>'; </script>
  <script type="text/javascript"> var errorLoadingFail            = '<?php echo $this->lang->line('errorLoadingFail'); ?>'; </script>
  <script type="text/javascript"> var errorTermsandConditionsCheck = '<?php echo $this->lang->line('errorTermsandConditionsCheck'); ?>'; </script>
  <script type="text/javascript"> var errorLastAndFirstNames      = '<?php echo $this->lang->line('errorTermsandConditionsCheck'); ?>'; </script>


  <script type="text/javascript"> var contactErrorEmptyName     = '<?php echo $this->lang->line('contactErrorEmptyName'); ?>'; </script>
  <script type="text/javascript"> var contactErrorEmptyEmail    = '<?php echo $this->lang->line('contactErrorEmptyEmail'); ?>'; </script>
  <script type="text/javascript"> var contactErrorInvalidEmail  = '<?php echo $this->lang->line('contactErrorInvalidEmail'); ?>'; </script>
  <script type="text/javascript"> var contactErrorEmptySubject  = '<?php echo $this->lang->line('contactErrorEmptySubject'); ?>'; </script>
  <script type="text/javascript"> var contactErrorEmptyMsg      = '<?php echo $this->lang->line('contactErrorEmptyMsg'); ?>'; </script>
  <script type="text/javascript"> var msgSentSuccess            = '<?php echo $this->lang->line('msgSentSuccess'); ?>'; </script>
  <!------------------------------------------------------------------------------------------------------------------------------>
