<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--------------------------------------HEADER SCRIPTS--------------------------------->
<?php $this->load->view('includes/head'); ?>
<!------------------------------------------------------------------------------------->
<title>Start Installation</title>
<!--------------------------------------HEADER ---------------------------------------->
<?php $this->load->view('includes/header'); ?>
<!------------------------------------------------------------------------------------->
<!--------------------------------------SIDEBAR --------------------------------------->
<?php $this->load->view('includes/sidebar');?>
<!------------------------------------------------------------------------------------->
<div class="rightSide">
	<div class="col-xs-12">
		<div class="tab-content shadow-1">
			<div class="tab-pane active" id="welcome">
				<h1 class="primaryText">Welcome To <strong>"Slippa | Domain & Website Marketplace Script"</strong> Installer</h1>
				<h3 class="secondaryText"><i class="fa fa-folder-o"></i>Slippa | Domain & Website Marketplace Script will allow you to create your digital marketplace in seconds</h3>
				<h4 class="primaryText">Thanks for Purchasing onlinetoolhub's Product</h4>
				<p class="secondaryText">Welcome to Installation Wizard. Click button below to Continue</p>
				<p class="secondaryText">If you face any problem while installation then open the support ticket here : <strong><a href="https://onlinetoolhub.com" target="_blank">Support</a></strong></p>
				<div class="clearfix"></div><br>
				<a href="./database" class="btn btn-theme btn-lg">Begin Installation!</a>
			</div>
		</div>
	</div>
</div>
<!--------------------------------------FOOTER --------------------------------------->
<?php $this->load->view('includes/footer') ?>
<!------------------------------------------------------------------------------------->