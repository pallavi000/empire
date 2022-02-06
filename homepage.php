<?php
include('user_auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Empire Gold</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png" />
  <!-- Pignose Calender -->
  <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet" />
  <!-- Chartist -->
  <link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css" />
  <link rel="stylesheet" href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css" />
  <!-- Custom Stylesheet -->
  <link href="css/style.css" rel="stylesheet" />
  <!---Font Awsome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <!-- <script src="js/login-page.js"></script> -->
</head>

<body>
  <!--*******************
        Preloader start
    ********************-->
  <div id="preloader">
    <div class="loader">
      <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
      </svg>
    </div>
  </div>
  <!--*******************
        Preloader end
    ********************-->

  <!--**********************************
        Main wrapper start
    ***********************************-->
  <div id="main-wrapper">
    <!--**********************************
            Nav header start
        ***********************************-->
    <div class="nav-header">
      <div class="brand-logo">
        <a href="homepage.html">
          
          <span class="brand-title">
            <img src="images/logo.png" alt="">
          </span>
        </a>
      </div>
    </div>
    <!--**********************************
            Nav header end
        ***********************************-->

    <!--**********************************
            Header start
        ***********************************-->
    
    <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

    <!--**********************************
            Sidebar start
        ***********************************-->
    <?php include './includes/user-sidebar.php'; ?>
    <!--**********************************
            Sidebar end
        ***********************************-->

    <!--**********************************
            Content body start
        ***********************************-->
        <?php
        $query = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
        $query->execute([$user['user_id']]);
        $wallet = $query->fetch();
        if($query->rowCount()>0) {
          $wallet_balance = $wallet['WALLET_BALANCE'];
        } else {
          $wallet_balance = 0;
        }
        ?>
    <div class="content-body">
      <div class="container-fluid mt-3">
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
              <div class="card-body">
                <h3 class="card-title text-white">eWallet</h3>
                <div class="d-inline-block">
                  <h2 id="walletBalance" class="text-white">RM <?php echo $wallet_balance; ?></h2>
                  <!-- <p class="text-white mb-0">Jan - March 2019</p> -->
                </div>
                <span class="float-right display-5 opacity-5"><i class="fas fas-diamond" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card gradient-2">
              <div class="card-body">
                <h3 class="card-title text-white">Personal Sales</h3>
                <div class="d-inline-block">
                  <?php
                  $personal_sales = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE user_id=? AND type=? AND Level=?");
                  $personal_sales->execute([$user['user_id'], 'B', 1]);
                  $total_personal_sales = 0;
                  while($row=$personal_sales->fetch()) {
                    $total_personal_sales += $row['AMOUNT'];
                  }
                  ?>
                  <h2 class="text-white">RM <?php echo $total_personal_sales; ?></h2>
                  <!-- <p class="text-white mb-0">Jan - March 2019</p> -->
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card gradient-3">
              <div class="card-body">
                <h3 class="card-title text-white">Group Sales</h3>
                <div class="d-inline-block">
                <?php
                  $group_sales = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE user_id=? AND type=? AND Level!=?");
                  $group_sales->execute([$user['user_id'], 'B', 1]);
                  $total_group_sales = 0;
                  while($row=$group_sales->fetch()) {
                    $total_group_sales += $row['AMOUNT'];
                  }
                  ?>
                  <h2 class="text-white">RM <?php echo $total_group_sales; ?></h2>
                  <!-- <p class="text-white mb-0">Jan - March 2019</p> -->
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card gradient-4">
              <div class="card-body">
                <h3 class="card-title text-white">PINS</h3>
                <div class="d-inline-block">
                  <h2 id="pinValue" class="text-white"><?php echo $wallet['PIN_VALUE'] ?></h2>
                  <!-- <p class="text-white mb-0">Jan - March 2019</p> -->
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-diamond"></i></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
              <div class="card-body">
                <h3 class="card-title text-white">Gold(g)</h3>
                <div class="d-inline-block">
                  <h2 id="goldIngram" class="text-white"><?php echo $wallet['gold_value'] ?></h2>
                  <!-- <p class="text-white mb-0">Jan - March 2019</p> -->
                </div>
                <span class="float-right display-5 opacity-5"><i class="fas fa-diamond"></i></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card gradient-2">
              <div class="card-body">
                <h3 class="card-title text-white">Gold Value(RM)</h3>
                <div class="d-inline-block">
                  <h2 id="goldValue" class="text-white"><?php echo $gold['gold_price']; ?></h2>
                  <!-- <p class="text-white mb-0">Jan - March 2019</p> -->
                </div>
                <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card gradient-3">
              <div class="card-body">
                <h3 class="card-title text-white">Point Value</h3>
                <div class="d-inline-block">
                  <h2 class="text-white"><?php echo $wallet['POINT_VALUE']; ?></h2>
                  <!-- <p class="text-white mb-0">Jan - March 2019</p> -->
                </div>
                <span class="float-right display-5 opacity-5">&nbsp;</span>
              </div>
            </div>
          </div>
        </div>
        

        <div class="row">
          <div class="col-md-7">
            <div class="card">
              <div class="card-body">
                <h3 class="text-danger">Bonus Summary</h3>
                <div class="table-responsive">
                  <!-- <table class="table table-xs mb-0">
                    <tbody>
                      <tr>
                        <td>
                          <h4>Total Active Sponsor:</h4>
                        </td>
                        <td>
                          <span class="m-0 pl-3">0</span>
                        </td>
                      </tr>
                      <tr>
                        <td>Bonus Sponsor:</td>
                        <td>
                          <span class="m-0 pl-3">RM<span id="bonusSponsor" class="m-0 pl-3">RM 0</span></span>
                        </td>
                      </tr>
                      <tr>
                        <td>Bonus Keyin:</td>
                        <td>
                          <span class="m-0 pl-3">RM
                            <span id="bonusKeyIn" class="m-0 pl-3">RM 0</span></span>
                        </td>
                      </tr>
                    </tbody>
                  </table> -->
                  <table class="table table-xs mb-0">
                    <tbody>
                      <tr>
                        <td>
                          <h4>Bonus Unilevel:(Unilevel)</h4>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-xs mb-0">
                    <tbody>
                      <tr>
                        <td style="width: 432px">Total Bonuses:</td>
                        <td>
                          <span class="text-center m-0 pl-3">RM<?php echo $total_personal_sales+$total_group_sales; ?></span>
                        </td>
                      </tr>
                      <tr>
                        <td>Bonus Gold:</td>
                        <td>
                          <span class="m-0 pl-3">0 g</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <?php include './includes/account-detail.php'; ?>
          </div>
        </div>
      </div>
      <!-- #/ container -->
    </div>
    <!--**********************************
            Content body end
        ***********************************-->

    <!--**********************************
            Footer start
        ***********************************-->
    <div class="footer">
      <div class="copyright">
        <p>Copyright &copy;2021 - Empire Gold - All Rights Reserved</p>
      </div>
    </div>
    <!--**********************************
            Footer end
        ***********************************-->
  </div>
  <!--**********************************
        Main wrapper end
    ***********************************-->

  <!--**********************************
        Scripts
    ***********************************-->
  <script src="plugins/common/common.min.js"></script>
  <script src="js/custom.min.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/gleek.js"></script>
  <script src="js/styleSwitcher.js"></script>

  <!-- Chartjs -->
  <script src="./plugins/chart.js/Chart.bundle.min.js"></script>
  <!-- Circle progress -->
  <script src="./plugins/circle-progress/circle-progress.min.js"></script>
  <!-- Datamap -->
  <script src="./plugins/d3v3/index.js"></script>
  <script src="./plugins/topojson/topojson.min.js"></script>
  <script src="./plugins/datamaps/datamaps.world.min.js"></script>
  <!-- Morrisjs -->
  <script src="./plugins/raphael/raphael.min.js"></script>
  <script src="./plugins/morris/morris.min.js"></script>
  <!-- Pignose Calender -->
  <script src="./plugins/moment/moment.min.js"></script>
  <script src="./plugins/pg-calendar/js/pignose.calendar.min.js"></script>
  <!-- ChartistJS -->
  <script src="./plugins/chartist/js/chartist.min.js"></script>
  <script src="./plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>

  <script src="./js/dashboard/dashboard-1.js"></script>
  <script src="js/homepage.js"></script>
</body>

</html>