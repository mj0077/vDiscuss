<?php
include '_dbconnect.php';
// if login form was filled
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = $_POST['loginemail'];
    $pass = $_POST['loginpass'];
    $showError = "false";

    $sql = "SELECT * FROM `users` WHERE user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    // if email exists
    if($numRows==0){
        $showError = "This email is not registered with us.";
    }
    // else check for passwords
    else {
        $row = mysqli_fetch_assoc($result);
        $name = $row['username'];
        $hash = $row['password'];
        if(password_verify($pass, $hash)){
            session_start();
            $_SESSION['loggedin'] = 'true';
            $_SESSION['username'] = $name;
            // echo var_dump($_SESSION);
            header("location:../index.php?sin=t&err=$showError");
            exit(); // this exit won't let line no.36 to run
            
        }
        else{
            $showError = "Credentials do not match. Please try again.";
        }
    }
    // now after the if-else check
    header("location:../index.php?sin=false&err=$showError");
    

}

?>