<?php
include_once('user_auth.php');
include './includes/header.php';
?>

<?php include './includes/user-sidebar.php'; ?>
<!--**********************************
            Sidebar end
        ***********************************-->

<!--**********************************
            Content body start
        ***********************************-->
<div class="page-body pt-5">

  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-xl-12">
        <div class="card">
          <div class="card-header">
            <h5>Redeem Gold</h5>

          </div>
          <div class="card-body">
            <form method="POST" action="member-query-updates.php" class="form theme-form">
              <div class="form-group row">
                <?php
                                  $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
                                  $wallet->execute([$user['user_id']]);
                                  $wallet = $wallet->fetch();
                                  $max_gold_value = $wallet['WALLET_BALANCE']/$gold['gold_price'];
                                  $max_gold_value = floor($max_gold_value);
                                  ?>
                <label class="col-sm-2 col-form-label">Wallet Balance</label>
                <div class="col-sm-5">
                  <input id="walletBalance" type="text" readonly="readonly" class="form-control-plaintext text-danger"
                    value="<?php echo $wallet['WALLET_BALANCE'] ?>">
                </div>
              </div>
              <div class="form-group row">
                <div class="col">
                  <label class="col-form-label">Redeem Gold(g)</label>

                  <input id="amountGold" type="number" min="1" max="<?php echo $max_gold_value ?>" name="gold_value"
                    class="form-control" required>
                </div>
              </div>
              <input type="hidden" name="action" value="redeem_gold" />
              <button id="redeem" type="submit" class="btn btn-primary">
                Redeem
              </button>

            </form>
          </div>
        </div>
      </div>


    </div>

  </div>
</div>
<!--**********************************
        Main wrapper end
    ***********************************-->

<!--**********************************
            Footer start
        ***********************************-->

<?php include './includes/footer.php' ?>