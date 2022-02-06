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
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script
      src="https://kit.fontawesome.com/a076d05399.js"
      crossorigin="anonymous"
    ></script>

   <script src="js/member-register.js"></script>

   <style>
    /* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 15px;
  margin-top: 5px;
}

#message p {
  padding: 10px 35px;
  font-size: 16px;
  margin-bottom: 0px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -20px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -20px;
  content: "✖";
}

  </style>

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
        <form method="POST" action="member-register.php" >
          <div class="row">
            <div class="col-lg-12">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-danger">Network & Package</h4>
                    <div class="basic-form">

                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label class="text-danger">Sponsor By</label>
                          
                          <input id="sponsorBy" name="sponsorBy" type="text" class="form-control" value="<?php echo $user['user_name'] ?>" required readonly/>
                        </div>
                      </div>

                      <?php
                        $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
                        $wallet->execute([$user['user_id']]);
                        $wallet = $wallet->fetch();
                        ?>
                        <input type="hidden" class="wallet_balance" value="<?php echo $wallet['PIN_VALUE'] ?>" />

                      <div class="form-group row">
                        <label class="col-sm-1 col-form-label">Package</label>
                        <div class="col-sm-4">
                          <select id="inputPlan" name="inputPlan"class="form-control" required>
                          <option disabled selected>Select Plan</option>
    <?php
        include "./connection.php";  // Using database connection file here
        $sql = "select * from PACKAGES";  
        $result = mysqli_query($con, $sql);  
        // $records = mysqli_query($db, "SELECT PACKAGES_NAME From PACKAGES");  // Use select query here 
echo 'hi';
        while($data = mysqli_fetch_array($result))
        {
            echo "<option value='". $data['PACKAGES_ID'] ."' package_price='".$data['PACKAGES_PRICE']."' pinvalue='".$data['PIN_VALUE']."'>" .$data['PACKAGES_NAME'] ."</option>";  // displaying data in option menu
        }	
    ?>  
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-1 col-form-label">POINT VALUE</label>
                        <div class="col-sm-4">
                          <input id="pins" type="text" name="point" class="form-control" readonly required/>
                        </div>
                        
                      </div>
                      <div class="form-group row error-point" style="display: none;">
                        <div class="col-sm-12">
                            <div class="alert alert-danger error-point-message"></div>
                          </div>
                        </div>

                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-danger">Account Details</h4>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Username</label>
                      <div class="col-sm-4">
                        <input id="user_name" name="username" type="text" class="form-control" onblur="checkUsername()" required="required"/>
                        <label id="checkingUsername"></label>
                      </div>
                      <label class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-4">
                        <input id="password" name="password" type="password" class="form-control" onfocus="checkPassword()" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required="required"/>
                        <!-- An element to toggle between password visibility -->
                        <input type="checkbox" onclick="showPassword()">
                        <label style="padding-left:5px" class="col-form-label">Show Password</label>
                        <div id="message">
                          <h5>Password must contain the following:</h3>
                          <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                          <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                          <p id="number" class="invalid">A <b>number</b></p>
                          <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-danger">Particulars</h4>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">National/Passport ID</label>
                      <div class="col-sm-4">
                        <input id="nationalID" type="text" class="form-control"  required="required"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Full Name</label>
                      <div class="col-sm-4">
                        <input id="fullName" name="fullName" type="text" class="form-control" required="required"/>
                      </div>
                      <label class="col-sm-2 col-form-label">Email Address</label>
                      <div class="col-sm-4">
                        <input id="email" name="email"type="text" class="form-control" required="required"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Address Street</label>
                      <div class="col-sm-4">
                        <textarea class="form-control h-150px" rows="6" name="address"id="address" required="required"></textarea>
                      </div>
                      <label class="col-sm-2 col-form-label">City</label>
                      <div class="col-sm-4">
                        <input id="city" name="city" type="text" class="form-control" required="required"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">State</label>
                      <div class="col-sm-4">
                        <input id="state" name="state"type="text" class="form-control" required="required"/>
                      </div>
                      <label class="col-sm-2 col-form-label">Country</label>
                      <div class="col-sm-4">
                        <select id="inputCountry" name="inputCountry" class="form-control">
                          <option selected="selected">Malaysia</option>
                          <option>Brunei</option>
                          <option>Indonesia</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Postcode</label>
                      <div class="col-sm-4">
                        <input id="postcode" name="postcode"type="text" class="form-control" required="required"/>
                      </div>
                      <label class="col-sm-2 col-form-label">Mobile Phone</label>
                      <div class="col-sm-4">
                        <input id="phone" name="phone"type="text" class="form-control" required="required"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Secret Key</label>
                      <div class="col-sm-4">
                        <input id="secretkey" name="secretkey"type="text" class="form-control" />
                      </div>
                      <label class="col-sm-2 col-form-label">Join Date</label>
                      <div class="col-sm-4">
                        <input id="joinDate" name="joinDate"type="date" class="form-control" required="required"/>
                      </div>
                    </div>
                    <input value="Register"type="submit" id="btn" class="btn login-form__btn submit w-100"/>

                    
                    
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
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
   
    <script>
     
      $("#inputPlan").on("change", function () {
        const wallet_balance = document.querySelector('.wallet_balance').value
        const selectPlan = $(this).value
        const pin_value = $(this).find(':selected').attr('pinvalue')
        const package_price = $(this).find(':selected').attr('package_price')
        var p = pin_value;
        var i = document.getElementById("pins");
        i.value = p;
        if(parseInt(package_price)>parseInt(wallet_balance)) {
          $('.error-point').show();
          $('.error-point-message').html('Your Pin Value is low. Your Pin Value: '+wallet_balance+'. Package Price: '+package_price)
        } else {
          $('.error-point').hide();
          $('.error-point-message').html()
        }
      });


    </script>
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="js/member-register.js"></script>
  </body>
</html>
