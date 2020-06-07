<?php $pageName = $this->router->fetch_method(); ?>
<div class="leftSide collapse" id="themeTabs">
  <div class="col-xs-12">
	<ul class="nav nav-pills nav-stacked shadow-1" role="tablist">
		<li class="<?php echo ($pageName == "index" ? "active": ""); ?>">
			<a href="<?php echo base_url(); ?>"><i class="fa fa-home fa-lg"></i>Welcome</a>
		</li>
		<li class="<?php echo ($pageName == "DatabaseOperations_view" ? "active": ""); ?>">
			<a href="<?php echo base_url(); ?>database" disabled><i class="fa fa-clipboard fa-lg"></i>Database Details</a>
		</li>
		<li class="<?php echo ($pageName == "RequirementsCheck" || $pageName == "DatabaseOperations_form_submit" ? "active": ""); ?>">
			<a href="<?php echo base_url(); ?>requirements" disabled><i class="fa fa-server fa-lg"></i>Server Requirments</a>
		</li>
         <li class="<?php echo ($pageName == "LicenceCheck" || $pageName =="LicenceCheckSubmit" ? "active": ""); ?>">
			<a href="<?php echo base_url(); ?>licence" disable><i class="fa fa-server fa-lg"></i>Licence Verification</a>
		</li>
		<li class="<?php echo ($pageName == "websiteSettings" || $pageName =="websiteSettings" ? "active": ""); ?>">
			<a href="<?php echo base_url(); ?>websitesettings" disable><i class="fa fa-list-alt fa-lg"></i>Website Details and Settings</a>
		</li>
		<li class="<?php echo ($pageName == "finish_setup" || $pageName =="finish_setup" ? "active": ""); ?>">
			<a href="<?php echo base_url(); ?>finish" disabled><i class="fa fa-thumbs-o-up fa-lg"></i>Finish</a>
		</li>
	</ul>
  </div>
</div>