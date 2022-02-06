<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>
    Empire Gold
  </title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="images/logo.png" />
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
  <link href="css/style.css" rel="stylesheet" />
  <script src="js/login-page.js"></script>
</head>

<body class="h-100">
  <!--*******************
        Preloader start
    ********************-->
  <div id="preloader">
    <div class="loader">
      <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
      </svg>
    </div>
  </div>
  <!--*******************
        Preloader end
    ********************-->

  <div class="login-form-bg h-100">
    <div class="container h-100">
      <div class="row justify-content-center h-100">
        <div class="col-xl-6">
          <div class="form-input-content">
            <div class="card login-form mb-0">
              <div id="frm" class="card-body pt-5">
                <span >
                  <img style=" width:100px;
                  margin: auto;
                  display: block;" src="images/logo.png">
                </span>

                <form name="f1" method="POST" action="login.php"
                  class="mt-5 mb-5 login-input">
                  <div class="form-group">
                    <input id="user" type="username" class="form-control" name="user" placeholder="Username" />
                  </div>
                  <div class="form-group">
                    <input id="pass" type="password" class="form-control" name="pass"placeholder="Password" />
                  </div>
                  <!-- <span role="alert" id="username" aria-hidden="true">
                    Please enter First Name
                  </span> -->
                  <input value="Login"type="submit" id="btn" class="btn login-form__btn submit w-100"/>
                    
                 
                </form>
                <p class="mt-5 login-form__footer">
                  Dont have account?
                  <a href="page-register.html" class="text-primary">Sign Up</a>
                  now
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--**********************************
        Scripts
    ***********************************-->
  <!-- <script>

      var userDetail  = localStorage.getItem('userDetail');
      alert(userDetail);
      document.getElementById("email").innerHTML = userDetail.EMAIL;
      document.getElementById("password").innerHTML = userDetail.PASSWORD;    

    </script> -->
  <script src="plugins/common/common.min.js"></script>
  <script src="js/custom.min.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/gleek.js"></script>
  <script src="js/styleSwitcher.js"></script>
</body>

</html>