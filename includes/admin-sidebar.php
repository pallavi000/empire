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
            <span class="text-dark ">Current Date & Time:</span>
            <span class="text-dark " id="date"></span>
          </li>

          <li>
            <span class="text-dark">Gold Price Today (RM):</span>
            <?php
              $gold = $db->prepare("SELECT * from gold_update");
              $gold->execute([]);
              $gold = $gold->fetch();
              ?>
            <span class="text-dark" id="priceGold">
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
              <li><a href="admin-homepage.php">Dashboard</a></li>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="account-setting.php">Account Setting</a></li>

            </ul>
          </li>
          <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-user"></i><span>Register</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class="iconbar-header sub-header">Register</li>
              <li><a href="admin_register_member.php">Register</a></li>
            </ul>
          </li>
          <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-th-large"></i><span>Transaction
                Request</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class="iconbar-header">Transaction Request</li>
              <li><a href="admin-transaction-request.php">Transaction Request </a></li>
            </ul>
          </li>
          <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-user-plus"></i><span>Registration
                Request</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class="iconbar-header">Registration Request</li>
              <li><a href="admin-registration-request.php">Registration Request</a></li>
            </ul>
          </li>
          <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-th-large"></i><span>Send Pins</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class="iconbar-header">Send Pins</li>
              <li><a href="admin_send_pins.php">Send Pins</a></li>
            </ul>
          </li>
          <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-th-large"></i><span>All
                Transaction</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class="iconbar-header">All Transaction</li>
              <li><a href="admin-all-transaction.php">All Transaction</a></li>
            </ul>
          </li>
          <li><a class="bar-icons" href="javascript:void(0)"><i class="fa fa-sign-out"></i><span>Logout</span></a>
            <ul class="iconbar-mainmenu custom-scrollbar">
              <li class="iconbar-header">Logout</li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </li>

        </ul>
      </div>

    </div>
 <div class=" pt-5 "></div>






    <!-- Page Sidebar Ends-->