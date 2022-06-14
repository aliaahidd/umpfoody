<?php
    require '../connection/dbase.php';
    session_start();
    /*$users_email=mysqli_real_escape_string($con,$_POST['users_email']);
    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if(!preg_match($regex_email,$users_email)){
        echo "Incorrect email. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=login.php" />
        <?php
    }*/
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $users_password=(mysqli_real_escape_string($con,$_POST['users_password']));
    if(strlen($users_password)<6){
        echo "Password should have atleast 6 characters. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=login.php" />
        <?php
    }
    $user_authentication_query="select userloginID, username, password from userlogin where username='$username' and password='$users_password'";
    $user_authentication_result=mysqli_query($con,$user_authentication_query) or die(mysqli_error($con));
    $rows_fetched=mysqli_num_rows($user_authentication_result);
    if($rows_fetched==0){
        //no user
        //redirecting to same login page
        ?>
        <script>
            window.alert("Wrong username or password");
        </script>
        <meta http-equiv="refresh" content="1;url=page-login.php" />
        <?php
        //header('location: login');
        //echo "Wrong email or password.";
    }else{
        $row=mysqli_fetch_array($user_authentication_result);
        $_SESSION['username']=$username;
        $_SESSION['userType']=$userType;
        $_SESSION['userloginID']=$row['userloginID'];  //user id

        //count cart user
        /*$query = "SELECT * FROM orders where userID = '".$_SESSION['users_userID']."' and orderStatus = 'Added to cart'";  
        $result = mysqli_query($con, $query);
        $count = mysqli_num_rows($result);

        $_SESSION['count'] = $count;

        //count order user
        $queryOrder = "SELECT * FROM orders where userID = '".$_SESSION['users_userID']."' and orderStatus = 'Pending'";  
        $resultOrder = mysqli_query($con, $queryOrder);
        $countOrder = mysqli_num_rows($resultOrder);

        $_SESSION['countOrder'] = $countOrder;*/

        // SESSION FOR RESTAURANT ONLY //


        // END SESSION FOR RESTAURANT ONLY //

        $userType = mysqli_real_escape_string($con,$_POST['userType']);

        if($userType == "General User"){
            header('location: ../views/userUI/userhome.php');
        }
        else if($userType == "Restaurant Owner"){
            $queryrestownerid = "SELECT * FROM restaurantdetails where userloginID = '".$_SESSION['userloginID']."'";  
            $resultqueryrestownerID = mysqli_query($con, $queryrestownerid);
            while ($row = mysqli_fetch_array($resultqueryrestownerID)) {

            $_SESSION['restaurantID'] = $row['restaurantID'];
            }

            header('location: ../views/restOwnerUI/restownerhome.php');
        }
        else if($userType == "Rider"){
            header('location: ../views/riderUI/riderhome.php');
        }
    }
    
 ?>