<?php include('partial/menu.php'); ?>


<!---------main content starts----->
<div class="main-content">

   <div class="wrapper ">
   <h1>Manage Admin</h1>
   <br>

   <?php 

        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add']; // displaying session message
            unset($_SESSION['add']); //removing session message
        }
     

         if(isset($_SESSION['del']))
         {
            echo $_SESSION['del']; // displaying session message
            unset($_SESSION['del']); //removing session message
         }


         if(isset($_SESSION['update']))
         {
            echo $_SESSION['update']; // displaying session message
            unset($_SESSION['update']); //removing session message
         }
         if(isset($_SESSION['user-not-found']))
         {
            echo $_SESSION['user-not-found']; // displaying session message
            unset($_SESSION['user-not-found']); //removing session message
         }
         if(isset($_SESSION['password-not-match']))
         {
            echo $_SESSION['password-not-match']; // displaying session message
            unset($_SESSION['password-not-match']); //removing session message
         }
         if(isset($_SESSION['change-pw']))
         {
            echo $_SESSION['change-pw']; // displaying session message
            unset($_SESSION['change-pw']); //removing session message
         }
?>

     <br>


  <!---  button to add admin--->
   <a href="add-admin.php" class="btn-primary"> ADD ADMIN</a>
   <br><br>
    <table class="tbl-full" border>

         <tr>

               <th>S.No</th>
               <th>Full-Name</th>
               <th>User-name</th>
               <th>Action</th>
         </tr>




         <?php

         //To get all admin
         $sql = "SELECT * from tbl_admin";
         //execute the query
         $res = mysqli_query($conn,$sql);
         $sno=1;
         //check query executed or not
         if($res==TRUE)
         {

            // count rows to check wheather we data in database or not
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                  while($rows=mysqli_fetch_assoc($res))
                  {
                     //get individual values
                     $id = $rows['id'];
                     $full_name = $rows['full_name'];
                     $user_name = $rows['user_name'];




                     ?>
                       <tr>
                              <td><?php echo $sno++ ;?></td>
                              <td><?php echo $full_name ;?>  </td>
                              <td> <?php echo $user_name ;?></td>
                              <td> 
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php? id=<?php echo $id ; ?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php? id=<?php echo $id ; ?> " class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php? id=<?php echo $id ; ?>"  class="btn-danger">Delete Admin</a>
                              </td>
                        </tr>

                     <?php
                  }

            }
         }
         ?>

         
    </table>
    
   </div>

</div>

<!---------main content ends----->

<?php include('partial/footer.php'); ?>

