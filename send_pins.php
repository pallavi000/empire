<?php
include('user_auth.php');
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
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png" />
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
   <script src="js/send_pin.js"></script>
  
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
            <form action="member-query-updates.php" method="POST">
          <div class="row">
            <div class="col-lg-12">
              
                <div class="card">
                  <div class="card-body">
                      <h4 class="card-title text-danger">Send To</h4>
                      <div class="basic-form">
                          <?php
                          $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
                          $wallet->execute([$user['user_id']]);
                          $wallet = $wallet->fetch();
                          ?>
                          <form action="member-query-updates.php" method="POST">
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Pin Balance</label>
                                  <div class="col-sm-5">
                                      <input id="walletBalance" type="text" readonly="readonly" class="form-control-plaintext text-danger" name="pin_balance" value="<?php echo $wallet['PIN_VALUE'] ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Member</label>
                                  <div class="col-sm-3">
                                      <select name="member" class="form-control" required>
                                        <?php
                                        $members = $db->prepare("SELECT * from USER_TABLE");
                                        $members->execute([]);
                                        while($row=$members->fetch()) {
                                            echo '<option value="'.$row["user_id"].'-'.$row['user_name'].'">'.$row["user_name"].'</option>';
                                        }
                                        ?>
                                    </select>
                                  </div>
                                  <label class="col-sm-2 col-form-label">Amount to Transfer</label>
                                  <div class="col-sm-3">
                                      <input id="amount" name="amount" type="text" class="form-control" >
                                  </div>
                                  
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Fees 0/0%</label>
                                <div class="col-sm-3">
                                    <input readonly="readonly" type="text" value="0" class="form-control" >
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
                            <input type="hidden" name="action" value="send_pins"/>
                              <button id="sendPin" type="submit" class="btn btn-dark">
                                Transfer
                              </button>
                              <script>
                      
                                document
                                  .getElementById("sendPin")
                                  .addEventListener("click", sendPin);
          
                                 
                              </script>
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
    <script src="js/send_pin.js"></script>
  
  </body>

</html>
