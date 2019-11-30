<?php

include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>




<!-- Modal -->
<div class="modal fade" id="packagesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Packages</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="packagescrud.php" method="post"> 
            <div class="modal-body">
                <div class="form-group">
                <label >Name</label>
                <input type="text" name="packname" class="form-control"  placeholder="Enter Name" required>
            </div>

            <div class="form-group">
                <label >Price</label>
                <input type="number" name="packprice"class="form-control" placeholder="Enter Price" required>
            </div>

            <div class="form-group">
                <label >Description</label>
                <input type="text" name="packdesc" class="form-control"  placeholder="Enter Description" required>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="addpackages" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>




<div class="container-fluid">

<!-- DataTables Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Packages
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#packagesModal">
              Add Packages
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
        $query="SELECT * FROM tbl_packages";
        $result=$conn->query($query);
        ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>EDIT</th>
            <th>DELETE </th>
          </tr>
        </thead>
       
        <tbody>
          <?php
          if(mysqli_num_rows($result)>0){
            while($rows = mysqli_fetch_assoc($result)){
          ?>
            <tr>
            <td><?php echo $rows['id'] ?></td>
            <td><?php echo $rows['Name']; ?></td>
            <td><?php echo $rows['Price']; ?></td>
            <td><?php echo $rows['Description']; ?></td>
            <td>
            <form action="packages_edit.php" method="POST" >
              <input type="hidden" name="edit_pack_id" value=" <?php echo $rows['id']; ?> " >
              <button type="submit" name="edit_pack_btn" class="btn btn-success"> EDIT </button>
              </form>
            </td>
            
            <td>
            <form action="packagescrud.php" method="post"> 
            <input type="hidden" name="delete_pack_id" value="<?php echo $rows['id']; ?>"> 
            <button type="submit" name="delete_pack_btn" class="btn btn-danger">DELETE</button>
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