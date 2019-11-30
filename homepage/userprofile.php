<?php
include('security.php');

?>


    
      <div class="card-body">
          <?php
          if(isset($_POST['edit-btn'])){
              $name=$_POST['username'];
              $query="select * from tbl_customer where customerName='$name';";
              $result=$conn->query($query);
    
              foreach($result as $rows){
                ?>

                <form action="userprofileupdate.php" method="post">
                    
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Username</label>
                        <input type="text" name="username" class="form-control" id="inputName" placeholder="New Username">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword4" placeholder=" New Password">
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" name="city" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">Country</label>
                        <select id="inputState" name="country" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Zip</label>
                        <input type="text" name="postalcode" class="form-control" id="inputZip">
                    </div>
                    </div>
                        <input type="hidden" name="edit_id" value="<?php echo $rows['id']; ?>">
						<button type="submit" name="edit_profile" class="btn btn-primary">Update Profile</button>

						
                </form>
                <?php
                  
          }
      }
      ?>


</div>