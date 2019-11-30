<?php

ini_set('display_errors', '1');

include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 

?>

<div class="container-fluid">

<!-- DataTables Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Edit Admin Profile 
            
    </h6>
  </div>

  <div class="card-body">
      <?php
      if(isset($_POST['edit_btn'])){
          $id=$_POST['edit_id'];
          $query="select * from admin where staffID='$id';";
          $result=$conn->query($query);

          foreach($result as $rows){
            ?>

    <form action="registercrud.php" method="post">
    <input type="hidden" name="edit_id" value="<?php echo $rows['staffID']; ?>" >
            <div class="form-group">
            
                      <label> Username </label>
                      <input type="text" name="edit_username" value="<?php echo $rows['staffName']; ?>" class="form-control" placeholder="Enter Username">
                  </div>
                  <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="edit_email" value="<?php echo $rows['Email']; ?>"class="form-control" placeholder="Enter Email">
                  </div>
                  <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="edit_password" value="<?php echo $rows['Password']; ?>"class="form-control" placeholder="Enter Password">
                  </div>
                    <a href="register.php" class="btn btn-danger">CANCEL</a>
                  <button type="submit" name="updatebtn" class="btn btn-primary">Update</button>
              </form>
             <?php
                  
          }
      }
      ?>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->





<?php
include('includes/scripts.php');
include('includes/footer.php');
?>