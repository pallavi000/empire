<?php
include('./admin_auth.php');
include('./includes/header.php');
?>

<?php include './includes/admin-sidebar.php' ?>
<!--**********************************
            Sidebar end
        ***********************************-->

<!--**********************************
            Content body start
        ***********************************-->
<div class="page-body pt-5">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-xl-6">
        <div class="row">
          <div class="col-sm-12 col-xl-12">
            <div class="card">
              <div class="card-header">
                <h5>Update Gold Price Today</h5>

              </div>
              <form action="admin-query-updates.php" method="POST" class="form theme-form">
                <div class="card-body">
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label class="text-danger">Gold Price</label>
                      <input id="gold_price" type="text" name="gold_price" class="form-control" />
                      <input type="hidden" name="gold_id" value="<?php echo $gold['gold_id'] ?>" readonly required />
                    </div>
                  </div>
                  <button class="btn btn-pill btn-primary" id="updateGoldPrice" type="submit">Update Price</button>
                </div>

                <div class="card-footer">
                </div>
              </form>
            </div>
          </div>
          <div class="col-sm-12 col-xl-12">

            <div class="card">
              <div class="card-header">
                <h5>Reload Pin</h5>
              </div>
              <div class="card-body">
                <form action="admin-query-updates.php" class="form theme-form" method="POST">
                  <div class="basic-form">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <?php
                                      $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
                                      $wallet->execute([$user['user_id']]);
                                      $wallet = $wallet->fetch();
                                      ?>
                        <label class="text-danger">Current Pin Amount:<label id="pinValue">
                            <?php echo $wallet['PIN_VALUE'] ?>
                          </label></label>
                        <input id="reloadAmount" name="pin_value" type="number" class="form-control" />
                        <input type="hidden" name="action" value="reload_pin" />
                      </div>

                    </div>


                    <button type="submit" id="reloadPin" class="btn btn-pill btn-primary">
                      Reload
                    </button>


                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-xl-6">
        <div class="card">

          <div class="card-body">
            <?php include './includes/account-detail.php' ?>

          </div>
        </div>

      </div>

    </div>


    <!-- #/ container -->

    <!--**********************************
            Content body end
        ***********************************-->

    <!--**********************************
            Footer start
        ***********************************-->
    <?php
include('./includes/footer.php');
?>