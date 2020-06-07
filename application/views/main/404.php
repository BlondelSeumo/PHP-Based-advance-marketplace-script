<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>404 - Not Found</title>
  <link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
  <meta name="robots" content="noindex">
  <!------------------------------------------------------------------------------------------------------------------>
  <?php $this->load->view('main/includes/headerscripts'); ?>
  <!------------------------------------------------------------------------------------------------------------------>
</head>

<body>
  <!---- 404 Page ----->
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
        <div class="row w-100">
          <div class="col-lg-7 mx-auto text-white">
            <div class="row align-items-center d-flex flex-row">
              <div class="col-lg-6 text-lg-right pr-lg-4">
                <h1 class="display-1 mb-0">404</h1>
              </div>
              <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4 text-white">
                <h2 class="text-white">SORRY!</h2>
                <h3 class="font-weight-light text-white">The page you’re looking for was not found.</h3>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 text-center mt-xl-2">
                <a class="text-white font-weight-medium" href="<?php echo base_url();?>"><b>Back to home</b></a>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 mt-xl-2">
                <p class="text-white font-weight-medium text-center">&copy; <?php echo date('Y');?><strong><a href="<?php echo base_url();?>" target="_blank"><?php echo $this->lang->line('site_name'); ?> </a></strong> | Powered By<a href="https://www.onlinetoolhub.com" target="_blank"> Onlinetoolhub</a>.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
</body>

</html>