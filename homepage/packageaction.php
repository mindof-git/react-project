<?php  
 include("security.php");
 


 if(isset($_POST["package_id"]))  
 {  
      $order_table = '';  
      $message = '';  
      if($_POST["action"] == "add")  
      {  
           if(isset($_SESSION["s_cart"]))  
           {  
                $is_available = 0;  
                foreach($_SESSION["s_cart"] as $keys => $values)  
                {  
                     if($_SESSION["s_cart"][$keys]['package_id'] == $_POST["package_id"])  
                     {  
                          $is_available++;  
                          $_SESSION["s_cart"][$keys]['package_quantity'] = $_SESSION["s_cart"][$keys]['package_quantity'] + $_POST["package_quantity"];  
                     }  
                }  
                if($is_available < 1)  
                {  
                     $item_array = array(  
                          'package_id'               =>     $_POST["package_id"],  
                          'package_name'               =>     $_POST["package_name"],  
                          'package_price'               =>     $_POST["package_price"],  
                          'package_quantity'          =>     $_POST["package_quantity"]  
                     );  
                     $_SESSION["s_cart"][] = $item_array;  
                }  
           }  
           else  
           {  
                $item_array = array(  
                     'package_id'               =>     $_POST["package_id"],  
                     'package_name'               =>     $_POST["package_name"],  
                     'package_price'               =>     $_POST["package_price"],  
                     'package_quantity'          =>     $_POST["package_quantity"]  
                );  
                $_SESSION["s_cart"][] = $item_array;  
           }  
      }  
      if($_POST["action"] == "remove")  
      {  
           foreach($_SESSION["s_cart"] as $keys => $values)  
           {  
                if($values["package_id"] == $_POST["package_id"])  
                {  
                     unset($_SESSION["s_cart"][$keys]);  
                     $message = '<label class="text-success">Package Removed</label>';  
                }  
           }  
      }  
      if($_POST["action"] == "quantity_change")  
      {  
           foreach($_SESSION["s_cart"] as $keys => $values)  
           {  
                if($_SESSION["s_cart"][$keys]['package_id'] == $_POST["package_id"])  
                {  
                     $_SESSION["s_cart"][$keys]['package_quantity'] = $_POST["quantity"];  
                }  
           }  
      }  
      $order_table .= '  
           '.$message.'  
           <table class="table table-bordered">  
                <tr>  
                     <th width="40%">Package Name</th>  
                     <th width="10%">Quantity</th>  
                     <th width="20%">Price</th>  
                     <th width="15%">Total</th>  
                     <th width="5%">Action</th>  
                </tr>  
           ';  
      if(!empty($_SESSION["s_cart"]))  
      {  
           $total = 0;  
           foreach($_SESSION["s_cart"] as $keys => $values)  
           {  
                $order_table .= '  
                     <tr>  
                          <td>'.$values["package_name"].'</td>  
                          <td><input type="text" name="quantity[]" id="quantity'.$values["package_id"].'" 
                          value="'.$values["package_quantity"].'" class="form-control quantity" data-package_id="'.$values["package_id"].'" /></td>  
                          <td align="right">$ '.$values["package_price"].'</td>  
                          <td align="right">$ '.number_format($values["package_quantity"] * $values["package_price"], 2).'</td>  
                          <td><button name="delete" class="btn btn-danger btn-xs delete" id="'.$values["package_id"].'">Remove</button></td>  
                     </tr>  
                ';  
                $total = $total + ($values["package_quantity"] * $values["package_price"]);  
           }  
           $order_table .= '  
                <tr>  
                     <td colspan="3" align="right">Total</td>  
                     <td align="right">$ '.number_format($total, 2).'</td>  
                     <td></td>  
                </tr>  
                <tr>  
                     <td colspan="5" align="center">  
                          <form action="packagecart.php" method="post" >  
                               <input type="submit" name="place_order" class="btn btn-warning" value="Place Order" />  
                          </form>  
                     </td>  
                </tr>  
           ';  
      }  
      $order_table .= '</table>';  
      $output = array(  
           'order_table'     =>     $order_table,  
           'cart_item'          =>     count($_SESSION["s_cart"])  
      );  
      echo json_encode($output);  
 }  
 ?>