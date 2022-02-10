<?php
include './connection.php';
include './user_auth.php';

$data = json_decode(file_get_contents("php://input"), true);

if(isset($_POST['action']) && $_POST['action']=="profile_update") {

    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $phone = intval(preg_replace('/[^0-9]+/', '', $phone), 10);
    $full_name= $_POST['fullName'];
    $address_no=$_POST['address'];
    $city=$_POST['city'];
    $state= $_POST['state'];
    $postcode=$_POST['postcode'];
    $country=$_POST['inputCountry'];
    $bank_name = $_POST['bank_name'];
    $bank_acc_num = $_POST['bank_acc_number'];
    $query = $db->prepare("UPDATE USER_TABLE SET email=?, tel_no=?, full_name=?, address_no=?, city=?, state=?, postcode=?, country=?, bank_name=?, bank_acc_num=?  WHERE user_name=?");
    $query->execute([$email, $phone, $full_name, $address_no, $city, $state, $postcode, $country, $bank_name, $bank_acc_num, $_SESSION['username']]);
    $_SESSION['success'] = "Record Updated.";
    // echo '<script>alert("Record Updated.")</script>';
    echo "<script> location.href='member-profile.php'; </script>";
} elseif(isset($_POST['action']) && $_POST['action']=="password_update") {
    $password = $_POST['newPassword'];
    $confirm = $_POST['confirmNewPassword'];
    if($password!=$confirm) {
         $_SESSION['error'] = "Password and Confirm Password Did Not Match.";
        // echo '<script>alert("Password and Confirm Password Did Not Match.")</script>';
        echo "<script> location.href='member-account-setting.php'; </script>";
    } else {
        $query = $db->prepare("UPDATE USER_TABLE SET PASSWORD=? WHERE user_name=?");
        $query->execute([$password, $_SESSION['username']]);
         $_SESSION['success'] = "Password Updated.";
        // echo '<script>alert("Password Updated.")</script>';
        echo "<script> location.href='member-account-setting.php'; </script>";
    }
} elseif(isset($data['action']) && $data['action']=="reinvest_init") {
    $user_id = $data['user_id'];
    $query = $db->prepare("SELECT * from USER_TABLE WHERE user_id=?");
    $query->execute([$user_id]);
    $user = $query->fetch();
    
    $query = $db->prepare("SELECT * from PACKAGES WHERE PACKAGES_ID=?");
    $query->execute([$user['package_id']]);
    $current_package = $query->fetch();

    $query = $db->prepare("SELECT * from PACKAGES WHERE PACKAGES_PRICE>=?");
    $query->execute([$current_package['PACKAGES_PRICE']]);
    $packages = $query->fetchAll();
    echo json_encode(array('user'=>$user, 'current_package'=>$current_package ,'packages'=>$packages));
} elseif(isset($_POST['action']) && $_POST['action']=="reinvest") {
    $upgrade_package = $db->prepare("SELECT * from PACKAGES WHERE PACKAGES_ID=?");
    $upgrade_package->execute([$_POST['package']]);
    $upgrade_package = $upgrade_package->fetch();

    if($_POST['pin_value']<$upgrade_package['PACKAGES_PRICE']) {
         $_SESSION['error'] ="You do not have enough pins." ;
        // echo '<script>alert("You do not have enough pins.")</script>';
        echo "<script> location.href='member_reinvest.php'; </script>";
    } else {
        $member = $db->prepare("SELECT * from USER_TABLE WHERE user_id=?");
        $member->execute([$_POST['member']]);
        $member = $member->fetch();

        $old_expire_date = $member['expired_date'];
        $today = date('Y-m-d H:i:s');
        $expire_date = date('Y-m-d H:i:s', strtotime($old_expire_date. ' + '.$upgrade_package["PACKAGES_VALIDITY_PERIOD"].' days'));
        $query = $db->prepare("UPDATE USER_TABLE SET expired_date=?, package_id=? WHERE user_id=?");
        $query->execute([$expire_date, $_POST['package'], $_POST['member']]);
        $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
        $wallet->execute([$_POST['member']]);
        $wallet = $wallet->fetch();
        $new_pin_value = $wallet['PIN_VALUE']+$upgrade_package['PIN_VALUE'];
        $query = $db->prepare("UPDATE WALLET SET PIN_VALUE=? WHERE USER_ID=?");
        $query->execute([$new_pin_value, $_POST['member']]);

        $reduce = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
        $reduce->execute([$user['user_id']]);
        $reduce = $reduce->fetch();
        $reduce_pin_value = $reduce['PIN_VALUE']-$upgrade_package['PACKAGES_PRICE'];
        $query = $db->prepare("UPDATE WALLET SET PIN_VALUE=? WHERE USER_ID=?");
        $query->execute([$reduce_pin_value, $user['user_id']]);

        $reinvest = $db->prepare("INSERT into reinvest (user_id, sponser_id, package_id, reinvest_date) VALUES (?, ?, ?, ?)");
        $reinvest->execute([$_POST['member'], $user['user_id'], $_POST['package'], $today]);
         $_SESSION['success'] = "Reinvest Successful.";
        // echo '<script>alert("Reinvest Successful.")</script>';
        echo "<script> location.href='member_reinvest.php'; </script>";

    }
} elseif(isset($_POST['action']) && $_POST['action']=="send_pins") {
    if($_POST['pin_balance']<$_POST['amount']) {
         $_SESSION['error'] = "You do not have enough pins.";
        // echo '<script>alert("You do not have enough pins.")</script>';
        echo "<script> location.href='send_pins.php'; </script>";
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

        //transactions
        $user_id = $user['user_id'];
        $created_at = date('Y-m-d H:i:s');
        $status = "PENDING";
        $type = "PV";
        $balance = $reduce_pin_value;
        $details = "transfer ".$_POST['amount']." to ".$member_username." with fee 0";
        $query = $db->prepare("INSERT INTO TRANSACTIONAL_DETAIL (`USER_ID`, `AMOUNT`, `CREATED_DATE`, `PERCENTAGE`, `STATUS`, `details`, `balance`, `type`, `Level`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$user_id, $_POST['amount'], $created_at, 0, $status, $details, $balance, $type, NULL]);

        $user_id = $member_id;
        $type = NULL;
        $details = "Received ".$_POST['amount']." from ".$user['user_name']." with fee 0";
        $balance = $add_pin_value;
        $query = $db->prepare("INSERT INTO TRANSACTIONAL_DETAIL (`USER_ID`, `AMOUNT`, `CREATED_DATE`, `PERCENTAGE`, `STATUS`, `details`, `balance`, `type`, `Level`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$user_id, $_POST['amount'], $created_at, 0, $status, $details, $balance, $type, NULL]);
         $_SESSION['success'] = "Pin send Successful.";
        // echo '<script>alert("Pin send Successful.")</script>';
        echo "<script> location.href='send_pins.php'; </script>";

    }
} elseif(isset($_POST['action']) && $_POST['action']=="redeem_gold") {
    $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
    $wallet->execute([$user['user_id']]);
    $wallet = $wallet->fetch();
    $gold = $db->prepare("SELECT * from gold_update");
    $gold->execute([]);
    $gold = $gold->fetch();
    $max_gold_value = $wallet['WALLET_BALANCE']/$gold['gold_price'];
    $max_gold_value = floor($max_gold_value);
    if($_POST['gold_value']>$max_gold_value) {
         $_SESSION['error'] = "You do not have enough balance.";
        // echo '<script>alert("You do not have enough balance.")</script>';
        echo "<script> location.href='redeem-gold.php'; </script>";
    } else {
        $amount = $_POST['gold_value']*$gold['gold_price'];
        $new_wallet_balance = $wallet['WALLET_BALANCE']-$amount;
        $query = $db->prepare("UPDATE WALLET SET WALLET_BALANCE=? WHERE USER_ID=?");
        $query->execute([$new_wallet_balance, $user['user_id']]);

        $user_id = $user['user_id'];
        $created_at = date('Y-m-d H:i:s');
        $status = "PENDING";
        $type = "R";
        $balance = $new_wallet_balance;
        $details = "Redeem gold ".$amount." from wallet amount ".$wallet['WALLET_BALANCE'];
        $query = $db->prepare("INSERT INTO TRANSACTIONAL_DETAIL (`USER_ID`, `AMOUNT`, `CREATED_DATE`, `PERCENTAGE`, `STATUS`, `details`, `balance`, `type`, `Level`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$user_id, $amount, $created_at, 0, $status, $details, $balance, $type, NULL]);

        $query = $db->prepare("INSERT INTO `REDEEM HISTORY`(`USER_ID`, `CREATED_ID`, `REDEEMED_VALUE`, `REDEEMED_DATE`, `REDEEMED_STATUS`) VALUES (?, ?, ?, ?, ?)");
        $created_id = $db->lastInsertId();
        $query->execute([$user_id, $created_id, $_POST['gold_value'], $created_at, 0]);
         $_SESSION['success'] = "Redeem Gold Successful.";
        // echo '<script>alert("Redeem Gold Successful.")</script>';
        echo "<script> location.href='redeem-gold.php'; </script>";
    }
} elseif(isset($_POST['action']) && $_POST['action']=="ewallet_to_pins") {
    $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
    $wallet->execute([$user['user_id']]);
    $wallet = $wallet->fetch();
    if($_POST['amount']>$wallet['WALLET_BALANCE']) {
        $_SESSION['success'] = "You do not have enough balance.";
        // echo '<script>alert("You do not have enough balance.")</script>';
        echo "<script> location.href='send_ewallet_to_pins.php'; </script>";
    } else {
        $user_id = $user['user_id'];
        $created_at = date('Y-m-d H:i:s');
        $status = "PENDING";
        $type = NULL;
        $new_wallet_balance = $wallet['WALLET_BALANCE']-$_POST['amount'];
        $balance = $_POST['wallet_balance'];

        $query = $db->prepare("UPDATE WALLET SET WALLET_BALANCE=? WHERE USER_ID=?");
        $query->execute([$new_wallet_balance, $user['user_id']]);

        $details = "Convert Ewallet ".$_POST['amount']." to PV with fee 0";
        $query = $db->prepare("INSERT INTO TRANSACTIONAL_DETAIL (`USER_ID`, `AMOUNT`, `CREATED_DATE`, `PERCENTAGE`, `STATUS`, `details`, `balance`, `type`, `Level`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$user_id, $_POST['amount'], $created_at, 0, $status, $details, $new_wallet_balance, $type, NULL]);
         $_SESSION['success'] = "Ewallet to Pins Convert Successful.";
        // echo '<script>alert("Ewallet to Pins Convert Successful.")</script>';
        echo "<script> location.href='send_ewallet_to_pins.php'; </script>";
        
    }
} elseif(isset($_POST['action']) && $_POST['action']=="withdraw") {
    if(isset($_POST['bank_name']) && isset($_POST['bank_acc_num'])) {
        $bank_name = $_POST['bank_name'];
        $bank_acc_num = $_POST['bank_acc_num'];
        $query = $db->prepare("UPDATE USER_TABLE SET bank_name=?, bank_acc_num=? WHERE user_id=?");
        $query->execute([$bank_name, $bank_acc_num, $user['user_id']]);
    } else {
        $bank_name = $user['bank_name'];
        $bank_acc_num = $user['bank_acc_num'];
    }

    $wallet = $db->prepare("SELECT * from WALLET WHERE USER_ID=?");
    $wallet->execute([$user['user_id']]);
    $wallet = $wallet->fetch();
    if($_POST['amount']>$wallet['WALLET_BALANCE']) {
        $_SESSION['error'] ="You do not have enough balance.";
        // echo '<script>alert("You do not have enough balance.")</script>';
        echo "<script> location.href='withdraw.php'; </script>";
    } else {
        $today = Date("Y-m-d H:i:s");
        $amount = $_POST['amount'];
        $fee = 5;
        $status = "PENDING";
        $user_id = $user['user_id'];
        $balance = $wallet['WALLET_BALANCE']-$amount;
        $type = "W";
        $details = "withraw ".$amount." from wallet amount ".$wallet['WALLET_BALANCE']." with fee 5";
        
        $query = $db->prepare("UPDATE WALLET SET WALLET_BALANCE=? WHERE USER_ID=?");
        $query->execute([$balance, $user_id]);

        $query = $db->prepare("INSERT INTO TRANSACTIONAL_DETAIL (`USER_ID`, `AMOUNT`, `CREATED_DATE`, `PERCENTAGE`, `STATUS`, `details`, `balance`, `type`, `Level`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$user_id, $amount, $today, 0, $status, $details, $balance, $type, NULL]);

        $trans_id = $db->lastInsertId();
        $query = $db->prepare("INSERT INTO WITHDRAWAL_HISTORY (`USER_ID`, `CREATED_DATE`, `WITHDRAWAL_AMOUNT`, `BANK_NAME`, `BANK_ACC_NUMBER`, `WITHDRAWAL_FEE`, `WITHDRAWAL_STATUS`, `Transaction_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$user['user_id'], $today, $amount, $bank_name, $bank_acc_num, $fee, $status, $trans_id]);
        // echo '<script>alert("Withdraw request successful.")</script>';
         $_SESSION['success'] = "Withdraw request successful.";
        echo "<script> location.href='withdraw.php'; </script>";
    }
}

?>