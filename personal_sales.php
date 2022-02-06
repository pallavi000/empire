<?php
include_once('user_auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Empire Gold</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png">
    <!-- Custom Stylesheet -->
    <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
     <!---Font Awsome-->
     <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
   />
   <script
     src="https://kit.fontawesome.com/a076d05399.js"
     crossorigin="anonymous"
   ></script>
   <script src="js/personal-sales.js"></script>

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
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <h2 class="card-title">Personal Sales</h2>
                                <?php
                                $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
                                $wallet->execute([$user['user_id']]);
                                $wallet = $wallet->fetch();
                                ?>
                                <h4 class="text-danger">Wallet Balance: RM <span id="walletBalance"><?php echo $wallet['WALLET_BALANCE'] ?></span></h4>
                                <div class="table-responsive">
                                    <table id="personalList" class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Details</th>
                                                <th>Amount</th>
                                                <th>Balance After(RM)</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                            $personal_sales = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE user_id=? AND type=? AND Level=?");
                                            $personal_sales->execute([$user['user_id'], 'B', 1]);
                                            while($row=$personal_sales->fetch()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['TRANS_ID'] ?></td>
                                                <td><?php echo $row['details'] ?></td>
                                                <td><?php echo $row['AMOUNT'] ?></td>
                                                <td><?php echo $row['balance'] ?></td>
                                                <td><?php echo $row['CREATED_DATE'] ?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                           
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
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
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
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
    <script>
      $(document).ready(function() {
          $('#personalList').DataTable({
            "aaSorting": [[ 0, "desc" ]]
          });
         
      });
    </script>
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

    <script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
    <script src="js/personal-sales.js"></script>

</body>

</html>