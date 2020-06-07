			<!----User Review ------>
			<div class="boxed-list margin-bottom-60">
				<div class="boxed-list-headline">
					<h3><i class="icon-material-outline-thumb-up"></i> User Reviews</h3>
				</div>
				<ul class="boxed-list-ul">
					<?php if(!empty($profileRatings)) { foreach ($profileRatings as $review) { ?>

					<!----User Review ------>
					<li>
						<div class="boxed-list-item">
							<div class="review-avatar">
								<a href="<?php echo base_url().'user_profile/'.$review['user_id']; ?>"><img src="<?php if(isset($review['thumbnail'])) echo base_url().USER_UPLOAD.$review['thumbnail']; ?>" alt=""></a>
							</div>
							<!-- Content -->
							<div class="item-content">

								<h4><a href="<?php echo base_url().'user_profile/'.$review['user_id']; ?>"><?php if(isset($review['username'])) echo $review['firstname'].' '.$review['lastname']; ?> <span><?php if(isset($review['username'])) echo '@'.$review['username']; ?></span></a></h4>
								<div class="item-details margin-top-10">
									<div class="star-rating" data-rating="<?php if(isset($review['ratings'])) echo number_format($review['ratings'],1); ?>"></div>
									<div class="detail-item"><i class="icon-material-outline-date-range"></i> August 2018</div>
								</div>
								<div class="item-description">
									<p><?php if(isset($review['review'])) echo $review['review']; ?> </p>
								</div>
							</div>
						</div>
					</li>
					<!----/Ends User Review ------>
					<?php } } ?>

				</ul>

				<!-- Pagination -->
				<div class="clearfix"></div>
				<div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
					<nav class="pagination paginationReviews">
						<ul>
							<?php if(isset($links)) { echo $links; }?>
						</ul>
					</nav>
				</div>
				<div class="clearfix"></div>
				<!-- Pagination / End -->

			</div>
			<!----/Ends User Reviews ------>