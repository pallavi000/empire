<?php
include('./admin_auth.php');
include './includes/header.php';
?>

<?php include './includes/admin-sidebar.php'; ?>
<div class="page-body pt-5">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 col-xl-6">
        <div class="card">
          <div class="card-header">
            <h5>Account Password</h5>
            <label class="text-muted">Set and Change New Password</label>

          </div>
          <div class="card-body">
            <form action="admin-query-updates.php" method="POST" class="form theme-form">


              <div class="form-group row">
                <div class="col">
                  <label class="col-form-label">New Password</label>
                  <input id="newPassword" name="newPassword" type="password" class="form-control" required />
                </div>
                <div class="col">
                  <label class=" col-form-label">Confirm New Password</label>
                  <input id="confirmNewPassword" name="confirmNewPassword" type="password" class="form-control" />
                </div>
              </div>
              <input type="hidden" name="action" value="password_update" required readonly />
              <button type="submit" id="bankDetailSave" class="btn btn-primary">
                Save Details
              </button>
            </form>
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
    <?php include './includes/footer.php'
?>