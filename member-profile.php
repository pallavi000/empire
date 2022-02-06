<?php
include('./user_auth.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Empire Gold</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png" />
    <!-- Pignose Calender -->
    <link
      href="./plugins/pg-calendar/css/pignose.calendar.min.css"
      rel="stylesheet"
    />
    <!-- Chartist -->
    <link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css" />
    <link
      rel="stylesheet"
      href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css"
    />
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
            <!-- <b class="logo-abbr"><img src="images/logo.png" alt=""> </b> -->
            <h4>Empire Gold</h4>
            <span class="logo-compact">
              <!-- <img src="./images/logo-compact.png" alt=""> -->
              <h4>Empire Gold</h4>
            </span>
            <span class="brand-title">
              <!-- <img src="images/logo-text.png" alt=""> -->
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
        <div class="container-fluid mt-3">
          <div class="row">
            <div class="col-md-7">
              <div class="card">
                <div class="card-body">
                  <div class="basic-form">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label class="text-danger">Sponsor By</label>
                        <input id="userName" type="text" class="form-control" value="<?php echo $user['sponser_by']; ?>" readonly/>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label class="text-danger">Refferal Link</label>
                        <p id="refferal">https://empiregold.com/<?php echo $user['user_name']; ?></p>
                      </div>
                      <div class="form-group">
                        <div
                          style="padding-top: 10px"
                          class="col-12 text-center"
                        >
                          <button onclick="copyRefLink()" class="btn btn-danger">
                            <i style="padding-right: 5px" class="fa fa-copy"></i
                            >Copy Link
                          </button>
                          <script>
                            function copyRefLink() {
                              /* Get the text field */
                              var copy = document.getElementById("refferal");
                              document.execCommand("copy");

                              /* Copy the text inside the text field */
                              navigator.clipboard.writeText(copy.innerHTML);

                              /* Alert the copied text */
                              alert("Copied to clipboard!");
                      }
                    </script>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <form action="member-query-updates.php" method="POST">
                  <h4 class="card-title text-danger">Particulars</h4>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"
                      >National/Passport ID</label
                    >
                    <div class="col-sm-4">
                      <input type="text" class="form-control" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="fullName" value="<?php echo $user['full_name'] ?>" required/>
                    </div>
                    <label class="col-sm-2 col-form-label">Email Address</label>
                    <div class="col-sm-4">
                      <input type="email" name="email" class="form-control" value="<?php echo $user['EMAIL'] ?>" required/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label"
                      >Address Street</label
                    >
                    <div class="col-sm-4">
                      <textarea
                        class="form-control h-150px"
                        rows="6"
                        id="comment"
                        name="address"
                       required><?php echo $user['address_no']; ?></textarea>
                    </div>
                    <label class="col-sm-2 col-form-label">City</label>
                    <div class="col-sm-4">
                      <input type="text" name="city" class="form-control" value="<?php echo $user['city'] ?>" required/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">State</label>
                    <div class="col-sm-4">
                      <input type="text" name="state" class="form-control" value="<?php echo $user['state'] ?>" required/>
                    </div>
                    <label class="col-sm-2 col-form-label">Country</label>
                    <div class="col-sm-4">
                      <select id="inputState" class="form-control" name="inputCountry" required>
                        <option <?php if($user['country']=="Malaysia") echo 'selected'; ?>>Malaysia</option>
                        <option <?php if($user['country']=="Brunei") echo 'selected'; ?>>Brunei</option>
                        <option <?php if($user['country']=="Indonesia") echo 'selected'; ?>>Indonesia</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Postcode</label>
                    <div class="col-sm-4">
                      <input type="text" name="postcode" class="form-control" value="<?php echo $user['postcode'] ?>" required/>
                    </div>
                    <label class="col-sm-2 col-form-label">Mobile Phone</label>
                    <div class="col-sm-4">
                      <input type="text" name="phone" class="form-control" value="<?php echo $user['tel_no'] ?>" required/>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Bank Name</label>
                    <div class="col-sm-4">
                      <input type="text" name="bank_name" class="form-control" value="<?php echo $user['bank_name'] ?>"/>
                    </div>
                    <label class="col-sm-2 col-form-label">Bank Account Number</label>
                    <div class="col-sm-4">
                      <input type="text" name="bank_acc_number" class="form-control" value="<?php echo $user['bank_acc_num'] ?>"/>
                    </div>
                  </div>
                  <input type="hidden" value="profile_update" name="action" />
                  <button type="submit" id="bankDetailSave" class="btn btn-dark">
                    Save Details
                  </button>

                  </form>
                  
                </div>
              </div>
            </div>
            <?php include './includes/account-detail.php' ?>
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
    <script src="js/bank-details.js"></script>
  </body>
</html>
