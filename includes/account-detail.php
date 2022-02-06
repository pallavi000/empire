<div class="col-md-12">
                <div class="text-center">
                  <img src="images/avatar/11.png" width="80" height="80" alt="" />
                </div>
                <div class="row mb-5" style="margin-top: 10px">
                  <div class="col text-center text-white btn btn-primary" >
                    <span>Account Status: <span id="status"><?php echo $user['user_status']; ?></span></span>
                  </div>
                </div>
                <table class="table table-xs mb-0">
                  <tbody>
                    <tr>
                      <td>
                        <i class="fa fa-user" style="padding-right: 10px"></i>Username
                      </td>
                      <td>
                        <span id="p-name" class="text-center m-0 pl-3"><?php echo $user['user_name']; ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <i class="fa fa-id-badge" style="padding-right: 10px"></i>Full Name
                      </td>
                      <td>
                        <span id="fullName" class="text-center m-0 pl-3"><?php echo $user['full_name']; ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <i class="fa fa-calendar" style="padding-right: 10px"></i>Joined
                      </td>
                      <td>
                        <span id="joinedDate" class="text-center m-0 pl-3"><?php echo $user['joined_date']; ?></span>
                      </td>
                    </tr>
                    <?php
                    $reinvest = $db->prepare("SELECT * from reinvest WHERE user_id=? ORDER By reinvest_date DESC");
                    $reinvest->execute([$user['user_id']]);
                    $reinvest_count = $reinvest->rowCount();
                    if($reinvest_count>0) {
                      $reinvests = $reinvest->fetchAll();
                      $last_reinvest_date = $reinvests[0]['reinvest_date'];
                    } else {
                      $last_reinvest_date = $user['joined_date'];
                    }
                    ?>
                    <tr>
                      <td>
                        <i class="fa fa-calendar" style="padding-right: 10px"></i>Reinvest Date
                      </td>
                      <td>
                        <span id="reinvestDate" class="text-center m-0 pl-3"><?php echo $last_reinvest_date; ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <i class="fa fa-calendar" style="padding-right: 10px"></i>Reinvest
                      </td>
                      <td>
                        <span id="reinvestTime" class="text-center m-0 pl-3"><?php echo $reinvest_count; ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <i class="fa fa-calendar" style="padding-right: 10px"></i>Expired
                      </td>
                      <td>
                        <span id="expiredDate" class="text-center m-0 pl-3"><?php echo $user['expired_date']; ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <i class="fa fa-diamond" style="padding-right: 10px"></i>Package
                      </td>
                      <td>
                        <?php
                          $package = $db->prepare('SELECT * from PACKAGES WHERE PACKAGES_ID=?');
                          $package->execute([$user['package_id']]);
                          $package = $package->fetch();
                        ?>
                        <span id="packageName" class="text-center m-0 pl-3"><?php echo $package['PACKAGES_NAME']; ?></span>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <i class="fa fa-money" style="padding-right: 10px"></i>Point Value
                      </td>
                      <td>
                        <span id="packageValue" class="text-center m-0 pl-3"><?php echo $package['PIN_VALUE']; ?></span>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div style="padding-top: 15px" class="col-12 text-center">
                <?php
                if(isset($_SESSION['admin_username'])) {
                  echo '<a href="profile.php">';
                } else {
                  echo '<a href="member-profile.php">';
                }
                ?>
                  <button class="btn btn-danger px-5">
                    <i style="padding-right: 5px" class="fa fa-edit"></i>Profile
                  </button>
                </a>
                </div>
                <div style="padding-top: 10px" class="col-12 text-center">
                <?php
                if(isset($_SESSION['admin_username'])) {
                  echo '<a href="account-setting.php">';
                } else {
                  echo '<a href="member-account-setting.php">';
                }
                ?>
                  <button class="btn btn-danger px-5">
                    <i style="padding-right: 5px" class="fa fa-lock"></i>Password
                  </button>
                </a>
                </div>

                <!-- <div style="padding-top: 10px" class="col-12 text-center">
                  <a href="./logout.php">
                    <button class="btn btn-danger px-5">
                      <i style="padding-right: 5px" class="fa fa-lock"></i>Logout
                    </button>
                  </a>
                </div> -->

                <h6 style="padding-top: 10px" class="text-danger">
                  Sponser by:
                </h6>

                <p id="sponsorBy" style="
                        border: 1px solid #ced4da;
                        padding-left: 20px;
                        text-align: center;
                      "><i style="padding-right: 5px" class="icon-user-follow"></i>
                      <?php echo $user['sponser_by']; ?>
                </p>

                <h6 style="padding-top: 10px" class="text-danger">
                  Refferal Link:
                </h6>
                <div>
                  <p id="refferal">https://empiregold.com/<?php echo $user['user_name']; ?></p>

                  <div style="padding-top: 10px" class="col-12 text-center">
                    <button onclick="copyLink()" class="btn btn-danger px-5">
                      <i style="padding-right: 5px" class="fa fa-copy"></i>Copy
                      Link
                    </button>
                    <script>
                      function copyLink() {
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
