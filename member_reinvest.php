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
<div class="page-body pt-5>
<div class=" content-body">

  <!-- row -->

  <div class="container-fluid">
    <form method="POST" action="member-query-updates.php" class="form theme-form">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-danger">Package Reinvest</h4>
              <div class="basic-form">
                <form method="POST" action="member-query-updates.php">

                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">PINS Balance</label>
                    <div class="col-sm-5">
                      <?php
                                      $query = $db->prepare("SELECT * from WALLET where USER_ID=?");
                                      $query->execute([$user['user_id']]);
                                      $wallet = $query->fetch();
                                      $query = $db->prepare("SELECT * from PACKAGES WHERE PACKAGES_ID=?");
                                      $query->execute([$user['package_id']]);
                                      $package = $query->fetch();
                                      $query = $db->prepare("SELECT * from PACKAGES WHERE PACKAGES_PRICE>=?");
                                      $query->execute([$package['PACKAGES_PRICE']]);
                                      $packages = $query->fetchAll();
                                      ?>
                      <input id="pins" name="pin_value" readonly="readonly" class="form-control-plaintext text-danger"
                        value="<?php echo $wallet['PIN_VALUE'] ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Member</label>
                    <div class="col-sm-5">
                      <input type="hidden" name="member" value="<?php echo $user['user_id'] ?>" readonly required />
                      <input type="text" class="form-control" value="<?php echo $user['user_name'] ?>" readonly />

                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sponsor</label>
                    <div class="col-sm-5">
                      <input type="text" name="sponser_by" readonly="readonly" class="form-control"
                        value="<?php echo $user['sponser_by'] ?>" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Current Package</label>
                    <div class="col-sm-5">
                      <input id="currentPackage" name="current_package" readonly="readonly" class="form-control"
                        value="<?php echo $package['PACKAGES_NAME'] ?>" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Reinvest Package</label>
                    <div class="col-sm-5">
                      <select id="inputPlan" name="package" class="form-control" required>
                        <?php
                              foreach($packages as $value) {
                                echo '<option value="'.$value["PACKAGES_ID"].'">'.$value['PACKAGES_NAME'].'</option>';
                              }
                              ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Payment Method</label>
                    <div class="col-sm-5">
                      <select id="inputState" class="form-control">
                        <option selected="selected">Using PINS</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-5">
                      <input type="text" readonly="readonly" class="form-control" value="<?php echo Date('Y-m-d') ?>" />
                    </div>
                  </div>
                  <div class="extra_data"></div>
                  <input type="hidden" name="action" value="reinvest" />
                  <button id="reinvest" type="submit" class="btn btn-primary">
                    Reinvest
                  </button>

                </form>
              </div>
            </div>


          </div>



        </div>
    </form>
  </div>
</div>
<!-- #/ container -->

<!--**********************************
            Content body end
        ***********************************-->

<!--**********************************
        Main wrapper end
    ***********************************-->

<!--**********************************
            Footer start
        ***********************************-->

<!--**********************************
              Footer end
          ***********************************-->
<!--**********************************
        Scripts
    ***********************************-->
<script>
  function getPackages(packages) {
    console.log(packages)
    let ele = ''
    packages.forEach(package => {
      ele += `<option value="${package.PACKAGES_ID}">${package.PACKAGES_NAME}</option>`
    })
    return ele;
  }

  document.querySelector('.member_select').addEventListener('change', (e) => {
    const user_id = e.target.value;
    const ele = document.querySelector('.extra_data')
    if (user_id) {
      let form_data = {
        user_id,
        action: "reinvest_init"
      }
      axios.post("./member-query-updates.php", form_data).then(res => {
        const data = res.data
        let content = `
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Current Package</label>
                            <div class="col-sm-5">
                            <input id="currentPackage" name="current_package" readonly="readonly" class="form-control" value="${data.current_package.PACKAGES_NAME}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Reinvest Package</label>
                            <div class="col-sm-5">
                            <select id="inputPlan" name="package" class="form-control" required>
                            ${getPackages(data.packages)}
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Payment Method</label>
                            <div class="col-sm-5">
                            <select id="inputState" class="form-control">
                                <option selected="selected">Using PINS</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-5">
                                <input type="text" readonly="readonly"class="form-control" value="2021-10-08"/>
                            </div>
                            </div>`;
        ele.innerHTML = content
      })
    } else {
      ele.innerHTML = ''
    }

  })

</script>

<script src="js/member_reinvest.js"></script>
<?php include './includes/footer.php' ?>