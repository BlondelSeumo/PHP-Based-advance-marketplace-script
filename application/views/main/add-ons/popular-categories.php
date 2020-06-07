<!-- Category Boxes  -->
<div class="section margin-top-5">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">

                <!---Section Title--->
				<div class="row">
    				<div class="col-xl-12 col-lg-10 mx-auto text-center wow fade-in-bottom" data-wow-duration="1s">
        				<h2 class="slippa-section-title dark">
            				<?php echo $this->lang->line('lang_categories_title'); ?>
        				</h2>
        				<p class="slippa-mb-0 slippa-light3 line-height-34 section-paragraph">
            				<?php echo $this->lang->line('lang_categories_title_sub'); ?>
        				</p>
    				</div><!-- /.col-xl-7 col-lg-10 mx-auto text-center wow fade-in-bottom -->
				</div><!-- /.row -->
				<!-----Section Title--->

				<!-- Category Boxes Container -->
				<div class="categories-container">
					<?php $i=0; foreach ($categoriesData as $category) { ?>
					<!-- Category Box -->
					<a href="<?php echo base_url() ?>main/category/<?php echo $category['url_slug']; ?>" class="category-box slippa-category-box">
						<div class="category-box-icon domian-bg-color color--<?php echo $i; ?> text-center f-size-28"><img src="<?php echo base_url().CATEGORY_IMAGES.'/'.$category["c_thumb"] ?>" alt="images" class="img-responsive"></div>
						<div class="category-box-counter"><?php echo $category["count"] ?></div>
						<div class="category-box-content">
							<h3><?php echo $category["c_name"] ?></h3>
							<p><?php echo $category["c_description"] ?></p>
						</div>
					</a>
					<?php $i++; } ?>	
				</div>
				<!-- /Category Boxes Container -->

			</div>
			
		</div>
	</div>
</div>
<!-- Category Boxes / End -->