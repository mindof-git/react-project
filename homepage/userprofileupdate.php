<?php

include("security.php");


if(isset($_POST['edit_profile'])){
    $id=$_POST['edit_id'];
    $name 	    = $_POST['username'];
    $addr 		= $_POST['address'];
    $city		= $_POST['city'];
    $postalcode = $_POST['postalcode'];
    $country 	= $_POST['country'];
    $pwd 		= $_POST['password'];
    $passwd 	= md5($pwd);


    $query="UPDATE tbl_customer SET customerName='$name', Address='$addr', City='$city',
    PostalCode='$postalcode', Country='$country', Password='$passwd'
    WHERE id='$id';";
    $result=$conn->query($query);

    if($result){
        $_SESSION['success'] ="Your Profile is Updated.";
        header("Location: userprofile.php");
    }else{
        $_SESSION['status'] ="Your Profile is Not Updated.";
        header("Location: userprofile.php");
    }


}






?>