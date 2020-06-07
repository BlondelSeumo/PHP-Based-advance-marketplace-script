<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta Tags--->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="author" content="onlinetoolhub.com">
<meta name="keywords" content="<?php if(!empty($blog[0]['metakeywords'])) echo implode(',', json_decode(html_entity_decode($blog[0]['metakeywords']),true)); ?>"/>
<meta name="description" content="<?php if(isset($blog[0]['metadescription'])) echo $blog[0]['metadescription']; ?>"/>
<meta name="copyright"content="onlinetoolhub">
<meta name="robots" content="index,follow" />
<meta name="url" content="<?php echo base_url(); ?>">
<title><?php if(isset($blog[0]['title'])) echo $blog[0]['title']; ?> | <?php echo $this->lang->line('site_name') ; ?> </title>
<meta name="og:title" content="<?php if(isset($blog[0]['title'])) echo $blog[0]['title']; ?> | <?php echo $this->lang->line('site_name') ; ?>"/>
<meta name="og:url" content="<?php echo current_url(); ?>"/>
<meta name="og:image" content="<?php if(isset($blog[0]['thumbnail'])) echo base_url().BLOG_UPLOAD.$blog[0]['thumbnail']; ?>" alt="thumbnail" />
<meta name="og:site_name" content="<?php if(isset($blog[0]['title'])) echo $blog[0]['title']; ?>| <?php echo $this->lang->line('site_name') ; ?> "/>
<meta name="og:description" content="<?php if(isset($blog[0]['metadescription'])) echo $blog[0]['metadescription']; ?>"/>
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<!--- --->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/headerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->
</head>
<body>

<!-- Wrapper -->
<div id="wrapper">

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/header'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<div class="clearfix"></div>
<!-- Header Container / End -->

<!---top section---->
<div class="slippa-breadcump slippa-breadcump-height breaducump-style-2">
    <div class="slippa-page-bg rtbgprefix-full" style="background-image: url(<?php if(!empty($imagesData[0]['homepage'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['homepage']; ?>);">
    </div>
    <!-- /.slippa-page-bg -->
    <div class="container">
        <div class="row slippa-breadcump-height align-items-center">
            <div class="col-lg-12 mx-auto text-center text-white">
                <h4 class="f-size-70 f-size-lg-50 f-size-md-40 f-size-xs-24 slippa-strong"><?php if(isset($blog[0]['title'])) echo $blog[0]['title']; ?></h4>
                <h4 class="f-size-36 f-size-lg-30 f-size-md-24 f-size-xs-16 slippa-light3">by : <?php if(isset($ownerData[0]['username'])) echo $ownerData[0]['username']; ?></h4>
                
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.slippa-bredcump -->
<!---/top section---->

