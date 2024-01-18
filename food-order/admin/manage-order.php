<?php include('partial/menu.php'); ?>


<!---------main content starts----->
<div class="main-content">

   <div class="wrapper flex">
   <h1>Manage Order</h1>
  
 
   <br><br>

   <?php
     if(isset($_SESSION['update']))
     {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
     }
   ?>
    <table class="tbl-full" >

         <tr>

               <th>S.N.</th>
               <th>Food</th>
               <th>Price</th>
               <th>QTY.</th>
               <th>Total</th>
               <th>Order Date</th>
               <th>Status</th>
               <th>Customer Name</th>
               <th> Contact</th>
               <th> Email</th>
               <th> Address</th>
               <th>Actions</th>
         </tr>

         <?php

            //Get all order from DATABASE
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC "; //Dispaly latest order at 1st.

            //Execute Query
            $res = mysqli_query($conn,$sql);

            //Count the rows
            $count = mysqli_num_rows($res);
            $sno =1; //Create a serial Number to set initial value as 1.

            if($count>0)
            {
                  //Order Available
                  while($row=mysqli_fetch_assoc($res))
                  {
                     //Get all the order details
                     $id = $row['id'];
                     $food = $row['food'];
                     $price = $row['price'];
                     $qty = $row['qty'];
                     $total = $row['total'];
                     $order_date = $row['order_date'];
                     $status = $row['status'];
                     $customer_name = $row['customer_name'];
                     $customer_contact = $row['customer_contact'];
                     $customer_email = $row['customer_email'];
                     $customer_address = $row['customer_adddress'];

                     ?>

                         <tr>
                              <td><?php echo $sno++;?></td>
                              <td><?php echo $food ;?></td>
                              <td><b> ₹ <?php echo $price ;?></b></td>
                              <td><?php echo $qty ;?></td>
                              <td><b> ₹ <?php echo $total ;?></b></td>
                              <td><?php echo $order_date ;?></td>

                              <td>
                                 <?php
                                    //Ordered, On Delivery, Delivery , Cancelled
                                    if($status=="Ordered")
                                    {
                                          echo "<label>$status</label>";
                                    }
                                    elseif($status=="On Delivery")
                                    {
                                          echo "<label style='color:orange;'>$status</label>";
                                    }
                                    elseif($status=="Delivered")
                                    {
                                          echo "<label style='color:green;'>$status</label>";
                                    }
                                    elseif($status=="Cancelled")
                                    {
                                          echo "<label style='color:red;'>$status</label>";
                                    }
                                 
                                 ?>
                              </td>

                              <td><?php echo $customer_name ;?></td>
                              <td><?php echo $customer_contact ;?></td>
                              <td><?php echo $customer_email ;?></td>
                              <td><?php echo $customer_address ;?></td>
                              <td>
                                    <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary"><p style="display:inline-block;">Update Order</p></a>
                                    
                              </td>
                        </tr>

                     <?php

                  }
            }
            else
            {
                  //Order Not Available
                  echo "<tr> <td colspan='12' class='fails'>Orders Not Available.</td> </tr>" ;
            }
         ?>

         
         
    </table>
    
    
   </div>

</div>

<!---------main content ends----->

<?php include('partial/footer.php'); ?>

