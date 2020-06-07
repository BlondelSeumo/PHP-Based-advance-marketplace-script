<!--Featured Domains---->
<?php if(!empty($featuredDomains)) { ?>
<div class="section margin-top-2">
    <div class="container">

        <div class="row">
            <div class="col-xl-12">
            <div class="row">
                <div class="col-lg-4 col-md-6 mx-auto margin-bottom-30 wow fade-in-bottom">
                <div class="slippa-price-1">
                <div class="price-hrader text-center margin-bottom-30">
                    <img src="<?php echo base_url() ?>assets/img/featured.png" alt="price image" draggable="false">
                    <h3 class="f-size-36  f-size-xs-32 slippa-normal"><?php echo $this->lang->line('lang_editor_choice'); ?></h3>
                    <p class="slippa-light3 f-size-xs-22 section-p-content">
                        <?php echo $this->lang->line('lang_editor_choice_sub'); ?>
                    </p>
                </div><!-- /.price-hrader -->

                <div class="price-body padding-top-10">
                    <ul class="slippa-list"> 
                    <?php foreach ($featuredDomains as $domain) { ?>
                    <li class="clearfix">
                        <a href="<?php echo base_url().$domain['listing_option'].'/'.$domain['listing_type'].'/'.$domain['id'];  ?>"><?php echo $domain['website_BusinessName']; ?>
                            <span class="float-right"><?php echo $default_currency; ?><?php echo number_format(floatval ($domain['website_buynowprice']),2); ?></span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                </div><!-- /.price-body -->

                <div class="price-footer margin-top-30 text-center">
                    <a href="<?php echo base_url().'search/'.$type ?>">View More </a>
                </div><!-- /.price-footer margin-top-30 -->
                </div><!-- /.slippa-price-1 -->
                </div><!-- /.col-lg-4 col-md-6 mx-auto margin-bottom-30 wow fade-in-bottom -->

                <div class="col-lg-4 col-md-6 mx-auto margin-bottom-30 wow fade-in-bottom">
                <div class="slippa-price-1">
                <div class="price-hrader text-center margin-bottom-30">
                    <img src="<?php echo base_url() ?>assets/img/ending.png" alt="price image" draggable="false">
                    <h3 class="f-size-36  f-size-xs-32 slippa-normal"><?php echo $this->lang->line('lang_ending_header'); ?></h3>
                    <p class="slippa-light3 f-size-xs-22 section-p-content"><?php echo $this->lang->line('lang_ending_sub'); ?></p>
                </div><!-- /.price-hrader -->
                <div class="price-body padding-top-10">
                    <ul class="slippa-list">
                    <?php foreach ($endingSoon as $domain) { ?>
                    <li class="clearfix">
                        <a href="<?php echo base_url().$domain['sell_type'].'/'.$domain['sell_web'].'/'.$domain['id'];  ?>"><?php echo $domain['website_BusinessName']; ?>
                            <span class="float-right"><?php echo $default_currency; ?><?php echo number_format(floatval ($domain['website_buynowprice']),2); ?></span>
                        </a>
                    </li>
                    <?php } ?>
                    </ul>
                </div><!-- /.price-body -->
                <div class="price-footer margin-top-30 text-center">
                    <a href="<?php echo base_url().'search/'.$type ?>">View More </a>
                </div><!-- /.price-footer margin-top-30 -->
                </div><!-- /.slippa-price-1 -->
                </div><!-- /.col-lg-4 col-md-6 mx-auto margin-bottom-30 wow fade-in-bottom -->


                <div class="col-lg-4 col-md-6 mx-auto margin-bottom-30 wow fade-in-bottom">
                <div class="slippa-price-1">
                <div class="price-hrader text-center margin-bottom-30">
                    <img src="<?php echo base_url() ?>assets/img/sold.png" alt="price image" draggable="false">
                    <h3 class="f-size-36  f-size-xs-32 slippa-normal"> <?php echo $this->lang->line('lang_sold_choice'); ?></h3>
                    <p class="slippa-light3 f-size-xs-22 section-p-content"><?php echo $this->lang->line('lang_sold_choice_sub'); ?></p>
                </div><!-- /.price-hrader -->

                <div class="price-body padding-top-10">
                    <ul class="slippa-list">
                    <?php foreach ($soldDomains as $domain) { ?>
                    <li class="clearfix">
                        <a href="<?php echo base_url().$domain['listing_option'].'/'.$domain['listing_type'].'/'.$domain['id'];  ?>"><?php echo $domain['website_BusinessName']; ?>
                            <span class="float-right"><?php echo $default_currency; ?><?php echo number_format(floatval ($domain['website_buynowprice']),2); ?></span>
                        </a>
                    </li>
                    <?php } ?>
                    </ul>
                </div><!-- /.price-body -->
                <div class="price-footer margin-top-30 text-center">
                    <a href="<?php echo base_url().'search/'.$type ?>">View More </a>
                </div><!-- /.price-footer margin-top-30 -->
                </div><!-- /.slippa-price-1 -->
                </div><!-- /.col-lg-4 col-md-6 mx-auto margin-bottom-30 wow fade-in-bottom -->

            </div><!-- /.row -->
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!--/Featured Domains---->