</div>
</div>
<footer>
	© <?php echo date("Y"); ?> <a>Onlinetoolhub</a> - All Right Reserved
</footer>
<!-----------------------------------------Data Passing Jquery---------------------------------------->
<script type="text/javascript"> var baseUrl = '<?php echo base_url(); ?>'; </script>  
<script type="text/javascript"> var basemethod ='<?php echo $this->router->fetch_class(); ?>'; </script> 
<script type="text/javascript"> var baseclass = '<?php echo $this->router->fetch_method(); ?>'; </script>  
<script type="text/javascript"> var currentUrl = '<?php echo current_url(); ?>'; </script>
<!----------------------------------------------------------------------------------------------------->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/control.js"></script>

</body>
</html>