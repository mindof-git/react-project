<?php


include('security.php');

if(isset($_POST['addpackages'])){
    $name=$_POST['packname'];
    $price=$_POST['packprice'];
    $desc=$_POST['packdesc'];
    
    $query=" INSERT tbl_packages SET Name='$name', Price='$price',  Description='$desc' " ; 
    $result=$conn->query($query);
    if($result){
        $_SESSION['success']="Packages Added";
        header("Location: packages.php");
    }else{
        $_SESSION['status']="Packags Not Added";
        header("Location: packages.php");
            
    }
  
}

if(isset($_POST['update_pack_btn'])){
    $edit_pid=$_POST['edit_pack_id'];
    $edit_pname=$_POST['edit_pname'];
    $edit_pprice=$_POST['edit_pprice'];
    $edit_pdesc=$_POST['edit_pdesc'];

    $query=" UPDATE tbl_packages SET Name='$edit_pname', Price='$edit_pprice', Description='$edit_pdesc' 
    WHERE id ='$edit_pid' " ; 
    $result=$conn->query($query);
        if($result){
            $_SESSION['success']="Packages Updated";
            header("Location: packages.php");
        }else{
            $_SESSION['status']="Packages Not Updated";
            header("Location: packages.php");
        }

 }

 if(isset($_POST['delete_pack_btn'])){
    $id=$_POST['delete_pack_id'];
    $query="DELETE from tbl_packages where id='$id';";
    $result=$conn->query($query);

    if($result){
        $_SESSION['success'] ="Your Data is DELETED.";
        header("Location: packages.php");
    }else{
        $_SESSION['status'] ="Your Data is NOT DELETED.";
        header("Location: packages.php");
    }
}


?>















