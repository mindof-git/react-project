<?php  
 //cart.php  
include("security.php");
//require_once("connect.php");
?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>SuperFast Internet Service Provider</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:800px;">  
                 <?php  
                    
                    
                if(isset($_POST["place_order"]))  
                {  
                     $insert_order = "  
                     INSERT INTO tbl_order(customerID, creationDate, orderStatus)  
                     VALUES('4', '".date('Y-m-d')."', 'success')  
                     ";  
                     $order_id = "";  
                     if($conn->query($insert_order))  
                     {  
                          $order_id = $conn->insert_id;  
                     }  
                     $_SESSION["order_id"] = $order_id;  
                     $order_details = "";  

                     foreach((array)$_SESSION["s_cart"] as $keys => $values)
                     {  
                          $order_details .= "  
                          INSERT INTO tbl_order_details(orderID, package_name, package_price, package_quantity)  
                          VALUES('".$order_id."', '".$values["package_name"]."', '".$values["package_price"]."', '".$values["package_quantity"]."');  
                          ";  
                     }  
                     if($conn->multi_query($order_details))  
                     {  
                          unset($_SESSION["s_cart"]);  
                          echo '<script>alert("You have successfully place an order...Thank you")</script>';  
                          echo '<script>window.location.href="packagecart.php"</script>';  
                     }  
                }  
                if(isset($_SESSION["order_id"]))  
                {  
                     $customer_details = '';  
                     $order_details = '';  
                     $total = 0;  
                     $query = '  
                     SELECT * FROM tbl_order  
                     INNER JOIN tbl_order_details  
                     ON tbl_order_details.orderID = tbl_order.orderID  
                     INNER JOIN tbl_customer  
                     ON tbl_customer.id = tbl_order.customerID 
                     WHERE tbl_order.orderID= "'.$_SESSION["order_id"].'"  
                     ';  
                     $result = $conn->query($query);  
               
                     while($row =mysqli_fetch_assoc($result))  
                     {  
                          $customer_details = '  
                          <label>'.$row["customerName"].'</label>  
                          <p>'.$row["Address"].'</p>  
                          <p>'.$row["City"].', '.$row["PostalCode"].'</p>  
                          <p>'.$row["Country"].'</p>  
                          ';  
                          $order_details .= "  
                               <tr>  
                                    <td>".$row["package_name"]."</td>  
                                    <td>".$row["package_quantity"]."</td>  
                                    <td>".$row["package_price"]."</td>  
                                    <td>".number_format($row["package_quantity"] * $row["package_price"], 2)."</td>  
                               </tr>  
                          ";  
                          $total = $total + ($row["package_quantity"] * $row["package_price"]);  
                     }  
                     
                     echo '  
                     <h3 align="center">Order Summary for Order No.'.$_SESSION["order_id"].'</h3>  
                     <div class="table-responsive">  
                          <table class="table">  
                               <tr>  
                                    <td><label>Customer Details</label></td>  
                               </tr>  
                               <tr>  
                                    <td>'.$customer_details.'</td>  
                               </tr>  
                               <tr>  
                                    <td><label>Order Details</label></td>  
                               </tr>  
                               <tr>  
                                    <td>  
                                         <table class="table table-bordered">  
                                              <tr>  
                                                   <th width="50%">Package Name</th>  
                                                   <th width="15%">Quantity</th>  
                                                   <th width="15%">Price</th>  
                                                   <th width="20%">Total</th>  
                                              </tr>  
                                              '.$order_details.'  
                                              <tr>  
                                                   <td colspan="3" align="right"><label>Total</label></td>  
                                                   <td>'.number_format($total, 2).'</td>  
                                              </tr>  
                                         </table>  
                                         <form action="afterloginpage.php">
                                         <div style="display:flex; justify-content:flex-end; width:100%; padding:0;">
                                          <input type="submit" id="payBtn" name="pay_btn" value="Pay Now"/>
                                          
                                          </div>
                                            </form>
                                    </td>  
                               </tr>  
                          </table>  
                     </div>  
                    



                     ';  
                }  

                ?>  
           </div>  
      </body>  
 </html> 

 <script>
    document.getElementById("payBtn").onclick=function(){
        alert(
        "Payment Complete"
        );
        document.location.href="../afterloginpage.php";
    }

</script>