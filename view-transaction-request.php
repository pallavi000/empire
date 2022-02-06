<?php
include('./admin_auth.php');
include './includes/header.php';
?>

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
              <div class="col-sm-12 col-xl-12">
                <div class="card">
                  <div class="card-header">
                    <h5>View Transaction Request</h5>
                  </div>
                  <div class="card-body">
                    <?php
                                $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE TRANS_ID=?");
                                $query->execute([$_GET['id']]);
                                $transaction = $query->fetch();
                                if($transaction['type']=="R") {
                                    $trans_type = "redeem";
                                } elseif($transaction['type']=="PV") {
                                    $trans_type = "transfer";
                                } elseif($transaction['type']=="W") {
                                    $trans_type = "withdraw";
                                } else {
                                    $trans_type = "convert";
                                }
                                $q = $db->prepare("SELECT * from USER_TABLE WHERE user_id=?");
                                $q->execute([$transaction['USER_ID']]);
                                $u = $q->fetch();
                                if($transaction['type']=="R") {
                                    $query = $db->prepare("SELECT * from `REDEEM HISTORY` WHERE CREATED_ID=?");
                                    $query->execute([$transaction['TRANS_ID']]);
                                    $redeem = $query->fetch();
                                }
                                ?>
                                <div class="view-wrapper mt-5">
                                    <div class="row pb-2">
                                        <div class="col-md-6">
                                            Transaction ID:
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo $transaction['TRANS_ID']; ?>
                                        </div>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-md-6">
                                            User:
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo $u['user_name']; ?>
                                        </div>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-md-6">
                                            Detail:
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo $transaction['details']; ?>
                                        </div>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-md-6">
                                            Amount:
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                                if($transaction['type']=="R" || strpos($transaction['details'], 'Convert Ewallet') !== false){
                                                    echo 'RM ';
                                                }
                                                echo $transaction['AMOUNT'];
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    if($transaction['type']=="W") {
                                    ?>
                                    <div class="row pb-2">
                                        <div class="col-md-6">
                                            Bank Name:
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                                echo $u['bank_name'];
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-md-6">
                                            Bank Account Number:
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                                echo $u['bank_acc_num'];
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    }?>
                                    <?php if($transaction['type']=="R" && $query->rowCount()>0){ ?>
                                    <div class="row pb-2">
                                        <div class="col-md-6">
                                            Gold:
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo $redeem['REDEEMED_VALUE'] ?> g
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="row pb-2">
                                        <div class="col-md-6">
                                            Status:
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo $transaction['STATUS']; ?>
                                        </div>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-md-6">
                                            Date Request:
                                        </div>
                                        <div class="col-md-6">
                                            <?php echo $transaction['CREATED_DATE']; ?>
                                        </div>
                                    </div>
                                    <form action="admin-query-updates.php" method="POST">
                                        <?php if($transaction['type']=="R" || $transaction['type']=="W" || strpos($transaction['details'], 'Convert Ewallet') !== false){ ?>
                                            <div class="row pb-2">
                                                <div class="col-md-6">
                                                    Fee(s):
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="fee" class="form-control">
                                                        <option value="0">Fee 0.00</option>
                                                        <option value="5.00" <?php if($transaction['type']=="W") echo 'selected' ?>>Fee RM 5.00</option>
                                                        <option value="5%">Fee 5% of total</option>
                                                        <option value="3%">Fee 3% of total</option>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <input type="hidden" name="user_id" value="<?php echo $transaction['USER_ID'] ?>" />
                                        <input type="hidden" name="trans_id" value="<?php echo $_GET['id'] ?>" />
                                        <input type="hidden" name="trans_type" value="<?php echo $trans_type; ?>" />
                                        <input type="hidden" name="action" value="trans_approve" />

                                        <?php if($trans_type=="convert") { ?>
                                            <div class="row pb-2">
                                                <div class="col-md-6">
                                                    Points:
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="number" name="convert_points" class="form-control" required />
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <div class="mt-5"></div>
                                        <button type="submit" class="btn btn-success mr-2" name="trans_action" value="true"><i class="fa fa-check"></i>Approve</button>
                                        <button type="submit" class="btn btn-danger" name="trans_action" value="false"><i class="fa fa-check"></i> Reject</button>
                                    </form>
                                </div>
                   
                  </div>
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
    <?php include './includes/footer.php' ?>