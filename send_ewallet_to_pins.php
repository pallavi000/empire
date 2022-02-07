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
            <h5>Convert eWallet</h5>
            <?php
                      $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
                      $wallet->execute([$user['user_id']]);
                      $wallet = $wallet->fetch();
                      ?>
          </div>
          <div class="card-body">
            <form method="POST" action="member-query-updates.php" class="form theme-form">
              <div class="form-group row">

                <label class=" col-sm-2  col-form-label">Wallet Balance</label>
                <div class=" col-sm-5 d-flex align-items-center text-danger">
                  <span class="mr-1">RM</span><input id="walletBalance" type="text" readonly="readonly"
                    name="wallet_balance" class="form-control-plaintext text-danger"
                    value="<?php echo $wallet['WALLET_BALANCE'] ?>">
                </div>
              </div>
              <div class="form-group row">
                <div class="col">
                  <label class="col-form-label">Convert to</label>

                  <select id="inputState" name="convert_type" class="form-control">
                    <option selected="selected">PINS</option>
                  </select>
                </div>
                <div class="col">
                  <label class="col-form-label">Amount</label>

                  <input id="amount" min="0" max="<?php echo $wallet['WALLET_BALANCE'] ?>" name="amount" type="number"
                    class="form-control">
                </div>

              </div>
              <div class="form-group row">
                <div class="col">
                  <label class="col-form-label">Fees 5/0%</label>

                  <input readonly="readonly" name="fees" class="form-control" value="0">
                </div>
                <div class="col">
                  <label class="col-form-label">Date</label>

                  <input readonly="readonly" id="today" class="form-control">
                </div>
                <script>
                  n = new Date();
                  year = n.getFullYear();
                  month = n.getMonth() + 1;
                  date = n.getDate();
                  hour = n.getHours();
                  minutes = n.getMinutes();
                  seconds = n.getSeconds();
                  t = date + '/' + month + '/' + year;
                  d = document.getElementById("today");
                  d.value = t;
                </script>
              </div>
              <input type="hidden" name="action" value="ewallet_to_pins" />
              <button id="transfer" type="submit" class="btn btn-primary">
                Transfer
              </button>


            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include './includes/footer.php' ?>