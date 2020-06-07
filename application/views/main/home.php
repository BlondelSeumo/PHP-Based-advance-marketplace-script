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
<title><?php echo $this->lang->line('site_title'); ?></title>
<meta name="og:title" content="<?php echo $this->lang->line('site_title'); ?>"/>
<meta name="og:url" content="<?php echo current_url(); ?>"/>
<meta name="og:image" content="<?php if(isset($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="thumbnail" />
<meta name="og:site_name" content="<?php if(isset($page[0]['txt_page_title'])) echo $page[0]['txt_page_title']; ?> | Domain Marketplace "/>
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

<!--------------------------------------------------------------------------------------------------------------->
<!---top section---->
<div class="slippa-breadcump slippa-breadcump-height breaducump-style-2">
    <div class="slippa-page-bg rtbgprefix-full" style="background-image: url(<?php if(!empty($imagesData[0]['homepage'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['homepage']; ?>);">
    </div>
    <!-- /.slippa-page-bg -->
    <div class="container">
        <div class="row slippa-breadcump-height align-items-center">
            <div class="col-lg-8 col-xl-7 mx-auto text-center text-white margin-top-40">
                <h4 class="f-size-70 f-size-lg-50 f-size-md-40 f-size-xs-24 slippa-strong"><?php echo $this->lang->line('lang_homepage_main'); ?> </h4>
                <h4 class="f-size-36 f-size-lg-30 f-size-md-24 f-size-xs-16 slippa-light3"><?php echo $this->lang->line('lang_homepage_sub'); ?></h4>
                <form id="home_search" name="home_search" method="post" class="margin-top-30 domain-searh-form" action="<?php echo base_url().'main/search/' ?>" data-duration="1.8s" data-dealy="0.9s" data-animation="wow fadeInUp">
                    <input id="searchterm" name="searchterm" type="text2" class="searchterm" placeholder="enter a new search">
                    <span class="bar"></span>
                    <select id="listing_type" name="listing_type" class="listing_type">
                    	<?php foreach ($platforms as $platform) { ?>
                    		<option value="<?php echo $platform['platform']; ?>"><?php echo $platform['name']; ?></option>
                    	<?php } ?>
                    </select>
                    <button name="searchBn" class="slippa-btn slippa-gradient pill slippa-Bshadow-1 searchBn" type="submit">
                    <?php echo $this->lang->line('lang_btn_search'); ?> <span><i class="fas fa-angle-right"></i></span>
                    </button>
                    <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                </form>
                <?php /*echo form_close();*/?>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
    <!-- Domains Crousel -->	
	<!--------------------------------------------------------------------------------------------------------------->
	<?php $this->load->view('main/add-ons/sold-domains'); ?>
	<!--------------------------------------------------------------------------------------------------------------->
	<!-- Domains Crousel / End-->	
</div>
<!--------------------------------------------------------------------------------------------------------------->

<?php if(in_array('domain',array_column($platforms,'platform'))) { ?>
<!-- Featured Domains -->	
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/add-ons/featured-domains-slider'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<!-- Featured Domains / End-->
<?php } ?>


<?php if(in_array('website',array_column($platforms,'platform'))) { ?>
<!-- Popular website categories -->	
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/add-ons/popular-categories'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<!-- Popular website categories / End-->
<?php } ?>


<?php if(in_array('auction',array_column($options,'platform'))) { ?>
<!-- Bids Listings -->    
<!--------------------------------------------------------------------------------------------------------------->
<div id="loadingAuctions" align="center" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </div>
<div id="auctionListings"></div>
<!--------------------------------------------------------------------------------------------------------------->
<!-- Bids Listings / End-->
<?php } ?>

<!-- Sponsored Ads -->	
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/add-ons/sponsored-ads'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<!-- Sponsored Ads / End-->	


<!-- ad-section -->	
<!--------------------------------------------------------------------------------------------------------------->
<?php if(!empty($ads[0]['homepage_banner_720x90'])) { ?>					
<div class="ad-section text-center margin-bottom-25">
	<?php print_r($ads[0]['homepage_banner_720x90']); ?>
</div>
<?php } ?>
<!--------------------------------------------------------------------------------------------------------------->
<!-- ad-section / End-->


