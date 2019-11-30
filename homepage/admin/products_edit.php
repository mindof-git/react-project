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
    <h6 class="m-0 font-weight-bold text-primary">Edit Products
            
    </h6>
  </div>

  <div class="card-body">
      <?php
      if(isset($_POST['edit_data_btn'])){
          $proid=$_POST['edit_proid'];
          $query="SELECT * FROM tbl_product where id='$proid';";
          $result=$conn->query($query);

          foreach($result as $rows){
            ?>

            <form action="productcrud.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="edit_proid" value="<?php echo $rows['id'] ?>" >
                    <div class="form-group">
                    
                              <label> Name </label>
                              <input type="text" name="edit_name" value="<?php echo $rows['name'] ?>" class="form-control" >
                          </div>
                          <div class="form-group">
                              <label>Price</label>
                              <input type="number" name="edit_price" value="<?php echo $rows['price'] ?>" class="form-control" >
                          </div>
                          <div class="form-group">
                              <label>Description</label>
                              <input type="text" name="edit_desc" value="<?php echo $rows['description']?>" class="form-control" >
                          </div>
                          <div class="form-group">
                              <label>Upload File</label>
                              <input type="file" name="edit_file" id="proimage" value="<?php echo $rows['image'] ?>" class="form-control" >
                          </div>
                            <a href="products.php" class="btn btn-danger">CANCEL</a>
                          <button type="submit" name="update_pro_btn" class="btn btn-primary">Update</button>
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