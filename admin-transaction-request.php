<?php
include('./admin_auth.php');
include './includes/header.php';
?>
<style>
    .btn-fix {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
</style>
<!--**********************************
            Nav header end
        ***********************************-->

<!--**********************************
            Header start
        ***********************************-->

<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

<!--**********************************
            Sidebar start
        ***********************************-->
<?php include './includes/admin-sidebar.php'; ?>
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
                        <h5>Transaction Request</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date Request</th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                                                    $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE STATUS=? AND (type=? OR type=? OR type=?) ORDER BY CREATED_DATE DESC");
                                                                    $query->execute(["PENDING", "PV", "R", "W"]);
                                                                    $all_transaction = $query->fetchAll();
                        
                                                                    $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE STATUS=? AND isnull(type) AND details LIKE ? ORDER BY CREATED_DATE DESC");
                                                                    $query->execute(['PENDING', 'Convert Ewallet%']);
                                                                    $conversion_transaction = $query->fetchAll();
                        
                                                                    $rows = array_merge($all_transaction, $conversion_transaction);
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
                                                                        if($row['type']=="R") {
                                                                            $trans_type = "redeem";
                                                                        } elseif($row['type']=="PV") {
                                                                            $trans_type = "transfer";
                                                                        } elseif($row['type']=="W") {
                                                                            $trans_type = "withdraw";
                                                                        } else {
                                                                            $trans_type = "convert";
                                                                        }
                                                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['TRANS_ID']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['details']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['AMOUNT']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['STATUS']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['CREATED_DATE']; ?>
                                        </td>
                                        <td class="d-flex">

                                            <?php
                                                                                echo '<a class="btn btn-info mr-2 btn-fix" href="view-transaction-request.php?id='.$row["TRANS_ID"].'"><i class="fa fa-pencil-square-o"></i> View</a>';
                                                                            ?>
                                            <form method="POST" action="admin-query-updates.php">
                                                <input type="hidden" name="user_id"
                                                    value="<?php echo $row['USER_ID'] ?>" />
                                                <input type="hidden" name="trans_id"
                                                    value="<?php echo $row['TRANS_ID'] ?>" />
                                                <input type="hidden" name="trans_type"
                                                    value="<?php echo $trans_type; ?>" />
                                                <input type="hidden" name="action" value="trans_approve" />
                                                <button type="submit" class="btn btn-danger btn-fix" name="trans_action"
                                                    value="false"><i class="fa fa-check"></i>
                                                    Reject</button>
                                            </form>
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