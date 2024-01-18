<?php include('partial/menu.php'); ?>


<!---------main content starts----->
<div class="main-content">

   <div class="wrapper flex">
   <h1>Manage Food</h1>
   <br>
   <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary"> ADD FOOD</a>
   <br><br>


   <?php
         if(isset($_SESSION['add']))
         {
             echo $_SESSION['add']; // displaying session message
             unset($_SESSION['add']); //removing session message
         }

         if(isset($_SESSION['remove']))
         {
             echo $_SESSION['remove']; // displaying session message
             unset($_SESSION['remove']); //removing session message
         }
         if(isset($_SESSION['delete']))
         {
             echo $_SESSION['delete']; // displaying session message
             unset($_SESSION['delete']); //removing session message
         }
         
        

         if(isset($_SESSION['upload']))
         {
             echo $_SESSION['upload']; // displaying session message
             unset($_SESSION['upload']); //removing session message
         }
         if(isset($_SESSION['remove-failed']))
         {
            echo $_SESSION['remove-failed']; // displaying session message
            unset($_SESSION['remove-failed']); //removing session message
         }
         if(isset($_SESSION['update']))
         {
             echo $_SESSION['update']; // displaying session message
             unset($_SESSION['update']); //removing session message
         }

         


    ?>
    <table class="tbl-full" border>

         <tr>

               <th>S.No</th>
               <th>Title</th>
               <th>Price</th>
               <th>Image</th>
               <th>Featured</th>
               <th>Active</th>
               <th>Action</th>
         </tr>

         <?php
         //query to get all the details
         
         $sql = "SELECT * FROM tbl_food ";

         //Execute query
         $res = mysqli_query($conn,$sql);

         //Count Rows to check the food is available or not

         $count = mysqli_num_rows($res);
         $sno = 1;

         if($count>0)
         {
            //get data form DATABASE and Diaplay
            while($rows=mysqli_fetch_assoc($res))
            {
                //get the value from individual column
                $id = $rows['id'];
                $title = $rows['title'];
                $price = $rows['price'];
                $image_name = $rows['image_name'];
                $featured = $rows['featured'];
                $active = $rows['active']; 
            ?>

            <tr>
               <td><?php echo $sno++ ; ?></td>
               <td><?php echo $title ;?></td>
               <td><?php echo $price ;?></td>
               <td>
               <?php 
                                        // To check the image is available or not
                    if($image_name!="")
                      {
                                          // Display the image
                        ?>

                        <img  src="<?php echo SITEURL; ?>images/food/<?php echo $image_name?>" width="100px">

                         <?php
                       }
                    else
                    {

                     //Dispaly the Message
                         echo "<div class='fails'> Image not Added</div>";
                  }
                                        
                                     
                     ?> 
               </td>
               <td><?php echo $featured ;?></td>
               <td><?php echo $active ;?></td>
               <td>
                  <a href="<?php echo SITEURL ; ?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                  <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
               </td>
         </tr>


            <?php
            }

         }
         else
         {
             echo "<tr><td colspan='7' class='fails'> Food Not Added Yet</td></tr>";
         }


         ?>
       
         

        

        
    </table>
    
   </div>

</div>

<!---------main content ends----->

<?php include('partial/footer.php'); ?>

