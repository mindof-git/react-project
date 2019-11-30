<?php


include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>




<!-- Modal -->
<!-- <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="usercrud.php" method="post" enctype="multipart/form-data" > 
            <div class="modal-body">
                <div class="form-group">
                <label >Name</label>
                <input type="text" name="username" class="form-control"  placeholder="Enter Name" required>
            </div>

            <div class="form-group">
                <label >Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
            </div>

            <div class="form-group">
                <label >Password</label>
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

</form> -->


<div class="container-fluid">

<!-- DataTables Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Customers Order Records
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productsModal">
              Add Customers
            </button> -->
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
        $query = '  
        SELECT * FROM tbl_order  
        INNER JOIN tbl_order_details  
        ON tbl_order_details.orderID = tbl_order.orderID  
        INNER JOIN tbl_customer  
        ON tbl_customer.id = tbl_order.customerID 
        WHERE tbl_order.orderID < 1000  
        ';  
        $result=$conn->query($query);
        if(mysqli_num_rows($result)>0){
        ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>customerID</th>
            <th>customerName</th>
            <th>orderID</th>
            <th>creationDate</th>
            <th>orderStatus</th>
            <th>orderCost</th>
            <th>orderDetail</th>
            <th>orderQuantities</th>
            
          </tr>
        </thead>
       
        <tbody>
        <?php
            while($rows = mysqli_fetch_assoc($result)){
          ?>
            <tr>
            <td><?php echo $rows['id']; ?></td>
            <td><?php echo $rows['customerName']; ?></td>
            <td><?php echo $rows['orderID']; ?></td>
            <td><?php echo $rows['creationDate']; ?></td>
            <td><?php echo $rows['orderStatus']; ?></td>
            <td><?php echo $rows['product_price']; ?></td>
            <td><?php echo $rows['product_name']; ?></td>
            <td><?php echo $rows['product_quantity']; ?></td>
            
            <!-- <td>
            <form action="user_edit.php" method="POST" >
              <input type="hidden" name="usereditid" value=" <?php echo $rows['id']; ?> " >
              <button type="submit" name="usereditbtn" class="btn btn-success"> EDIT </button>
              </form>
            </td>
            
            <td>
            <form action="usercrud.php" method="post" >
            <input type="hidden" name="deluserid" value="<?php echo $rows['id']; ?>">
              <button type="submit" name="deluserbtn" class="btn btn-danger">DELETE</button>
            </form>
            </td> -->
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