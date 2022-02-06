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
     <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
                      <h4 class="card-title text-danger">Package Reinvest</h4>
                      <div class="basic-form">
                          <form method="POST" action="member-query-updates.php">
                          
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">PINS Balance</label>
                                  <div class="col-sm-5">
                                      <?php
                                      $query = $db->prepare("SELECT * from WALLET where USER_ID=?");
                                      $query->execute([$user['user_id']]);
                                      $wallet = $query->fetch();
                                      $query = $db->prepare("SELECT * from PACKAGES WHERE PACKAGES_ID=?");
                                      $query->execute([$user['package_id']]);
                                      $package = $query->fetch();
                                      $query = $db->prepare("SELECT * from PACKAGES WHERE PACKAGES_PRICE>=?");
                                      $query->execute([$package['PACKAGES_PRICE']]);
                                      $packages = $query->fetchAll();
                                      ?>
                                      <input id="pins" name="pin_value" readonly="readonly" class="form-control-plaintext text-danger" value="<?php echo $wallet['PIN_VALUE'] ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Member</label>
                                  <div class="col-sm-5">
                                    <input type="hidden" name="member" value="<?php echo $user['user_id'] ?>" readonly required />
                                    <input type="text" class="form-control" value="<?php echo $user['user_name'] ?>" readonly />
                                    
                                  </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Sponsor</label>
                                <div class="col-sm-5">
                                <input type="text" name="sponser_by" readonly="readonly"class="form-control" value="<?php echo $user['sponser_by'] ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Current Package</label>
                            <div class="col-sm-5">
                            <input id="currentPackage" name="current_package" readonly="readonly" class="form-control" value="<?php echo $package['PACKAGES_NAME'] ?>" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Reinvest Package</label>
                            <div class="col-sm-5">
                            <select id="inputPlan" name="package" class="form-control" required>
                              <?php
                              foreach($packages as $value) {
                                echo '<option value="'.$value["PACKAGES_ID"].'">'.$value['PACKAGES_NAME'].'</option>';
                              }
                              ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Payment Method</label>
                            <div class="col-sm-5">
                            <select id="inputState" class="form-control">
                                <option selected="selected">Using PINS</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-5">
                                <input type="text" readonly="readonly"class="form-control" value="<?php echo Date('Y-m-d') ?>"/>
                            </div>
                            </div>
                              <div class="extra_data"></div>
                              <input type="hidden" name="action" value="reinvest"/>
                              <button id="reinvest" type="submit" class="btn btn-dark">
                                Reinvest
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
    <script>
        function getPackages(packages) {
            console.log(packages)
            let ele = ''
            packages.forEach(package=>{
                ele += `<option value="${package.PACKAGES_ID}">${package.PACKAGES_NAME}</option>`
            })
            return ele;
        }

        document.querySelector('.member_select').addEventListener('change', (e)=>{
            const user_id = e.target.value;
            const ele = document.querySelector('.extra_data')
            if(user_id) {
                let form_data = {
                    user_id,
                    action: "reinvest_init"
                }
                axios.post("./member-query-updates.php", form_data).then(res=>{
                    const data = res.data
                    let content = `
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Current Package</label>
                            <div class="col-sm-5">
                            <input id="currentPackage" name="current_package" readonly="readonly" class="form-control" value="${data.current_package.PACKAGES_NAME}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Reinvest Package</label>
                            <div class="col-sm-5">
                            <select id="inputPlan" name="package" class="form-control" required>
                            ${getPackages(data.packages)}
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Payment Method</label>
                            <div class="col-sm-5">
                            <select id="inputState" class="form-control">
                                <option selected="selected">Using PINS</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-5">
                                <input type="text" readonly="readonly"class="form-control" value="2021-10-08"/>
                            </div>
                            </div>`;
                        ele.innerHTML = content  
                })
            } else {
                ele.innerHTML = ''
            }
            
        })
        
    </script>
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="js/member_reinvest.js"></script>
   
  </body>

</html>
