<!-- Recent Blog Posts -->
<div class="section white padding-top-0 padding-bottom-60 full-width-carousel-fix">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="blog-carousel">
					<?php foreach ($featuredPosts as $post) { ?>
					<a href="<?php echo base_url().'blog_post/'.$post['slug'] ?>" class="blog-compact-item-container">
						<div class="blog-compact-item">
							<img src="<?php if(isset($post['thumbnail'])) echo base_url().BLOG_UPLOAD.$post['thumbnail']; ?>" alt="">
							<?php if(isset($ownerData[0]['username'])) { ?>
								<span class="blog-item-tag"><?php if(isset($ownerData[0]['username'])) echo $ownerData[0]['username']; ?></span>
							<?php } ?>
							<div class="blog-compact-item-content">
								<ul class="blog-post-tags">
									<li><?php if(isset($post['date'])) echo date('F d Y',strtotime($post['date'])); ?></li>
								</ul>
								<h3><?php if(isset($post['title'])) echo $post['title']; ?></h3>
								<p><?php if(isset($post['metadescription'])) echo substr($post['metadescription'], 0,45); ?></p>
							</div>
						</div>
					</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Recent Blog Posts / End -->