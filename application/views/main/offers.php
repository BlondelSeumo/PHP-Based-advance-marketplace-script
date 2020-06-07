<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta Tags--->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="author" content="onlinetoolhub.com">
<meta name="keywords" content="<?php echo $this->lang->line('site_offers_keywords'); ?>"/>
<meta name="description" content="<?php echo $this->lang->line('site_offers_metadescription'); ?>"/>
<meta name="copyright"content="onlinetoolhub">
<meta name="robots" content="index,follow" />
<meta name="url" content="<?php echo base_url(); ?>">
<title><?php echo $this->lang->line('site_offers'); ?> | <?php echo $this->lang->line('site_name'); ?></title>
<meta name="og:title" content="<?php echo $this->lang->line('site_offers'); ?> | <?php echo $this->lang->line('site_name'); ?>"/>
<meta name="og:url" content="<?php echo current_url(); ?>"/>
<meta name="og:image" content="<?php if(isset($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="thumbnail" />
<meta name="og:site_name" content="<?php echo $this->lang->line('site_offers'); ?> | <?php echo $this->lang->line('site_name'); ?>"/>
<meta name="og:description" content="<?php echo $this->lang->line('site_offers_metadescription'); ?>"/>
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

<!---top section---->
<div class="slippa-breadcump slippa-breadcump-height breaducump-style-2">
    <div class="slippa-page-bg rtbgprefix-full" style="background-image: url(<?php if(!empty($imagesData[0]['homepage'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['homepage']; ?>);">
    </div>
    <!-- /.slippa-page-bg -->
    <div class="container">
        <div class="row slippa-breadcump-height align-items-center">
            <div class="col-lg-12 mx-auto text-center text-white">
                <h4 class="f-size-70 f-size-lg-50 f-size-md-40 f-size-xs-24 slippa-strong"><?php echo $this->lang->line('lang_bred_offers_page_main'); ?></h4>
                <h4 class="f-size-36 f-size-lg-30 f-size-md-24 f-size-xs-16 slippa-light3"><?php echo $this->lang->line('lang_bred_offers_page_sub'); ?></h4>
                
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.slippa-bredcump -->
<!---/top section---->

<!-- Page Content-->
<div class="container">

    <!---Section Title--->
    <div class="row">
        <div class="col-xl-12 col-lg-10 mx-auto text-center wow fade-in-bottom" data-wow-duration="1s">
            <h2 class="slippa-section-title dark">
            <?php echo $this->lang->line('lang_offers_title'); ?>
            </h2>
            <p class="slippa-mb-0 slippa-light3 line-height-34 section-paragraph">
            <?php echo $this->lang->line('lang_offers_title_sub'); ?>
            </p>
        </div><!-- /.col-xl-7 col-lg-10 mx-auto text-center wow fade-in-bottom -->
    </div><!-- /.row -->
    <!-----Section Title--->

	<div class="row">
		<div class="col-xl-12">
        
            <div class="slippa-spacer-60"></div><!-- /.slippa-spacer-60 -->

            <div class="row">
            <div class="col-lg-8 mx-auto">
                <ul class="nav tbanavs" id="myOffersTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-all" data-toggle="tab" href="#slippa-tab-1" role="tab"
                            aria-controls="slippa-tab-1" aria-selected="true"><?php echo $this->lang->line('lang_filter_offers'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-websites" data-toggle="tab" href="#slippa-tab-2" role="tab"
                            aria-controls="slippa-tab-2" aria-selected="false"><?php echo $this->lang->line('lang_filter_only_websites'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-domains" data-toggle="tab" href="#slippa-tab-3" role="tab"
                            aria-controls="slippa-tab-3" aria-selected="false"><?php echo $this->lang->line('lang_filter_only_domains'); ?></a>
                    </li>
                </ul>
            </div><!-- /.col-lg-8 -->
            </div><!-- /.row -->

            <div class="slippa-spacer-40"></div><!-- /.slippa-spacer-40 -->
            <div id="offer_table">
            <div class="row">
            <div class="col-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade-in-bottom show active" id="slippa-tab-1" role="tabpanel" aria-labelledby="slippa-tab-1-tab">

                        <div class="table-responsive">
                            <table class="table domain-table">
                                <thead>
                                    <tr class="slippa-light-gray">
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_1'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_offers_table_header_2'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_offers_table_header_3'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_4'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_5'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_offers_table_header_6'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_offers_table_header_7'); ?></th>
                                    </tr>
                                </thead>

                                <?php if(!empty($offers)) { foreach ($offers as $offer) { ?>  
                                <tbody>
                                    <tr>
                                    <th class="f-size-18 f-size-md-18 slippa-semiblod text-234"><?php echo $offer['website_BusinessName'];  ?>&nbsp; <span class="badge badge-warning"><?php echo $offer['listing_type'];  ?></span></th>
                                    <?php if($offer['status'] === '1') { ?>
                                        <?php if($offer['sold_status'] === '0') { ?>
                                            <td class="f-size-18 f-size-md-18 slippa-semiblod text-success"><?php echo $this->lang->line('lang_available'); ?></td>
                                        <?php } else { ?>
                                            <td class="f-size-18 f-size-md-18 slippa-semiblod text-warning"><?php echo $this->lang->line('lang_sold'); ?></td>
                                        <?php }?>
                                    <?php } ?>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-info"><?php echo $offer['totalOffers'];  ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-605"><?php echo $offer['views'];  ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-338"><?php echo $default_currency;  ?><?php if(!empty($offer['minimumOffer'])) echo number_format($offer['minimumOffer'],2);  ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-dark"><?php echo $offer['ago'];  ?></td>
                                    <td class="text-center"><a href="<?php echo base_url().$offer['listing_option'].'/'.$offer['listing_type'].'/'.$offer['id'];  ?>" class="slippa-btn slippa-gradient2 slippa-sm4 pill"><?php echo $this->lang->line('lang_btn_place_offer'); ?></a></td>
                                    </tr>
                                </tbody>
                                <?php } } ?>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div>
                </div>
            </div><!-- /.col-12 -->
        	</div><!-- ./row -->

        	<div class="slippa-spacer-60 slippa-spacer-xs-40"></div><!-- /.slippa-spacer-60 -->
        	<div class="row">
            <div class="col-12">
                <div class="text-center">
                    <div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
					<nav class="pagination paginationOffer">
						<ul>
							<?php if(isset($links)) { echo $links; }?>
						</ul>
					</nav>
					</div>
                </div><!-- /.text-center -->
            </div><!-- /.col-12 -->
        	</div><!-- /.row -->
            </div>
    	</div>
	</div>
</div>


<!-- Spacer -->
<div class="margin-top-15"></div>
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