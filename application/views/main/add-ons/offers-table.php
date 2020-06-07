
            <div class="slippa-spacer-40"></div><!-- /.slippa-spacer-40 -->
            <div class="row">
            <div class="col-12">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade-in-bottom show active" id="slippa-tab-1" role="tabpanel" aria-labelledby="slippa-tab-1-tab">

                        <div class="table-responsive">
                            <table class="table domain-table">
                                <thead>
                                    <tr class="slippa-light-gray">
                                    <th class="text-323639 slippa-strong f-size-18">Domain/Website</th>
                                    <th class="text-323639 slippa-strong f-size-18">Status</th>
                                    <th class="text-323639 slippa-strong f-size-18">Offers</th>
                                    <th class="text-323639 slippa-strong f-size-18">Views</th>
                                    <th class="text-323639 slippa-strong f-size-18">Price</th>
                                    <th class="text-323639 slippa-strong f-size-18">Added</th>
                                    <th class="text-323639 slippa-strong f-size-18">Place Offer</th>
                                    </tr>
                                </thead>

                                <?php if(!empty($offers)) { foreach ($offers as $offer) { ?>  
                                <tbody>
                                    <tr>
                                    <th class="f-size-18 f-size-md-18 slippa-semiblod text-234"><?php echo $offer['website_BusinessName'];  ?>&nbsp; <span class="badge badge-warning"><?php echo $offer['listing_type'];  ?></span></th>
                                    <?php if($offer['status'] === '1') { ?>
                                        <?php if($offer['sold_status'] === '0') { ?>
                                            <td class="f-size-18 f-size-md-18 slippa-semiblod text-success">AVAILABLE</td>
                                        <?php } else { ?>
                                            <td class="f-size-18 f-size-md-18 slippa-semiblod text-warning">SOLD</td>
                                        <?php }?>
                                    <?php } ?>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-info"><?php echo $offer['totalOffers'];  ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-605"><?php echo $offer['views'];  ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-338"><?php echo $default_currency;  ?><?php if(!empty($offer['minimumOffer'])) echo number_format($offer['minimumOffer'],2);  ?></td>
                                    <td class="f-size-18 f-size-md-18 slippa-semiblod text-dark"><?php echo $offer['ago'];  ?></td>
                                    <td class="text-center"><a href="<?php echo base_url().$offer['listing_option'].'/'.$offer['listing_type'].'/'.$offer['id'];  ?>" class="slippa-btn slippa-gradient2 slippa-sm4 pill">Place Offer</a></td>
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
					<nav class="pagination paginationOffer">
						<ul>
							<?php if(isset($links)) { echo $links; }?>
						</ul>
					</nav>
					</div>
                </div><!-- /.text-center -->
            </div><!-- /.col-12 -->
        	</div><!-- /.row -->
                   


