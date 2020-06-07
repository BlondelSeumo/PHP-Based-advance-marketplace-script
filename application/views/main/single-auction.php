<!DOCTYPE html>
<html lang="en">
<head>
<!---meta tags---->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="author" content="onlinetoolhub.com">
<meta name="keywords" content="<?php if(!empty($listing_data[0]['website_metakeywords'])) echo implode(',', json_decode(html_entity_decode($listing_data[0]['website_metakeywords']),true)); ?>"/>
<meta name="description" content="<?php if(isset($listing_data[0]['website_metadescription'])) echo $listing_data[0]['website_metadescription']; ?>"/>
<meta name="copyright"content="onlinetoolhub">
<meta name="robots" content="index,follow" />
<meta name="url" content="<?php echo base_url(); ?>">
<title><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName'];?> - FOR SALE</title>
<meta name="og:title" content="<?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName'];?> - FOR SALE"/>
<meta name="og:url" content="<?php echo current_url(); ?>"/>
<meta name="og:image" content="<?php if(isset($listing_data[0]['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$listing_data[0]['website_thumbnail']; ?>" alt="thumbnail" />
<meta name="og:site_name" content="<?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?> | Domain Marketplace"/>
<meta name="og:description" content="<?php if(isset($listing_data[0]['website_metadescription'])) echo $listing_data[0]['website_metadescription']; ?>"/>
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<!---/meta tags---->
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
                <h4 class="f-size-70 f-size-lg-50 f-size-md-40 f-size-xs-24 slippa-strong"><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?></h4>
                <h4 class="f-size-36 f-size-lg-30 f-size-md-24 f-size-xs-16 slippa-light3"><?php if(isset($listing_data[0]['listing_type'])) echo ($listing_data[0]['listing_type']); ?> is for sale</h4>
                
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.slippa-bredcump -->
<!---/top section---->

