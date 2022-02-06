<?php
include('./admin_auth.php');
include './includes/header.php';
?>

        <?php include './includes/admin-sidebar.php'; ?>
      <div class="page-body pt-5">
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>All Transaction</h5>
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
                                  <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                 $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL ORDER BY CREATED_DATE DESC");
                                 $query->execute([]);
                                 while($row=$query->fetch()) {
                                 ?>
                                 <tr>
                                    <td><?php echo $row['TRANS_ID']; ?></td>
                                    <td><?php echo $row['details']; ?></td>
                                    <td><?php echo $row['AMOUNT']; ?></td>
                                    <td><?php echo $row['CREATED_DATE']; ?></td>
                                    <td><?php echo $row['STATUS']; ?></td>
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
