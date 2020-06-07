<!----------------------------------------------------------------------------------------------------------->
<!-- header -->
<header class="slippa-site-header slippa-fixed-top white-menu">
    <div class="top-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-9">
                
                <ul class="text-center text-md-left top-social">
                    <li><span><a href="<?php echo base_url() ?>contact" class="f-size-14 text-white"><img src="<?php echo base_url() ?>assets/img/top-1.png" alt="" draggable="false"> <?php echo $this->lang->line('lang_header_top_support'); ?></a></span></li>
                    <li>
                        <select id="ot-languages" class="slippa-selectactive ot-languages" name="from" style="width: 100%">
                        </select><!-- /# -->
                        <span class="select-arrwo"><i class="fas fa-angle-down"></i></span>
                    </li>

                    <?php if(!empty($settings[0]['user_facebook'])) { ?>
                        <li><a href="<?php echo $settings[0]['user_facebook']; ?>"><i class="fab fa-facebook" data-toggle="tooltip" data-placement="top" title="Facebook"></i></a></li>
                    <?php }
                    if(!empty($settings[0]['user_twitter'])) { ?> 
                        <li><a href="<?php echo $settings[0]['user_twitter']; ?>"><i class="fab fa-twitter" data-toggle="tooltip" data-placement="top" title="Twitter"></i></a></li>
                    <?php }
                    if(!empty($settings[0]['user_youtube'])) { ?>
                        <li><a href="<?php echo $settings[0]['user_youtube']; ?>"><i class="fab fa-youtube" data-toggle="tooltip" data-placement="top" title="Youtube"></i></a></li>
                    <?php }
                    if(!empty($settings[0]['user_google'])) { ?>
                        <li><a href="<?php echo $settings[0]['user_google']; ?>"><i class="fab fa-google-plus" data-toggle="tooltip" data-placement="top" title="Google Plus"></i></a></li>
                    <?php }
                    if(!empty($settings[0]['user_github'])) { ?>
                        <li><a href="<?php echo $settings[0]['user_github']; ?>"><i class="fab fa-github" data-toggle="tooltip" data-placement="top" title="Github"></i></a></li>
                    <?php }
                    if(!empty($settings[0]['user_Instagram'])) { ?>
                        <li><a href="<?php echo $settings[0]['user_Instagram']; ?>"><i class="fab fa-instagram" data-toggle="tooltip" data-placement="top" title="Instagram"></i></a></li>
                    <?php } ?>

                </ul>
            </div><!-- end top header single -->
            <div class="col-md-3 text-center text-md-right">
                <div class="slippa-nav-tolls">
                	<?php if(!isset($userdata[0]['username'] )) { ?>
                    	<span class="d-md-inline d-none margin-right-15 text-333 open-cart-opt"><a href="<?php echo base_url() ?>login"><i class="fas fa-sign-in-alt" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('lang_header_main_login'); ?>"></i></a></span>
                    	<span class="d-md-inline d-none margin-right-15 text-333 open-cart-opt"><a href="<?php echo base_url() ?>signup"> <i class="fas fa-user-plus" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('lang_header_main_signup'); ?>"></i></a></span>
                    <?php } else { ?>
                    	<?php if($userdata[0]['user_level'] !== '0' ) { ?>
                    		<span class="d-md-inline d-none margin-right-15 text-333"><a href="<?php echo base_url() ?>user"> <b><?php echo $this->lang->line('lang_header_top_welcome'); ?> </b><?php echo $userdata[0]['username']; ?></a> !</span>
                    		<span class="d-md-inline d-none margin-right-15 text-333 open-cart-opt"><a href="<?php echo base_url() ?>user/logout"><i class="fas fa-sign-out-alt" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('lang_header_main_logout'); ?>"></i></a></span>
                    	<?php } else { ?>
                    		<span class="d-md-inline d-none margin-right-15 text-333"><b><?php echo $this->lang->line('lang_header_top_welcome'); ?> </b><a href="<?php echo base_url() ?>admin"> <?php echo $userdata[0]['username']; ?></a> !</span>
                    		<span class="d-md-inline d-none margin-right-15 text-333 open-cart-opt"><a href="<?php echo base_url() ?>admin/logout"><i class="fas fa-sign-out-alt" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('lang_header_main_logout'); ?>"></i></a></span>
                    	<?php }?>
                    <?php } ?>
                </div><!-- /.slippa-nav-tolls -->
            </div><!-- end top header single -->
        </div>
    </div>
    </div> <!-- end top header -->

    <div class="main-header slippa-sticky">
    <nav class="navbar">
        <div class="container">
        <a href="<?php echo base_url(); ?>" class="brand-logo"><img src="<?php if(!empty($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt=""></a>
        <a href="<?php echo base_url(); ?>" class="sticky-logo"><img src="<?php if(!empty($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt=""></a>
        <div class="ml-auto d-flex align-items-center">
            <div class="main-menu">
                <ul>
                    <li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('lang_header_main_home'); ?></a></li>
                    <?php if(in_array('auction',array_column($options,'platform'))) { ?>
                        <li><a href="<?php echo base_url(); ?>auctions"><?php echo $this->lang->line('lang_header_main_auction'); ?></a></li>
                    <?php } ?>
                    <?php if(in_array('classified',array_column($options,'platform'))) { ?>
                        <li><a href="<?php echo base_url(); ?>offers"><?php echo $this->lang->line('lang_header_main_offer'); ?></a></li>
                    <?php } ?>

                    <?php if(in_array('website',array_column($platforms,'platform'))) { ?>
                    <li class="menu-item-has-children"><a href="#"><?php echo $this->lang->line('lang_header_main_buy_website'); ?></a>
                        <ul class="sub-menu">
                        	<?php foreach ($categoriesData as $category) { ?>
                            	<li><a href="<?php echo base_url() ?>main/category/<?php echo $category['url_slug']; ?>"><?php echo $category["c_name"] ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <li class="menu-item-has-children"><a href="#"><?php echo $this->lang->line('lang_header_main_buy'); ?></a>
                        <ul class="sub-menu">
                            <?php if(in_array('website',array_column($platforms,'platform'))) { ?>
                                <li><a href="<?php echo base_url().'websites' ?>"><?php echo $this->lang->line('lang_header_main_sub_website'); ?></a></li>
                            <?php } ?>
                            <?php if(in_array('domain',array_column($platforms,'platform'))) { ?>
                                <li><a href="<?php echo base_url().'domains' ?>"><?php echo $this->lang->line('lang_header_main_sub_domains'); ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="menu-item-has-children"><a href="#"><?php echo $this->lang->line('lang_header_main_pages'); ?></a>
                        <ul class="sub-menu">
                            <?php if(!empty($pages)) { ?>
                            <li class="menu-item-has-children"><a href="#"><?php echo $this->lang->line('lang_header_main_sub_page'); ?></a>
                                <ul class="sub-menu">
                                    <?php foreach ($pages as $page) { ?>
                                        <li><a href="<?php echo base_url().'page/'.$page['txt_page_url_slug']; ?>"><?php echo $page['txt_page_title'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php } ?>
                            <li class="menu-item-has-children"><a href="#"><?php echo $this->lang->line('lang_header_main_sub_page_2'); ?></a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo base_url() ?>login"><?php echo $this->lang->line('lang_header_main_login'); ?></a></li>
                                    <li><a href="<?php echo base_url() ?>signup"><?php echo $this->lang->line('lang_header_main_signup'); ?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li> <a href="<?php echo base_url() ?>contact"><?php echo $this->lang->line('lang_header_main_contact'); ?></a></li>
                </ul>
			</div><!-- end main menu -->


            <div class="slippa-nav-tolls d-flex align-items-center">
    			<a href="<?php echo base_url() ?>user/create_listings" class="slippa-btn slippa-gradient pill text-uppercase slippa-Bshadow-1 slippa-sm2  d-none d-md-block"><?php echo $this->lang->line('lang_header_main_start_selling'); ?>
    			</a>
    
    			<div class="mobile-menu">
        			<div class="menu-click">
            			<span></span>
            			<span></span>
            			<span></span>
        			</div>
    			</div>
			</div>
            
        </div>
        </div>

    </nav>
	</div><!-- /.bootom-header -->
</header>
<!-- header -->

<!---------------------------------------Google Analytics--------------------------------------------------->
<!-- Global site tag (gtag.js) - Google Analytics -->
<?php if(!empty($settings[0]['google_analytics'])) { 
    echo "<script async src='https://www.googletagmanager.com/gtag/js?id='".$settings[0]['google_analytics']."></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

        gtag('config', '".$settings[0]['google_analytics']."');
    </script>";
} ?>
<!-- /Global site tag (gtag.js) - Google Analytics -->

<!---------------------------PRE LOADER---------------------------------------------------------------------->
<?php if(!empty($imagesData[0]['loader'])) { ?>
<div class="slippa-preloder">
    <div class="preloder-box">
        <img src="<?php if(!empty($imagesData[0]['loader'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['loader']; ?>" alt="preloder logo" draggable="false">
    </div><!-- /.preloder-box -->
</div><!-- /.slippa-preloder -->
<?php } ?>
<!----------------------------------------------------------------------------------------------------------->