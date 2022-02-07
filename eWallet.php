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
<div class="page-body pt-5">
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">eWallet</h2>
                        <?php
                                                    $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
                                                    $wallet->execute([$user['user_id']]);
                                                    $wallet = $wallet->fetch();
                                                    ?>
                        <h5>Wallet Balance:RM <span id="walletBalance">
                                <?php echo $wallet['WALLET_BALANCE'] ?>
                            </span></h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="e-wallet">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Details</th>
                                        <th>Amount(RM)</th>
                                        <th>Balance After(RM)</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                                                            $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE USER_ID=? AND isnull(type) AND details LIKE ? ORDER BY CREATED_DATE DESC");
                                                                            $query->execute([$user['user_id'], 'Convert Ewallet%']);
                                                                            $conversion_transaction = $query->fetchAll();
                                                                            $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE USER_ID=? AND type=? ORDER BY CREATED_DATE DESC");
                                                                            $query->execute([$user['user_id'], 'R']);
                                                                            $redeem_transaction = $query->fetchAll();
                                                                            $rows = array_merge($conversion_transaction, $redeem_transaction);
                                                                            usort($rows, function($a, $b) {
                                                                                if ($a['TRANS_ID'] > $b['TRANS_ID']) {
                                                                                    return -1;
                                                                                } elseif ($a['TRANS_ID'] < $b['TRANS_ID']) {
                                                                                    return 1;
                                                                                } else {
                                                                                    return 0;
                                                                                }
                                                                            });
                                                                            foreach ($rows as $row) {
                                                                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['TRANS_ID'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['details'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['AMOUNT'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['balance'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['CREATED_DATE'] ?>
                                        </td>
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















            <!-- #/ container -->
        </div>
    </div>

    <!--**********************************
            Content body end
        ***********************************-->


    <!--**********************************
            Footer start
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
            $('#e-wallet').DataTable({
                "aaSorting": [[0, "desc"]]
            });

        });
    </script>



    <script src="js/ewallet.js"></script>
    <?php include './includes/footer.php' ?>