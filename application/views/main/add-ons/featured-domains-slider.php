<?php if(!empty($featuredDomains)) { ?>
<!---Section Title--->
<div class="margin-top-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
            <!---Section Title--->
            <div class="row">
                <div class="col-xl-12 col-lg-10 mx-auto text-center wow fade-in-bottom" data-wow-duration="1s">
                    <h2 class="slippa-section-title dark">
                        <?php echo $this->lang->line('lang_featured_domain_title'); ?>
                    </h2>
                    <p class="slippa-mb-0 slippa-light3 line-height-34 section-paragraph">
                        <?php echo $this->lang->line('lang_featured_domain_sub'); ?>
                    </p>
                </div><!-- /.col-xl-7 col-lg-10 mx-auto text-center wow fade-in-bottom -->
            </div><!-- /.row -->
            <!-----Section Title--->
            </div>
        </div>
    </div>
</div>
<!---/Section Title--->

<!------Featured Domain Slider---------> 
<div class="section margin-top-0">
    <div class="container">
        <div class="main-content">
            <div class="section featureds">          
            <!-- featured-slider -->
            <div class="featured-slider">
            <div id="feature-active">
            <?php $i=0; foreach ($featuredDomains as $ad) { ?>

                <div class="featured box-hover">

                    <span class="bookmark-icon"></span>
                    <!-- featured image -->
                    <div class="featured-image slippa-category-box slippa-rounded-10 slippa-p-20">
                        <?php if($settings[0]['image_thumbnails'] === '1') { ?>
                        <a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>"><img src="<?php if(isset($ad['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$ad['website_thumbnail'];  ?>" alt="" class="img-sponsored"></a>
                        <?php } else { ?>
                        <a href="<?php echo base_url().$ad['listing_option'].'/'.$ad['listing_type'].'/'.$ad['id'];  ?>"><div class="category-box-icon domian-bg-color color--<?php echo $i; ?> text-center f-size-28">.<?php if(isset($ad['extension'])) echo $ad['extension'];  ?></div></a>
                        <?php } ?>
                        <?php if($ad['listing_option'] === 'auction') { ?>
                        <a href="#" class="auction" data-toggle="tooltip" data-placement="left" title="AUCTION"><i class="fas fa-gavel"></i></a>
                        <?php } else { ?>
                        <a href="#" class="verified" data-toggle="tooltip" data-placement="left" title="CLASSIFIED"><i class="fab fa-adversal"></i></a>
                        <?php } ?>
                    </div>
                    
                    <!-- ad-info -->
                    <div class="ad-info">
                        <h2 class="item-title">
                            <strong><a href="#"><?php if(isset($ad['website_BusinessName'])) echo $ad['website_BusinessName'];  ?></a></strong>
                        </h2>
                        <h4 class="item-price"><b><?php if(isset($ad['default_currency'])) echo $ad['default_currency']; else echo 'US $';  ?></span>  <?php if(isset($ad['website_buynowprice'])) echo number_format(floatval($ad['website_buynowprice'])); else echo number_format(floatval($ad['website_buynowprice']));  ?></b>
                        </h4>
                    </div><!-- ad-info -->
                    
                    <!-- ad-meta -->
                    <div class="ad-meta">
                        <div class="meta-content">
                            <span class="item-cat"><b><?php if(!empty($ad['ago'])) echo $ad['ago']; ?></b></span>
                        </div>                  
                    <!-- item-info-right -->
                        <div class="user-option pull-right">
                            <?php if($ad['user_id'] !== $this->session->userdata('user_id')) { ?>
                            <?php if(!empty($ad['website_buynowprice'])) { ?>
                            <a href="<?php echo base_url().'checkout/'.'buynow'.'/'.$ad['id']; ?>" class="text-primary" data-toggle="tooltip" data-placement="top" title="Buy Now"><i class="mdi mdi-cart-plus"></i></a>
                            <?php } ?>
                            <?php } else {  ?>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Buy Now" class="add-to-cart-own text-primary"><i class="mdi mdi-cart-plus"></i></a>  
                            <?php } ?>
                            <a href="<?php echo base_url().'user_profile/'.$ad['user_id'];  ?>" data-toggle="tooltip" data-placement="top" title="<?php if(!empty($ad['username'])) echo $ad['username'];  ?>"> <i class="fa fa-user"></i> </a>               
                        </div><!-- item-info-right -->
                    </div><!-- ad-meta -->
                </div><!-- featured -->

                <?php $i++; } ?>  
                </div><!-- featured-slider -->
            </div><!-- #featured-slider -->
            <?php if(!empty($featuredDomains)) { ?>
            <a href="<?php base_url() ?>search/domain" class="headline-link"><?php echo $this->lang->line('lang_btn_see_all'); ?></a>
            <?php } ?>
            </div><!-- featureds -->
        </div>
    </div>
</div>
<?php } ?>
<!--/Featured Domains---->