<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta Tags--->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="author" content="onlinetoolhub.com">
<meta name="keywords" content="<?php if(!empty($page[0]['txt_page_meta_keywords'])) echo implode(',', json_decode(html_entity_decode($page[0]['txt_page_meta_keywords']),true)); ?>"/>
<meta name="description" content="<?php if(isset($page[0]['txt_page_description'])) echo substr($page[0]['txt_page_description'], 0,70); ?>"/>
<meta name="copyright"content="onlinetoolhub">
<meta name="robots" content="index,follow" />
<meta name="url" content="<?php echo base_url(); ?>">
<title><?php if(isset($page[0]['txt_page_title'])) echo $page[0]['txt_page_title']; ?> | <?php echo $this->lang->line('site_name') ; ?> </title>
<meta name="og:title" content="<?php if(isset($page[0]['txt_page_title'])) echo $page[0]['txt_page_title']; ?> | <?php echo $this->lang->line('site_name') ; ?>"/>
<meta name="og:url" content="<?php echo current_url(); ?>"/>
<meta name="og:image" content="<?php if(isset($imagesData[0]['sitelogo'])) echo base_url().IMAGES_UPLOAD.$imagesData[0]['sitelogo']; ?>" alt="thumbnail" />
<meta name="og:site_name" content="<?php if(isset($page[0]['txt_page_title'])) echo $page[0]['txt_page_title']; ?> | <?php echo $this->lang->line('site_name') ; ?> "/>
<meta name="og:description" content="<?php if(isset($page[0]['txt_page_description'])) echo substr($page[0]['txt_page_description'], 0,70); ?>"/>
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<!--- --->

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

<!-- Content -->
<!---top section---->
<div class="slippa-breadcump slippa-breadcump-height breaducump-style-2">
    <div class="slippa-page-bg rtbgprefix-full" style="background-image: url(<?php if(!empty($imagesData[0]['homepage'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['homepage']; ?>);">
    </div>
    <!-- /.slippa-page-bg -->
    <div class="container">
        <div class="row slippa-breadcump-height align-items-center">
            <div class="col-lg-12 mx-auto text-center text-white">
                <h4 class="f-size-70 f-size-lg-50 f-size-md-40 f-size-xs-24 slippa-strong"><?php if(isset($page[0]['txt_page_title'])) echo $page[0]['txt_page_title']; ?></h4>

            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.slippa-bredcump -->
<!---/top section---->

<!-- Post Content -->
<div class="container">
	<div class="row">
		
		<!-- Inner Content -->
		<div class="col-xl-12 col-lg-12">
			<!-- Blog Post -->
			<div class="blog-post single-post">

				<!-- Blog Post Content -->
				<div class="blog-post-content">
					<h3 class="margin-bottom-10"><?php if(isset($page[0]['txt_page_title'])) echo $page[0]['txt_page_title']; ?></h3>

					<div class="blog-post-info-list margin-bottom-20">
						<a href="#" class="blog-post-info"><?php if(isset($page[0]['date'])) echo date('F d Y',strtotime($page[0]['date'])); ?></a>
					</div>

					<?php if(isset($page[0]['txt_page_description'])) if(DECODE_DESCRIPTIONS) echo html_entity_decode($page[0]['txt_page_description']);  else echo ($page[0]['txt_page_description']); ?>

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span>Interesting? <strong>Share It!</strong></span>
							<ul class="share-buttons-icons">
								<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url(); ?>" data-button-color="#3b5998" title="Share on Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
								<li><a href="https://twitter.com/intent/tweet?text=<?php echo current_url(); ?>" data-button-color="#1da1f2" title="Share on Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								<li><a href="#" data-button-color="#dd4b39" title="Share on Google Plus" data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a></li>
								<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source=<?php echo current_url(); ?>" data-button-color="#0077b5" title="Share on LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
			<!-- Blog Post Content / End -->

			<!-- Sponsored Ads -->	
			<!--------------------------------------------------------------------------------------------------------------->
			<?php $this->load->view('main/add-ons/sponsored-ads'); ?>
			<!--------------------------------------------------------------------------------------------------------------->
			<!-- Sponsored Ads / End-->				
		</div>
		<!-- Inner Content / End -->

	</div>
</div>

<!-- Spacer -->
<div class="padding-top-40"></div>
<!-- Spacer -->

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