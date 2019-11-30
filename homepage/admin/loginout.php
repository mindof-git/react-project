<?php
include("security.php");

if(isset($_POST['login_btn'])){
    $email_login=$_POST['emaill'];
    $password_login=$_POST['passwordd'];

    $query="SELECT * From admin where Email='$email_login' AND Password='$password_login';";
    $result=$conn->query($query);
    if(mysqli_fetch_array($result)){
        $_SESSION['username']=$email_login;
        header("Location: index.php");
    }else{
        $_SESSION['status']="Email ID / Password is INVALID.";
        header("Location: login.php");
    }
}



if(isset($_POST['logout_btn'])){
    session_destroy();
    unset($_SESSION['username']);
}



?>