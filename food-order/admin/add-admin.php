<?php include('partial/menu.php'); ?>


<!-----main content starts------->
<div class="main-content">
    <div class="wrapper">

        <h1>Add Admin</h1>


        <?php 

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // displaying session message
                unset($_SESSION['add']); //removing session message
            }
        ?>


        <form action="" method="POST" >
    
            <table class="tbl-30">
                <tr>
                    <td>Full Name :</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Username">
                    </td>
                </tr>

                <tr>
                    <td>Password  :</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Your Paasword">
                    </td>
                </tr>

                <tr >
                    <br>
                <tr>
                    
                    <td>
                        <br>
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary" >
                    </td> 
                </tr>
            </table>


        </form>

       



    </div>

</div>

<!-----main content ends------->








<?php include('partial/footer.php'); ?>

<?php

//action needs to take after submission of form


    if(isset($_POST['submit'])){

            //1.Get data from FORM
            $full_name= mysqli_real_escape_string($conn, $_POST['full_name']);
            $username=mysqli_real_escape_string($conn,$_POST['username']);
            $password=md5($_POST['password']);
   
            //2.SQL Query to save the data into the DATABASE
            $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            user_name='$username',
            password='$password'
            ";

          


           //3. Executing query and saving data into database

            $res = mysqli_query($conn,$sql) or die(mysql_error());
           
            // 4.checking weather the (Query is executed) data is inserted or not and display the appropriate message
            if($res==TRUE)
            {
                //Data inserted
                //echo "Data inserted";

                //create session variable to display message
                $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";

                //Redirect Page to manage-admin
                   header("location:".SITEURL.'admin/manage-admin.php');
                   exit;
            }
            else
            {
                //Failed to insert data
                //echo "Failed to insert data";

                //create session variable to display message
                $_SESSION['add'] = "<div class='fails'>Fails to add Admin</div>";

                //Redirect Page to add-admin
                header("location:".SITEURL.'admin/add-admin.php');
            }
    }
?>