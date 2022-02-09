<?php
include('user_auth.php');
include './includes/header.php';
?>


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


<?php include './includes/user-sidebar.php'; ?>
<!--**********************************
            Sidebar end
        ***********************************-->

<!--**********************************
            Content body start
        ***********************************-->
<div class="page-body pt-5">

  <div class="container-fluid">
    <form method="POST" action="member-register.php" class="form theme-form ">
      <div class="row">
        <div class="col-sm-12 col-xl-12">
          <div class="card">
            <div class="card-header">
              <h5>Network & Package</h5>
            </div>
            <div class="card-body">
              <div class="form-group row">
                <div class="col">
                  <label class="text-danger">Sponsor By</label>

                  <input id="sponsorBy" name="sponsorBy" type="text" class="form-control"
                    value="<?php echo $user['user_name'] ?>" required readonly />
                </div>
                <div class="col"></div>
              </div>

              <?php
                                      $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
                                      $wallet->execute([$user['user_id']]);
                                      $wallet = $wallet->fetch();
                                      ?>

              <input type="hidden" class="wallet_balance" value="<?php echo $wallet['PIN_VALUE'] ?>" />
              <div class="form-group row">
                <div class="col">
                  <label class="col-form-label">Package</label>

                  <select id="inputPlan" name="inputPlan" class="form-control" required>
                    <option disabled selected>Select Plan</option>
                    <?php
                                              include "./connection.php";  // Using database connection file here
                                              $sql = "select * from PACKAGES";  
                                              $result = mysqli_query($con, $sql);  
                                              // $records = mysqli_query($db, "SELECT PACKAGES_NAME From PACKAGES");  // Use select query here 
                                              while($data = mysqli_fetch_array($result))
                                              {
                                                  echo "<option value='". $data['PACKAGES_ID'] ."' package_price='".$data['PACKAGES_PRICE']."' pinvalue='".$data['PIN_VALUE']."'>" .$data['PACKAGES_NAME'] ."</option>";  // displaying data in option menu
                                              }	
                                          ?>
                  </select>
                </div>
                <div class="col">

                </div>

              </div>
              <div class="form-group row">
                <div class="col">
                  <label class="col-form-label">POINT VALUE</label>

                  <input id="pins" type="text" name="point" class="form-control" readonly required />
                </div>
                <div class="col"></div>

              </div>
              <div class="form-group row error-point" style="display: none;">
                <div class="col-sm-12">
                  <div class="alert alert-danger error-point-message"></div>
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
                <div class="col-md-6 col-sm-12">
                  <label class="col-form-label">Username</label>

                  <input id="user_name" name="username" type="text" class="form-control" onblur="checkUsername()"
                    required="required" />

                  <label id="checkingUsername"></label>
                </div>
                <div class="col-md-6 col-sm-12">
                  <label class="col-form-label">Password</label>
                  <input id="password" name="password" type="password" class="form-control" onfocus="checkPassword()"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required="required" />
                  <!-- An element to toggle between password visibility -->
                  <input type="checkbox" class="ml-3" onclick="showPassword()">
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
                <div class="col-md-6 col-sm-12">
                  <label class=" col-form-label">National/Passport ID</label>

                  <input id="nationalID" type="text" class="form-control" required="required" />
                </div>
                <div class="col-md-6 col-sm-12"></div>
              </div>
              <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                  <label class="col-form-label">Full Name</label>

                  <input id="fullName" name="fullName" type="text" class="form-control" required="required" />
                </div>
                <div class="col-md-6 col-sm-12">
                  <label class="col-form-label">Email Address</label>

                  <input id="email" name="email" type="text" class="form-control" required="required" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                  <label class="col-form-label">Address Street</label>

                  <textarea class="form-control h-150px" rows="6" name="address" id="address"
                    required="required"></textarea>
                </div>
                <div class="col-md-6 col-sm-12">
                  <label class="col-form-label">City</label>

                  <input id="city" name="city" type="text" class="form-control" required="required" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                  <label class="col-form-label">State</label>

                  <input id="state" name="state" type="text" class="form-control" required="required" />
                </div>
                <div class="col-md-6 col-sm-12">
                  <label class="col-form-label">Country</label>

                  <select id="inputCountry" name="inputCountry" class="form-control">
                    <option selected="selected">Malaysia</option>
                    <option>Brunei</option>
                    <option>Indonesia</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                  <label class="col-form-label">Postcode</label>

                  <input id="postcode" name="postcode" type="text" class="form-control" required="required" />
                </div>
                <div class="col-md-6 col-sm-12">
                  <label class="col-form-label">Mobile Phone</label>

                  <input id="phone" name="phone" type="text" class="form-control" required="required" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6 col-sm-12">
                  <label class="col-form-label">Secret Key</label>

                  <input id="secretkey" name="secretkey" type="text" class="form-control" />
                </div>
                <div class="col-md-6 col-sm-12">
                  <label class=" col-form-label">Join Date</label>

                  <input id="joinDate" name="joinDate" type="date" class="form-control" required="required" />
                </div>
              </div>
              <input value="Register" type="submit" id="btn" class="btn btn-primary w-100" />
            </div>
          </div>
        </div>

      </div>
    </form>
  </div>

</div>









<!--**********************************
            Content body end
        ***********************************-->

<!--**********************************
            Footer start
        ***********************************-->

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
    if (parseInt(package_price) > parseInt(wallet_balance)) {
      $('.error-point').show();
      $('.error-point-message').html('Your Pin Value is low. Your Pin Value: ' + wallet_balance + '. Package Price: ' + package_price)
    } else {
      $('.error-point').hide();
      $('.error-point-message').html()
    }
  });

</script>
<script src="js/member-register.js"></script>
<?php include './includes/footer.php'?>