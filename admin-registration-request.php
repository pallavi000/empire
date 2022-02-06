<?php
include('admin_auth.php');
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
                        <h5>Registration Request</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                                <th>User Name</th>
                                                <th>Full Name</th>
                                                <th>Status</th>
                                                <th>Date Request</th>
                                                <th>
                                                  Action
                                                </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $query = $db->prepare("SELECT * from USER_TABLE WHERE user_status=?");
                                            $query->execute(['INACTIVE']);
                                            while($row=$query->fetch()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['user_id'] ?></td>
                                                <td><?php echo $row['user_name'] ?></td>
                                                <td><?php echo $row['full_name'] ?></td>
                                                <td><?php echo $row['user_status'] ?></td>
                                                <td><?php echo $row['joined_date'] ?></td>
                                                <td>
                                                    <?php
                                                    if($row['user_status']=="INACTIVE") {
                                                        echo '<a class="btn btn-success mr-2" href="admin-query-updates.php?approve=true&&id='.$row["user_id"].'"><i class="fa fa-check"></i> Approve</a>';
                                                        echo '<a class="btn btn-danger" href="admin-query-updates.php?approve=false&&id='.$row["user_id"].'"><i class="fa fa-times"></i> Reject</a>';
                                                    }
                                                    ?>
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