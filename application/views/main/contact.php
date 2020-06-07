<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta Tags--->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="author" content="onlinetoolhub.com">
<meta name="keywords" content="<?php echo $this->lang->line('site_keywords'); ?>"/>
<meta name="description" content="<?php echo $this->lang->line('site_metadescription'); ?>"/>
<meta name="copyright"content="onlinetoolhub">
<meta name="robots" content="index,follow" />
<meta name="url" content="<?php echo base_url(); ?>">
<title><?php echo $this->lang->line('site_contact_page'); ?> | <?php echo $this->lang->line('site_name'); ?></title>
<meta name="og:title" content="<?php echo $this->lang->line('site_contact_page'); ?> | <?php echo $this->lang->line('site_name'); ?>"/>
<meta name="og:url" content="<?php echo current_url(); ?>"/>
<meta name="og:image" content="<?php if(isset($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="thumbnail" />
<meta name="og:site_name" content="<?php echo $this->lang->line('site_contact_page'); ?> | <?php echo $this->lang->line('site_name'); ?>"/>
<meta name="og:description" content="<?php echo $this->lang->line('site_metadescription'); ?>"/>
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<!--- /Meta Tags --->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/headerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</head>
<body>

<!-- Wrapper -->
<div id="wrapper">

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/header'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<div class="clearfix"></div>
<!-- Header Container / End -->

<!---top section---->
<div class="slippa-breadcump slippa-breadcump-height breaducump-style-2">
    <div class="slippa-page-bg rtbgprefix-full" style="background-image: url(<?php if(!empty($imagesData[0]['homepage'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['homepage']; ?>);">
    </div>
    <!-- /.slippa-page-bg -->
    <div class="container">
        <div class="row slippa-breadcump-height align-items-center">
            <div class="col-lg-12 mx-auto text-center text-white">
                <h4 class="f-size-70 f-size-lg-50 f-size-md-40 f-size-xs-24 slippa-strong"><?php echo $this->lang->line('lang_bred_contact_us_main'); ?></h4>
                <h4 class="f-size-36 f-size-lg-30 f-size-md-24 f-size-xs-16 slippa-light3"><?php echo $this->lang->line('lang_bred_contact_us_sub'); ?></h4>
                
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.slippa-bredcump -->
<!---/top section---->


<!-- Content-->

<!-- Container -->
<div class="container">
	<div class="row">

		<div class="col-xl-12">
			<div class="contact-location-info margin-bottom-50">
				<div class="contact-address">
					<ul>
						<li class="contact-address-headline">Our Office</li>
						<li><?php if(isset($settings[0]['office_add1']) && !empty($settings[0]['office_add1'])) echo $settings[0]['office_add1']; ?></li>
						<li><?php if(isset($settings[0]['office_add2']) && !empty($settings[0]['office_add2'])) echo $settings[0]['office_add2']; ?></li>
						<?php if(isset($settings[0]['office_tel']) && !empty($settings[0]['office_tel'])) { ?>
						<li>Phone <?php echo $settings[0]['office_tel']; } ?></li>
						<li><a href="#"><?php if(isset($settings[0]['office_email']) && !empty($settings[0]['office_email'])) echo $settings[0]['office_email']; ?></a></li>
						<li>
							<div class="seller-socials">
								<ul>
									<?php if(!empty($settings[0]['user_facebook'])) { ?>
										<li><a href="<?php echo $settings[0]['user_facebook']; ?>" title="Facebook" data-tippy-placement="top"><i class="icon-brand-facebook"></i></a></li>
									<?php } 
									if(!empty($settings[0]['user_twitter'])) { ?>
										<li><a href="<?php echo $settings[0]['user_twitter']; ?>" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
									<?php } 
									if(!empty($settings[0]['user_Instagram'])) { ?>
										<li><a href="<?php echo $settings[0]['user_Instagram']; ?>" title="Instagram" data-tippy-placement="top"><i class="icon-brand-instagram"></i></a></li>
									<?php } 
									if(!empty($settings[0]['user_github'])) { ?>
										<li><a href="<?php echo $settings[0]['user_github']; ?>" title="GitHub" data-tippy-placement="top"><i class="icon-brand-github"></i></a></li>
									<?php }
									if(!empty($settings[0]['user_google'])) { ?>
										<li><a href="<?php echo $settings[0]['user_google']; ?>" title="Google+" data-tippy-placement="top"><i class="icon-brand-google"></i></a></li>
									<?php }
									if(!empty($settings[0]['user_youtube'])) { ?>
										<li><a href="<?php echo $settings[0]['user_youtube']; ?>" title="Youtube" data-tippy-placement="top"><i class="icon-brand-youtube"></i></a></li>
									<?php } ?>
								</ul>
							</div>
						</li>
					</ul>

				</div>
			</div>
		</div>

		<div class="col-xl-8 col-lg-8 offset-xl-2 offset-lg-2">

			<section id="contact" class="margin-bottom-60">
				<h3 class="headline margin-top-15 margin-bottom-35"><?php echo $this->lang->line('lang_contactus_page_header'); ?></h3>

				<form method="post" name="contactform" id="contactform" autocomplete="on">
					<div class="row">
						<div class="col-md-6">
							<div class="input-with-icon-left">
								<input class="with-border" name="contact_name" type="text" id="contact_name" placeholder="Your Name" required="required" />
								<i class="icon-material-outline-account-circle"></i>
							</div>
						</div>

						<div class="col-md-6">
							<div class="input-with-icon-left">
								<input class="with-border" name="contact_email" type="email" id="contact_email" placeholder="Email Address" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" required="required" />
								<i class="icon-material-outline-email"></i>
							</div>
						</div>
					</div>

					<div class="input-with-icon-left">
						<input class="with-border" name="contact_subject" type="text" id="contact_subject" placeholder="Subject" required="required" />
						<i class="icon-material-outline-assignment"></i>
					</div>

					<div>
						<textarea class="with-border" name="contact_msg" cols="40" rows="5" id="contact_msg" placeholder="Message" spellcheck="true" required="required"></textarea>
					</div>

					<input type="submit" class="submit button margin-top-15" id="submit" value="Submit Message" />
					<div id="notification"></div>
                    <span id="loader" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>

                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

				</form>
			</section>

		</div>

	</div>
</div>
<!-- Container / End -->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footer'); ?>
<!--------------------------------------------------------------------------------------------------------------->
</div>
<!-- Wrapper / End -->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->
</body>
</html>