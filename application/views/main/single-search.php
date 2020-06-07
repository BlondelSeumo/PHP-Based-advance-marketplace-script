<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="author" content="onlinetoolhub.com">
<meta name="keywords" content="<?php echo $this->lang->line('site_keywords'); ?>"/>
<meta name="description" content="<?php echo $this->lang->line('site_metadescription'); ?>"/>
<meta name="copyright"content="onlinetoolhub">
<meta name="robots" content="index,follow" />
<meta name="url" content="<?php echo base_url(); ?>">
<title><?php echo 'SEARCH '.strtoupper($searchtype) ?> | <?php echo $this->lang->line('site_name'); ?> </title>
<meta name="og:title" content="<?php echo 'SEARCH '.strtoupper($searchtype) ?> | Domain Marketplace"/>
<meta name="og:url" content="<?php echo current_url(); ?>"/>
<meta name="og:image" content="<?php if(isset($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="thumbnail" />
<meta name="og:site_name" content="<?php echo 'SEARCH '.strtoupper($searchtype) ?> | <?php echo $this->lang->line('site_name'); ?> "/>
<meta name="og:description" content=""/>
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
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
                <h4 class="f-size-70 f-size-lg-50 f-size-md-40 f-size-xs-24 slippa-strong"><?php echo 'SEARCH '.strtoupper($searchtype) ?></h4>        
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.slippa-bredcump -->
<!---/top section---->

<div class="clearfix"></div>

<!-- Spacer -->
<div class="margin-top-40"></div>
<!-- Spacer / End-->

<!--SEARCH BAR -->
<section>
	<div class="container">
		<!-- Search Filter -->
		<div class="row extra-mrg">
			<div class="wrap-search-filter">
				<form>
					<div class="row">
						<div class="col-md-8 col-sm-8">
							<input id="searchterm" name="searchterm" value="<?php if(!empty($searchterm)) echo $searchterm; ?>" type="text" class="form-control border" placeholder="Keyword: Name, Tag">
						</div>
								
						<div class="col-md-4 col-sm-2">
							<button type="button" class="btn btn-primary full-width-button button-search slippa-gradient">Filter</button>
						</div>
					</div>

					<!-----collapse menu ------->
					<div class="row margin-top-10">
						<div class="col-md-12 col-sm-12">
							<a id="sidebar-toggle" class="float-right sidebar-toggle" type="button" data-toggle="collapse" href='#sidebar-search' aria-expanded='false' aria-controls='sidebar-search'><i class="fa fa-plus">&nbsp;</i>Advance Filters</a>
						</div>
					</div>
					<!-----/collapse menu ------->
					<input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				</form>
			</div>
		</div>
		<!-- /Search Filter -->
	</div>
</section>
<!----/ SEARCH BAR -->

