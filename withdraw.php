<?php
include_once('user_auth.php');
include './includes/header.php';
?>
<!DOCTYPE html>

<style>
  /* The Modal (background) */
  .modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    padding-top: 100px;
    /* Location of the box */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
  }

  /* Modal Content */
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }

  /* The Close Button */
  .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }
</style>

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
            <h5>Withdraw and Credit to Account</h5>
            <?php
                                            $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
                                            $wallet->execute([$user['user_id']]);
                                            $wallet = $wallet->fetch();
                                            ?>
          </div>
          <div class="card-body">
            <form method="POST" action="member-query-updates.php" class="form theme-form">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Wallet Balance</label>
                <div class="col-sm-5">
                  <input id="walletBalance" type="text" readonly="readonly" class="form-control-plaintext text-danger"
                    value="<?php echo $wallet['WALLET_BALANCE'] ?>">
                </div>
              </div>
              <?php
                                                  if(!$user['bank_name'] && !$user['bank_acc_num']) {
                                                    echo '<div class="alert alert-danger">You have not added your bank account. Please fill the form below.</div>';
                                                  ?>
              <div class="form-group row">
                <div class="col">
                  <label class="col-form-label">Bank Name</label>

                  <input name="bank_name" class="form-control" required>
                </div>
                <div class="col">
                  <label class=" col-form-label">Bank Account Number</label>

                  <input name="bank_acc_num" class="form-control" required>
                </div>

              </div>
              <?php
                                                  }
                                                  ?>
              <div class="form-group row">
                <div class="col">
                  <label class="col-form-label">Credit/Pay to</label>

                  <input readonly="readonly" class="form-control" value="Account">
                </div>
                <div class="col">
                  <label class=" col-form-label">Amount</label>

                  <input id="amount" type="number" min="0" max="<?php echo $wallet['WALLET_BALANCE'] ?>" name="amount"
                    class="form-control" required>
                </div>

              </div>
              <div class="form-group row">
                <div class="col">
                  <label class="col-form-label">Fees 3%/RM5</label>

                  <input readonly="readonly" class="form-control" value="3%">
                </div>
                <div class="col">
                  <label class="col-form-label">Date</label>

                  <input id="today" readonly="readonly" class="form-control">
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
              <input type="hidden" name="action" value="withdraw" />
              <button id="withdraw" type="submit" class="btn btn-primary">
                Withdraw
              </button>


            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!--**********************************
            Content body end
        ***********************************-->
  <?php include './includes/footer.php' ?>