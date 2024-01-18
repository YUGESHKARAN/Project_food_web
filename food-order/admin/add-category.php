<?php include('partial/menu.php'); ?>


<!---------main content starts----->
<div class="main-content">

   <div class="wrapper flex">

        <h1>Add Category</h1>


        <?php 

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; // displaying session message
                unset($_SESSION['add']); //removing session message
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload']; // displaying session message
                unset($_SESSION['upload']); //removing session message
            }
        ?>
        <br>

        <!---Form starts--->

        <form action="" method="POST" enctype = "multipart/form-data">

           <table class="tbl-30">
            <tr>
                <td>Title :</td>
                <td>
                    <input type="text" name="title" placeholder="Category Title">
                </td>
            </tr>

            <tr>
                <td>Select Image :</td>
                <td>
                    <input type="file" name="image" >
                </td>
            </tr>

            <tr>
                <td>Featured :</td>
                <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active :</td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                   
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                </td>
            </tr>

           </table>
        </form>
        <!---Form ends--->


        <?php

        //action needs to take after submission of form


        if(isset($_POST['submit']))
        {
          // 1.Get data from FORM
          $title = mysqli_real_escape_string($conn, $_POST['title']);
          
          //For radio input we need to check the button selected or not
          if(isset($_POST['featured']))
          {
            //Get the value from FORM 
            $featured = $_POST['featured'];
          }
          else
          {
            $featured = "No";
          }

          if(isset($_POST['active']))
          {
            $active = $_POST['active'];
          }
          else{
            $active = "No";
          }

          //To check image is selected or not and set the value of image name accordingly 
          //print_r($_FILES['image']);
          //die();

          if(isset($_FILES['image']['name']))
          {
            // Upload the image
            //To upload the image we need source path and destination path
            $image_name = $_FILES['image']['name'];

            // Upload the image only if image selected
            if($image_name != "")
            {

            





                //Auto rename images
                //Get the extension of the image  e.g: "food_image.jpg"

                $ext = end(explode('.',$image_name)); // seperate the extension e.g: "jpg"

                $image_name = "Food_Category_".rand(000,999).'.'.$ext; // make a new value for image name e.g: "Food_Category_453.jpg"

                $source_path = $_FILES['image']['tmp_name'];
                
                $destination_path = "../images/category/".$image_name;

                // Upload the image
                $upload = move_uploaded_file($source_path,$destination_path);

                //check image upoladed or not
                //if not upload stop the process and redirect with error messsage
                if($upload==false)
                {
                  //SET message
                  $_SESSION['upload'] = "<div class='fails'> Failed to Upload Image</div>"  ;

                  header("location:".SITEURL.'admin/add-category.php');

                  // Stop the process
                  die();
                }
           }
          }
          else{

            //don't upload the image and set the image_name value blank

            $image_name = "";
          }

          // 2. Insert values into DATABASE
          $sql = "INSERT INTO tbl_category SET
          title = '$title',
          image_name = '$image_name',
          featured = '$featured',
          active = '$active'
          ";

          //3. Executing query and saving data into database

          $res = mysqli_query($conn,$sql) or die(mysql_error());

          // 4.checking weather the (Query is executed) data is inserted or not and display the appropriate message
          if($res==TRUE)
          {
              //Data inserted
              //echo "Data inserted";

              //create session variable to display message
              $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";

              //Redirect Page to manage-admin
                 header("location:".SITEURL.'admin/manage-category.php');
                 exit;
          }
          else
          {
              //Failed to insert data
              //echo "Failed to insert data";

              //create session variable to display message
              $_SESSION['add'] = "<div class='fails'>Fails to add category</div>";

              //Redirect Page to add-admin
              header("location:".SITEURL.'admin/add-category.php');
          }
        }

        

    ?>
   </div>

</div>

<!---------main content ends----->


<?php include('partial/footer.php'); ?>