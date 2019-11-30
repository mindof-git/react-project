<?php
ini_set('display_errors', '1');

include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>




<!-- Modal -->
<div class="modal fade" id="productsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="productcrud.php" method="post" enctype="multipart/form-data" > 
            <div class="modal-body">
                <div class="form-group">
                <label >Name</label>
                <input type="text" name="proname" class="form-control"  placeholder="Enter Name" required>
            </div>

            <div class="form-group">
                <label >Price</label>
                <input type="number" name="proprice" class="form-control" placeholder="Enter Price" required>
            </div>

            <div class="form-group">
                <label >Description</label>
                <input type="text" name="prodesc" class="form-control"  placeholder="Enter Description" required>
            </div>

            <div class="form-group">
                <label >Upload Image</label>
                <input type="file" name="proimage" id="proimage" class="form-control" >
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addproducts" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>




<div class="container-fluid">

<!-- DataTables Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Products
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productsModal">
              Add Products
            </button>
    </h6>
  </div>

  <div class="card-body">
  <?php 
        if(isset($_SESSION['success']) && $_SESSION['success'] !=''){
          echo '<h2 class="bg-primary text-white">'.$_SESSION['success'].'</h2>';
          unset($_SESSION['success']);
        }
      


        if(isset($_SESSION['status']) && $_SESSION['status'] !=''){
          echo '<h2 class="bg-danger text-white">'.$_SESSION['status'].'</h2>';
          unset($_SESSION['status']);
        }
      
      
      ?>
    <div class="table-responsive">
        <?php
        $query="SELECT * FROM tbl_product";
        $result=$conn->query($query);
        if(mysqli_num_rows($result)>0){
        ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>EDIT</th>
            <th>DELETE </th>
          </tr>
        </thead>
       
        <tbody>
        <?php
            while($rows = mysqli_fetch_assoc($result)){
          ?>
            <tr>
            <td><?php echo $rows['id']; ?></td>
            <td><?php echo $rows['name']; ?></td>
            <td><?php echo $rows['price']; ?></td>
            <td><?php echo $rows['description']; ?></td>
            <td><?php echo '<img src="upload/'.$rows['image'].'" width="100px;" height="100px;" alt="Image">'?> </td>
            <td>
            <form action="products_edit.php" method="POST" >
              <input type="hidden" name="edit_proid" value=" <?php echo $rows['id']; ?> " >
              <button type="submit" name="edit_data_btn" class="btn btn-success"> EDIT </button>
              </form>
            </td>
            
            <td>
            <form action="productcrud.php" method="post" >
            <input type="hidden" name="delete_pro_id" value="<?php echo $rows['id']; ?>">
              <button type="submit" name="delete_pro_btn" class="btn btn-danger">DELETE</button>
            </form>
            </td>
          </tr>

        <?php
          }
        ?>
      
        </tbody>
      </table>
      <?php
        
       }else{
        echo "No Record Found";
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