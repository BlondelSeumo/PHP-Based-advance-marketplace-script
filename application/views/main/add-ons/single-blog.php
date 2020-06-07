		<!-- Blog Posts Slider ------>	
			<div>
				<!-- Section Headline -->
				<div class="section-headline margin-top-60 margin-bottom-35">
					<h4>Recent Posts</h4>
				</div>

				<?php foreach ($blogs as $post) { ?>
				<!-- Blog Post -->
				<a href="<?php echo base_url().'blog_post/'.$post['slug'] ?>" class="blog-post">
					<!-- Blog Post Thumbnail -->
					<div class="blog-post-thumbnail">
						<div class="blog-post-thumbnail-inner">
							<span class="blog-item-tag"><?php if(isset($ownerData[0]['username'])) echo $ownerData[0]['username']; ?></span>
							<img src="<?php if(isset($post['thumbnail'])) echo base_url().BLOG_UPLOAD.$post['thumbnail']; ?>" alt="">
						</div>
					</div>
					<!-- Blog Post Content -->
					<div class="blog-post-content">
						<span class="blog-post-date"><?php if(isset($post['date'])) echo date('F d Y',strtotime($post['date'])); ?></span>
						<h3><?php if(isset($post['title'])) echo $post['title']; ?></h3>
						<p><?php if(isset($post['metadescription'])) echo substr($post['metadescription'], 0,75); ?></p>
					</div>
					<!-- Icon -->
					<div class="entry-icon"></div>
				</a>
				<?php } ?>

				<!-- Pagination -->
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12">
						<!-- Pagination -->
						<div class="pagination-container margin-top-40 margin-bottom-10 centerButtons">
						<nav class="pagination paginationBlog">
							<ul>
								<?php if(!empty($links)) if(isset($links)) { echo $links; }?>
							</ul>
						</nav>
						</div>
						<div class="clearfix"></div>
						<!-- Pagination / End -->
					</div>
				</div>
				<!-- Pagination / End -->

			</div>
		<!-- /Blog Posts Slider ------>	