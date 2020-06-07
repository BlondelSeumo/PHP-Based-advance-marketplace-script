<!DOCTYPE html>
<html lang="en">
<head>

<!--User Page Meta Tags-->
<title>Invoice - <?php if(isset($invoice[0]['invoice_id'])) echo $invoice[0]['invoice_id']; ?> | <?php echo $this->lang->line('site_name') ?>| User Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<meta name="robots" content="noindex">
<!--User Page Meta Tags-->

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/headerscripts'); ?>
<!--------------------------------------------------------------------------------------------------------------->

</head>

<body class="gray">

<!-- Wrapper -->
<div id="wrapper">

<!--------------------------------------------------------------------------------------------------------------->
<div class="clearfix"></div>
<!--------------------------------------------------------------------------------------------------------------->


<!-- Dashboard Container -->
<!--------------------------------------------------------------------------------------------------------------->
<div class="dashboard-container">
<?php $this->load->view('user/includes/sidebar'); ?>
<!--------------------------------------------------------------------------------------------------------------->
	
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Invoices</h3>
				<span class="margin-top-7">INVOICE #<a href=""><?php if(isset($invoice[0]['invoice_id'])) echo $invoice[0]['invoice_id']; ?></a></span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Invoice</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<div class="toolbar hidden-print margin-top-20">
        						<div class="text-right">
            						<button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            						<button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
       							</div>
    						</div>
						</div>

						<div class="content margin-top-20">

						<!---tem-->
						<div class="row">
						
    
						<div id="invoice">

    
    					<div class="invoice overflow-auto">
        					<div class="col-xl-12">
            					<header>
                				<div class="row">
                    				
                                    <div class="col">
                        				<a target="_blank" href="<?php echo base_url(); ?>">
                            				<img src="<?php if(!empty($imagesData[0]['invoice_logo'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['invoice_logo']; ?>" data-holder-rendered="true" />
                            			</a>
                    				</div>

                    				<div class="col company-details">
                        			<h2 class="name text-right">
                            		<a target="_blank" href="">
                            			<?php if(isset($ownerinfo[0]['firstname'])) echo $ownerinfo[0]['firstname'] ?> <?php if(isset($ownerinfo[0]['lastname'])) echo $ownerinfo[0]['lastname']; ?>
                            		</a>
                        			</h2>
                        			<div><b>Via <?php echo $this->lang->line('site_name'); ?></b></div>
                        			<div><?php if(isset($ownerinfo[0]['email'])) echo $ownerinfo[0]['email'] ?></div>
                    				</div>
                				</div>
            					</header>
            					<main>
                				<div class="row contacts">
                    				<div class="col-6 invoice-to float-left">
                        				<div class="text-gray-light"><b>INVOICE TO:</b></div>
                        				<h2 class="to float-left"><a target="_blank" href=""><?php if(isset($customerinfo[0]['firstname'])) echo $customerinfo[0]['firstname'] ?> <?php if(isset($customerinfo[0]['lastname'])) echo $customerinfo[0]['lastname']; ?></a></h2><br>
                        				<div class="address float-left"><b>Via <?php echo $this->lang->line('site_name'); ?></b></div><br>
                        				<div class="email float-left"><a href="<?php if(isset($customerinfo[0]['email'])) echo $customerinfo[0]['email'] ?>"><?php if(isset($customerinfo[0]['email'])) echo $customerinfo[0]['email'] ?></a></div>
                    				</div>

                    				<div class="col invoice-details text-right">
                    					<h3><span class="margin-top-7">
                                        <?php if ($invoice[0]['status'] === '0' ){?>
                                            <div class="badge badge-info"> Pending</div>
                                        <?php } else if ($invoice[0]['status'] === '1' ) { ?>
                                            <div class="badge badge-success"> Paid</div>
                                        <?php } else if ($invoice[0]['status'] === '4' ) { ?>
                                            <div class="badge badge-success"> Completed</div>
                                        <?php } else if ($invoice[0]['status'] === '3' ) { ?>
                                            <div class="badge badge-danger"> Canceled & Refunded</div>
                                        <?php } else if ($invoice[0]['status'] === '7' ) { ?>
                                            <div class="badge badge-warning"> On Hold</div>  
                                        <?php }?>
                                        </span></h3>
                        				<h3 class="invoice-id">#<?php if(isset($invoice[0]['invoice_id'])) echo $invoice[0]['invoice_id']; ?></h3>
                        				<div class="date">Created On : <?php if(isset($invoice[0]['date'])) echo date('D, M j, Y',strtotime($invoice[0]['date'])); ?>
                        					<div class="date">Last Updated On : <?php if(isset($invoice[0]['updated'])) echo date('D, M j, Y',strtotime($invoice[0]['updated'])); ?></div>
                    					</div>
                					</div>


                					<table border="0" cellspacing="0" cellpadding="0" class="margin-top-20">
                    					<thead>
                        					<tr>
                            					<th>#</th>
                            					<th class="text-left">DESCRIPTION</th>
                            					<th class="text-right">PRICE</th>
                        					</tr>
                    					</thead>

                    				<tbody>
                        				<tr>
                            				<td class="no">01</td>
                            				<td class="text-left"><?php if(isset($listing_data[0]['website_BusinessName'])) echo $listing_data[0]['website_BusinessName']; ?></td>
                            				<td class="total"><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?><?php if(isset($invoice[0]['gross_amount'])) echo number_format(floatval(($invoice[0]['gross_amount'])),2); ?></td>
                        				</tr>
                    				</tbody>
                    				<tfoot>
                        				<tr>
                            				<td colspan="0"></td>
                            				<td colspan="0">SUBTOTAL</td>
                            				<td><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?><?php if(isset($invoice[0]['gross_amount'])) echo number_format(floatval(($invoice[0]['gross_amount'])),2); ?></td>
                        				</tr>
                        				<tr>
                            				<td colspan="0"></td>
                            				<td colspan="0">FEE</td>
                            				<td><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?><?php if(isset($invoice[0]['success_fee'])) echo number_format(floatval(($invoice[0]['success_fee'])),2); ?></td>
                        				</tr>
                        				<tr>
                            				<td colspan="0"></td>
                            				<td colspan="0">TOTAL</td>
                            				<td><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?><?php if(isset($invoice[0]['gross_amount'])) echo number_format(floatval(($invoice[0]['gross_amount'])) - floatval(($invoice[0]['success_fee'])),2); ?></td>
                        				</tr>
                    				</tfoot>
                					</table>

                					<div class="thanks">Thank you!</div>
               	 					<div class="notices">
                    					<div><b>NOTICE:</b></div>
                    					<div class="notice">According to terms & conditions a success fee of <b><?php if(isset($default_currency)) echo $default_currency; else echo '$'; ?> <?php if(isset($invoice[0]['success_fee'])) echo number_format(floatval(($invoice[0]['success_fee'])),2); ?></b> has been charged by <b><?php echo $this->lang->line('site_name'); ?></b></div>
                					</div>
            					</main>
            					<footer>
                					Invoice was created on a computer and is valid without the signature and seal.
            					</footer>
        					</div>
        					<!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        					<div></div>
    					</div>
						</div>

						</div>

						<!--/end temp -->


						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->

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

<!--------------------------------------------------------------------------------------------------------------->
<?php $this->load->view('main/includes/footerscripts'); ?>
<script type="text/javascript">
	 $('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data) 
            {
                window.print();
                return true;
            }
        });
</script>
<!--------------------------------------------------------------------------------------------------------------->

</body>
</html>