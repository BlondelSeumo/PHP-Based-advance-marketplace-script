<?php if(!empty($auctions)) { ?>
<div class="section margin-top-2">
	<div class="container">
        
        <!---Section Title--->
        <div class="row">
            <div class="col-xl-12 col-lg-10 mx-auto text-center wow fade-in-bottom" data-wow-duration="1s">
                <h2 class="slippa-section-title dark">
                    <?php echo $this->lang->line('lang_auction_title'); ?>
                </h2>
                <p class="slippa-mb-0 slippa-light3 line-height-34 section-paragraph">
                    <?php echo $this->lang->line('lang_auction_title_sub'); ?>
                </p>
            </div><!-- /.col-xl-7 col-lg-10 mx-auto text-center wow fade-in-bottom -->
        </div><!-- /.row -->
        <!-----Section Title--->

		<div class="row">
			<div class="col-xl-12">
        
            <div class="slippa-spacer-60"></div><!-- /.slippa-spacer-60 -->

            <div class="row">
            <div class="col-lg-8 mx-auto">
                <ul class="nav tbanavs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="slippa-tab-1-tab" data-toggle="tab" href="#slippa-tab-1" role="tab"
                            aria-controls="slippa-tab-1" aria-selected="true"><?php echo $this->lang->line('lang_filter_auctions'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="slippa-tab-2-tab" data-toggle="tab" href="#slippa-tab-2" role="tab"
                            aria-controls="slippa-tab-2" aria-selected="false"><?php echo $this->lang->line('lang_filter_ending_soon'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="slippa-tab-3-tab" data-toggle="tab" href="#slippa-tab-3" role="tab"
                            aria-controls="slippa-tab-3" aria-selected="false"><?php echo $this->lang->line('lang_filter_sold_auctions'); ?></a>
                    </li>
                </ul>
            </div><!-- /.col-lg-8 -->
            </div><!-- /.row -->

            <div class="slippa-spacer-40"></div><!-- /.slippa-spacer-40 -->
            <div class="row">
            <div class="col-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade-in-bottom show active" id="slippa-tab-1" role="tabpanel" aria-labelledby="slippa-tab-1-tab">

                        <div class="table-responsive">
                            <table class="table domain-table">
                                <thead>
                                    <tr class="slippa-light-gray">
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_1'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_2'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_3'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_4'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_5'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_6'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_7'); ?></th>
                                    </tr>
                                </thead>

                                <?php if(!empty($auctions)) { foreach ($auctions as $auction) { ?>  
                                <tbody>
                                    <tr>
                                    <th class="f-size-18 f-size-md-18 slippa-semiblod text-234"><?php echo $auction['website_BusinessName'];  ?>&nbsp; <span class="badge badge-warning"><?php echo $auction['listing_type'];  ?></span></th>
                                    <?php if($auction['status'] === '1') { ?>
                                        <?php if($auction['auctionstatus'] !== 'invalid') { ?>
                                            <?php if($auction['sold_status'] === '0') { ?>
                                                <td class="f-size-18 f-size-md-18 slippa-semiblod text-success"><?php echo $this->lang->line('lang_active'); ?></td>
                                            <?php } else { ?>
                                                <td class="f-size-18 f-size-md-18 slippa-semiblod text-danger"><?php echo $this->lang->line('lang_sold'); ?></td>
                                            <?php }?>
                                        <?php } else { ?>
                                            <td class="f-size-18 f-size-md-18 slippa-semiblod text-warning"><?php echo $this->lang->line('lang_expired'); ?></td>
                                        <?php }?>
                                    <?php } ?>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-info"><?php echo $auction['totalBids'];  ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-605"><?php echo $auction['views'];  ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-338"><?php echo $default_currency;  ?><?php if(!empty($offer['highestbid'])) echo number_format($auction['highestbid'],2); else { if(!empty($auction['website_startingprice'])) echo number_format($auction['website_startingprice'],2); } ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-dark"><?php echo $auction['endingdays'];  ?> days <?php echo $auction['endinghours'];  ?> hours</td>
                                    <td class="text-center"><a href="<?php echo base_url().$auction['listing_option'].'/'.$auction['listing_type'].'/'.$auction['id'];  ?>" class="slippa-btn slippa-gradient2 slippa-sm4 pill">Place Bid</a></td>
                                    </tr>
                                </tbody>
                                <?php } } ?>
                            </table>
                        </div><!-- /.table-responsive -->
                    </div>

                    <div class="tab-pane fade-in-bottom" id="slippa-tab-2" role="tabpanel" aria-labelledby="slippa-tab-2-tab">
                        <div class="table-responsive">
                            <table class="table domain-table">
        
                                <thead>
                                    <tr class="slippa-light-gray">
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_1'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_2'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_3'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_4'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_5'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_6'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_7'); ?></th>
                                    </tr>
                                </thead>

                                <?php if(!empty($ending)) { foreach ($ending as $auction) { ?>  
                                <tbody>
                                    <tr>
                                    <th class="f-size-18 f-size-md-18 slippa-semiblod text-234"><?php echo $auction['website_BusinessName'];  ?>&nbsp; <span class="badge badge-warning"><?php echo $auction['listing_type'];  ?></span></th>
                                    <?php if($auction['status'] === '1') { ?>
                                        <?php if($auction['auctionstatus'] !== 'invalid') { ?>
                                            <?php if($auction['sold_status'] === '0') { ?>
                                                <td class="f-size-18 f-size-md-18 slippa-semiblod text-success"><?php echo $this->lang->line('lang_active'); ?></td>
                                            <?php } else { ?>
                                                <td class="f-size-18 f-size-md-18 slippa-semiblod text-danger"><?php echo $this->lang->line('lang_sold'); ?></td>
                                            <?php }?>
                                        <?php } else { ?>
                                            <td class="f-size-18 f-size-md-18 slippa-semiblod text-warning"><?php echo $this->lang->line('lang_expired'); ?></td>
                                        <?php }?>
                                    <?php } ?>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-info"><?php echo $auction['totalBids'];  ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-605"><?php echo $auction['views'];  ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-338"><?php echo $default_currency;  ?><?php if(!empty($offer['highestbid'])) echo number_format($auction['highestbid'],2); else { if(!empty($auction['website_startingprice'])) echo number_format($auction['website_startingprice'],2); } ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-dark"><?php echo $auction['endingdays'];  ?> days <?php echo $auction['endinghours'];  ?> hours</td>
                                    <td class="text-center"><a href="<?php echo base_url().$auction['listing_option'].'/'.$auction['listing_type'].'/'.$auction['id'];  ?>" class="slippa-btn slippa-gradient2 slippa-sm4 pill">Place Bid</a></td>
                                    </tr>
                                </tbody>
                                <?php } } ?>
                            </table>
                        </div>
                    </div><!-- /.table-responsive -->

                   <div class="tab-pane fade-in-bottom" id="slippa-tab-3" role="tabpanel" aria-labelledby="slippa-tab-3-tab">
                         <div class="table-responsive">
                            <table class="table domain-table">
                                <thead>
                                    <tr class="slippa-light-gray">
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_1'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_2'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_3'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_4'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_5'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_6'); ?></th>
                                    <th class="text-323639 slippa-strong f-size-18"><?php echo $this->lang->line('lang_auction_table_header_7'); ?></th>
                                    </tr>
                                </thead>

                                <?php if(!empty($sold)) { foreach ($sold as $auction) { ?>  
                                <tbody>
                                    <tr>
                                    <th class="f-size-18 f-size-md-18 slippa-semiblod text-234"><?php echo $auction['website_BusinessName'];  ?>&nbsp; <span class="badge badge-warning"><?php echo $auction['listing_type'];  ?></span></th>
                                    <?php if($auction['status'] === '1') { ?>
                                        <?php if($auction['auctionstatus'] !== 'invalid') { ?>
                                            <?php if($auction['sold_status'] === '0') { ?>
                                                <td class="f-size-18 f-size-md-18 slippa-semiblod text-success"><?php echo $this->lang->line('lang_active'); ?></td>
                                            <?php } else { ?>
                                                <td class="f-size-18 f-size-md-18 slippa-semiblod text-danger"><?php echo $this->lang->line('lang_sold'); ?></td>
                                            <?php }?>
                                        <?php } else { ?>
                                            <td class="f-size-18 f-size-md-18 slippa-semiblod text-warning"><?php echo $this->lang->line('lang_expired'); ?></td>
                                        <?php }?>
                                    <?php } ?>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-info"><?php echo $auction['totalBids'];  ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-605"><?php echo $auction['views'];  ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-338"><?php echo $default_currency;  ?><?php if(!empty($offer['highestbid'])) echo number_format($auction['highestbid'],2); else { if(!empty($auction['website_startingprice'])) echo number_format($auction['website_startingprice'],2); } ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-dark"><?php echo $auction['endingdays'];  ?> days <?php echo $auction['endinghours'];  ?> hours</td>
                                    <td class="text-center"><a href="<?php echo base_url().$auction['listing_option'].'/'.$auction['listing_type'].'/'.$auction['id'];  ?>" class="slippa-btn slippa-gradient2 slippa-sm4 pill">Place Bid</a></td>
                                    </tr>
                                </tbody>
                                <?php } }?>
                            </table>
                        </div>
                    </div><!-- /.table-responsive -->
                </div>
                
            </div><!-- /.col-12 -->
        </div><!-- ./row -->
        <div class="slippa-spacer-60 slippa-spacer-xs-40"></div><!-- /.slippa-spacer-60 -->
            <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <a href="<?php echo base_url() ?>main/auctions" class="slippa-btn slippa-outline-gray text-uppercase pill"> <i class="icofont-refresh slippa-mr-5"></i> <?php echo $this->lang->line('lang_btn_view_all'); ?></a>
                </div><!-- /.text-center -->
            </div><!-- /.col-12 -->
            </div><!-- /.row -->
    </div>
</div>
</div>
</div>
<?php } ?>