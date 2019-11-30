<?php
$server_name="localhost";
$user_name="root";
$user_password="";
$data_access="tql";

$conn=new mysqli($server_name,$user_name,$user_password,$data_access);

if ($conn->connect_errno){
	echo $conn->connect_errno.":".$conn->connect_error;
}
//else{
//	echo "Connection Sucessfully";
//}


?>