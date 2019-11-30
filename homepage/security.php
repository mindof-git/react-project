<?php
session_start();

include('connect.php');

if($conn){
    //echo "Database Connected";
}else{
    header("Location: connect.php");
}
if(!$_SESSION['username'] ){
    header("Location: login.php");
}


?>