<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta Tags--->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="author" content="onlinetoolhub.com">
<meta name="keywords" content="<?php if(isset($page[0]['site_pricing_blog_keywords'])) echo $page[0]['site_pricing_blog_keywords']; ?>"/>
<meta name="description" content="<?php if(isset($page[0]['site_pricing_blog_description'])) echo $page[0]['site_pricing_blog_description']; ?>"/>
<meta name="copyright"content="onlinetoolhub">
<meta name="robots" content="index,follow" />
<meta name="url" content="<?php echo base_url(); ?>">
<title><?php echo $this->lang->line('site_blog_title') ; ?> | <?php echo $this->lang->line('site_name') ; ?> </title>
<meta name="og:title" content="<?php echo $this->lang->line('site_blog_title') ; ?> | <?php echo $this->lang->line('site_name') ; ?>"/>
<meta name="og:url" content="<?php echo current_url(); ?>"/>
<meta name="og:image" content="<?php if(isset($imagesData[0]['sitelogo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['sitelogo']; ?>" alt="thumbnail" />
<meta name="og:site_name" content="<?php echo $this->lang->line('site_blog_title') ; ?> | <?php echo $this->lang->line('site_name') ; ?>"/>
<meta name="og:description" content="<?php if(isset($page[0]['site_pricing_blog_description'])) echo $page[0]['site_pricing_blog_description']; ?>"/>
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

<!-- Content-->
<!---top section---->
<div class="slippa-breadcump slippa-breadcump-height breaducump-style-2">
    <div class="slippa-page-bg rtbgprefix-full" style="background-image: url(<?php if(!empty($imagesData[0]['homepage'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['homepage']; ?>);">
    </div>
    <!-- /.slippa-page-bg -->
    <div class="container">
        <div class="row slippa-breadcump-height align-items-center">
            <div class="col-lg-12 mx-auto text-center text-white">
                <h4 class="f-size-70 f-size-lg-50 f-size-md-40 f-size-xs-24 slippa-strong">Blog</h4>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.slippa-bredcump -->
<!---/top section---->

<!---- Featured Blog Post ---->
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/add-ons/featured-blog-posts'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<!---- /Featured Blog Post ---->

<!-- ad-section -->	
<!--------------------------------------------------------------------------------------------------------------->
<?php if(!empty($ads[0]['blog_page_720x90'])) { ?>					
<div class="ad-section text-center margin-bottom-25">
	<?php print_r($ads[0]['blog_page_720x90']); ?>
</div>
<?php } ?>
<!--------------------------------------------------------------------------------------------------------------->
<!-- ad-section / End-->

<!-- Section -->
<div class="section gray">
	<div class="container">
		<div class="row">

			<div id="recent-posts" class="col-xl-8 col-lg-8">

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

			<div class="col-xl-4 col-lg-4 content-left-offset">

				<!-- ad-section -->	
				<!--------------------------------------------------------------------------------------------------------------->
				<?php if(!empty($ads[0]['blog_300x250'])) { ?>					
				<div class="ad-section text-center margin-bottom-25">
					<?php print_r($ads[0]['blog_300x250']); ?>
				</div>
				<?php } ?>
				<!--------------------------------------------------------------------------------------------------------------->
				<!-- ad-section / End-->

				<div class="sidebar-container margin-top-65">
					
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

					<!-- Widget -->
					<div class="sidebar-widget">
						
					</div>

				</div>
			</div>

		</div>
	</div>
</div>

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