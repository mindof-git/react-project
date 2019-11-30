<?php


include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 

?>

<div class="container-fluid">

<!-- DataTables Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Edit Packages
            
    </h6>
  </div>

  <div class="card-body">
      <?php
      if(isset($_POST['edit_pack_btn'])){
          $packid=$_POST['edit_pack_id'];
          $query="SELECT * FROM tbl_packages where id='$packid';";
          $result=$conn->query($query);

          foreach($result as $rows){
            ?>

            <form action="packagescrud.php" method="post">
            <input type="hidden" name="edit_pack_id" value="<?php echo $rows['id']; ?>" >
                    <div class="form-group">
                    
                      <label> Name </label>
                      <input type="text" name="edit_pname" value="<?php echo $rows['Name']; ?>" class="form-control" >
                    </div>
                         
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="edit_pprice" value="<?php echo $rows['Price']; ?>" class="form-control" >
                    </div>
                          
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="edit_pdesc" value="<?php echo $rows['Description']; ?>" class="form-control" >
                    </div>
                          
                    <a href="packages.php" class="btn btn-danger">CANCEL</a>
                    <button type="submit" name="update_pack_btn" class="btn btn-primary">Update</button>
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
//include('includes/footer.php');
?>