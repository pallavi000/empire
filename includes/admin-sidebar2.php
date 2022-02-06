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
                <span id='username' class="text-darker"></span>
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
                      <a href="profile.html"><i class="icon-user"></i> <span>Profile</span></a>
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
<div class="nk-sidebar">
      <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
          <li class="nav-label">Dashboard</li>
          <li>
            <a href="admin-homepage.php" aria-expanded="false">
              <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
            </a>
          </li>
          <li class="mega-menu mega-menu-sm">
            <a href="admin_register_member.php" aria-expanded="false">
              <i class="icon-user menu-icon"></i><span class="nav-text">Register</span>
            </a>

          </li>

          <li>
            <a href="admin-transaction-request.php" aria-expanded="false">
              <i class="icon-grid menu-icon"> </i><span class="nav-text">Transaction Request</span>
            </a>

          </li>
          <li>
            <a href="admin-registration-request.php" aria-expanded="false">
              <i class="icon-user-follow"></i><span class="nav-text">Registration Request</span>
            </a>

          </li>
          <li>
            <a href="admin_send_pins.php" aria-expanded="false">
              <i class="icon-grid menu-icon"> </i><span class="nav-text">Send Pins</span>
            </a>

          </li>
          <li>
            <a href="admin-all-transaction.php" aria-expanded="false">
              <i class="icon-grid menu-icon"> </i><span class="nav-text">All Transaction</span>
            </a>

          </li>

          <li>
            <a href="logout.php" aria-expanded="false">
            <i class="icon-logout menu-icon"></i><span class="nav-text">Logout</span>
            </a>

          </li>




        </ul>
      </div>
    </div>