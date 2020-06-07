<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta Tags--->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="author" content="onlinetoolhub.com">
<meta name="keywords" content="<?php echo $this->lang->line('site_keywords'); ?>"/>
<meta name="description" content="<?php if(isset($page[0]['site_pricing_page_description'])) echo $page[0]['site_pricing_page_description']; ?>"/>
<meta name="copyright"content="onlinetoolhub">
<meta name="robots" content="index,follow" />
<meta name="url" content="<?php echo base_url(); ?>">
<title><?php echo $this->lang->line('site_pricing_page_title') ; ?> | <?php echo $this->lang->line('site_name') ; ?> </title>
<meta name="og:title" content="<?php echo $this->lang->line('site_pricing_page_title') ; ?> | <?php echo $this->lang->line('site_name') ; ?>"/>
<meta name="og:url" content="<?php echo current_url(); ?>"/>
<meta name="og:image" content="<?php if(isset($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="thumbnail" />
<meta name="og:site_name" content="<?php echo $this->lang->line('site_pricing_page_title') ; ?> | <?php echo $this->lang->line('site_name') ; ?>"/>
<meta name="og:description" content="<?php if(isset($page[0]['site_pricing_page_description'])) echo $page[0]['site_pricing_page_description']; ?>"/>
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
<!-- Header Container / End -->

