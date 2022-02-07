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
              <div class="col-sm-12 col-xl-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Send To</h5>
                    <?php
                          $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
                          $wallet->execute([$user['user_id']]);
                          $wallet = $wallet->fetch();
                          ?>
                  </div>
                  <div class="card-body">
                    <form action="member-query-updates.php" method="POST" class="form theme-form">
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Pin Balance</label>
                                  <div class="col-sm-5">
                                      <input id="walletBalance" type="text" readonly="readonly" class="form-control-plaintext text-danger" name="pin_balance" value="<?php echo $wallet['PIN_VALUE'] ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                <div class="col">
                                  <label class="col-form-label">Member</label>
                                
                                      <select name="member" class="form-control" required>
                                        <?php
                                        $members = $db->prepare("SELECT * from USER_TABLE");
                                        $members->execute([]);
                                        while($row=$members->fetch()) {
                                            echo '<option value="'.$row["user_id"].'-'.$row['user_name'].'">'.$row["user_name"].'</option>';
                                        }
                                        ?>
                                    </select>
                                  </div>

                                  <div class="col">
                                  <label class=" col-form-label">Amount to Transfer</label>
                                 
                                      <input id="amount" name="amount" type="text" class="form-control" >
                                  </div>
                                  
                              </div>
                              <div class="form-group row">
                                <div class="col">
                                <label class="col-form-label">Fees 0/0%</label>
                              
                                    <input readonly="readonly" type="text" value="0" class="form-control" >
                                </div>
                                <div class="col">
                                <label class="col-form-label">Date</label>
                                
                                    <input  readonly="readonly" id="today" class="form-control" >
                                </div>
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
                            <input type="hidden" name="action" value="send_pins"/>
                              <button id="sendPin" type="submit" class="btn btn-primary">
                                Transfer
                              </button>
                              <script>
                      
                                document
                                  .getElementById("sendPin")
                                  .addEventListener("click", sendPin);
          
                                 
                              </script>
                          </form>
                  </div>
                </div>
              </div>
          </div>
    </div>

          




      

        
      <!--**********************************
            Content body end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

     <!--**********************************
            Footer start
        ***********************************-->
    <?php include './includes/footer.php'?>