<!-- Page Content-->
<div class="container">
	<div class="row">
		<div class="col-xl-3 col-lg-4">
			<div id="sidebar-search" class="sidebar-container collapse show">
				
				<!-- Location -->
				<div class="sidebar-widget">
					<h3>Country</h3>
					<select id="location-input" name="location-input" class="form-control default">
						<option value="">Any</option>
					</select>
				</div>

				<!-- Keywords -->
				<div class="sidebar-widget">
					<h3>Keywords</h3>
					<div class="keywords-container">
						<div class="keyword-input-container">
							<input type="text" class="keyword-input" placeholder="e.g. domains title"/>
							<button class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
						</div>
						<div class="keywords-list"><!-- keywords go here --></div>
						<div class="clearfix"></div>
					</div>
				</div>
				
				<?php if($searchtype === 'website') { ?>
				<!--Website Category -->
				<div class="sidebar-widget">
					<h3>Website Category</h3>
					<select id="website_industry" name="website_industry" class="form-control default">
						<option value="">Any</option>
						<?php foreach ($categoriesData as $key) { ?>
							<option value="<?php echo $key['c_id']; ?>"><?php echo $key['c_name']; ?></option>
						<?php } ?>
					</select>
				</div>
				<?php } ?>

				<!--Website Category -->
				<div class="sidebar-widget">
					<h3>Domain Extension</h3>
					<select id="extension" name="extension" class="form-control default">
						<option value="">Any</option>
					</select>
				</div>
				
				<?php if(in_array('auction',array_column($options,'platform')) && in_array('classified',array_column($options,'platform'))) {?>
				<!-- domains Types -->
				<div class="sidebar-widget">
					<h3>Listing Types</h3>

					<div class="switches-list">
						<div class="switch-container">
							<label class="switch"><input id="auction_check" name="auction_check" type="checkbox"><span class="switch-button"></span> Auction Listings</label>
						</div>

						<div class="switch-container">
							<label class="switch"><input id="classified_check" name="classified_check" type="checkbox"><span class="switch-button"></span> Classified Listings</label>
						</div>

					</div>

				</div>
				<?php } ?>

				<!-- Price Range -->
				<div class="sidebar-widget">
					<h3>Price Range</h3>
					<div class="margin-top-55"></div>
					<!-- Range Slider -->
					<input class="range-slider" type="text" value="" data-slider-currency="$" data-slider-min="<?php echo RANGE_MIN ?>" data-slider-max="<?php echo RANGE_MAX ?>" data-slider-step="<?php echo RANGE_STEP ?>" data-slider-value="[<?php echo RANGE_MIN ?>,<?php echo RANGE_MAX ?>]"/>
				</div>

			</div>
		</div>

		<input type="hidden" name="listing_type" id="listing_type" value="<?php echo $searchtype; ?>">
		<div id="results_div" class="col-xl-9 col-lg-8 content-left-offset">

		<h3 class="page-title">Search Results</h3>
		<div class="notify-box margin-top-15">
			<div class="sort-by">
				<span>Sort by:</span>
				<select id="sortyby" class="slippa-sort hide-tick">
					<option value="tbl_listings.date">Relevance</option>
					<option value="tbl_listings.views">Views</option>
					<option value="tbl_listings.date">Date</option>
				</select>
			</div>
		</div>

		<div id="searchResultsDiv" >
			
			<div class="listings-container grid-layout margin-top-35">
				
				<?php if(!empty($results)) { foreach ($results as $result) { ?>
				<!-- Listings -->
				<a href="<?php echo base_url().$result['listing_option'].'/'.$result['listing_type'].'/'.$result['id'];  ?>">
				<div class="domains-box bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden featured box-hover">
					<?php if(!empty($result['sponsored'])) { ?>
						<span class="tg-themetag tg-featuretag">Sponsored</span>
					<?php } ?>
					
					<div class="lable text-center pt-2 pb-2">
                        <ul class="list-unstyled best text-white mb-0 text-uppercase">
                            <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                        </ul>
                    </div>
					<!-- Listing Details -->
					<div class="domains-listing-details">
						<!-- Logo -->
						<div class="domains-listing-company-logo">
							<img src="<?php if(isset($result['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$result['website_thumbnail'];  ?>" alt="" class="img-sponsored">
						</div>

						<!-- Details -->
						<div class="ad-info">
							<h4 class="domains-listing-company"><?php if(isset($result['website_BusinessName'])) echo $result['website_BusinessName']; ?> 
							<?php if($result['google_verified'] === '1') { ?>
								<span class="verified-badge" title="Google Analytics Verified Listing" data-tippy-placement="top"></span>
							<?php } ?>
							</h4>
							<h3 class="domains-listing-title"><?php if(isset($result['website_tagline'])) echo substr($result['website_tagline'], 0,60); ?></h3>
							<a href="<?php base_url().'search/'.$result['listing_type']; ?>"><p class="text-muted mb-0"><img src="<?php echo base_url().ICON_UPLOAD.''.$result['categoryIcon']; ?>" alt="images" class="img-responsive text-primary mr-2 imageResize3"><?php if(isset($result['listing_type'])) echo strtoupper($result['listing_type']);  ?></p></a>
							<br>
							<?php if(!empty($result['website_buynowprice'])) { ?>
							<h4 class="item-price text-dark"><b><span><?php if(isset($result['default_currency'])) echo $result['default_currency']; else echo 'US $';  ?></span>  <?php if(isset($result['website_buynowprice'])) echo number_format(floatval($result['website_buynowprice'])); else echo number_format(floatval($result['website_buynowprice']));  ?></b></h4>
							<?php } ?>
						</div>

						<div class="ad-meta">
							&nbsp;&nbsp;<i class="icon-material-outline-access-time"></i> <?php if(isset($result['ago'])) echo $result['ago'];  ?>
							&nbsp;&nbsp;<i class="fa fa-flag"></i> <?php if(isset($result['listing_option'])) echo $result['listing_option']; ?>
							&nbsp;&nbsp;<i class="fa fa-user"></i> <?php if(isset($result['username'])) echo $result['username']; ?>
							&nbsp;&nbsp;<?php if($result['user_id'] !== $this->session->userdata('user_id')) { ?>
							<?php if(!empty($result['website_buynowprice'])) { ?>
                            	<a href="<?php echo base_url().'checkout/'.'buynow'.'/'.$result['id']; ?>" class="text-warning float-right"><i class="mdi mdi-credit-card-scan"></i> P a y   N o w</a>
                        		<?php } ?>
                            <?php } else { ?>
                            <a href="#" class="add-to-cart-own text-warning float-right"><i class="mdi mdi-credit-card-scan"></i> P a y   N o w</a>  
                            <?php } ?>
						</div>

						<span class="bookmark-icon"></span>

					</div>

				</div>
				</a>

				<?php } } else { ?>
				<h4 class="domains-listing-company"><?php echo 'Sorry , No Results were found '; ?> 
				<?php } ?>	

			</div>

			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
				<nav class="pagination paginationSearch">
					<ul>
						<?php if(!empty($links)) if(isset($links)) { echo $links; }?>
					</ul>
				</nav>
			</div>
			<div class="clearfix"></div>
			<!-- Pagination / End -->
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
<script>populateListOfCountries('location-input','');</script>
<script>
	$(window).bind('resize load', function (){
		if($(this).width() < 922){
			$('.collapse').removeClass('show');
		}
		else
		{
			$('.collapse').addClass('show');
		}
	});
</script>
<script>populateListTlds('extension');</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>