<!---top section---->
<div class="slippa-breadcump slippa-breadcump-height breaducump-style-2">
    <div class="slippa-page-bg rtbgprefix-full" style="background-image: url(<?php if(!empty($imagesData[0]['homepage'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['homepage']; ?>);">
    </div>
    <!-- /.slippa-page-bg -->
    <div class="container">
        <div class="row slippa-breadcump-height align-items-center">
            <div class="col-lg-12 mx-auto text-center text-white">
                <h4 class="f-size-70 f-size-lg-50 f-size-md-40 f-size-xs-24 slippa-strong">Plans & Pricings</h4>
                <h4 class="f-size-36 f-size-lg-30 f-size-md-24 f-size-xs-16 slippa-light3">Plans & Pricing Options available</h4>
                
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
		<!-- PRICING START -->
        <div class="container">

        	<!---Section Title--->
    		<div class="row">
        		<div class="col-xl-12 col-lg-10 mx-auto text-center wow fade-in-bottom" data-wow-duration="1s">
            		<h2 class="slippa-section-title dark">
                		Pricing & Listing Options
            		</h2>
            		<p class="slippa-mb-0 slippa-light3 line-height-34 section-paragraph">
                		sell domains & websites.
            		</p>
        		</div><!-- /.col-xl-7 col-lg-10 mx-auto text-center wow fade-in-bottom -->
    		</div><!-- /.row -->
    		<!-----Section Title--->

    		<!---website pricing -->
    		<div class="slippa-spacer-60"></div><!-- /.slippa-spacer-60 -->
    		<div class="section-title featured-top">
                <h3><b>WEBSITE LISTING PLANS</b></h3>
            </div>
            <div class="row mar">
            <div id="pricing-plans-1">
            	<?php foreach ($website_headers as $header) { ?>
                <div class="col-md-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="pricing-box border rounded pt-4">
                        <div class="pl-2 pr-2">
                            <h6 class="text-center text-uppercase font-weight-bold"><?php echo strtoupper($header['listing_name']); ?></h6>
                            <p class="text-muted text-center mb-0 price mt-3 p-1"><span class="text-danger font-weight-normal h1"><sup class="h5">$</sup><?php echo number_format($header['listing_price'],2); ?>/</span><?php echo $header['listing_duration']; ?><b> days</b></p>
                            <div class="pricing-plan-item text-center">
                                <ul class="list-unstyled mb-4">
                                    <li class="text-muted"><i class="mdi mdi-minus mr-2"></i><b>LISTING:</b> <?php echo strtoupper($header['listing_type']); ?></li>
                                    <li class="text-muted"><i class="mdi mdi-minus mr-2"></i><b>DURATION:</b> <?php echo $header['listing_duration']; ?><b> days</b></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="text-center border-top p-4">
                            <a href="<?php echo base_url()?>user/create_listings" class="btn btn-block slippa-btn slippa-gradient">Start Now</a>
                        </div>
                    </div>
                </div>
           		<?php } ?>
            </div>
        	</div>
            <!---/website pricing -->

            <!---domains pricing -->
            <div class="slippa-spacer-60"></div><!-- /.slippa-spacer-60 -->
            <div class="section-title featured-top">
                <h3><b>DOMAINS LISTING PLANS</b></h3>
            </div>
            <div class="row mar">
            <div id="pricing-plans-2">
            	<?php foreach ($domains_headers as $header) { ?>
                <div class="col-md-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="pricing-box border rounded pt-4">
                        <div class="pl-2 pr-2">
                            <h6 class="text-center text-uppercase font-weight-bold"><?php echo strtoupper($header['listing_name']); ?></h6>
                            <p class="text-muted text-center mb-0 price mt-3 p-1"><span class="text-danger font-weight-normal h1"><sup class="h5">$</sup><?php echo number_format($header['listing_price'],2); ?>/</span><?php echo $header['listing_duration']; ?><b> days</b></p>
                            <div class="pricing-plan-item text-center">
                                <ul class="list-unstyled mb-4">
                                    <li class="text-muted"><i class="mdi mdi-minus mr-2"></i><b>LISTING:</b> <?php echo strtoupper($header['listing_type']); ?></li>
                                    <li class="text-muted"><i class="mdi mdi-minus mr-2"></i><b>DURATION:</b> <?php echo $header['listing_duration']; ?><b> days</b></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="text-center border-top p-4">
                            <a href="<?php echo base_url()?>user/create_listings" class="btn btn-block slippa-btn slippa-gradient">Start Now</a>
                        </div>
                    </div>
                </div>
           		<?php } ?>
            </div>
        	</div>
            <!---/domains pricing -->

            <!---sponsored pricing -->
            <div class="slippa-spacer-60"></div><!-- /.slippa-spacer-60 -->
            <div class="section-title featured-top">
                <h3><b>SPONSORED LISTING PLANS</b></h3>
            </div>
            <div class="row mar">
            <div id="pricing-plans-3">
            	<?php foreach ($sponsored_headers as $header) { ?>
                <div class="col-md-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="pricing-box border rounded pt-4">
                        <div class="pl-2 pr-2">
                            <h6 class="text-center text-uppercase font-weight-bold"><?php echo strtoupper($header['listing_name']); ?></h6>
                            <p class="text-muted text-center mb-0 price mt-3 p-1"><span class="text-danger font-weight-normal h1"><sup class="h5">$</sup><?php echo number_format($header['listing_price'],2); ?>/</span><?php echo $header['listing_duration']; ?><b> days</b></p>
                            <div class="pricing-plan-item text-center">
                                <ul class="list-unstyled mb-4">
                                    <li class="text-muted"><i class="mdi mdi-minus mr-2"></i><b>LISTING:</b> <?php echo strtoupper($header['listing_type']); ?></li>
                                    <li class="text-muted"><i class="mdi mdi-minus mr-2"></i><b>DURATION:</b> <?php echo $header['listing_duration']; ?><b> days</b></li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="text-center border-top p-4">
                            <a href="<?php echo base_url()?>user/create_listings" class="btn btn-block slippa-btn slippa-gradient">Start Now</a>
                        </div>
                    </div>
                </div>
           		<?php } ?>
            </div>
        	</div>
            <!---/sponsored pricing -->
        </div>
    	<!-- PRICING END -->
		</div>

	</div>
</div>
<!-- Container / End -->

<!-- Spacer -->
<div class="margin-top-40"></div>
<!-- Spacer / End-->

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