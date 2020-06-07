<!DOCTYPE html>
<html lang="en">
<head>

<!--Admin Page Meta Tags-->
<title>Cron Jobs Manager | <?php echo $this->lang->line('site_name') ?> | Admin Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="<?php if(isset($imagesData[0]['favicon'])) echo base_url().ADMIN_IMAGES.$imagesData[0]['favicon']; ?>" alt="favicon" />
<meta name="robots" content="noindex">
<!--/Admin Page Meta Tags-->

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
<?php $this->load->view('admin/includes/sidebar'); ?>
<!--------------------------------------------------------------------------------------------------------------->

	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3><b>Cron Jobs Manager</b></h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li>Cron Jobs Manager</li>
					</ul>
				</nav>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0 panel-group" id="accordion" role="tablist" aria-multiselectable="true">

						<div class="row">
                    
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">           

                          <form method="post" id="cronJobsFrom" enctype="multipart/form-data">  
                           
                            <div class="card mb-3">

                              <div class="card-body">
                                
                                <div class="form-row">
                                  <div class="form-group col-md-2">
                                    <label>Minutes</label>
                                    <select name="cronjob_minutes" class="form-control">
                                      <option value="*">Every Minute</option>
                                      <option value="0">0</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      <option value="13">13</option>
                                      <option value="14">14</option>
                                      <option value="15">15</option>
                                      <option value="16">16</option>
                                      <option value="17">17</option>
                                      <option value="18">18</option>
                                      <option value="19">19</option>
                                      <option value="20">20</option>
                                      <option value="21">21</option>
                                      <option value="22">22</option>
                                      <option value="23">23</option>
                                      <option value="24">24</option>
                                      <option value="25">25</option>
                                      <option value="26">26</option>
                                      <option value="27">27</option>
                                      <option value="28">28</option>
                                      <option value="29">29</option>
                                      <option value="30">30</option>
                                      <option value="31">31</option>
                                      <option value="32">32</option>
                                      <option value="33">33</option>
                                      <option value="34">34</option>
                                      <option value="35">35</option>
                                      <option value="36">36</option>
                                      <option value="37">37</option>
                                      <option value="38">38</option>
                                      <option value="39">39</option>
                                      <option value="40">40</option>
                                      <option value="41">41</option>
                                      <option value="42">42</option>
                                      <option value="43">43</option>
                                      <option value="44">44</option>
                                      <option value="45">45</option>
                                      <option value="46">46</option>
                                      <option value="47">47</option>
                                      <option value="48">48</option>
                                      <option value="49">49</option>
                                      <option value="50">50</option>
                                      <option value="51">51</option>
                                      <option value="52">52</option>
                                      <option value="53">53</option>
                                      <option value="54">54</option>
                                      <option value="55">55</option>
                                      <option value="56">56</option>
                                      <option value="57">57</option>
                                      <option value="58">58</option>
                                      <option value="59">59</option>
                                    </select>
                                  </div>
                                  <div class="form-group col-md-2">
                                    <label>Hour</label>
                                      <select name="cronjob_hours" class="form-control">
                                        <option value="*">Every Hour</option>
                                        <option value="0">12:00 AM</option>
                                        <option value="1">01:00 AM</option>
                                        <option value="2">02:00 AM</option>
                                        <option value="3">03:00 AM</option>
                                        <option value="4">04:00 AM</option>
                                        <option value="5">05:00 AM</option>
                                        <option value="6">06:00 AM</option>
                                        <option value="7">07:00 AM</option>
                                        <option value="8">08:00 AM</option>
                                        <option value="9">09:00 AM</option>
                                        <option value="10">10:00 AM</option>
                                        <option value="11">11:00 AM</option>
                                        <option value="12">12:00 PM</option>
                                        <option value="13">13:00 PM</option>
                                        <option value="14">14:00 PM</option>
                                        <option value="15">15:00 PM</option>
                                        <option value="16">16:00 PM</option>
                                        <option value="17">17:00 PM</option>
                                        <option value="18">18:00 PM</option>
                                        <option value="19">19:00 PM</option>
                                        <option value="20">20:00 PM</option>
                                        <option value="21">21:00 PM</option>
                                        <option value="22">22:00 PM</option>
                                        <option value="23">23:00 PM</option>
                                      </select>
                                  </div>
                                  <div class="form-group col-md-2">
                                    <label>Day</label>
                                      <select name="cronjob_days" class="form-control">
                                        <option value="*">Everyday</option>
                                        <option value="1">1st</option>
                                        <option value="2">2nd</option>
                                        <option value="3">3rd</option>
                                        <option value="4">4th</option>
                                        <option value="5">5th</option>
                                        <option value="6">6th</option>
                                        <option value="7">7th</option>
                                        <option value="8">8th</option>
                                        <option value="9">9th</option>
                                        <option value="10">10th</option>
                                        <option value="11">11th</option>
                                        <option value="12">12th</option>
                                        <option value="13">13th</option>
                                        <option value="14">14th</option>
                                        <option value="15">15th</option>
                                        <option value="16">16th</option>
                                        <option value="17">17th</option>
                                        <option value="18">18th</option>
                                        <option value="19">19th</option>
                                        <option value="20">20th</option>
                                        <option value="21">21th</option>
                                        <option value="22">22th</option>
                                        <option value="23">23th</option>
                                        <option value="24">24th</option>
                                        <option value="25">25th</option>
                                        <option value="26">26th</option>
                                        <option value="27">27th</option>
                                        <option value="28">28th</option>
                                        <option value="29">29th</option>
                                        <option value="30">30th</option>
                                        <option value="31">31st</option>
                                      </select>
                                  </div>
                                  <div class="form-group col-md-2">
                                    <label>Month</label>
                                      <select name="cronjob_months" class="form-control">
                                        <option value="*">Every Month</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                      </select>
                                  </div>
                                <div class="form-group col-md-2">
                                  <label>Weekday</label>
                                    <select name="cronjob_weekdays" class="form-control">
                                      <option value="*">Everyday</option>
                                      <option value="0">Sunday</option>
                                      <option value="2">Monday</option>
                                      <option value="3">Tuesday</option>
                                      <option value="4">Wednesday</option>
                                      <option value="5">Thrusday</option>
                                      <option value="6">Friday</option>
                                      <option value="7">Saturday</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                  <label>Task</label>
                                    <select name="cronjob_tasks" class="form-control">
                                      <option value="markascompleted">Mark As Completed</option>
                                    </select>
                                </div>
                            </div>  
                            
                          <div class="form-group">
                            <button id="cron_button" name="cron_button" class="btn btn-primary" type="submit">Add Cron Job</button>
                          </div>

                          <input type="hidden" class="txt_csrfname" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                   
                    </div>  
                    <!-- end card-body -->                
                      
                  </div>
                  <!-- end card --> 
                  
                  </form>

                  <div class="row">
                    <div class="col-xs-24 col-sm-24 col-md-24 col-lg-12 col-xl-12">           
                        <div class="card mb-3">
                          <div class="card-body">
                            <div class="table-responsive">
                              <table id="tbl_crondata" class="table table-bordered table-hover display">
                                <thead>
                                  <tr>
                                    <th></th>
                                    <th>Minutes</th>
                                    <th>Hour</th>
                                    <th>Day</th>
                                    <th>Month</th>
                                    <th>Weekday</th>
                                    <th>Task</th>
                                    <th></th>
                                  </tr>
                                </thead>
                              </table>
                            </div>
                          </div>              
                        </div><!-- end card-->          
                    </div>

                  </div>
                                    
                </div>
                    <!-- end col -->  
                                  
              </div>
              <!-- end row -->  
						
					</div>
					<!--Full Tabs Ends-->
				</div>

			</div>
			<!-- Row / End -->

			<!-- Footer -->
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
<!--------------------------------------------------------------------------------------------------------------->
<script>loadCronData();</script>

</body>
</html>