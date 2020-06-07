			<!-- Footer -->
			<div class="dashboard-footer-spacer"></div>
			<div class="small-footer margin-top-15">
				<div class="small-footer-copyrights">
					&copy; <?php echo date('Y');?><strong><a href="<?php echo base_url();?>" target="_blank"><?php echo $this->lang->line('site_name'); ?> </a></strong> | Powered By<a href="https://www.onlinetoolhub.com" target="_blank"> Onlinetoolhub</a>.
				</div>
				<ul class="footer-social-links">
					<?php if(!empty($settings[0]['user_facebook'])) { ?>
					<li>
						<a href="<?php echo $settings[0]['user_facebook']; ?>" title="Facebook" data-tippy-placement="bottom" data-tippy-theme="light">
						<i class="icon-brand-facebook-f"></i>
						</a>
					</li>
					<?php } 
					if(!empty($settings[0]['user_twitter'])) { ?>
					<li>
						<a href="<?php echo $settings[0]['user_twitter']; ?>" title="Twitter" data-tippy-placement="bottom" data-tippy-theme="light">
						<i class="icon-brand-twitter"></i>
						</a>
					</li>
					<?php }
					if(!empty($settings[0]['user_Instagram'])) { ?> 
					<li>
						<a href="<?php echo $settings[0]['user_Instagram']; ?>" title="Instagram" data-tippy-placement="bottom" data-tippy-theme="light">
						<i class="icon-brand-instagram"></i>
						</a>
					</li>
					<?php }
					if(!empty($settings[0]['user_github'])) { ?> 
					<li>
						<a href="<?php echo $settings[0]['user_github']; ?>" title="Github" data-tippy-placement="bottom" data-tippy-theme="light">
						<i class="icon-brand-github"></i>
						</a>
					</li>
					<?php }
					if(!empty($settings[0]['user_google'])) { ?> 
					<li>
						<a href="<?php echo $settings[0]['user_google']; ?>" title="Google Plus" data-tippy-placement="bottom" data-tippy-theme="light">
						<i class="icon-brand-google-plus-g"></i>
						</a>
					</li>
					<?php } ?>
				</ul>
				<div class="clearfix"></div>
			</div>
			<!-- Footer / End -->