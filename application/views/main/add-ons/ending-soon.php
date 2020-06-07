<?php if(!empty($endingSoon)) { ?>
<!----------------------------Ending Soon Title ------------------------------------------------------------------>
<div class="section margin-top-1">
    <div class="container">
      <div class="main-content">
          <div class="section featureds">
              
            <div class="row">
              <div class="col-sm-12">
                <div class="section-title featured-top">
                  <h3><b><?php echo $this->lang->line('lang_ending_header'); ?></b></h3>
                </div>
              </div>
            </div>
            
            <!-- featured-slider -->
            <div class="featured-slider">
            <div id="ending-soon-slider" >
            <?php $i=1; foreach ($endingSoon as $ad) { ?>
            <!-- featured -->
              <div class="featured">
              <span class="bookmark-icon"></span>
              <!--featured image -->

              <div class="featured-image slippa-category-box slippa-rounded-10 slippa-p-20">
                <?php if($settings[0]['image_thumbnails'] === '1') { ?>
                <a href="<?php echo base_url().$ad['sell_type'].'/'.$ad['sell_web'].'/'.$ad['id'];  ?>"><img src="<?php if(isset($ad['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$ad['website_thumbnail'];  ?>" alt="" class="img-sponsored"></a>
                <?php } else { ?>
                <a href="<?php echo base_url().$ad['sell_type'].'/'.$ad['sell_web'].'/'.$ad['id'];  ?>"><div class="category-box-icon domian-bg-color color--<?php echo $i; ?> text-center f-size-28">.<?php if(isset($ad['extension'])) echo $ad['extension'];  ?></div></a>
                <?php } ?>

                <?php if($ad['sell_type'] === 'auction') { ?>
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
                <h4 class="item-price"><?php if(isset($ad['default_currency'])) echo $ad['default_currency']; else echo 'US $';  ?></span>  <?php if(isset($ad['website_buynowprice'])) echo number_format(floatval($ad['website_buynowprice'])); else echo number_format(floatval($ad['website_buynowprice']));  ?>
                </h4>
              </div><!-- ad-info -->
                    
              <!-- ad-meta -->
              <div class="ad-meta">
                <div class="meta-content">
                  <?php if(isset($ad['listing_type'])) echo strtoupper($ad['listing_type']);  ?></b></span>
                </div>                  
                <div class="user-option pull-right">
                  <?php if($ad['user_id'] !== $this->session->userdata('user_id')) { ?>
                    <?php if(!empty($ad['website_buynowprice'])) { ?>
                      <a href="<?php echo base_url().'checkout/'.'buynow'.'/'.$ad['id']; ?>" class="text-primary" data-toggle="tooltip" data-placement="top" title="Buy Now"><i class="mdi mdi-cart-plus"></i></a>
                    <?php } ?>
                  <?php } else {  ?>
                  <a href="#" class="add-to-cart-own text-primary"><i class="mdi mdi-cart-plus"></i></a>  
                  <?php } ?>
                  <a href="<?php echo base_url().'user_profile/'.$ad['user_id'];  ?>" data-toggle="tooltip" data-placement="top" title="<?php if(isset($ad['username'])) echo $ad['username'];  ?>"><i class="fa fa-user"></i> </a>                     
                </div><!-- item-info-right -->
              </div><!-- ad-meta -->

              </div><!-- featured -->
              <?php $i++; } ?>
                    
            </div><!-- featured-slider -->
            </div><!-- #featured-slider -->
            <a href="<?php base_url() ?>auctions" class="headline-link"><?php echo $this->lang->line('lang_btn_see_all'); ?></a>
          </div><!-- featureds -->
          <!--------------------------------------------------------------------------------------------------------------->
      </div>
  </div>
</div>
<?php } ?>
<!--------------------------------------------------------------------------------------------------------------->




