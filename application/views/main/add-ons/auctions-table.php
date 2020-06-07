
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
                </div>
            </div><!-- /.col-12 -->
        	</div><!-- ./row -->

        	<div class="slippa-spacer-60 slippa-spacer-xs-40"></div><!-- /.slippa-spacer-60 -->
        	<div class="row">
            <div class="col-12">
                <div class="text-center">
                    <div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
					<nav class="pagination paginationAuction">
						<ul>
							<?php if(isset($links)) { echo $links; }?>
						</ul>
					</nav>
					</div>
                </div><!-- /.text-center -->
            </div><!-- /.col-12 -->
        	</div><!-- /.row -->
                   


