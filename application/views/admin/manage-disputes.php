<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Disputes Manager | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<meta name="robots" content="noindex">
<!--/Admin Page Meta Tags-->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/headerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</head>

<body class="gray" onload="bootChat();load_thread(<?php if(isset($contract[0]['user_id'])) echo $contract[0]['user_id']; ?>);">

<!-- Wrapper -->
<div id="wrapper">

<!--------------------------------------------------------------------------------------------------------------->
<div class="clearfix"></div>
<!--------------------------------------------------------------------------------------------------------------->


<!-- Dashboard Container -->
<!--------------------------------------------------------------------------------------------------------------->
<div class="dashboard-container">
<?php $this->load->view('admin/includes/sidebar'); ?>
<!--------------------------------------------------------------------------------------------------------------->
	
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			<?php if(isset($contract[0]['id']) && !empty($contract[0]['id'])) { ?>
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Open Contract With <b>Buyer :</b><a href=""> <?php if(isset($buyer[0]['firstname'])) echo $buyer[0]['firstname'] ?> <?php if(isset($buyer[0]['lastname'])) echo $buyer[0]['lastname']; ?></a> & <b>Seller :</b> <a href="<?php echo current_url(); ?>"><?php if(isset($seller[0]['firstname'])) echo $seller[0]['firstname'] ?> <?php if(isset($seller[0]['lastname'])) echo $seller[0]['lastname']; ?></a></h3>
				<span class="margin-top-7"> # <a href="<?php echo current_url(); ?>"><?php if(isset($contract[0]['contract_id'])) echo $contract[0]['contract_id']; ?></a>  <?php if ($contract[0]['status'] === '4' || $contract[0]['status'] === '7'){?>
                <div class="badge badge-danger"> CLOSED</div> <?php } ?></span>
				<span class="margin-top-7">
				<?php if ($contract[0]['status'] === '0' ){?>
                <div class="badge badge-info"> Pending for payment</div>
                <?php } else if ($contract[0]['status'] === '1' ) { ?>
                <div class="badge badge-success"> Paid Contract</div>
                <?php } else if ($contract[0]['status'] === '2' ) { ?>
                <div class="badge badge-danger"> In Reolution Manager</div>
                <?php } else if ($contract[0]['status'] === '3' ) { ?>
                <div class="badge badge-danger"> Canceled By Buyer</div>
                <?php } else if ($contract[0]['status'] === '4' ) { ?>
                <div class="badge badge-warning"> Sale Completed</div>	
                <?php } else if ($contract[0]['status'] === '5' ) { ?>
                <div class="badge badge-dark"> Delivered</div>
                <?php } else if ($contract[0]['status'] === '6' ) { ?>
                <div class="badge badge-warning"> On Revision</div>
            	<?php } else if ($contract[0]['status'] === '8' ) { ?>
                <div class="badge badge-warning"> Reject Cancel Request</div>
            	<?php } else if ($contract[0]['status'] === '9' ) { ?>
                <div class="badge badge-warning"> Raised a Dispute</div>
            	<?php } else if ($contract[0]['status'] === '7' ) { ?>
                <div class="badge badge-warning"> Canceled Contract & Refunded</div>
                <?php } ?>
            	</span>

            	<?php if ($dispute[0]['status'] === '0' ){  ?>
            	<div class="input-group margin-top-25">
            		
            		<a href="#small-dialog-4" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button dark ripple-effect float-left"><i class="mdi mid-hand-okay"></i> MARK AS COMPLETED  </a>&nbsp;&nbsp;
            		<a href="#small-dialog-6" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button dark ripple-effect"><i class="mdi mid-hand-okay"></i> REJECT & REFUND </a>
				</div>
				<?php } ?>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Open Disputes</li>
					</ul>
				</nav>
			</div>

			<div id="paymentView" class="row">

				<div class="col-xl-12">
				<div class="dashboard-box margin-top-0">
				<div class="content">
				<ul class="dashboard-box-list">

				<li class="domains-box active bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden">

					<div class="lable text-center pt-2 pb-2">
                        <ul class="list-unstyled best text-white mb-0 text-uppercase">
                            <?php if ($contract[0]['status'] === '0' ){?>
                            <li class="list-inline-item"><i class="mdi mdi-bell-ring"></i></li>
                            <?php } else if ($contract[0]['status'] === '1' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-credit-card-outline"></i></li>
                            <?php } else if ($contract[0]['status'] === '2' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-face-agent"></i></li>
                            <?php } else if ($contract[0]['status'] === '3' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-close-circle"></i></li>
                            <?php } else if ($contract[0]['status'] === '4' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-check-outline"></i></li>	
                            <?php } else if ($contract[0]['status'] === '5' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-truck-delivery"></i></li>
                            <?php } else if ($contract[0]['status'] === '6' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-flag-triangle"></i></li>	
                            <?php } else if ($contract[0]['status'] === '7' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-flag-triangle"></i></li>	
                            <?php } else if ($contract[0]['status'] === '8' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-flag-triangle"></i></li>	
                        	<?php } else if ($contract[0]['status'] === '9' ) { ?>
                            <li class="list-inline-item"><i class="mdi mdi-flag-triangle"></i></li>	
                            <?php } ?>
                        </ul>
                    </div>

					<!-- Overview -->
					<div class="seller-overview manage-candidates">
						<div class="seller-overview-inner">



							<!-- Thumbnail -->
							<div class="seller-avatar">
								<div class="verified-badge"></div>
								<a href="#"><img src="<?php if(isset($listing_data[0]['website_thumbnail'])) echo base_url().USER_UPLOAD.$listing_data[0]['website_thumbnail']; ?>" alt=""></a>
							</div>

							<!-- Name -->
							<div class="seller-name">
								<h4><a href="#"><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?> <?php if(!empty($biddata[0]['user_country'])){?>  <img class="flag" src="<?php echo base_url().ICON_FLAGS ?><?php echo strtolower($biddata[0]['user_country']); ?>.svg " alt="" title="<?php if(isset($biddata[0]['user_country'])) echo $biddata[0]['user_country'] ?>"data-tippy-placement="top"><?php } ?></a>&nbsp;<?php if(isset($contract[0]['customer_id']) && !empty($contract[0]['customer_id'])) { ?><span id="FirstStep" class="badge badge-success text-white">HIGHEST <?php echo strtoupper($contract[0]['type']); ?> </span> <?php } ?></h4>

								<!-- Details -->
								<span class="seller-detail-item"><a href="<?php echo site_url('user_profile/'.$contract[0]['username']) ?>"><i class="icon-feather-user"></i> <?php if(isset($contract[0]['firstname'])) echo $contract[0]['firstname'].' '.$contract[0]['lastname']; ?></a></span>

								<?php if($contract[0]['status'] === '0') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-warning text-white">Pending Payment</span></a></span>
								<?php } else if($contract[0]['status'] === '1') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-success text-white">Paid </span></a></span>
								<?php } else if($contract[0]['status'] === '2') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-danger text-white">Support Review </span></a></span>
								<?php } else if($contract[0]['status'] === '3') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-danger text-white">Canceled Contract </span></a></span>
								<?php } else if($contract[0]['status'] === '6') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-danger text-white">Requested a Revision </span></a></span>
								<?php } else if($contract[0]['status'] === '4') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-info text-white">Completed </span></a></span>
								<?php } else if($contract[0]['status'] === '5') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-info text-white">Delivered & Waiting for Approval</span></a></span>
								<?php } else if($contract[0]['status'] === '7') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-info text-white">Canceled Contract & Refunded</span></a></span>
								<?php } else if($contract[0]['status'] === '8') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-info text-white">Rejected Cancel Request</span></a></span>
								<?php } else if($contract[0]['status'] === '9') { ?>
									<span class="seller-detail-item"><a href="#"><i class="icon-feather"></i> <span class="badge badge-info text-white">Raised a Dispute</span></a></span>
								<?php } ?>

								<br><span class="seller-detail-item"><a href="#"><i class="icon-feather-time"></i> Created On : <?php if(isset($contract[0]['date'])) echo date('Y-m-d',strtotime($contract[0]['date'])); ?></a></span>

								<!-- Bid Details -->
								<ul class="dashboard-task-info bid-info">
									<?php if($contract[0]['bid_id'] === 'direct'){ ?> <li><strong><?php if(isset($default_currency)) echo $default_currency; ?> <?php if(!empty($contractamount )) echo number_format($contractamount); ?></strong><span>Contract Amount</span></li><?php } else { ?> <li><strong><?php if(isset($default_currency)) echo $default_currency; ?><?php if(isset($biddata[0]['bid_amount'])) echo number_format($biddata[0]['bid_amount']); ?></strong><span><?php echo strtoupper($contract[0]['type'])?> AMOUNT</span></li> <?php } ?>
									<li><strong><?php if(isset($contract[0]['delivery'])) echo $contract[0]['delivery']; ?> DAYS</strong><span>Delivery</span></li>
								</ul>

								<!-- Add to cart -->
								<div class="buttons-to-right always-visible margin-top-25 margin-bottom-0">
									<?php if ($contract[0]['status'] === '0' ){
										if($contract[0]['customer_id'] === $this->session->userdata('user_id')) { ?>
											<a href="#" data-name="<?php if(isset($listing_data[0]['website_BusinessName'])) echo 'Contract : '.$contract[0]['contract_id'].' - '.$listing_data[0]['website_BusinessName'];  ?>" data-price="<?php if(isset($biddata[0]['bid_amount'])) echo $biddata[0]['bid_amount']; ?>" data-thumb="<?php if(isset($listing_data[0]['website_thumbnail'])) echo base_url().IMAGES_UPLOAD.$listing_data[0]['website_thumbnail'];  ?>" data-cur="<?php if(isset($listing_data[0]['default_currency'])) echo $listing_data[0]['default_currency']; else echo '$';  ?>"  data-id="<?php if(isset($contract[0]['listing_id'])) echo $contract[0]['listing_id']; ?>" data-sale='<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>' class="add-to-cart text-primary"><i class="mdi mdi-cart-plus"></i>Add to cart</a>
									<?php } } ?>

									<?php if ($contract[0]['status'] === '1' || $contract[0]['status'] === '6' ){ 
										if($contract[0]['owner_id'] === $this->session->userdata('user_id')) { ?>
											<a href="#small-dialog-7" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button dark ripple-effect"><i class="mdi mid-hand-okay"></i> Deliver & Complete </a>
									<?php } } ?>

									<?php if ($contract[0]['status'] === '3' ){ 
										if($contract[0]['owner_id'] === $this->session->userdata('user_id')) { ?>
											<button type="button" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button dark ripple-effect float-left accept_cancel"><i class="mdi mid-hand-okay"></i> Accept Cancel Request & Refund</button>
											<button type="button" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button dark ripple-effect float-left reject_cancel"><i class="mdi mid-hand-okay"></i>Reject Cancel Request</button>
									<?php } } ?>

									<?php if ($contract[0]['status'] === '5' ){
										if($contract[0]['customer_id'] === $this->session->userdata('user_id')) { ?>
											<a href="#small-dialog-4" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button dark ripple-effect"><i class="mdi mid-hand-okay"></i> Accept Delivery </a>
											<a href="#small-dialog-5" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button red ripple-effect"><i class="mdi mid-hand-okay"></i> Request a Revision </a>
									<?php } } ?>

									<?php if ($contract[0]['status'] === '8' ){
										if($contract[0]['customer_id'] === $this->session->userdata('user_id')) { ?>
											<a href="#small-dialog-4" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="popup-with-send-message button dark ripple-effect"><i class="mdi mid-hand-okay"></i> Accept Delivery </a>
											<a href="" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="button dark ripple-effect raise_dispute"><i class="mdi mid-hand-okay"></i> Raise a Dispute </a>
									<?php } } ?>
									

									<?php if ($contract[0]['status'] === '4' ){
										if($contract[0]['customer_id'] === $this->session->userdata('user_id')) { ?>
											<a href="#small-dialog-2" class="popup-with-zoom-anim badge badge-light"><i class="icon-material-outline-thumb-up"></i> Leave a Review</a>
									<?php } } ?>
								</div>
							</div>
						</div>
					</div>
				</li>
				</ul>
				<!-------EnDs---------------->
				</div>
				</div>
				</div>

			</div>

			<!-- Row -->
			<?php if(!empty($contractsHistory)) { ?>
			<div id="contract_history" class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3>Contract History</h3>
						</div>
						<div id="negotiations_table" class="bs-example container" data-example-id="striped-table">
  							<table class="table table-striped table-bordered table-hover">
    							<thead>
      							<tr>
        							<th>#</th>
        							<th>Status</th>
        							<th>Remarks</th>
        							<th><i class="fas fa-arrow-circle-up"></i></th>
        							<th>Date</th>
      							</tr>
    							</thead>
    							<tbody>

    								<?php $i=1; foreach ($contractsHistory as $contracts) { ?>
      								<tr>
        								<th scope="row"><?php echo $i; ?></th>
        								<td><?php if($contracts['status'] === '1') echo 'Paid'; else if($contracts['status'] === '2')
        								echo 'Support Review'; else if($contracts['status'] === '3')
        								echo 'Canceled Contract'; else if($contracts['status'] === '6')
        								echo 'Requested a Revision'; else if($contracts['status'] === '4')
        								echo 'Completed'; else if($contracts['status'] === '5')
        								echo 'Delivered & Waiting for Approval'; else if($contracts['status'] === '7')
        								echo 'Canceled the contract and refunded';else if($contracts['status'] === '8')
        								echo 'Rejected Cancel Request By Seller';else if($contracts['status'] === '9')
        								echo 'Raised a dispute by the buyer';
        								?></td>
        								<td><?php if(!empty($contracts['remarks'])) echo $contracts['remarks']; ?></td>
        								<td><?php if(!empty($contracts['uploads'])) echo '<a href="'.base_url().FILES_UPLOAD.$contracts['uploads'].'">'.'<i title="Download Attachment" data-toggle="tooltip" class="fas fa-arrow-circle-down text-warning">'.'</a>'; ?></td>
        								<td><?php if(!empty($contracts['date'])) echo date('Y-m-d',strtotime($contracts['date'])); ?></td>
      								</tr>
      								<?php $i++; } ?>
    							</tbody>
  							</table>
						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->
			<?php } ?>
	
			<!-- Row -->
			<?php if($contract[0]['status'] === '9') { ?>
			<div id="deliveryView" class="row">
			<?php } else { ?>
			<div id="deliveryView" class="row" style="display: none;">
			<?php } ?>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-time"></i> TIME LEFT</h3>
						</div>

						<div class="container-timeleft" id="container">
							<h1 id="days"></h1>
							<h1 id="time">00:00:<span>00</span></h1>
							<h2 id="code"></h2>
							<div class="button-group" id="action">
								<a href="#" data-contractid="<?php if(isset($contract[0]['id'])) echo $contract[0]['id']; ?>" class="button dark ripple-effect"><i class="mdi mid-hand-okay"></i> DELIVERED </a>
							</div>
						</div>

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-users"></i> <?php ?></h3>
						</div>

						<div class="content">
						<!-- Message Content -->
						<div class="message-content">

							<div class="messages-headline">
								<input type="hidden" name="chat_buddy_id" id="chat_buddy_id" value="<?php if(isset($contract[0]['user_id'])) echo $contract[0]['user_id']; ?>">
								<h4 id="ChatName">Conversation Between You & <?php if(isset($contract[0]['username'])) echo $contract[0]['username']; ?></h4>
								<a href="#" class="message-action"><i class="icon-feather-trash-2"></i> Delete Conversation</a>
							</div>
							
							<!-- Message Content Inner -->
							<div id="chat-message" class="message-content-inner">
								<!----message loading bubble-->
								<div id="message-loading" class="message-bubble" style="display: none;">
									<div class="message-bubble-inner">
										<div class="message-avatar"></div>
										<div class="message-text">
											<!-- Typing Indicator -->
											<div class="typing-indicator">
												<span></span>
												<span></span>
												<span></span>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<!----/Ends message loading bubble-->

							</div>
							<!-- Message Content Inner / End -->
							

						</div>
						<!-- Message Content -->

						<div>
							
						</div>


						</div>

					</div>
				</div>

			</div>
			<!-- Row / End -->
			<?php } else { ?>

			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">
						<!-- Headline -->
						<div class="headline">
							<h3>No Contracts were Found</h3>
						</div>
					</div>
				</div>
			</div>

			<?php } ?>

			<!----------------------------------------------------------------------------------------------------------->
			<?php $this->load->view('user/includes/footer'); ?>
			<!----------------------------------------------------------------------------------------------------------->

		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->


<!-----------------Common Models -------------------------------------------------------------------------------->
<?php $this->load->view('user/includes/models'); ?>
<!--------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<script>
	dateval = <?php echo date("Y", strtotime($contract[0]['delivery_time'])); ?> + '-' + <?php echo date("m", strtotime($contract[0]['delivery_time'])); ?> + '-' + <?php echo date("d", strtotime($contract[0]['delivery_time'])); ?>;
	timeval = <?php echo date("H", strtotime($contract[0]['delivery_time'])); ?> + ':' + <?php echo date("i", strtotime($contract[0]['delivery_time'])); ?>;

	timeleft();

</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>