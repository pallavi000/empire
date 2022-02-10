<?php      
    include './connection.php';
    include './admin_auth.php';
    ini_set('display_errors', 1);
    
    $username = $_POST['username'];  
    $password = $_POST['password'];  
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $phone = intval(preg_replace('/[^0-9]+/', '', $phone), 10);
  
    $join_date = $_POST['joinDate'];
    $sponser_by = $_POST['sponsorBy'];

    $package_id = filter_input(INPUT_POST, 'inputPlan', FILTER_SANITIZE_STRING);
    $package = $db->prepare("SELECT * from PACKAGES WHERE PACKAGES_ID=?");
    $package->execute([$package_id]);
    $package = $package->fetch();
    $expire_date = date('Y-m-d H:i:s', strtotime($join_date. ' + '.$package["PACKAGES_VALIDITY_PERIOD"].' days'));
    
    $user_status= 'INACTIVE';
    $user_type= 'AG';
    $full_name= $_POST['fullName'];
    $address_no=$_POST['address'];
    $city=$_POST['city'];
    $state= $_POST['state'];
    $postcode=$_POST['postcode'];
    $country=$_POST['inputCountry'];
    $secret_key= $_POST['secretkey'];
    $query = $db->prepare("SELECT * from USER_TABLE WHERE user_name=?");
    $query->execute([$_POST['sponsorBy']]);
    $row = $query->fetch();
    $genealogy_user_id = $row['user_id'];

    $query = $db->prepare("INSERT into USER_TABLE (user_id, user_name, PASSWORD, EMAIL, tel_no, joined_date, expired_date, sponser_by, package_id, bank_name, bank_acc_num, user_status, genealogy_user_id, user_type, full_name, address_no, city, state, postcode, country, secret_key, makan_level) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
   
    $query->execute([NULL, $username, $password, $email, $phone, $join_date, $expire_date, $sponser_by, $package_id, NULL, NULL, $user_status, $genealogy_user_id, $user_type, $full_name, $address_no, $city , $state, $postcode, $country, $secret_key, NULL]);

    $user_id = $db->lastInsertId();

    $point_value = $_POST['point'];
    if($package['PACKAGES_NAME']=="PLAN3600") {
        $point_value = 0;
    }
    $q = $db->prepare("INSERT into WALLET (WALLET_BALANCE, PIN_VALUE, USER_ID, BONUS_SPONSER, BONUS_KEYIN,  gold_value, POINT_VALUE) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $q->execute([0, 0, $user_id, 0, 0, 0, $point_value]);

    // $sql = "INSERT INTO USER_TABLE (user_id, user_name, PASSWORD, EMAIL, tel_no, joined_date, expired_date, sponser_by, package_id, bank_name, bank_acc_num, user_status, genealogy_user_id, user_type, full_name, address_no, city, state, postcode, country, secret_key, makan_level)
    //      VALUES (NULL, '$username', '$password', '$email', '$phone', '$join_date', '2021-11-26 23:23:54', '$sponser_by', '$package_id', NULL, NULL, '$user_status', NULL, '$user_type', '$full_name', '$address_no', '$city ', '$state', '$postcode', '$country', '$secret_key', NULL)";
    //     $result = mysqli_query($con, $sql);  
    //     // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    //     // $count = mysqli_num_rows($result);  
          
        if($query){
                     $_SESSION['success'] = "Records added successfully.";
            // echo '<script>alert("Records added successfully.")</script>';
        } else{
            // echo '<script>alert("ERROR: Could not able to execute.")</script>';
            $_SESSION['error'] = "Could not able to execute.";

        }
        
        
        echo "<script> location.href='admin_register_member.php'; </script>";
?>  