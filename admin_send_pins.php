<?php
include('admin_auth.php');
include('./includes/header.php');
?>

       <?php include './includes/admin-sidebar.php'; ?>
      <div class="page-body pt-5">
        <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12 col-xl-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Send To</h5>
                  </div>
                  <div class="card-body">
                      <form method="POST" action="admin-query-updates.php" class="form theme-form">
                              <div class="form-group row">
                                  <?php
                                  $query = $db->prepare("SELECT * from WALLET WHERE user_id=?");
                                  $query->execute([$user['user_id']]);
                                  $wallet = $query->fetch();
                                  $query = $db->prepare("SELECT * from USER_TABLE");
                                  $query->execute([]);
                                  ?>
                                  <label class="col-sm-2 col-form-label">Pin Balance</label>
                                  <div class="col-sm-5">
                                      <input id="walletBalance" name="pin_balance" type="text" readonly="readonly" class="form-control-plaintext text-danger" value="<?php echo $wallet['PIN_VALUE']; ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                <div class="col">
                                  <label class="col-form-label">Member</label>

                                      <select id="memberName" class="form-control" name="member" required>
                                          <?php
                                          while($row=$query->fetch()) {
                                              echo '<option value="'.$row["user_id"].'-'.$row['user_name'].'">'.$row["user_name"].'</option>';
                                          }
                                          ?>
                                      </select>
                                  </div>
                                  <div class="col">
                                  <label class=" col-form-label">Amount to Transfer</label>
                                
                                      <input id="amount" name="amount" type="text" class="form-control"  required>
                                  </div>
                                  
                              </div>
                              <div class="form-group row">
                                <div class="col">
                                <label class="col-form-label">Date</label>
                               
                                    <input id="today" readonly="readonly" class="form-control" >
                                </div>
                                <div class="col"></div>
                                <script>
                                  n = new Date();
                                  year = n.getFullYear();
                                  month = n.getMonth() + 1;
                                  date = n.getDate();
                                  hour = n.getHours();
                                  minutes = n.getMinutes();
                                  seconds = n.getSeconds();
                                  t = date+'/'+month+'/'+year;
                                  d = document.getElementById("today");
                                  d.value = t;
                
                                </script>
                                
                            </div>
                            <input type="hidden" name="action" value="send_pins" />
                              <button id="sendPin" type="submit" class="btn btn-primary">
                                Transfer
                              </button>
                              
                          </form>
                  </div>
                </div>
              </div>
</div>
</div>
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Send Pins History</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                  <th>Details</th>
                                  <th>Amount</th>
                                  <th>Date</th>
                                  <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                              $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE USER_ID=? AND type=? ORDER BY CREATED_DATE DESC");
                              $query->execute([$user['user_id'], 'PV']);
                              while($row=$query->fetch()) {
                              ?>
                              <tr>
                              <td><?php echo $row['TRANS_ID']; ?></td>
                              <td><?php echo $row['details']; ?></td>
                              <td><?php echo $row['AMOUNT']; ?></td>
                              <td><?php echo $row['CREATED_DATE']; ?></td>
                              <td><?php echo $row['balance']; ?></td>
                              </tr>
                              <?php
                              }
                              ?>
                                </tbody>
                            </table>
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

        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
        Main wrapper end
    ***********************************-->

        <!--**********************************
        Scripts
    ***********************************-->




        <script src="assets/js/jquery-3.5.1.min.js"></script>
        <!-- Bootstrap js-->
        <script src="assets/js/bootstrap/popper.min.js"></script>
        <script src="assets/js/bootstrap/bootstrap.js"></script>
        <!-- feather icon js-->
        <script src="assets/js/icons/feather-icon/feather.min.js"></script>
        <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
        <!-- Sidebar jquery-->
        <script src="assets/js/sidebar-menu.js"></script>
        <script src="assets/js/config.js"></script>
        <!-- Plugins JS start-->
        <script src="assets/js/jquery-3.5.1.min.js"></script>
        <script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/js/datatable/datatables/datatable.custom.js"></script>
        <script src="assets/js/chat-menu.js"></script>
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="assets/js/script.js"></script>
        <script src="assets/js/theme-customizer/customizer.js"></script>

        <script>
            $(document).ready(function () {
                $('#basic-1').DataTable();
                function filterGlobal() {
                    $('#transactionRequest').DataTable().search(
                        $('#global_filter').val(),
                        $('#global_regex').prop('checked'),
                        $('#global_smart').prop('checked')
                    ).draw();
                }
                $('#transactionRequest').DataTable({
                    sDom: 'ltipr',
                    "aaSorting": [[0, "desc"]]
                });
                $('input.global_filter').on('keyup click', function () {
                    filterGlobal();
                });
            });
        </script>

        <?php include './includes/footer.php' ?>
      
