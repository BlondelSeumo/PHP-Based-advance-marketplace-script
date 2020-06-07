<!-------------------------------------PAGE SCRIPTS ------------------------------------------------------------>
<link href="<?php echo base_url();?>assets/css/payment/payment.css" rel="stylesheet">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,500,700,900'>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<!--------------------------------------------------------------------------------------------------------------->
<script src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript"> var baseUrl = '<?php echo base_url(); ?>'; </script> 
<script type="text/javascript">
      var count = 10; // Timer
      var redirect = '<?php echo $this->session->userdata('url'); ?>'; // Target URL
      function countDown() {
      var timer = document.getElementById("timer"); // Timer ID
      if (count > 0) {
          count--;
          timer.innerHTML = "This page will redirect in " + count + " seconds."; // Timer Message
          setTimeout("countDown()", 1000);
      } else {
          window.location.href = redirect;
      }
    }
</script>
<!--------------------------------------------------------------------------------------------------------------->
<div class="bg">
  
  <div class="card">
    
    <span class="card__fail"><i class="far fa-frown"></i></span>
    
    <h1 class="card__msg"><?php echo $this->lang->line('lang_payments_cancel'); ?></h1>
    <h2 class="card__submsg"><?php echo $this->lang->line('lang_payments_tryagain'); ?> </h2>
    <hr>
    <p class="points" id="timer">
        <script type="text/javascript">
          countDown();
        </script>
    </p>
      
    <div class="card__tags">
        <span class="card__tag"><?php echo 'CANCELED'; ?></span>
        <span class="card__tag">#N/A</span>        
    </div>
    
  </div>
  
</div>
<!-------------------------------------------------------------------------------------------------------------------->