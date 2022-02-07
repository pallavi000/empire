<?php
include('user_auth.php');
include './includes/header.php';
?>

<?php include './includes/user-sidebar.php'; ?>
<!--**********************************
            Sidebar end
        ***********************************-->

<!--**********************************
            Content body start
        ***********************************-->
<?php
        $query = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
        $query->execute([$user['user_id']]);
        $wallet = $query->fetch();
        if($query->rowCount()>0) {
          $wallet_balance = $wallet['WALLET_BALANCE'];
        } else {
          $wallet_balance = 0;
        }
        ?>
       
<div class="page-body pt-5">
  <div class="container-fluid">
    <!-- Chart widget top Start-->
    <div class="row">
      <div class="col-xl-4 col-md-12 box-col-12">
        <div class="card gradient-primary text-white">
          <div class="chart-widget-top">
            <div class="row card-body p-b-3">
              <div class="col-4">
                <h1><i class="fa fa-diamond"></i></h1>
              </div>
              <div class="col-8 text-right">
                <h6 class="f-w-600">eWallet</h6>
                <h4 class="total-value">RM<span>
                    <?php echo $wallet_balance; ?>
                  </span></h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-12 box-col-12">
        <div class="card gradient-secondary text-white">
          <div class="chart-widget-top">
            <div class="row card-body p-b-3">
              <div class="col-4">
                <h1> <i class="fa fa-money"></i></h1>
              </div>
              <div class="col-8 text-right text-white">
                <h6 class="f-w-600">Personal Sales</h6>
                <?php
                                  $personal_sales = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE user_id=? AND type=? AND Level=?");
                                  $personal_sales->execute([$user['user_id'], 'B', 1]);
                                  $total_personal_sales = 0;
                                  while($row=$personal_sales->fetch()) {
                                    $total_personal_sales += $row['AMOUNT'];
                                  }
                                  ?>
                <h4 class="total-value">RM
                  <?php echo $total_personal_sales; ?>
                </h4>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-12 box-col-12">
        <div class="card gradient-info text-white">
          <div class="chart-widget-top">
            <div class="row card-body p-b-3">
              <div class="col-4">
                <h1><i class="fa fa-money"></i></h1>
              </div>
              <div class="col-8 text-right">
                <h6 class="f-w-600">Group Sales</h6>
                <?php
                                  $group_sales = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE user_id=? AND type=? AND Level!=?");
                                  $group_sales->execute([$user['user_id'], 'B', 1]);
                                  $total_group_sales = 0;
                                  while($row=$group_sales->fetch()) {
                                    $total_group_sales += $row['AMOUNT'];
                                  }
                                  ?>
                <h4 class="total-value">RM
                  <?php echo $total_group_sales; ?>
                </h4>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-xl-4 col-md-12 box-col-12">
        <div class="card gradient-primary text-white">
          <div class="chart-widget-top">
            <div class="row card-body p-b-3">
              <div class="col-4">
                <h1><i class="fa fa-money"></i></h1>
              </div>
              <div class="col-8 text-right">
                <h6 class="f-w-600">PINS</h6>
                <h4 class="total-value">
                  <?php echo $wallet['PIN_VALUE'] ?>
                </h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-12 box-col-12">
        <div class="card gradient-secondary text-white">
          <div class="chart-widget-top">
            <div class="row card-body p-b-3">
              <div class="col-4">
                <h1> <i class="fa fa-diamond"></i></h1>
              </div>
              <div class="col-8 text-right text-white">
                <h6 class="f-w-600">Gold(g)</h6>
                <h4 class="total-value">
                  <?php echo $wallet['gold_value'] ?>
                </h4>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-12 box-col-12">
        <div class="card gradient-info text-white">
          <div class="chart-widget-top">
            <div class="row card-body p-b-3">
              <div class="col-4">
                <h1><i class="fa fa-money"></i></h1>
              </div>
              <div class="col-8 text-right">
                <h6 class="f-w-600">Gold Value(RM)</h6>
                <h4 class="total-value">RM
                  <?php echo $gold['gold_price']; ?>
                </h4>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-xl-6">
        <div class="card">
          <div class="card-header">
            <h5>Bonus Summary</h5>
          </div>
          <div class="card-body">
            <h4>Bonus Unilevel:(Unilevel)</h4>
            <div class="card-body pt-3">
              <div class="row">

                <div class="col-md-8 col-sm-12">
                  <h6>Total Bonuses:</h6>

                </div>
                <div class="col-md-4 col-sm-12">
                  RM
                  <?php echo $total_personal_sales+$total_group_sales; ?>
                </div>
                <div class="col-md-8 col-sm-12">
                  <h6>Bonus Gold:</h6>

                </div>
                <div class="col-md-4 col-sm-12">
                  0 g
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-xl-6">
        <div class="card b-r-0">
          <div class="card-body">
            <?php include './includes/account-detail.php'; ?>

          </div>
        </div>
      </div>
    </div>
  </div>



</div>
<!--**********************************
            Content body end
        ***********************************-->

<!--**********************************
            Footer start
        ***********************************-->
<?php include './includes/footer.php'?>