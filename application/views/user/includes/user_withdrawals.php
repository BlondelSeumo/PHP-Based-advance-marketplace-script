          <div class="dashboard-box margin-top-20">
						<!-- Headline -->
						<div class="headline">
							<h3><i class="mdi mdi-currency-usd"></i> Withdrawal History</h3>
						</div>

						<div class="content  with-padding padding-bottom-0">
							<!--- row ------>
							<div class="row">
								<div class="col-xl-12">
              						<div class="withdraw-alert alert alert-info">
                						<img class="my-alert__icon" src="./images/icon-alert.svg" alt>
                						<span class="my-alert__text">
                  							Your latest transaction may take a few minutes to show up in your activity.
                						</span>
              						</div>

              					<!-- Begin Pending card -->
              					<div class="withdraw-card card">
                					<div class="withdraw-card__header card-header">
                  						<h3 class="withdraw-card__header-title card-title">Current Withdrawals</h3>
                  							<a class="withdraw-card__header-link" href="#">See all →</a>
                					</div>

                					<?php foreach ($withdrawals as $withdrawal) { ?>
   
                					<ul class="withdraw-list list-group list-group-flush">
                						<!----Item ----->
                  						<li class="withdraw-list-item list-group-item">
                                <div class="withdraw-list-item__date">
                                    <span class="withdraw-list-item__date-day"><?php if(isset($withdrawal['updated'])) echo date("d", strtotime($withdrawal['updated'])); ?></span>
                                    <span class="withdraw-list-item__date-month"><b><?php if(isset($withdrawal['updated'])) echo date("M", strtotime($withdrawal['updated'])); ?></b></span>
                                </div>

                                <div class="withdraw-list-item__text">
                                    <h4 class="withdraw-list-item__text-title"><b>#<?php if(isset($withdrawal['withdrawal_id'])) echo $withdrawal['withdrawal_id'] ; ?> </b></h4>
                                    <p class="withdraw-list-item__text-description">Withdraw to <?php if(isset($withdrawal['w_method'])) echo $withdrawal['w_method']; ?></p>
                                </div>

                                <div class="withdraw-list-item__fee">
                                    <span class="withdraw-list-item__fee-delta">-<?php if(isset($withdrawal['updated'])) echo number_format(floatval($withdrawal['final_amount'])); ?></span>
                                    <span class="withdraw-list-item__fee-currency">USD</span>
                                    <?php if($withdrawal['status'] === '0') {?>
                                      <span class="badge badge-warning">Pending</span>
                                    <?php } else if($withdrawal['status'] === '2') { ?>
                                      <span class="badge badge-success">Paid</span>
                                    <?php } else if($withdrawal['status'] === '3') { ?>
                                      <span class="badge badge-danger">Rejected</span>
                                    <?php } ?>
                                </div>
                  
                              </li>
                  						<!----/Item ----->
                					</ul>
                					<?php } ?>
              					</div>
              					<!-- End Pending card -->
            					</div>
							</div>
							<!---/row --->
						</div>
            <!-- Pagination -->
            <div class="clearfix"></div>
            <div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
              <nav class="pagination paginationWithdrawals">
                <ul>
                  <?php if(isset($links)) { echo $links; }?>
                </ul>
              </nav>
            </div>
            <div class="clearfix"></div>
            <!-- Pagination / End -->
					</div>