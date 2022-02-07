<?php
include('./user_auth.php');
include './includes/header.php'
?>

<?php include './includes/user-sidebar.php'; ?>

<div class="page-body pt-5">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-xl-7">
        <div class="row">
          <div class="col-sm-12 col-xl-12">
            <div class="card">
              <div class="card-body">
                <div class="basic-form">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label class="text-danger">Sponsor By</label>
                      <input id="userName" type="text" class="form-control" value="<?php echo $user['sponser_by']; ?>"
                        readonly />
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label class="text-danger">Refferal Link</label>
                      <p id="refferal">https://empiregold.com/
                        <?php echo $user['user_name']; ?>
                      </p>
                    </div>
                    <div class="form-group">
                      <div style="padding-top: 10px" class="col-12 text-center">
                        <button onclick="copyRefLink()" class="btn btn-danger">
                          <i style="padding-right: 5px" class="fa fa-copy"></i>Copy Link
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
          </div>
          <div class="col-sm-12 col-xl-12">

            <div class="card">
              <div class="card-body">

                <form action="member-query-updates.php" class="form theme-form" method="POST">
                  <h4 class="card-title text-danger">Particulars</h4>
                  <div class="form-group row">
                    <div class="col">
                      <label class=" col-form-label">National/Passport ID</label>
                      <input type="text" class="form-control" />
                    </div>
                    <div class="col"></div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label class="col-form-label">Full Name</label>

                      <input type="text" class="form-control" name="fullName" value="<?php echo $user['full_name'] ?>"
                        required />
                    </div>
                    <div class="col">
                      <label class="col-form-label">Email Address</label>

                      <input type="email" name="email" class="form-control" value="<?php echo $user['EMAIL'] ?>"
                        required />
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label class=" col-form-label">Address Street</label>

                      <textarea class="form-control h-150px" rows="6" id="comment" name="address"
                        required><?php echo $user['address_no']; ?></textarea>
                    </div>
                    <div class="col">
                      <label class=" col-form-label">City</label>

                      <input type="text" name="city" class="form-control" value="<?php echo $user['city'] ?>"
                        required />
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label class=" col-form-label">State</label>

                      <input type="text" name="state" class="form-control" value="<?php echo $user['state'] ?>"
                        required />
                    </div>
                    <div class="col">
                      <label class="col-form-label">Country</label>

                      <select id="inputState" class="form-control" name="inputCountry" required>
                        <option <?php if($user['country']=="Malaysia" ) echo 'selected' ; ?>>Malaysia</option>
                        <option <?php if($user['country']=="Brunei" ) echo 'selected' ; ?>>Brunei</option>
                        <option <?php if($user['country']=="Indonesia" ) echo 'selected' ; ?>>Indonesia</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label class="col-form-label">Postcode</label>

                      <input type="text" name="postcode" class="form-control" value="<?php echo $user['postcode'] ?>"
                        required />
                    </div>
                    <div class="col">
                      <label class="col-form-label">Mobile Phone</label>

                      <input type="text" name="phone" class="form-control" value="<?php echo $user['tel_no'] ?>"
                        required />
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label class="col-form-label">Bank Name</label>

                      <input type="text" name="bank_name" class="form-control"
                        value="<?php echo $user['bank_name'] ?>" />
                    </div>
                    <div class="col">
                      <label class="col-form-label">Bank Account Number</label>

                      <input type="text" name="bank_acc_number" class="form-control"
                        value="<?php echo $user['bank_acc_num'] ?>" />
                    </div>
                  </div>
                  <input type="hidden" value="profile_update" name="action" />
                  <button type="submit" id="bankDetailSave" class="btn btn-primary">
                    Save Details
                  </button>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-xl-5">
        <div class="card">

          <div class="card-body">
            <?php include './includes/account-detail.php' ?>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<?php include './includes/footer.php' ?>