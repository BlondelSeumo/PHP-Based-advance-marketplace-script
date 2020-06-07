<!------------------ Annoucement --------------------->
<?php if(isset($announcements) && sizeof($announcements) > 0 ) {?>
<div class="col-12">
<?php foreach ($announcements as $key) { 
  if($this->session->userdata('user_level') === $key['group_id']) { ?>
  	<div class="alert <?php echo $key['announcement_type'] ?>" role="alert"><a class="close" data-dismiss="alert">×</a>
    	<h3><i class="fa fa-bullhorn"></i> <?php echo $key['announcement_heading'] ?></h3><br>
    	<p><?php echo $key['announcement'] ?></p>
  	</div>
  <?php } }?> 
</div>
<?php  } ?> 
<!------------------ /Annoucement --------------------->