<!-------How it works-------------->
<div class="clearfix"></div>
<div class="how-it-works margin-top-30">
    <div class="container">
        
        <!---Section Title--->
        <div class="row">
            <div class="col-xl-12 col-lg-10 mx-auto text-center wow fade-in-bottom" data-wow-duration="1s">
                <h2 class="slippa-section-title dark">
                    <?php echo $this->lang->line('lang_working_process_title'); ?>
                </h2>
                <p class="slippa-mb-0 slippa-light3 line-height-34 section-paragraph">
                    <?php echo $this->lang->line('lang_working_process_title_sub'); ?>
                </p>
            </div><!-- /.col-xl-7 col-lg-10 mx-auto text-center wow fade-in-bottom -->
        </div><!-- /.row -->
        <!-----Section Title--->

        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="working-process"><span class="process-img"><img src="<?php echo base_url() ?>assets/img/step-1.png" class="img-responsive" alt=""/><span class="process-num">01</span></span>
                	<h4><?php echo $this->lang->line('lang_working_process_setp_1'); ?></h4>
                	<p><?php echo $this->lang->line('lang_working_process_setp_1_desc'); ?></p>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
               	<div class="working-process"><span class="process-img"><img src="<?php echo base_url() ?>assets/img/step-2.png" class="img-responsive" alt=""/><span class="process-num">02</span></span>
                <h4><?php echo $this->lang->line('lang_working_process_setp_2'); ?></h4>
                <p><?php echo $this->lang->line('lang_working_process_setp_2_desc'); ?></p>
            </div>

            </div>
            <div class="col-md-4 col-sm-4">
                <div class="working-process"><span class="process-img"><img src="<?php echo base_url() ?>assets/img/step-3.png" class="img-responsive" alt=""/><span class="process-num">03</span></span>
                	<h4><?php echo $this->lang->line('lang_working_process_setp_3'); ?></h4>
                	<p><?php echo $this->lang->line('lang_working_process_setp_3_desc'); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-----/ How it Works ----->

<?php if(in_array('auction',array_column($options,'platform'))) { ?>
<!-- Ending Soon -->
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/add-ons/ending-soon'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<!-- Ending Soon / End-->	
<?php } ?>

<!-- ad-section -->	
<!--------------------------------------------------------------------------------------------------------------->
<?php if(!empty($ads[0]['homepage_banner_720x90'])) { ?>					
<div class="ad-section text-center margin-bottom-25">
	<?php print_r($ads[0]['homepage_banner_720x90']); ?>
</div>
<?php } ?>
<!--------------------------------------------------------------------------------------------------------------->
<!-- ad-section / End-->


<!-- Features Jobs -->
<!--------------------------------------------------------------------------------------------------------------->
<div id="loadingtrendingAds" align="center" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </div>
<div id="trendingAds"></div>
<!--------------------------------------------------------------------------------------------------------------->
<!-- Featured Jobs / End -->


<!-------info sec------------>
<!-- cta -->
<div class="section cta text-center">
	<div class="container">
    <div class="main-content">

	<div class="row">
			<!-- single-cta -->
		<div class="col-sm-4">
			<div class="single-cta">
				<!-- cta-icon -->
				<div class="cta-icon icon-secure">
					<img src="<?php echo base_url(); ?>assets/img/security.png" alt="Icon" class="img-responsive">
				</div><!-- cta-icon -->

				<h4><?php echo $this->lang->line('lang_why_us__1_title'); ?></h4>
				<p><?php echo $this->lang->line('lang_why_us__1_desc'); ?></p>
			</div>
		</div><!-- single-cta -->

			<!-- single-cta -->
		<div class="col-sm-4">
			<div class="single-cta">
					<!-- cta-icon -->
				<div class="cta-icon icon-support">
					<img src="<?php echo base_url(); ?>assets/img/support.png" alt="Icon" class="img-responsive">
				</div><!-- cta-icon -->

				<h4><?php echo $this->lang->line('lang_why_us__2_title'); ?></h4>
				<p><?php echo $this->lang->line('lang_why_us__2_desc'); ?></p>
			</div>
		</div><!-- single-cta -->

								<!-- single-cta -->
		<div class="col-sm-4">
			<div class="single-cta">
					<!-- cta-icon -->
				<div class="cta-icon icon-trading">
					<img src="<?php echo base_url(); ?>assets/img/profit.png" alt="Icon" class="img-responsive">
				</div><!-- cta-icon -->

				<h4><?php echo $this->lang->line('lang_why_us__3_title'); ?></h4>
				<p><?php echo $this->lang->line('lang_why_us__3_desc'); ?></p>
			</div>
		</div><!-- single-cta -->
	</div><!-- row -->

	<div class="row">
			<!-- single-cta -->
		<div class="col-sm-4">
			<div class="single-cta">
				<!-- cta-icon -->
				<div class="cta-icon icon-secure">
					<img src="<?php echo base_url(); ?>assets/img/commisions.png" alt="Icon" class="img-responsive">
				</div><!-- cta-icon -->

				<h4><?php echo $this->lang->line('lang_why_us__4_title'); ?></h4>
				<p><?php echo $this->lang->line('lang_why_us__4_desc'); ?></p>
			</div>
		</div><!-- single-cta -->

			<!-- single-cta -->
		<div class="col-sm-4">
			<div class="single-cta">
					<!-- cta-icon -->
				<div class="cta-icon icon-support">
					<img src="<?php echo base_url(); ?>assets/img/bid.png" alt="Icon" class="img-responsive">
				</div><!-- cta-icon -->

				<h4><?php echo $this->lang->line('lang_why_us__5_title'); ?></h4>
				<p><?php echo $this->lang->line('lang_why_us__5_desc'); ?></p>
			</div>
		</div><!-- single-cta -->

								<!-- single-cta -->
		<div class="col-sm-4">
			<div class="single-cta">
					<!-- cta-icon -->
				<div class="cta-icon icon-trading">
					<img src="<?php echo base_url(); ?>assets/img/visibility.png" alt="Icon" class="img-responsive">
				</div><!-- cta-icon -->

				<h4><?php echo $this->lang->line('lang_why_us__6_title'); ?></h4>
				<p><?php echo $this->lang->line('lang_why_us__6_desc'); ?></p>
			</div>
		</div><!-- single-cta -->
	</div><!-- row -->

	</div>
	</div>
