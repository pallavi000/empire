
    <!-- Page Sidebar Ends-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<div class="header">
      <div class="header-content clearfix">
        <div class="header-left">
          <ul class="clearfix">
            <li style="padding-top: 25px">
              <span class="text-dark">Current Date & Time:</span>
              <span class="text-dark" id="date"></span>
            </li>
            <li>
              <span class="text-dark">Gold Price Today (RM):</span>
              <?php
              $gold = $db->prepare("SELECT * from gold_update");
              $gold->execute([]);
              $gold = $gold->fetch();
              ?>
              <span class="text-dark" id="priceGold"><?php echo $gold['gold_price'] ?></span>
            </li>
          </ul>
          <script>
            n = new Date();
            year = n.getFullYear();
            month = n.getMonth() + 1;
            date = n.getDate();
            hour = n.getHours();
            minutes = n.getMinutes();
            seconds = n.getSeconds();
            document.getElementById("date").innerHTML = n;
          </script>
        </div>
        <div class="header-right">
          <ul class="clearfix">
            <li class="icons dropdown d-none d-md-flex" style="padding-right: 40px">
              <a href="javascript:void(0)" class="log-user" data-toggle="dropdown">
                <span>English</span>
                <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
              </a>
              <div class="
                    drop-down
                    dropdown-language
                    animated
                    fadeIn
                    dropdown-menu
                  ">
                <div class="dropdown-content-body">
                  <ul>
                    <li><a href="javascript:void()">English</a></li>
                    <li><a href="javascript:void()">Dutch</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li style="padding-right: 40px" class="icons dropdown">
              <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                <!-- <img src="images/user/1.png" height="40" width="40" alt="" /> -->
                <span id="username" class="text-darker"></span>
              </div>
              <div class="
                    drop-down
                    dropdown-profile
                    animated
                    fadeIn
                    dropdown-menu
                  ">
                <div class="dropdown-content-body">
                  <h5 style="padding-left: 10px" class="text-danger">
                    Welcome!
                  </h5>
                  <ul>
                    <li>
                      <a href="app-profile.html"><i class="icon-user"></i> <span>Profile</span></a>
                    </li>
                    <li>
                      <a href="account-setting.html">
                        <i class="icon-settings"></i>
                        <span>Security Settings</span>
                      </a>
                    </li>
                    <li>
                      <a href="bank-details.html"><i class="icon-credit-card"></i>
                        <span>Banking/Payment</span></a>
                    </li>

                    <hr class="my-2" />

                    <li>
                      <a href="page-login.html"><i class="icon-key"></i> <span>Logout</span></a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
          </ul>

        </div>

      </div>
    </div>

    <?php
    $today = Date("Y-m-d H:i:s");
    $about_to_expire = date('Y-m-d H:i:s', strtotime($user['expired_date']. ' - 2 days'));
    if($today>$user['expired_date']) {
      echo '<div class="header mb-0" style="background-color: transparent;">
      <div class="alert alert-danger mt-5">Your Plan is expired. Please reinvest to continue.</div>
    </div>';
    } elseif($today>$about_to_expire) {
      echo '<div class="header mb-0" style="background-color: transparent;">
      <div class="alert alert-danger mt-5">Your Plan is about to expire in 2 days. Please reinvest to continue.</div>
    </div>';
    }
    ?>


    <div class="nk-sidebar">
      
      <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
          <li class="nav-label">Dashboard</li>
          <li>
            <a href="homepage.php" aria-expanded="false">
              <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
            </a>
          </li>
          <li class="mega-menu mega-menu-sm">
            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
              <i class="icon-user menu-icon"></i><span class="nav-text">Register/Upgrade</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="./new-member.php">New Register</a></li>
              <li><a href="./member_reinvest.php">Reinvest</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
              <i class="icon-wallet menu-icon"></i>
              <span class="nav-text">Wallet</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="./eWallet.php">eWallet</a></li>
              <li><a href="./personal_sales.php">Personal Sale</a></li>
              <li><a href="./group_sales.php">Group Sale</a></li>
              <li><a href="./pins.php">PINS</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
              <i class="icon-grid menu-icon"> </i><span class="nav-text">Transaction</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="./send_pins.php">Send PINS</a></li>
              <li>
                <a href="./send_ewallet_to_pins.php">Send eWallet to PINS</a>
              </li>
              <li><a href="withdraw.php">Withdraw</a></li>
              <li>
                <a href="./withdrawal_history.php">Withdraw History</a>
              </li>
            </ul>
          </li>
          <!-- <li>
            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
              <i class="icon-diamond menu-icon"></i>
              <span class="nav-text">Plan</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="./member_reinvest.php">Reinvest</a></li>
            </ul>
          </li> -->
          <li>
            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
              <i class="icon-present menu-icon"></i>
              <span class="nav-text">Redeem Gold</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="redeem-gold.php">Redeem</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
              <i class="icon-people menu-icon"></i><span class="nav-text">Network</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="./sponser_tree.php">Sponsor Tree</a></li>
              <li><a href="./genealogy.php">Genealogy</a></li>
            </ul>
          </li>
          <li>
            <a href="./logout.php"><i class="icon-logout menu-icon"></i><span class="nav-text">Logout</span></a>
          </li>
          <!-- <li>
            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
              <i class="icon-doc menu-icon"></i><span class="nav-text">Report</span>
            </a>
            <ul aria-expanded="false">
              <li><a href="./bonus_sponsor.html">Bonus Sponsor</a></li>
              <li><a href="./bonus_unilevel.html">Bonus Unilevel</a></li>
            </ul>
          </li> -->
          
        </ul>
      </div>
    </div>