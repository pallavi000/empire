<?php
include_once('user_auth.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>
      Empire Gold
    </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png" />
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet" />
     <!---Font Awsome-->
     <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
   />
   <script
     src="https://kit.fontawesome.com/a076d05399.js"
     crossorigin="anonymous"
   ></script>
   <script src="js/ewallet_to_pin.js"></script>
  </head>

  <body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
      <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
          <circle
            class="path"
            cx="50"
            cy="50"
            r="20"
            fill="none"
            stroke-width="3"
            stroke-miterlimit="10"
          />
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
      <div class="content-body">
        <div class="row page-titles mx-0">
          <div class="col p-md-0">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="javascript:void(0)">Dashboard</a>
              </li>
              <li class="breadcrumb-item active">
                <a href="javascript:void(0)">Home</a>
              </li>
            </ol>
          </div>
        </div>
        <!-- row -->

        <div class="container-fluid">
            <form method="POST" action="member-query-updates.php">
          <div class="row">
            <div class="col-lg-12">
              
                <div class="card">
                  <div class="card-body">
                      <h4 class="card-title text-danger">Convert eWallet</h4>
                      <?php
                      $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
                      $wallet->execute([$user['user_id']]);
                      $wallet = $wallet->fetch();
                      ?>
                      <div class="basic-form">
                          <form method="POST" action="member-query-updates.php">
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Wallet Balance</label>
                                  <div class="col-sm-5 d-flex align-items-center text-danger">
                                      <span class="mr-1">RM</span><input id="walletBalance" type="text" readonly="readonly" name="wallet_balance" class="form-control-plaintext text-danger" value="<?php echo $wallet['WALLET_BALANCE'] ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Convert to</label>
                                  <div class="col-sm-3">
                                    <select id="inputState" name="convert_type" class="form-control">
                                      <option selected="selected">PINS</option>
                                    </select>
                                  </div>
                                  <label class="col-sm-2 col-form-label">Amount</label>
                                  <div class="col-sm-3">
                                      <input id="amount" min="0" max="<?php echo $wallet['WALLET_BALANCE'] ?>" name="amount" type="number" class="form-control" >
                                  </div>
                                  
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Fees 5/0%</label>
                                <div class="col-sm-3">
                                    <input readonly="readonly" name="fees" class="form-control" value="0">
                                </div>
                                <label class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-3">
                                    <input  readonly="readonly" id="today" class="form-control" >
                                </div>
                                <script>
                                  n = new Date();
                                  year = n.getFullYear();
                                  month = n.getMonth() + 1;
                                  date = n.getDate();
                                  hour = n.getHours();
                                  minutes = n.getMinutes();
                                  seconds = n.getSeconds();
                                  t = date+'/'+month+'/'+year;
                                  d = document.getElementById("today");
                                  d.value = t;
                                </script>
                            </div>
                            <input type="hidden" name="action" value="ewallet_to_pins"/>
                              <button id="transfer"type="submit" class="btn btn-dark">
                                Transfer
                              </button>

                
                          </form>
                      </div>
                  </div>
                  
                  
              </div>
             

              
          </div>
        </form>
        </div>
        <!-- #/ container -->
      </div>
      <!--**********************************
            Content body end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

     <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
          <div class="copyright">
            <p>
              Copyright &copy; Designed & Developed by
              <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018
            </p>
          </div>
        </div>
        <!--**********************************
              Footer end
          ***********************************-->
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="js/ewallet_to_pin.js"></script>
   
  </body>

</html>
