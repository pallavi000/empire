<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper">
  <!-- Page Header Start-->
  <div class="page-main-header">
    <div class="main-header-right">
      <div class="main-header-left text-center">
        <div class="logo-wrapper"><a href><img src="images/logo.png" height="45" width="auto" alt></a></div>
      </div>
      <div class="mobile-sidebar">
        <div class="media-body text-right switch-sm">
          <label class="switch ml-3"><i class="font-primary" id="sidebar-toggle"
              data-feather="align-center"></i></label>
        </div>
      </div>
      <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar"> </i></div>
      <div class="nav-right col pull-right right-menu">
        <ul class="nav-menus">
          <li>
            <span class=" ">Current Date & Time:</span>
            <span class=" " id="date"></span>
          </li>

          <li>
            <span class="">Gold Price Today (RM):</span>
            <?php
              $gold = $db->prepare("SELECT * from gold_update");
              $gold->execute([]);
              $gold = $gold->fetch();
              ?>
            <span class="" id="priceGold">
              <?php echo $gold['gold_price'] ?>
            </span>
          </li>
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

          <li class="onhover-dropdown"> <span class="media user-header"><img class="img-fluid"
                src="assets/images/dashboard/user.png" alt></span>
            <ul class="onhover-show-div profile-dropdown">
              <li class="gradient-primary">
                <h5 class="f-w-600 mb-0">
                  <?php echo $user['full_name']; ?>
                </h5><span>
                  <?php echo $user['user_name'];?>
                </span>
              </li>
              <li><a href="profile.php"><i data-feather="user"> </i>Profile</a></li>

              <li><a href="logout.php"> <i data-feather="log-out"> </i>Logout</a> </li>
            </ul>
          </li>
        </ul>
        <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
      </div>
      <script id="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><i class="pe-7s-home"></i></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">{{name}}</div>
            </div>
            </div>
          </script>
      <script id="empty-template"
        type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
    </div>
  </div>
  <!-- Page Header Ends                              -->
  <!-- Page Body Start-->
  <div class="page-body-wrapper">

    <!-- Page Sidebar Start-->
    <div class="iconsidebar-menu">
      <div class="sidebar">
        <ul class="iconMenu-bar custom-scrollbar">
          <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-th"></i><span>Dashboard </span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class="iconbar-header">Dashboard</li>
              <li><a href="homepage.php">Dashboard</a></li>
              <li><a href="member-profile.php">Profile</a></li>
              <li><a href="member-account-setting.php">Account Setting</a></li>
            </ul>
          </li>
          <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-user"></i><span>Register</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class="iconbar-header sub-header">Register</li>
              <li><a href="new-member.php">New Register</a></li>
              <li><a href="member_reinvest.php">Reinvest</a></li>
            </ul>
          </li>
          <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-th-large"></i><span>Wallet</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class="iconbar-header">Wallet</li>
              <li><a href="eWallet.php">eWallet</a></li>
              <li><a href="personal_sales.php">Personal Sale</a></li>
              <li><a href="group_sales.php">Group Sale</a></li>
              <li><a href="pins.php">PINS</a></li>
            </ul>
          </li>
          <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-user-plus"></i><span>Transaction</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class="iconbar-header">Transaction</li>
              <li><a href="send_pins.php">Send PINS</a></li>
               <li><a href="send_ewallet_to_pins.php">Send eWallet to PINS</a></li>
                <li><a href="withdraw.php">Withdraw</a></li>
                 <li><a href="withdrawal_history.php">Withdraw History</a></li>
            </ul>
          </li>
          <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-th-large"></i><span>Redeem Gold</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class="iconbar-header">Redeem Gold</li>
              <li><a href="redeem-gold.php">Redeem</a></li>
            </ul>
          </li>
          <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-th-large"></i><span>Network</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class="iconbar-header">Netwaork</li>
              <li><a href="sponser_tree.php">Sponser Tree</a></li>
               <li><a href="genealogy.php">Genealogy</a></li>

            </ul>
          </li>
          <li><a class="bar-icons" href="logout.php"><i class="fa fa-sign-out"></i><span>Logout</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class="iconbar-header">Logout</li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </li>

        </ul>
      </div>

    </div>
    <!-- <div class="mt-5">
     
    </div> -->