<!-- Page Content-->
<div class="container">
	<div class="row">
		<input type="hidden" name="listingidwebsite" id="listingidwebsite" value="<?php if(isset($listing_data[0]['id'])) echo $listing_data[0]['id']; ?>">
		<!-- Content -->
		<div class="col-xl-8 col-lg-8 content-right-offset">
		<div class="imil-box margin-bottom-30">
            <div class="slippa-box-style-2">
                <h4 class="f-size-36 f-size-xs-30 slippa-semiblod text-422"><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?></h4>   
               	<h5 class="f-size-18 slippa-light3"><?php if(isset($listing_data[0]['website_tagline'])) echo $listing_data[0]['website_tagline']; ?></h5>
                <div class="row margin-top-50">
                    <div class="domain-border col-lg-4">
                        <span class="d-block f-size-24 slippa-semiblod"><?php if(isset($listing_data[0]['website_age'])) echo $listing_data[0]['website_age']; ?> Years</span>
                        <span class="d-block f-size-16 slippa-light3">Age</span>
                    </div>

                    <div class="domain-border col-lg-4 media-body">
                        <img class="flag" src="<?php echo base_url().ICON_FLAGS ?><?php if(isset($listing_data[0]['business_registeredCountry'])) echo strtolower($listing_data[0]['business_registeredCountry']); ?>.svg" alt=""> <?php if(isset($listing_data[0]['business_registeredCountry'])) echo strtoupper($listing_data[0]['business_registeredCountry']); ?></span>
                        <span class="d-block f-size-16 slippa-light3">Registered Country</span>
                    </div>

                    <div class="col-lg-4">
                        <span class="d-block f-size-24 slippa-semiblod"><?php if(!empty($alexaRank['globalRank'][0])) echo number_format($alexaRank['globalRank'][0]); else echo 'N/A'; ?></span>
                        <span class="d-block f-size-16 slippa-light3">Alexa</span>
                   </div>

                </div><!-- /.d-flex -->
            </div><!-- /.slippa-box-style-2 -->
            <div class="slippa-gradient-4 text-center f-size-18 slippa-semiblod padding-top-10 margin-bottom-10 padding-bottom-10 text-white">
                Premium Public Auction
           	</div><!-- /.slippa-gradient-4 -->
        </div><!-- /.imil-box -->

        <div class="slippa-box-style-2 margin-bottom-30 slippa-dorder-off">
            <span class="f-size-18"><span class="slippa-strong">Hot & Sponsored You would Also Like - </span> <a id="sponsored-dom" class="no-deco" href=""><span class="txt-rotate" data-period="2000" data-rotate=''></span></a></span>
        </div><!-- /.slippa-box-style-2 -->

        <!-- ad-section -->	
		<!--------------------------------------------------------------------------------------------------------------->
		<?php if(!empty($ads[0]['webpage_banner_720x90'])) { ?>					
		<div class="ad-section text-center margin-bottom-25">
			<?php print_r($ads[0]['webpage_banner_720x90']); ?>
		</div>
		<?php } ?>
		<!--------------------------------------------------------------------------------------------------------------->
		<!-- ad-section / End-->

       	<div class="slippa-box-style-2 margin-bottom-30">
       	
       	<?php if(empty($this->session->userdata('user_id'))) { ?>
            <span class="f-size-24 d-block margin-bottom-30"><h3>About Business</h3></span>
			<!-- Meta Description -->
			<p class="f-size-18 slippa-light3 line-height-34"><?php if(isset($listing_data[0]['website_metadescription'])) echo $listing_data[0]['website_metadescription']; ?></p>
		<?php } ?>
       
			
		<?php if(!empty($this->session->userdata('user_id'))) { ?>

			<!-- Description -->
			<div class="single-page-section">
				<div class="row">
					<div class="col-md-12">
						<div class="content">
							<h3 class="margin-bottom-25">About Business</h3>
							<p class="description-width"><?php if(isset($listing_data[0]['description'])) if(DECODE_DESCRIPTIONS) echo html_entity_decode($listing_data[0]['description']);  else echo ($listing_data[0]['description']); ?></p>
						</div>
					</div>
				</div>
			</div>
			
			<?php if(!empty($domainStatics)) { ?>
			<!-- Key Points -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">Traffic</h3>
				<div class="row">
				<div class="col-md-12">
				<div class="content">
					<!-- Chart -->
					<div class="chart">
						<canvas id="chart" width="100" height="45"></canvas>
					</div>
				</div>
				</div>
				</div>
				<!-- Dashboard Container -->
				<div class="row">
				<div class="col-md-12">
				<!-- Dashboard Container -->
				<div class="fun-facts-container">
				<div class="fun-fact" data-fun-fact-color="#36bd78">
					<div class="fun-fact-text">
						<span>Total Unique Visitors</span>
						<h4><?php if(isset($domainStatics[0][0])) echo $domainStatics[0][0]; ?></h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-gavel"></i></div>
				</div>
				<div class="fun-fact" data-fun-fact-color="#b81b7f">
					<div class="fun-fact-text">
						<span>Total Page Views</span>
						<h4><?php if(isset($domainStatics[0][1])) echo $domainStatics[0][1]; ?></h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-business-center"></i></div>
				</div>
				</div>
				</div>
				</div>
				<!-- /Dashboard Container -->
			</div>
			<?php } ?>

			<?php if(!empty($listing_data[0]['website_how_make_money'])) { ?>
			<!-- How to make money -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">How to make money?</h3>
				<p class="description-width"><?php echo $listing_data[0]['website_how_make_money']; ?></p>
			</div>
			<?php } ?>

			<?php if(!empty($listing_data[0]['website_purchasing_fulfilment'])) { ?>
			<!-- Website Purchasing Fullfilment -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">How do you deliver this business?</h3>
				<p class="description-width"><?php echo $listing_data[0]['website_purchasing_fulfilment']; ?></p>
			</div>
			<?php } ?>

			<?php if(!empty($listing_data[0]['website_whyselling'])) { ?>
			<!-- Why are you selling this business -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">Why are you selling this bussiness?</h3>
				<p class="description-width"><?php echo $listing_data[0]['website_whyselling']; ?></p>
			</div>
			<?php } ?>


			<?php if(!empty($listing_data[0]['website_suitsfor'])) { ?>
			<!-- Website is sutable for -->
			<div class="single-page-section">
				<h3 class="margin-bottom-25">Website is suitable for?</h3>
				<p class="description-width"><?php echo $listing_data[0]['website_suitsfor']; ?></p>
			</div>
			<?php } ?>

			<?php if(!empty($listing_data[0]['financial_uploadVisual']))  { ?>
			<!-- Atachments -->
			<div class="single-page-section">
				<h3>Attachments</h3>
				<?php if(!empty($listing_data[0]['financial_uploadVisual']))  { ?>
				<div class="input-group margin-top-25">
					<div class="attachments-container">
						<a href="<?php echo base_url().FILES_UPLOAD.$listing_data[0]['financial_uploadVisual']; ?>" class="attachment-box ripple-effect"><span><?php echo $listing_data[0]['financial_uploadVisual']; ?></span><i><?php echo strtoupper(pathinfo($listing_data[0]['financial_uploadVisual'], PATHINFO_EXTENSION)); ?></i></a>
					</div>
				</div>
				<?php } ?>
				<?php if(!empty($listing_data[0]['financial_uploadProfitLoss']))  { ?>
				<div class="input-group margin-top-25">
					<div class="attachments-container">
						<a href="<?php echo base_url().FILES_UPLOAD.$listing_data[0]['financial_uploadVisual']; ?>" class="attachment-box ripple-effect"><span><?php echo $listing_data[0]['financial_uploadProfitLoss'] ?></span><i><?php echo strtoupper(pathinfo($listing_data[0]['financial_uploadProfitLoss'], PATHINFO_EXTENSION)); ?></i></a>
					</div>
				</div>				
				<?php } ?>
			</div>
			<?php } ?>

			<?php if(!empty($listing_data[0]['website_metakeywords'])) { ?>
			<!-- Tags -->
			<div class="single-page-section">
				<h3>Tags</h3>
				<div class="task-tags">
					<?php foreach (json_decode(html_entity_decode($listing_data[0]['website_metakeywords']),true) as $key) { ?>
						<span><?php echo $key ?></span>
					<?php }?>
				</div>
			</div>
			<?php } ?>

			<div class="clearfix"></div>
			
			<!-- Comments Area -->
			<div class="boxed-list margin-bottom-60">

				<?php if(!empty($this->session->userdata('user_id'))) { ?>
				<div class="boxed-list-headline">
					<h3><i class="fa fa-comments"></i> Comments</h3>
				</div>

				<div id="commentsSection"></div>
				<!--------------------------------------------------------------------------------------------------------------->
				<?php $this->load->view('main/add-ons/comments'); ?>
				<!--------------------------------------------------------------------------------------------------------------->
				<?php } else { ?>
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-lock"></i> Please <a href="<?php echo base_url().'login' ?>">login</a> to View Comments</h3>
				</div>	
				<?php }?>
			</div>

		<?php } else { ?>
			<div class="boxed-list-headline">
				<h3><i class="icon-material-outline-lock"></i> Please <a href="<?php echo base_url().'login' ?>">login</a> to View Statics , Other Information </h3>
			</div>	
		<?php } ?>

		</div><!-- /.slippa-box-style-2 -->

		</div>

		<!-- Sidebar -->
		<div class="col-xl-4 col-lg-4">
			<div class="slippa-gradient-2 text-center text-white slippa-light3 f-size-28 f-size-xs-24 margin-top-25 margin-bottom-25 margin-bottom-30">
                This <?php if(isset($listing_data[0]['listing_type'])) echo ($listing_data[0]['listing_type']); ?> is in <?php if(isset($listing_data[0]['listing_option'])) echo ($listing_data[0]['listing_option']); ?>
            </div><!-- /.slippa-gradient-2 -->

			<div class="sidebar-container">

				<?php if ($auctionstatus ==='valid' ){?>
				<div class="countdown green margin-bottom-35"><?php if(!empty($nofdaysleft['days'])) echo $nofdaysleft['days']; ?> days, <?php if(!empty($nofdaysleft['hours'])) echo $nofdaysleft['hours']; ?> hours left</div>
				<?php }else { ?>
				<div class="countdown bg-danger text-white margin-bottom-35"> AUCTION ENDED !! </div>
				<?php } ?>

				<div class="sidebar-widget">
					<div class="bidding-widget">
						<div class="bidding-headline centerButtons"><h3><?php echo strtoupper('Bid on this Business !');  ?></h3></div>
						<div class="bidding-inner">
						<?php if($listing_data[0]['status'] !== '5') {
							if($listing_data[0]['sold_status'] === '0') { ?>
								
							<?php if ($auctionstatus ==='valid' ){?>
							<!-- Headline -->
							<span class="bidding-detail" style="float: right;"><a href="#sign-in-dialog" class="popup-with-zoom-anim"> <?php echo count($validBids); ?> <strong>Bids </a> </strong></span>
							<?php } ?>
							<span class="bidding-detail"><strong>CURRENT PRICE</strong></span>

							<!-- Price-->
							<div class="bidding-value">$ <?php echo number_format(floatval($currentPrice)); ?></div>
							<?php if ($auctionstatus ==='valid' ){?>
							<!-- Headline -->
							<span class="bidding-detail margin-top-30">Reserve: <strong><?php if(!empty($default_currency)) echo $default_currency; else echo '$'; ?> <?php if(isset($listing_data[0]['website_reserveprice'])) echo $listing_data[0]['website_reserveprice']; ?></strong></span>
							<?php } ?>

							<?php if($listing_data[0]['user_id'] !== $this->session->userdata('user_id')) { ?>
							<?php if ($auctionstatus ==='valid' ){?>
							<!-- Button PLACE BID-->
							<a href="#small-dialog" class="button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim"><?php echo strtoupper('Place Bid');  ?> <i class="icon-material-outline-arrow-right-alt"></i></a>
							<?php } else { ?>	
							<?php } }?>

							<!-- Button -->
							<?php if($listing_data[0]['user_id'] !== $this->session->userdata('user_id')) { ?>
							<a href="#small-dialog-4" class="button ripple-effect move-on-hover full-width margin-top-20 popup-with-zoom-anim"><?php echo strtoupper('contact seller');  ?> <i class="icon-feather-mail"></i></a>
							<?php } else { ?>
							<div class="countdown alert alert-warning margin-bottom-35 margin-top-30"> This is one of your listings </div>
							<?php }?>

							<?php if($listing_data[0]['user_id'] !== $this->session->userdata('user_id')) { ?>
							<?php if(!empty($listing_data[0]['website_buynowprice'])) { ?>
								<!-- Button -->
								<a href="<?php echo base_url().'checkout/'.'buynow'.'/'.$listing_data[0]['id']; ?>" class="button ripple-effect move-on-hover full-width margin-top-20"><span>BUY IT NOW FOR $ <?php if(!empty($listing_data[0]['website_buynowprice'])) echo number_format($listing_data[0]['website_buynowprice']); ?></span></a>
							<?php } } ?>
						<?php } else { ?>
							<div class="alert alert-info text-dark margin-bottom-35 text-center"> SOLD </div>
						<?php } } else { ?>
						<div class="alert alert-danger text-dark margin-bottom-35 text-center"> UNVERIFIED LISTING </div>
						<?php } ?>
						</div>
						<?php if($listing_data[0]['user_id'] !== $this->session->userdata('user_id')) { ?>
							<div class="bidding-signup"><a href="#small-dialog-5" class="popup-with-zoom-anim">Report this</a></div>
						<?php } ?>
					</div>
				</div>

				<?php if(!empty($this->session->userdata('user_id'))) { ?>
				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<div class="domains-overview">
						<div class="domains-overview-headline">At a Glance</div>
						<div class="domains-overview-inner">
							<ul>
								<li>
									<i class="fa fa-globe"></i>
									<span>ALEXA RANK</span>
									<h5><?php if(!empty($alexaRank['globalRank'][0])) echo number_format($alexaRank['globalRank'][0]); else echo 'N/A'; ?></h5>
								</li>

								<?php if($listing_data[0]['listing_type'] === 'website') { ?>
								<li>
									<i class="icon-material-outline-business-center"></i>
									<span><?php if(isset($listing_data[0]['listing_type'])) echo strtoupper($listing_data[0]['listing_type']); ?> TYPE</span>
									<h5> <a href="<?php echo base_url().'main/category/'.$selectedcategoriesData[0]['url_slug'] ?>"><?php if(isset($selectedcategoriesData[0]['c_name'])) echo $selectedcategoriesData[0]['c_name']; ?></h5>
								</li>
								<?php } ?>

								<li>
									<i class="icon-material-outline-access-time"></i>
									<span><?php if(isset($listing_data[0]['listing_type'])) echo strtoupper($listing_data[0]['listing_type']); ?> AGE</span>
									<h5><?php if(isset($listing_data[0]['website_age'])) echo $listing_data[0]['website_age']; ?> Years</h5>
								</li>

								<?php if($listing_data[0]['listing_type'] === 'website') { ?>
								<li>
									<i class="icon-feather-dollar-sign"></i>
									<span>NET PROFIT</span>
									<h5><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?> <?php if(isset($listing_data[0]['annual_profit'])) echo number_format($listing_data[0]['annual_profit']); ?></h5>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<?php } ?>

				<!----About Seller --->
				<div class="sidebar-widget">
				<div class="seller-box margin-bottom-30">
                    <div class="slippa-box-style-2">
                        <h4 class="f-size-20 slippa-semiblod text-center">THE SELLER</h4>
                        <div class="media  margin-top-30">
                            <div class="media-body text-center">
                            	<img src="<?php if(isset($ownerData[0]['thumbnail'])) echo base_url().USER_UPLOAD.$ownerData[0]['thumbnail']; ?>" alt="" class="msgavatar centerButtons">

                                <h5 class="margin-bottom-15 f-size-24 slippa-semiblod"><a href="<?php echo base_url().'user_profile/'.$ownerData[0]['username']?>"><?php if(isset($ownerData[0]['username'])) echo $ownerData[0]['username']; ?></a></h5>
                                <img class="flag" src="<?php echo base_url().ICON_FLAGS ?><?php if(isset($listing_data[0]['business_registeredCountry'])) echo strtolower($listing_data[0]['business_registeredCountry']); ?>.svg" alt=""> <?php if(isset($listing_data[0]['business_registeredCountry'])) echo strtoupper($listing_data[0]['business_registeredCountry']); ?>
                                <p class="margin-bottom-15 f-size-18 text-338">
                                    <div class="star-rating" data-rating="5.0"></div>
                                </p>
                                <?php if(!empty($this->session->userdata('user_id'))) { ?>
                                <p>
                                	<?php if($listing_data[0]['user_id'] !== $this->session->userdata('user_id')) { ?>
                                    	<a href="#small-dialog-4" class="slippa-btn slippa-outline-gradientL pill text-uppercase ull-width margin-top-30 popup-with-zoom-anim">Contact Seller</a>
                                    <?php } 
                            		} else { ?>
                            		<a href="#" class="slippa-btn slippa-outline-gradientL pill text-uppercase ull-width margin-top-30 own-listing">Contact Seller</a>
                            	<?php }?>
                            </div>
                        </div>
                    </div><!-- /.slippa-box-style-3 -->
                </div><!-- /.seller-box -->
				</div>

				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<div class="media margin-bottom-30">
                    <img src="<?php echo base_url()?>assets/img/safe.png" class="slippa-mr-30 resize" alt="">
                    <div class="media-body">
                        <h5 class="mt-0 f-size-24 slippa-semiblod"> Buyer protection</h5>
                        <p class="slippa-mb-0 f-size-18 line-height-34 slippa-light3">
                            <?php echo $this->lang->line('product_description_info1'); ?>
                        </p>
                    </div>
                	</div>

                	<div class="media margin-bottom-30">
                    <img src="<?php echo base_url()?>assets/img/migrate.png" class="slippa-mr-30" alt="">
                    <div class="media-body">
                        <h5 class="mt-0 f-size-24 slippa-semiblod">Transfer Service</h5>
                        <p class="slippa-mb-0 f-size-18 line-height-34 slippa-light3">
                            <?php echo $this->lang->line('product_description_info2'); ?>
                        </p>
                    </div>
                	</div>
				</div>

				<!-- Sidebar Widget -->
				<div class="sidebar-widget">
					<h3>Share</h3>

					<!-- Copy URL -->
					<div class="copy-url">
						<input id="copy-url" type="text" value="" class="with-border">
						<button class="copy-url-button ripple-effect" data-clipboard-target="#copy-url" title="Copy to Clipboard" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>
					</div>

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
<!----page scripts ---->
<script>loadDomainTrafficData('chart');textRotator();</script>
<?php if($expiredStatus) { ?>
<script>disableScreen();</script>
<?php } ?>
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/models'); ?>
<!--------------------------------------------------------------------------------------------------------------->
</body>
</html>