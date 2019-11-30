<?php
include("security.php");

?>
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>SuperFast ISP</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:800px;">  
                <h3 text-align="center">SuperFast Internet Service Provider</h3><br />  
                <ul class="nav nav-tabs">  
                     <li class="active"><a data-toggle="tab" href="#packages">Packages</a></li>  
                     <li><a data-toggle="tab" href="#cart">Cart <span class="badge"><?php if(isset($_SESSION["s_cart"])) { echo count($_SESSION["s_cart"]); } else { echo '0';}?></span></a></li>  
                </ul>  
                <div class="tab-content">  
                     <div id="packages" class="tab-pane fade in active">  
                     <?php  
                     $query = "SELECT * FROM tbl_packages ORDER BY id ASC";  
                     $result = $conn->query($query) ;  
                     while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))  
                     {  
                     ?>  
                     <div class="col-md-4" style="margin-top:12px;">  
                          <div style="border:0.5px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:350px;" text-align="center">  
              
                               <h4 class="text-info"><?php echo $row["Name"]; ?></h4>  
                               <h4 class="text-danger"><?php echo $row["Price"]; ?></h4>
                               <h4 class="text-info"><?php echo $row["Description"]; ?></h4>  
                               <input type="text" name="quantity" id="Quantity<?php echo $row["id"]; ?>" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" id="Name<?php echo $row["id"]; ?>" value="<?php echo $row["Name"]; ?>" />  
                               <input type="hidden" name="hidden_price" id="Price<?php echo $row["id"]; ?>" value="<?php echo $row["Price"]; ?>" />  
                               <input type="hidden" name="hidden_desc" id="Desc<?php echo $row["id"]; ?>" value="<?php echo $row["Desrciption"]; ?>" />  
                               <input type="button" name="add_to_cart" id="<?php echo $row["id"]; ?>" style="margin-top:5px;" class="btn btn-warning form-control add_to_cart" value="Add to Cart" />  
                          </div>  
                     </div>  
                     <?php  
                     }  
                     ?>  
                     </div>  <div id="cart" class="tab-pane fade">  
                          <div class="table-responsive" id="order_table">  
                               <table class="table table-bordered">  
                                    <tr>  
                                         <th width="40%">Packages Name</th>  
                                         <th width="10%">Quantity</th>  
                                         <th width="20%">Price</th>  
                                         <th width="15%">Total</th>  
                                         <th width="5%">Action</th>  
                                    </tr>  
                                    <?php  
                                    if(!empty($_SESSION["s_cart"]))  
                                    {  
                                         $total = 0;  
                                         foreach($_SESSION["s_cart"] as $keys => $values)  
                                         {                                               
                                    ?>  
                                    <tr>  
                                         <td><?php echo $values["package_name"]; ?></td>  
                                         <td><input type="text" name="quantity[]" id="quantity<?php echo $values["package_id"]; ?>" 
                                         value="<?php echo $values["package_quantity"]; ?>" data-package_id="<?php echo $values["package_id"]; ?>" 
                                         class="form-control quantity" /></td>  
                                         <td text-align="right">$ <?php echo $values["package_price"]; ?></td>  
                                         <td text-align="right">$ <?php echo number_format($values["package_quantity"] * $values["package_price"], 2); ?></td>  
                                         <td><button name="delete" class="btn btn-danger btn-xs delete" id="<?php echo $values["package_id"]; ?>">Remove</button></td>  
                                    </tr>  
                                    <?php  
                                              $total = $total + ($values["package_quantity"] * $values["package_price"]);  
                                         }  
                                    ?>  
                                    <tr>  
                                         <td colspan="3" text-align="right">Total</td>  
                                         <td text-align="right">$ <?php echo number_format($total, 2); ?></td>  
                                         <td></td>  
                                    </tr>  
                                    <tr>  
                                         <td colspan="5" text-align="center">  
                                              <form action="packagecart.php" method="post">  
                                                   <input type="submit" name="place_order" class="btn btn-warning" value="Place Order" />  
                                              </form>  
                                         </td>  
                                    </tr>  
                                    <?php  
                                    }  
                                    ?>  
                               </table>  
                          </div>  
                     </div>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(data){  
      $('.add_to_cart').click(function(){  
           var package_id = $(this).attr("id");  
           var package_name = $('#Name'+package_id).val();  
           var package_price = $('#Price'+package_id).val();  
           var package_quantity = $('#Quantity'+package_id).val();  
           var action = "add";  
           if(package_quantity > 0)  
           {  
                $.ajax({  
                     url:"packageaction.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{  
                          package_id: package_id,   
                          package_name: package_name,   
                          package_price: package_price,   
                          package_quantity: package_quantity,   
                          action: action  
                     },  
                     success:function(data)  
                     {  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                          alert("Package has been Added into Cart");  
                     }  
                });  
           }  
           else  
           {  
                alert("Please Enter Number of Quantity")  
           }  
      });  
      $(document).on('click', '.delete', function(){  
           var package_id = $(this).attr("id");  
           var action = "remove";  
           if(confirm("Are you sure you want to remove this package?"))  
           {  
                $.ajax({  
                     url:"packageaction.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{package_id:package_id, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                     }  
                });  
           }  
           else  
           {  
                return false;  
           }  
      });  
      $(document).on('keyup', '.quantity', function(){  
           var package_id = $(this).data("package_id");  
           var quantity = $(this).val();  
           var action = "quantity_change";  
           if(quantity != '')  
           {  
                $.ajax({  
                     url :"packageaction.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{package_id:package_id, quantity:quantity, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                     }  
                });  
           }  
      });  
 });  
 </script>