<!-- Post Content -->
<div class="container">
	<div class="row">
		
		<!-- Inner Content -->
		<div class="col-xl-8 col-lg-8">
			<!-- Blog Post -->
			<div class="blog-post single-post">

				<!-- Blog Post Thumbnail -->
				<div class="blog-post-thumbnail">
					<div class="blog-post-thumbnail-inner">
						<span class="blog-item-tag">POST</span>
						<img src="<?php if(isset($blog[0]['thumbnail'])) echo base_url().BLOG_UPLOAD.$blog[0]['thumbnail']; ?>" alt="">
					</div>
				</div>

				<!-- Blog Post Content -->
				<div class="blog-post-content">
					<h3 class="margin-bottom-10"><?php if(isset($blog[0]['title'])) echo $blog[0]['title']; ?></h3>

					<div class="blog-post-info-list margin-bottom-20">
						<a href="#" class="blog-post-info"><?php if(isset($blog[0]['date'])) echo date('F d Y',strtotime($blog[0]['date'])); ?></a>
						<a href="#"  class="blog-post-info"><?php if(isset($blog[0]['views'])) echo $blog[0]['views']; ?> Views</a>
					</div>

					<?php if(isset($blog[0]['blog_post'])) if(DECODE_DESCRIPTIONS) echo html_entity_decode($blog[0]['blog_post']);  else echo ($blog[0]['blog_post']); ?>

					<!-- Share Buttons -->
					<div class="share-buttons margin-top-25">
						<div class="share-buttons-trigger"><i class="icon-feather-share-2"></i></div>
						<div class="share-buttons-content">
							<span>Interesting? <strong>Share It!</strong></span>
							<ul class="share-buttons-icons">
								<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url(); ?>" data-button-color="#3b5998" title="Share on Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a></li>
								<li><a href="https://twitter.com/intent/tweet?text=<?php echo current_url(); ?>" data-button-color="#1da1f2" title="Share on Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
								<li><a href="#" data-button-color="#dd4b39" title="Share on Google Plus" data-tippy-placement="top"><i class="icon-brand-google-plus-g"></i></a></li>
								<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source=<?php echo current_url(); ?>" data-button-color="#0077b5" title="Share on LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
			<!-- Blog Post Content / End -->
			
			<!-- Blog Nav -->
			<ul id="posts-nav" class="margin-top-0 margin-bottom-40">
				<li class="next-post">
					<a href="#">
						<span>Next Post</span>
						<strong><?php if(isset($nextPost[0]['title'])) echo $nextPost[0]['title'];  ?></strong>
					</a>
				</li>
				<li class="prev-post">
					<a href="#">
						<span>Previous Post</span>
						<strong><?php if(isset($prevPost[0]['title'])) echo $prevPost[0]['title'];  ?></strong>
					</a>
				</li>
				<input type="hidden" name="current_id" id="current_id" value="<?php if(isset($blog[0]['id'])) echo $blog[0]['id'];  ?>">
			</ul>
			
			<!-- Related Posts -->
			<div class="row">
				
			<!-- ad-section -->	
			<!--------------------------------------------------------------------------------------------------------------->
			<?php if(!empty($ads[0]['blog__post_page_720x90'])) { ?>					
			<div class="ad-section text-center margin-bottom-25">
				<?php print_r($ads[0]['blog__post_page_720x90']); ?>
			</div>
			<?php } ?>
			<!--------------------------------------------------------------------------------------------------------------->
			<!-- ad-section / End-->

			</div>
			<!-- Related Posts / End -->
				

			<!-- Comments -->
			<div class="boxed-list margin-bottom-60">
				<?php if(!empty($this->session->userdata('user_id'))) { ?>
					<div class="boxed-list-headline">
						<h3><i class="fa fa-comments"></i> Comments</h3>
					</div>

					<div id="commentsSection"></div>
					<!--------------------------------------------------------------------------------------------------------------->
					<?php $this->load->view('main/add-ons/comments'); ?>
					<!--------------------------------------------------------------------------------------------------------------->
					<?php } else { ?>
					<div class="boxed-list-headline">
						<h3><i class="icon-material-outline-lock"></i> Please <a href="<?php echo base_url().'login' ?>">login</a> to View Comments</h3>
					</div>	
				<?php }?>
			</div>
			<!-- Comments / End -->

		</div>
		<!-- Inner Content / End -->


		<div class="col-xl-4 col-lg-4 content-left-offset">

			<!-- ad-section -->	
			<!--------------------------------------------------------------------------------------------------------------->
			<?php if(!empty($ads[0]['blog__post_page_300x250'])) { ?>					
			<div class="ad-section text-center margin-bottom-25">
				<?php print_r($ads[0]['blog__post_page_300x250']); ?>
			</div>
			<?php } ?>
			<!--------------------------------------------------------------------------------------------------------------->
			<!-- ad-section / End-->

			<div class="sidebar-container">
				
				<!-- Location -->
				<div class="sidebar-widget margin-bottom-40">
					<div class="input-with-icon">
						<input id="autocomplete-input" type="text" placeholder="Search">
						<i class="icon-material-outline-search"></i>
					</div>
				</div>

				<!-- Widget -->
				<div class="sidebar-widget">
					<h3>Trending Posts</h3>
					<ul class="widget-tabs">
						<?php foreach ($trendingPosts as $post) { ?>
						<!-- Post #1 -->
						<li>
							<a href="<?php echo base_url().'blog_post/'.$post['slug'] ?>" class="widget-content active">
								<img src="<?php if(isset($post['thumbnail'])) echo base_url().BLOG_UPLOAD.$post['thumbnail']; ?>" alt="">
								<div class="widget-text">
									<h5><?php if(isset($post['title'])) echo $post['title']; ?></h5>
									<span><?php if(isset($post['date'])) echo date('F d Y',strtotime($post['date'])); ?></span>
								</div>
							</a>
						</li>
						<?php } ?>
					</ul>
				</div>
				<!-- Widget / End-->

				<?php if(!empty($blog[0]['blog_tags'])) { ?>
				<!-- Tags Widget -->
				<div class="sidebar-widget">
					<h3>Tags</h3>
					<div class="task-tags">
						<?php foreach (json_decode(html_entity_decode($blog[0]['blog_tags']),true) as $key) { ?>
							<a href="#"><span><?php echo $key; ?></span></a>
						<?php } ?>
					</div>
				</div>
				<?php } ?>

			</div>
		</div>

	</div>
</div>

<!-- Spacer -->
<div class="padding-top-40"></div>
<!-- Spacer -->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footer'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</div>
<!-- Wrapper / End -->
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>