</div><!-- cta -->

<!-------info sec /Ends ----->

<?php if(in_array('domain',array_column($platforms,'platform'))) { ?>
<!-- Domains Ads / End-->
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/add-ons/domains'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<!-- /Domains Ads / End-->
<?php } ?>


<!----Start Selling Section ---->
<div class="section margin-top-2 text-center">
	<div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto text-center wow fade-in-bottom padding-bottom-10">
                <div class="footer-calltoaction slippa-p-50 slippa-rounded-10 slippa-p-md-40 slippa-p-xs-30 d-flex flex-lg-row flex-column align-items-center text-center text-lg-left justify-content-lg-between rtbgprefix-cover text-white justify-content-center" style="background-image: url(<?php if(!empty($imagesData[0]['backgrounds'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['backgrounds']; ?>)">
                    <div class="left-column">
                        <h4 class="wow fade-in-top f-size-50 f-size-lg-40 f-size-md-35 f-size-xs-24 slippa-semibold margin-bottom-15" data-wow-duration="1s" data-wow-delay="0.2s">
                          <?php echo $this->lang->line('lang_infobox_title'); ?>
                        </h4>
                        <p class="wow fade-in-bottom f-size-xs-20 slippa-light1 slippa-mb-md-20 section-p-content" data-wow-duration="1s" data-wow-delay="0.2s">
                           <?php echo $this->lang->line('lang_infobox_desc'); ?>
                        </p>
                    </div><!-- /.left-column -->
                    <div class="right-column">
                        <a href="<?php echo base_url().'user' ?>" class="slippa-btn slippa-gradient  text-uppercase  slippa-Bshadow-2 wow fade-in-left pill" data-wow-duration="1s" data-wow-delay="0.6s"><?php echo $this->lang->line('lang_infobox_btn'); ?> </a><!-- /.slippa-btn -->
                    </div><!-- /.right-column -->
                </div><!-- /.inner-content -->
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div>
<!---- / Start Selling Section -->

<!----Featured Blog Section ----->
<?php if(!empty($featuredPosts)) { ?>
<!-- From Our Blog -->
<div class="section gray padding-top-65 padding-bottom-70 full-width-carousel-fix">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<!-- Section Headline -->
				<div class="section-headline margin-top-0 margin-bottom-25">
					<h3><?php echo $this->lang->line('lang_blog_title'); ?></h3>
					<a href="<?php echo base_url().'blog' ?>" class="headline-link"><?php echo $this->lang->line('lang_blog_link'); ?></a>
				</div>
			</div>

			<div class="col-xl-12">
				<!---- Featured Blog Post ---->
				<!--------------------------------------------------------------------------------------------------------------->
				<?php $this->load->view('main/add-ons/featured-blog-posts'); ?>
				<!--------------------------------------------------------------------------------------------------------------->
				<!---- /Featured Blog Post ---->
			</div>
		</div>
	</div>
</div>
<!-- From Our Blog / End-->
<?php } ?>
<!---- /Featured Blog Section ---->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footer'); ?>
<!--------------------------------------------------------------------------------------------------------------->
</div>
<!-- Wrapper / End -->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<script>loadTrendingAds(); auctionListings();</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>