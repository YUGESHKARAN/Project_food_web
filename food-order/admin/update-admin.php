<?php include('partial/menu.php'); ?>


<div class="main-content">

    <div class="wrapper">
      
     <h1>Update Admin</h1>
     <br>

     <?php 
     // 1.Get the ID of selected admin
     $id = $_GET['id'];

     // 2.Create query to get the details

     $sql = "SELECT * FROM tbl_admin WHERE id= $id";

     //Execute the query 
     $res = mysqli_query($conn,$sql);

     //check the query is executed or not

     if($res==TRUE)
     {
        //check the wether the data is available or not
        $count = mysqli_num_rows($res);

        //check wether the number have admin data or not
         if($count==1)
         {
            // GET the details
            //echo "Admin Available" ;
            $rows=mysqli_fetch_assoc($res);
            
            $full_name = $rows['full_name'];
            $user_name = $rows['user_name'];
         }
         else
         {
           // Redirect to Manage Admin
           header("location:".SITEURL.'admin/manage-admin.php');
         }
     }
     
     ?>

     <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name</td>
                <td>
                <input type="text" name="full_name" value="<?php echo $full_name ?>"> 
                </td>
            </tr>

            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" value="<?php echo $user_name?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                </td>
            </tr>

        </table>
     </form>

     </div>    

</div>



<?php
     if(isset($_POST['submit']))
     {
       // echo "Button Clicked";
       $id=$_POST['id'];
       $full_name=mysqli_real_escape_string($conn, $_POST['full_name']);
       $username=mysqli_real_escape_string($conn,$_POST['username']);



       //2.SQL Query to update the Admin
       $sql = "UPDATE tbl_admin SET
       full_name='$full_name',
       user_name='$username' WHERE id=$id";



           //3. Executing query and saving data into database

           $res = mysqli_query($conn,$sql) or die(mysql_error());
           
           // 4.checking weather the (Query is executed) data is inserted or not and display the appropriate message
           if($res==TRUE)
           {
               //Data inserted
               //echo "Admin Updated";

               //create session variable to display message
               $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";

               //Redirect Page to manage-admin
                  header("location:".SITEURL.'admin/manage-admin.php');
                  exit;
           }
           else
           {
               //Failed to insert data
               //echo "Failed to insert data";

               //create session variable to display message
               $_SESSION['update'] = "<div class='fails'>Admin Not Updated </div>";

               //Redirect Page to add-admin
               header("location:".SITEURL.'admin/update-admin.php');
           }
       
     }
?>



<?php include('partial/footer.php'); ?>