<?php
include('./admin_auth.php');
?>
<?php include './includes/header.php'?>
<style>
  /* The message box is shown when the user clicks on the password field */
  #message {
    display: none;
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
<!-- </head>

<body> -->
<!--*******************
        Preloader start
    ********************-->
<!-- <div id="preloader">
    <div class="loader">
      <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
      </svg>
    </div>
  </div> -->
<!--*******************
        Preloader end
    ********************-->

<!--**********************************
        Main wrapper start
    ***********************************-->
<!-- <div id="main-wrapper"> -->
<!--**********************************
            Nav header start
        ***********************************-->
<!-- <div class="nav-header">
      <div class="brand-logo">
        <a href="homepage.html">
          <span class="brand-title">
            <img src="images/logo.png" alt="">
          </span>
        </a>
      </div>
    </div> -->
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
<?php include './includes/admin-sidebar.php' ?>
<!--**********************************
            Sidebar end
        ***********************************-->

<!--**********************************
            Content body start
        ***********************************-->
<div class="page-body pt-5">

  <div class="container-fluid">
    <div class="row">
      <form method="POST" action="admin-register.php" class="form theme-form w-100">
        <div class="col-sm-12 col-xl-12">
          <div class="card">
            <div class="card-header">
              <h5>Network & Package</h5>
            </div>
            <div class="card-body">


              <div class="form-row">
                <div class="form-group col-md-6">
                  <label class="text-danger">Sponsor By</label>
                  <select id="sponsorBy" name="sponsorBy" class="form-control" required>
                    <?php
                                            $q = $db->prepare("SELECT * from USER_TABLE");
                                            $q->execute([]);
                                            while($row=$q->fetch()) {
                                              echo "<option value='".$row['user_name']."'>".$row['user_name']."</option>";
                                            }
                                          ?>
                  </select>
                  <!--                           <input id="sponsorBy" name="sponsorBy"type="text" class="form-control" />
               -->
                </div>
              </div>



              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Package</label>
                <div class="col-sm-5">
                  <select id="inputPlan" name="inputPlan" class="form-control" required>
                    <option disabled selected>Select Plan</option>
                    <?php
                      include "./connection.php";  // Using database connection file here
                      $sql = "select * from PACKAGES";  
                      $result = mysqli_query($con, $sql);  
                      // $records = mysqli_query($db, "SELECT PACKAGES_NAME From PACKAGES");  // Use select query here 
              echo 'hi';
                      while($data = mysqli_fetch_array($result))
                      {
                          echo "<option value='". $data['PACKAGES_ID'] ."' pinvalue='".$data['PIN_VALUE']."'>" .$data['PACKAGES_NAME'] ."</option>";  // displaying data in option menu
                      }	
                  ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">POINT VALUE</label>
                <div class="col-sm-5">
                  <input id="pins" type="text" name="point" class="form-control" readonly required />
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-sm-12 col-xl-12">
          <div class="card">
            <div class="card-header">
              <h5>Account Details</h5>
            </div>
            <div class="card-body">
              <div class="form-group row">
                <div class="col">
                  <label class="col-form-label">Username</label>

                  <input id="username2" name="username" type="text" class="form-control" onblur="checkUsername()"
                    required="required" />
                  <label id="checkingUsername"></label>
                </div>
                <div class="col">
                  <label class=" col-form-label">Password</label>
                  <input id="password" name="password" type="password" class="form-control" onfocus="checkPassword()"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required="required" />

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
        <div class="col-sm-12 col-xl-12">
          <div class="card">
            <div class="card-header">
              <h5>Particulars</h5>
            </div>
            <div class="card-body">
              <div class="form-group row">
                <div class="col">
                  <label class="col-form-label">National/Passport ID</label>
                  <input id="nationalID" type="text" class="form-control" required="required" />
                </div>
                <div class="col"></div>
              </div>
              <div class="form-group row">
                <div class="col">
                  <label class=" col-form-label">Full Name</label>

                  <input id="fullName" name="fullName" type="text" class="form-control" required="required" />
                </div>
                <div class="col">
                  <label class="col-form-label">Email Address</label>
                  <input id="email" name="email" type="text" class="form-control" required="required" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col">
                  <label class=" col-form-label">Address Street</label>
                  <textarea class="form-control h-150px" rows="6" name="address" id="address"
                    required="required"></textarea>
                </div>
                <div class="col">
                  <label class=" col-form-label">City</label>
                  <input id="city" name="city" type="text" class="form-control" required="required" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col">
                  <label class=" col-form-label">State</label>
                  <input id="state" name="state" type="text" class="form-control" required="required" />
                </div>
                <div class="col">
                  <label class="col-form-label">Country</label>
                  <select id="inputCountry" name="inputCountry" class="form-control">
                    <option selected="selected">Malaysia</option>
                    <option>Brunei</option>
                    <option>Indonesia</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col">
                  <label class="col-form-label">Postcode</label>

                  <input id="postcode" name="postcode" type="text" class="form-control" required="required" />
                </div>
                <div class="col">
                  <label class=" col-form-label">Mobile Phone</label>

                  <input id="phone" name="phone" type="text" class="form-control" required="required" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col">
                  <label class="col-form-label">Secret Key</label>
                  <input id="secretkey" name="secretkey" type="text" class="form-control" />
                </div>
                <div class="col">
                  <label class="col-form-label">Join Date</label>
                  <input id="joinDate" name="joinDate" type="date" class="form-control" required="required" />
                </div>
              </div>
              <button class="btn btn-primary w-100 btn-lg" type="submit">Register</button>
              <div class="form-group row" style="padding-top: 10px;">
                <div class="col">
                  <label class=" col-form-label text-danger">For Bulk Registration</label>

                  <input id="fileUpload" type="file" class="form-control" />
                </div>
                <div class="col">
                  <label class="col-form-label text-danger">&nbsp;</label>
                  <button type="button" onclick="upload()" class="btn btn-dark d-block">Upload</button>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    </form>
  </div>
</div>
</div>
<script src="js/admin-register.js"></script>
<?php
            
include('./includes/footer.php');
?>
<!-- </div> -->
<!-- #/ container -->
<!-- </div> -->
<!--**********************************
            Content body end
        ***********************************-->

<!--**********************************
            Footer start
        ***********************************-->
<!-- <div class="footer">
          <div class="copyright">
            <p>Copyright &copy;2021 - Empire Gold - All Rights Reserved</p>
          </div>
        </div> -->
<!--**********************************
            Footer end
        ***********************************-->
<!-- </div> -->
<!--**********************************
        Main wrapper end
    ***********************************-->

<!--**********************************
        Scripts
    ***********************************-->


<!-- <script src="plugins/common/common.min.js"></script>
  <script src="js/custom.min.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/gleek.js"></script>
  <script src="js/styleSwitcher.js"></script>
  <script src="js/admin-register.js"></script>
</body>

</html> -->