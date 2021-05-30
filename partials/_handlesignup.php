<?php
include '_dbconnect.php';
// if signup form was filled
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['username'];
    $email = $_POST['signupemail'];
    $pass = $_POST['signuppass'];
    $cpass = $_POST['signupcpass'];
    $showError = "false";

    $sql = "SELECT * FROM `users` WHERE user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    // if email exists
    if($numRows!=0){
        $showError = "This email is already registered with us.";
    }
    // else check for passwords
    else {
        if($pass==$cpass){
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `user_email`, `password`) VALUES ('$name', '$email', '$pass');";
            $result = mysqli_query($conn, $sql);
            if($result){
                header("location:../index.php?ins=true&err=$showError");
                exit();
            }
        }
        else{
            $showError = "Passwords do not match. Please try again.";
        }
    }
    // now after the if-else check
    header("location:../index.php?ins=false&err=$showError");
    

}

?>