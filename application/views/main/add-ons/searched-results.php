		<div>

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
							<h4 class="item-price text-dark"><b><?php if(isset($result['default_currency'])) echo $result['default_currency']; else echo 'US $';  ?></span>  <?php if(isset($result['website_buynowprice'])) echo number_format(floatval($result['website_buynowprice'])); else echo number_format(floatval($result['website_buynowprice']));  ?></b></h4>
							<?php } ?>
						</div>

						<div class="ad-meta">
							&nbsp;&nbsp;<i class="icon-material-outline-access-time"></i><?php if(isset($result['ago'])) echo $result['ago'];  ?>
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
						<?php if(isset($links)) { echo $links; }?>
					</ul>
				</nav>
			</div>
			<div class="clearfix"></div>
			<!-- Pagination / End -->
		</div>