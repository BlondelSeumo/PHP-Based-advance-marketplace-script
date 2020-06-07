          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">No of Users</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php if(isset($NOFU)) {echo $NOFU;} else { echo 0; } ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-glassdoor mr-1" aria-hidden="true"> REGISTRED USERS</i>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cash-usd text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Total Earnings</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php if(isset($TE)) {echo '$ '.$TE;} else { echo '$ '.'0'; } ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-timetable mr-1" aria-hidden="true"></i> <?php echo date('d/M/Y', time()); ?>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cash-100 text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Monthly Earnings</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php if(isset($EM)) {echo '$ '.$EM;} else { echo '$ '.'0'; } ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-timetable mr-1" aria-hidden="true"></i> <?php echo date('F Y'); ?>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-download text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Total Downloads</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?php if(isset($TD)) {echo $TD;} else { echo 0; } ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-tablet-ipad mr-1" aria-hidden="true"></i> IP WISE
                  </p>
                </div>
              </div>
            </div>
            
          </div>

          <!--------PLATFORM WISE DOWNLOADS --------------------------------------------------------------------------->
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">PLATFORMS WISE DOWNLOADS</h4>
                  <span id="loaderPlatformsWise" class="centerButtons" style="display:none;"> <img src="<?php echo base_url();?>assets/img/loadingimage.gif"/> </span>
                  <canvas id="platformWiseDownloads" style="height:250px"></canvas>
                </div>
              </div>
            </div>
          </div>
          <!--------/PLATFORM WISE DOWNLOADS --------------------------------------------------------------------------->

          