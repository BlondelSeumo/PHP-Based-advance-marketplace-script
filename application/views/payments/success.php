<!------------------------------------------PAGE SCRIPTS -------------------------------------------------------------------->
<link href="<?php echo base_url();?>assets/css/payment/payment.css" rel="stylesheet">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,500,700,900'>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<!--------------------------------------------------------------------------------------------------------------------------->
<script src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript"> var baseUrl = '<?php echo base_url(); ?>'; </script> 
<script src="<?php echo base_url(); ?>assets/js/cart.js"></script>
<script type="text/javascript">
      var count = 10; // Timer
      var redirect = baseUrl; // Target URL
      function countDown() {
      var timer = document.getElementById("timer"); // Timer ID
      if (count > 0) {
          count--;
          timer.innerHTML = "This page will redirect in " + count + " seconds."; // Timer Message
          setTimeout("countDown()", 1000);
      } else {
          shoppingCart.clearCart();
          window.location.href = redirect;
      }
    }
</script>
<!--------------------------------------------------------------------------------------------------------------------------->
<div class="bg">
  
  <div class="card">
    
    <span class="card__success"><i class="fas fa-check-circle"></i></span>
    
    <h1 class="card__msg"><?php echo $this->lang->line('lang_payments_complete'); ?></h1>
    <h2 class="card__submsg"><?php echo $this->lang->line('lang_payments_thankyou'); ?></h2>
    <hr>
    <p class="points" id="timer">
        <script type="text/javascript">
          countDown();
        </script>
    </p>
    
    <div class="card__body">
      
      <img src="<?php echo base_url().ICON_UPLOAD;?>user.png" class="card__avatar">
      <div class="card__recipient-info">
        <p class="card__recipient"><?php echo $PAYMENT['user_username']; ?></p>
        <p class="card__email"><?php echo $PAYMENT['user_email']; ?></p>
      </div>
      
      <h1 class="card__price"><span><?php if(isset($PAYMENT['currency'])) echo $PAYMENT['currency']; ?></span><?php if(isset($PAYMENT['amount'])) echo $PAYMENT['amount']; ?></h1>
      
      <p class="card__method"><?php echo $this->lang->line('lang_payments_method'); ?></p>
      <div class="card__payment">
        <img src="https://seeklogo.com/images/V/VISA-logo-F3440F512B-seeklogo.com.png" class="card__credit-card">
        <div class="card__card-details">
          <p class="card__card-type"><?php if(isset($PAYMENT['payment_method'])) echo $PAYMENT['payment_method']; ?></p>
          <p class="card__card-number"></p>          
        </div>
      </div>
      
    </div>
    
    <div class="card__tags">
        <span class="card__tag"><?php if(isset($RETURNED['ACK'])) echo $RETURNED['ACK']; ?></span>
        <span class="card__tag">#<?php if(isset($PAYMENT['transactionId'])) echo $PAYMENT['transactionId']; ?></span>        
    </div>
    
  </div>
  
</div>
<!----------------------------------------------------------------------------------------------------------------------------->