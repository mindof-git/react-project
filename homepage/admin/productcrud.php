<?php
include('security.php');



if(isset($_POST['addproducts'])){
    $name=$_POST['proname'];
    $price=$_POST['proprice'];
    $desc=$_POST['prodesc'];
    $img=$_FILES["proimage"]["name"];

    if(file_exists("upload/".$_FILES["proimage"]["name"])){
        $store=$_FILES["proimage"]["name"];
        $_SESSION['status']="Image is already EXISTED '.$store.' ";
        header("Location: products.php");

    }else{ 
        $query=" INSERT tbl_product (name, image, price, description) values ('$name','$img', '$price', '$desc')" ; 
        $result=$conn->query($query);
            if($result){
                move_uploaded_file($_FILES["proimage"]["tmp_name"], "upload/".$_FILES["proimage"]["name"]);
                $_SESSION['success']="Products Added";
                header("Location: products.php");
            }else{
                $_SESSION['status']="Products Not Added";
                header("Location: products.php");
            }

    }
            
    
}

if(isset($_POST['update_pro_btn'])){
    $edit_id=$_POST['edit_proid'];
    $edit_name=$_POST['edit_name'];
    $edit_price=$_POST['edit_price'];
    $edit_desc=$_POST['edit_desc'];
    $edit_file=$_FILES["proimage"]["name"];

    $query=" UPDATE tbl_product SET name='$edit_name', image='$edit_file', price='$edit_price', description='$edit_desc' 
    WHERE id ='$edit_id'; " ; 
    $result=$conn->query($query);
        if($result){
            move_uploaded_file($_FILES["proimage"]["tmp_name"], 
            "upload/".$_FILES["proimage"]["name"]);
            $_SESSION['success']="Products Updated";
            header("Location: products.php");
        }else{
            $_SESSION['status']="Products Not Updated";
            header("Location: products.php");
        }

 }


 if(isset($_POST['delete_pro_btn'])){
    $id=$_POST['delete_pro_id'];
    $query="DELETE from tbl_product where id='$id';";
    $result=$conn->query($query);

    if($result){
        $_SESSION['success'] ="Your Data is DELETED.";
        header("Location: products.php");
    }else{
        $_SESSION['status'] ="Your Data is NOT DELETED.";
        header("Location: products.php");
    }
}

?>