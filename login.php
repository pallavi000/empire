<?php      
    include './connection.php';  
    session_start();
    $username = $_POST['user'];  
    $username = trim(htmlentities(strip_tags($username)));
    $password = $_POST['pass'];
    $password = trim(htmlentities(strip_tags($password)));

    
        // //to prevent from mysqli injection  
        // $username = stripcslashes($username);  
        // $password = stripcslashes($password);  
        // $username = mysqli_real_escape_string($con, $username);  
        // $password = mysqli_real_escape_string($con, $password); 

        $sql = $db->prepare("SELECT * from USER_TABLE WHERE user_name=? AND PASSWORD=?");
        $sql->execute([$username, $password]);
        $count = $sql->rowCount();
        if($count == 1) {
            $row = $sql->fetch();
            if($row["user_status"]=="ACTIVE") {
                // echo '<script>alert("Login successful")</script>'; 
                if($row['user_type']==="AD") {
                    $_SESSION['admin_username'] = $username;
                    $_SESSION['success'] = "Login Success!";
                    echo "<script> location.href='admin-homepage.php'; </script>";
                } else {
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = 'Login Success';
                    echo "<script> location.href='homepage.php'; </script>";
                }
            } else {
                $_SESSION['error'] = "Your account is not active yet. Account Status: ".$row["user_status"];
                // echo '<script>alert("Your account is not active yet. Account Status: '.$row["user_status"].'")</script>'; 
                echo "<script> location.href='index.php'; </script>";
            }
        } else {
            $_SESSION['error'] = "Login failed. Invalid username or password.";
           // echo '<script>alert("Login failed. Invalid username or password.")</script>'; 
            echo "<script> location.href='index.php'; </script>";
        }
      
        // $sql = "select * from USER_TABLE where user_name = '$username' and PASSWORD = '$password'";  
        // $result = mysqli_query($con, $sql);  
        // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        // $count = mysqli_num_rows($result);  
          
        // if($count == 1){  
        //     //echo "<h1><center> Login successful </center></h1>";  
        //       echo '<script>alert("Login successful")</script>'; 
        //     echo "<script> location.href='admin_register_member.php'; </script>";
            
        // }  
        // else{  
        //     //echo "<h1> Login failed. Invalid username or password.</h1>"; 
        //     echo '<script>alert("Login failed. Invalid username or password.")</script>'; 
        // }     
?>  