<?php
include './connection.php';
include './admin_auth.php';


if(isset($_POST['gold_price']) && isset($_POST['gold_id'])) {
    $gold_price = $_POST['gold_price'];
    $gold_id = $_POST['gold_id'];
    $query = $db->prepare("UPDATE gold_update SET gold_price=? WHERE gold_id=?");
    $query->execute([$gold_price, $gold_id]);
    $_SESSION['success'] = "Gold Price Update.";
    // echo '<script>alert("Gold Price Update.")</script>';
    echo "<script> location.href='admin-homepage.php'; </script>";
} elseif(isset($_POST['action']) && $_POST['action']=="profile_update") {

    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $phone = intval(preg_replace('/[^0-9]+/', '', $phone), 10);
    $full_name= $_POST['fullName'];
    $address_no=$_POST['address'];
    $city=$_POST['city'];
    $state= $_POST['state'];
    $postcode=$_POST['postcode'];
    $country=$_POST['inputCountry'];
    $query = $db->prepare("UPDATE USER_TABLE SET email=?, tel_no=?, full_name=?, address_no=?, city=?, state=?, postcode=?, country=?  WHERE user_name=?");
    $query->execute([$email, $phone, $full_name, $address_no, $city, $state, $postcode, $country, $_SESSION['admin_username']]);
        $_SESSION['success'] = "Record Updated.";
    // echo '<script>alert("Record Updated.")</script>';
    echo "<script> location.href='profile.php'; </script>";
} elseif(isset($_POST['action']) && $_POST['action']=="password_update") {
    $password = $_POST['newPassword'];
    $confirm = $_POST['confirmNewPassword'];
    if($password!=$confirm) {
        $_SESSION['error'] = "Password and Confirm Password Did Not Match.";
        // echo '<script>alert("Password and Confirm Password Did Not Match.")</script>';
        echo "<script> location.href='account-setting.php'; </script>";
    } else {
        $query = $db->prepare("UPDATE USER_TABLE SET PASSWORD=? WHERE user_name=?");
        $query->execute([$password, $_SESSION['admin_username']]);
         $_SESSION['success'] = "Password Updated.";
        // echo '<script>alert("Password Updated.")</script>';
        echo "<script> location.href='account-setting.php'; </script>";
    }
} elseif(isset($_GET['approve']) && isset($_GET['id'])) {
    $query = $db->prepare("SELECT * from USER_TABLE WHERE user_id=?");
    $query->execute([$_GET['id']]);
    $row = $query->fetch();
    $sponser = $row['genealogy_user_id'];
    $package = $db->prepare("SELECT * from PACKAGES WHERE PACKAGES_ID=?");
    $package->execute([$row['package_id']]);
    $package = $package->fetch();
    if($_GET['approve']=="true") {
        $user_status = 'ACTIVE';

        function bonus_divide($sponser_id, $bonus_level, $package){
            include './connection.php';
            $sponser_user = $db->prepare("SELECT * from USER_TABLE WHERE user_id=?");
            $sponser_user->execute([$sponser_id]);
            if($sponser_user->rowCount()>0) {
                $sponser_user = $sponser_user->fetch();
                
                $bonus = $db->prepare("SELECT * from BONUS_SPONSOR_DETAIL WHERE BONUS_LEVEL=?");
                $bonus->execute([$bonus_level]);

                if($bonus->rowCount()>0) {
                    $bonus = $bonus->fetch();
                    $bonus_balance = ($package['PIN_VALUE']*$bonus['BONUS_PERCENTAGE'])/100;
                    $bonus_balance = round($bonus_balance, 4);
                    
                    $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
                    $wallet->execute([$sponser_user['user_id']]);
                    $wallet = $wallet->fetch();
                    $new_wallet_balance = $wallet['WALLET_BALANCE']+$bonus_balance;
                    $query = $db->prepare("UPDATE WALLET SET WALLET_BALANCE=? WHERE USER_ID=?");
                    $query->execute([$new_wallet_balance, $sponser_user['user_id']]);
    
                    $user_id = $sponser_user['user_id'];
                    $created_at = date('Y-m-d H:i:s');
                    $status = "ACCEPTED";
                    $type = "B";
                    $level = $bonus_level;
    
                    $details = "Bonus Sponser ".$bonus_balance;
                    $query = $db->prepare("INSERT INTO TRANSACTIONAL_DETAIL (`USER_ID`, `AMOUNT`, `CREATED_DATE`, `PERCENTAGE`, `STATUS`, `details`, `balance`, `type`, `Level`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $query->execute([$user_id, $bonus_balance, $created_at, 0, $status, $details, $new_wallet_balance, $type, $level]);
    
                    $bonus_level = $bonus_level+1;
                    $loop_value = 6;
                    if($package['PACKAGES_NAME']=="PLAN3600") {
                        $loop_value = 12;
                    }
                    if($bonus_level>$loop_value) {
                        return;
                    } else {
                        if($sponser_user['genealogy_user_id']) {
                            bonus_divide($sponser_user['genealogy_user_id'], $bonus_level, $package);
                        }
                    }
                } else {
                    return;
                }
            }
        }

        bonus_divide($sponser, 1, $package);


    } else {
        $user_status = 'REJECTED';
        $query = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
        $query->execute([$sponser]);
        $wallet = $query->fetch();
        $new_pin_value = $package['PACKAGES_PRICE']+$wallet['PIN_VALUE'];
        $query = $db->prepare("UPDATE WALLET SET PIN_VALUE=? WHERE USER_ID=?");
        $query->execute([$new_pin_value, $sponser]);
    }

    $query = $db->prepare("UPDATE USER_TABLE SET user_status=? WHERE user_id=?");
    $query->execute([$user_status, $_GET['id']]);
    $_SESSION['success'] = "Request Updated.";
    // echo '<script>alert("Request Updated.")</script>';
    echo "<script> location.href='admin-registration-request.php'; </script>";
} elseif(isset($_POST['action']) && $_POST['action']=="send_pins") {
    if($_POST['amount']>$_POST['pin_balance']) {
         $_SESSION['error'] = "You do not have enough pin balance.";
        // echo '<script>alert("You do not have enough pin balance.")</script>';
        echo "<script> location.href='admin_send_pins.php'; </script>";
    } else {
        $reduce_pin_value = $_POST['pin_balance']-$_POST['amount'];
        $reduce = $db->prepare("UPDATE WALLET SET PIN_VALUE=? WHERE USER_ID=?");
        $reduce->execute([$reduce_pin_value, $user['user_id']]);

        $member = explode("-", $_POST['member']);
        $member_id = $member[0];
        $member_username = $member[1];
        $user_wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
        $user_wallet->execute([$member_id]);
        $user_wallet = $user_wallet->fetch();
        $add_pin_value = $_POST['amount']+$user_wallet['PIN_VALUE'];
        $add = $db->prepare("UPDATE WALLET SET PIN_VALUE=? WHERE USER_ID=?");
        $add->execute([$add_pin_value, $member_id]);

        //transactions
        $user_id = $user['user_id'];
        $created_at = date('Y-m-d H:i:s');
        $status = "ACCEPTED";
        $type = "PV";
        $balance = $reduce_pin_value;
        $details = "transfer ".$_POST['amount']." to ".$member_username." with fee 0";
        $query = $db->prepare("INSERT INTO TRANSACTIONAL_DETAIL (`USER_ID`, `AMOUNT`, `CREATED_DATE`, `PERCENTAGE`, `STATUS`, `details`, `balance`, `type`, `Level`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$user_id, $_POST['amount'], $created_at, 12, $status, $details, $balance, $type, NULL]);

        $user_id = $member_id;
        $type = NULL;
        $details = "Received ".$_POST['amount']." from ".$user['user_name']." with fee 0";
        $balance = $add_pin_value;
        $query = $db->prepare("INSERT INTO TRANSACTIONAL_DETAIL (`USER_ID`, `AMOUNT`, `CREATED_DATE`, `PERCENTAGE`, `STATUS`, `details`, `balance`, `type`, `Level`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$user_id, $_POST['amount'], $created_at, 12, $status, $details, $balance, $type, NULL]);
        // echo '<script>alert("Amount Transferee Successfully.")</script>';
        $_SESSION['success'] = "Amount Transferee Successfully." ;
        echo "<script> location.href='admin_send_pins.php'; </script>";
    }
} elseif(isset($_POST['action']) && $_POST['action']=="trans_approve") {
    
    
    $trans_id = $_POST['trans_id'];
    $trans_type = $_POST['trans_type'];
    $trans_action = $_POST['trans_action'];
    $today = Date("Y-m-d H:i:s");
   

    if($trans_action=="true") {

        if($trans_type=="transfer") {
            $query = $db->prepare("UPDATE TRANSACTIONAL_DETAIL SET STATUS=? WHERE TRANS_ID=?");
            $query->execute(["ACCEPTED", $trans_id]);
            $query->execute(["ACCEPTED", $trans_id+1]);
    
            $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE TRANS_ID=?");
            $query->execute([$trans_id+1]);
            $row = $query->fetch();
            $user_wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
            $user_wallet->execute([$row['USER_ID']]);
            $user_wallet = $user_wallet->fetch();
            $add_pin_value = $row['AMOUNT']+$user_wallet['PIN_VALUE'];
            $add = $db->prepare("UPDATE WALLET SET PIN_VALUE=? WHERE USER_ID=?");
            $add->execute([$add_pin_value, $row['USER_ID']]);
        } elseif($trans_type=="convert") {
            $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
            $wallet->execute([$_POST['user_id']]);
            $wallet = $wallet->fetch();
            $add_pin_value = $_POST['convert_points']+$wallet['PIN_VALUE'];

            $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE TRANS_ID=?");
            $query->execute([$trans_id]);
            $row = $query->fetch();

            if($_POST['fee']=="5.00") {
                if($wallet['WALLET_BALANCE']<5) {
                    $_SESSION['error'] = "User do not have enough balance for fee." ;
                    // echo '<script>alert("User do not have enough balance for fee.")</script>';
                    echo "<script> location.href='".$_SERVER['HTTP_REFERER']."'; </script>";
                    exit;
                } else {
                    $fee = 5;
                }
            } elseif($_POST['fee']=="5%") {
                $fee = ($row['AMOUNT']*5)/100;
                $fee = round($fee, 2);
                if($wallet['WALLET_BALANCE']<$fee) {
                 $_SESSION['error'] = "User do not have enough balance for fee.";
                    // echo '<script>alert("User do not have enough balance for fee.")</script>';
                    echo "<script> location.href='".$_SERVER['HTTP_REFERER']."'; </script>";
                    exit;
                }
            } elseif($_POST['fee']=="3%") {
                $fee = ($row['AMOUNT']*3)/100;
                $fee = round($fee, 2);
                if($wallet['WALLET_BALANCE']<$fee) {
                     $_SESSION['error'] = "User do not have enough balance for fee.";
                    // echo '<script>alert("User do not have enough balance for fee.")</script>';
                    echo "<script> location.href='".$_SERVER['HTTP_REFERER']."'; </script>";
                    exit;
                }
            } else {
                $fee = 0;
            }

            $new_wallet_balance = $wallet['WALLET_BALANCE']-$fee;

            $details = "Convert Ewallet ".$row['AMOUNT']." to PV  with fee ".$fee;

            $query = $db->prepare("UPDATE TRANSACTIONAL_DETAIL SET STATUS=?, details=? WHERE TRANS_ID=?");
            $query->execute(["ACCEPTED", $details, $trans_id]);

            $add = $db->prepare("UPDATE WALLET SET PIN_VALUE=?, WALLET_BALANCE=? WHERE USER_ID=?");
            $add->execute([$add_pin_value, $new_wallet_balance, $_POST['user_id']]);

        } elseif($trans_type=="redeem") {

            $user_wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
            $user_wallet->execute([$_POST['user_id']]);
            $user_wallet = $user_wallet->fetch();

            $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE TRANS_ID=?");
            $query->execute([$trans_id]);
            $row = $query->fetch();

            $query = $db->prepare("UPDATE `REDEEM HISTORY` SET REDEEMED_STATUS=?, APPROVED_DATE=?, APPROVED_BY=? WHERE CREATED_ID=?");
            $query->execute([1, $today, $user['user_name'], $trans_id]);
            
            $query = $db->prepare("UPDATE TRANSACTIONAL_DETAIL SET STATUS=? WHERE TRANS_ID=?");
            $query->execute(["ACCEPTED", $trans_id]);

            $query = $db->prepare("SELECT * from `REDEEM HISTORY` WHERE CREATED_ID=?");
            $query->execute([$trans_id]);
            $redeem = $query->fetch();

            $add_gold_value = $redeem['REDEEMED_VALUE']+$user_wallet['gold_value'];
            $add = $db->prepare("UPDATE WALLET SET gold_value=? WHERE USER_ID=?");
            $add->execute([$add_gold_value, $_POST['user_id']]);
        } elseif($trans_type=="withdraw") {

            if($_POST['fee']=="5.00") {
                    $fee = 5;
            } elseif($_POST['fee']=="5%") {
                $fee = ($row['AMOUNT']*5)/100;
                $fee = round($fee, 2);
            } elseif($_POST['fee']=="3%") {
                $fee = ($row['AMOUNT']*3)/100;
                $fee = round($fee, 2);
            } else {
                $fee = 0;
            }

            $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE TRANS_ID=?");
            $query->execute([$trans_id]);
            $row = $query->fetch();

            $details = "withraw ".$row['AMOUNT']." from wallet amount ".$row['balance']." with fee ".$fee;
            $query = $db->prepare("UPDATE TRANSACTIONAL_DETAIL SET STATUS=?, details=? WHERE TRANS_ID=?");
            $query->execute(["ACCEPTED", $details, $trans_id]);
            $today = Date("Y-m-d H:i:s");

            $query = $db->prepare("UPDATE WITHDRAWAL_HISTORY SET APPROVED_DATE=?, APPROVED_BY=?, WITHDRAWAL_FEE=?, WITHDRAWAL_STATUS=? WHERE Transaction_id=?");
            $query->execute([$today, $user['user_name'], $fee, "ACCEPTED", $trans_id]);

        }
        

    } else {
        if($trans_type=="transfer") {
            $query = $db->prepare("UPDATE TRANSACTIONAL_DETAIL SET STATUS=? WHERE TRANS_ID=?");
            $query->execute(["REJECTED", $trans_id]);
            $query->execute(["REJECTED", $trans_id+1]);
    
            $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE TRANS_ID=?");
            $query->execute([$trans_id]);
            $row = $query->fetch();
            $sender_id = $row['USER_ID'];
    
            $user_wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
            $user_wallet->execute([$sender_id]);
            $user_wallet = $user_wallet->fetch();
            $add_pin_value = $row['AMOUNT']+$user_wallet['PIN_VALUE'];
            $add = $db->prepare("UPDATE WALLET SET PIN_VALUE=? WHERE USER_ID=?");
            $add->execute([$add_pin_value, $sender_id]);
        } elseif($trans_type=="convert") {
            $query = $db->prepare("UPDATE TRANSACTIONAL_DETAIL SET STATUS=? WHERE TRANS_ID=?");
            $query->execute(["REJECTED", $trans_id]);

            $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE TRANS_ID=?");
            $query->execute([$trans_id]);
            $row = $query->fetch();
            $sender_id = $row['USER_ID'];

            $user_wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
            $user_wallet->execute([$sender_id]);
            $user_wallet = $user_wallet->fetch();
            $add_wallet_value = $row['AMOUNT']+$user_wallet['WALLET_BALANCE'];

            $add = $db->prepare("UPDATE WALLET SET WALLET_BALANCE=? WHERE USER_ID=?");
            $add->execute([$add_wallet_value, $sender_id]);

        } elseif($trans_type=="redeem") {

            $query = $db->prepare("UPDATE TRANSACTIONAL_DETAIL SET STATUS=? WHERE TRANS_ID=?");
            $query->execute(["REJECTED", $trans_id]);

            $query = $db->prepare("UPDATE `REDEEM HISTORY` SET REDEEMED_STATUS=? WHERE CREATED_ID=?");
            $query->execute([0, $trans_id]);

            $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE TRANS_ID=?");
            $query->execute([$trans_id]);
            $row = $query->fetch();
            $sender_id = $row['USER_ID'];
    
            $user_wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
            $user_wallet->execute([$sender_id]);
            $user_wallet = $user_wallet->fetch();

            $add_wallet_value = $row['AMOUNT']+$user_wallet['WALLET_BALANCE'];
            $add = $db->prepare("UPDATE WALLET SET WALLET_BALANCE=? WHERE USER_ID=?");
            $add->execute([$add_wallet_value, $sender_id]);

        } elseif($trans_type=="withdraw") {

            $query = $db->prepare("SELECT * from TRANSACTIONAL_DETAIL WHERE TRANS_ID=?");
            $query->execute([$trans_id]);
            $row = $query->fetch();
            $sender_id = $row['USER_ID'];

            $user_wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
            $user_wallet->execute([$sender_id]);
            $user_wallet = $user_wallet->fetch();

            $add_wallet_value = $row['AMOUNT']+$user_wallet['WALLET_BALANCE'];
            $add = $db->prepare("UPDATE WALLET SET WALLET_BALANCE=? WHERE USER_ID=?");
            $add->execute([$add_wallet_value, $sender_id]);

            $query = $db->prepare("UPDATE TRANSACTIONAL_DETAIL SET STATUS=? WHERE TRANS_ID=?");
            $query->execute(["REJECTED", $trans_id]);
            $today = Date("Y-m-d H:i:s");

            $query = $db->prepare("UPDATE WITHDRAWAL_HISTORY SET APPROVED_DATE=?, APPROVED_BY=?, WITHDRAWAL_STATUS=? WHERE Transaction_id=?");
            $query->execute([$today, $user['user_name'], "REJECTED", $trans_id]);



        }
        
    }
     $_SESSION['success'] = "Transaction Status Updated.";
    // echo '<script>alert("Transaction Status Updated.")</script>';
    echo "<script> location.href='admin-transaction-request.php'; </script>";

} elseif(isset($_POST['action']) && $_POST['action']=="reload_pin") {
    $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
    $wallet->execute([$user['user_id']]);
    $wallet = $wallet->fetch();
    $new_pin_value = $wallet['PIN_VALUE']+$_POST['pin_value'];
    $query = $db->prepare("UPDATE WALLET SET PIN_VALUE=? WHERE USER_ID=?");
    $query->execute([$new_pin_value, $user['user_id']]);
    $_SESSION['success'] = "Reload Pin Successful.";
    // echo '<script>alert("Reload Pin Successful.")</script>';
    echo "<script> location.href='admin-homepage.php'; </script>";
}

?>