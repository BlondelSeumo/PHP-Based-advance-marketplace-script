	<!-- Dashboard Sidebar -->
	<div class="dashboard-sidebar">
		<div class="dashboard-sidebar-inner" data-simplebar>
			<div class="dashboard-nav-container">

				<!-- Responsive Navigation Trigger -->
				<a href="#" class="dashboard-responsive-nav-trigger">
					<span class="hamburger hamburger--collapse" >
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</span>
					<span class="trigger-title">Dashboard Navigation</span>
				</a>
				
				<!-- Navigation -->
				<div class="dashboard-nav">
					<div class="dashboard-nav-inner">

						<a class="navbar-brand brand-logo-mini text-center" href="<?php echo base_url().'user' ?>">
          					<img src="<?php if(isset($imagesData[0]['invoice_logo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['invoice_logo']; ?>" alt="logo" />
        				</a>

						<ul data-submenu-title="Start">
							<li><a href="<?php echo site_url('user/dashboard'); ?>"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
							<li><a href="<?php echo site_url('chat'); ?>"><i class="icon-material-outline-question-answer"></i> Messages <span class="nav-tag"><?php echo $messageCount; ?></span></a></li>
						</ul>
						
						<ul data-submenu-title="Organize and Manage">
							<li><a href="#"><i class="icon-material-outline-business-center"></i> Listings</a>
								<ul>
									<li><a href="<?php echo site_url('user/create_listings'); ?>">Post a Listing</a></li>
									<?php if(in_array('auction',array_column($options,'platform'))) { ?>
									<li><a href="<?php echo site_url('user/manage_listings'); ?>">Manage Auctions<span class="nav-tag"><?php echo $listingCount; ?></span></a></li>
									<?php } ?>
									<?php if(in_array('classified',array_column($options,'platform'))) { ?>
									<li><a href="<?php echo site_url('user/manage_offers'); ?>">Manage Offers<span class="nav-tag"><?php echo $listingOfferCount; ?></span></a></li>
									<?php } ?>
								</ul>	
							</li>
							<li class="active-submenu"><a href="#"><i class="mdi mdi-gavel"></i> Bids & Offers</a>
								<ul>
									<?php if(in_array('auction',array_column($options,'platform'))) { ?>
									<li><a href="<?php echo site_url('user/pending_bids'); ?>">My Active Bids</a></li>
									<?php } ?>
									<?php if(in_array('classified',array_column($options,'platform'))) { ?>
									<li><a href="<?php echo site_url('user/pending_offers'); ?>">My Active Offers</a></li>
									<?php } ?>
								</ul>	
							</li>

							<li><a href="#"><i class="icon-material-outline-assignment"></i> Open Contracts <span class="nav-tag"><?php echo count($openContracts); ?></span></a>
								<ul>
									<?php foreach ($openContracts as $contract) { ?>
										<li><a href="<?php echo site_url('user/contract/'.$contract['contract_id']); ?>">Contract - #<?php echo $contract['contract_id']; ?> </a></li>
									<?php } ?>
								</ul>	
							</li>

							<li><a href="#"><i class="mdi mdi-briefcase-check"></i> Closed Contracts <span class="nav-tag"><?php echo count($closeContracts); ?></span></a>
								<ul>
									<?php foreach ($closeContracts as $contract) { ?>
										<li><a href="<?php echo site_url('user/closed_contracts/'.$contract['contract_id']); ?>">Contract - #<?php echo $contract['contract_id']; ?> </a></li>
									<?php } ?>
								</ul>	
							</li>

							<li><a href="<?php echo site_url('user/invoices'); ?>"><i class="mdi mdi-fax"></i> Invoices </a></li>
						</ul>

						<ul data-submenu-title="Account">
							<li><a href="<?php echo site_url('user/withdrawals'); ?>"><i class="mdi mdi-currency-usd"></i> Withdrawals</a></li>
							<li><a href="<?php echo site_url('user/user_settings'); ?>"><i class="icon-material-outline-settings"></i> Settings</a></li>
							<li><a href="<?php echo site_url('user/change_password'); ?>"><i class="icon-material-outline-lock"></i> Change Password</a></li>
							<li><a href="<?php echo site_url('user/logout'); ?>"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
						</ul>
						
					</div>
				</div>
				<!-- Navigation / End -->

			</div>
		</div>
	</div>
	<!-- Dashboard Sidebar / End -->