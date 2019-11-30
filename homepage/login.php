
<?php
include("security.php");

if(isset($_POST['login'])){
    $username = $_POST['username'];
	$password = $_POST['password'];
	$passwd = md5($password);
	$q="SELECT id, customerName, password FROM tbl_customer WHERE customerName='$username' and password='$passwd' " ;
    $result=$conn->query($q);
    if(mysqli_num_rows($result)){
        $_SESSION['username']=$username;
        $_SESSION['id']=$id;
        header("Location: afterloginpage.php");
	}elseif(isset($_POST['forgotpass'])){
		// Go to forgot_password page!
		header("Location: forgot_password.php");

	}else{
        $_SESSION['status']="Email ID / Password is INVALID.";
        header("Location: loginform.html");
    }
}



if(isset($_POST['logout_btn'])){
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['iduser']);
	header("Location: superfast.html");
}



?>