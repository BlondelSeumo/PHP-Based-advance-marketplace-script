    <!-- all domains start -->
    <?php if(!empty($domainlist)) { ?>
    <div class="section margin-top-2">
        <div class="container">

            <!---Section Title--->
            <div class="row">
            <div class="col-xl-12 col-lg-10 mx-auto text-center wow fade-in-bottom" data-wow-duration="1s">
                <h2 class="slippa-section-title dark">
                    <?php echo $this->lang->line('lang_domains_title'); ?>
                </h2>
                <p class="slippa-mb-0 slippa-light3 line-height-34 section-paragraph">
                    <?php echo $this->lang->line('lang_domains_title_sub'); ?>
                </p>
            </div><!-- /.col-xl-7 col-lg-10 mx-auto text-center wow fade-in-bottom -->
            </div><!-- /.row -->
            <!-----Section Title--->

            <div class="row">
                <div class="col-12">
                    <div class="tab-content mt-5" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="recent-domains" role="tabpanel" aria-labelledby="recent-domains-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                <!--- ROW ----->
                                <div class="row">
                                    <?php foreach ($domainlist as $domain) { ?>

                                    <div class="col-lg-4 col-sm-12">
                                        <ul class="category-list category-bx">
                                            <?php foreach ($domain as $key ) { ?>
                                            <li>
                                                <a href="<?php echo base_url().$key['listing_option'].'/'.$key['listing_type'].'/'.$key['id'] ?>">
                                                <div class="logo"><img src="<?php if(isset($key['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$key['website_thumbnail']; ?>" alt=""></div>
                                                <span><b><?php if(isset($key['website_BusinessName'])) echo $key['website_BusinessName'];  ?></b></span>
                                                </a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div> 

                                    <?php } ?>
                                </div>
                                <!--- END MAIN ROW --->
                            </div>
                        </div>

                    </div>
                </div>
                <br>
                <a href="<?php echo base_url() ?>search/domain" class="headline-link"><?php echo $this->lang->line('lang_btn_browse_all'); ?></a>
            </div>
            <!-- end row -->
        </div>
        <!-- end containar -->
    </div>
    <!-- all domain section -->
</div>
<?php } ?>
