<?php
ini_set('display_errors', '1');

include("security.php");


if(isset($_POST['registerbtn'])){
    
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $cpassword=$_POST['confirmpassword'];

if($password === $cpassword){

    $query="INSERT INTO admin (staffName, Email, Password) values ('$username', '$email', '$password');";
    $result=$conn->query($query);

    if($result){
        $_SESSION['success']="Admin Profile Added";
        header("Location: register.php");
    }
    else{
        $_SESSION['status']="Admin Profile NOT Added";
        header("Location: register.php");

    }

}
else{
    $_SESSION['status']="Password and Confirm Password Does Not Match!";
    header("Location: register.php");
}


}



if(isset($_POST['edit_btn'])){
    $id=$_POST['edit_id'];
    $query="select * from admin where id='$id'";
    $result=$conn->query($query);

}




if(isset($_POST['updatebtn'])){
    $id=$_POST['edit_id'];
    $username=$_POST['edit_username'];
    $email=$_POST['edit_email'];
    $password=$_POST['edit_password'];

    $query="UPDATE admin SET staffName='$username', Email='$email', Password='$password'
    WHERE staffID='$id';";
    $result=$conn->query($query);

    if($result){
        $_SESSION['success'] ="Your Data is Updated.";
        header("Location: register.php");
    }else{
        $_SESSION['status'] ="Your Data is Not Updated.";
        header("Location: register.php");
    }
}


if(isset($_POST['delete_btn'])){
    $id=$_POST['delete_id'];
    $query="DELETE from admin where staffID='$id';";
    $result=$conn->query($query);

    if($result){
        $_SESSION['success'] ="Your Data is DELETED.";
        header("Location: register.php");
    }else{
        $_SESSION['status'] ="Your Data is NOT DELETED.";
        header("Location: register.php");
    }
}



?>