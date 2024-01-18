<?php include('partial/menu.php'); ?>


<!---------main content starts----->
<div class="main-content">

   <div class="wrapper flex">
       <h1>Add Food</h1>
     <br>

     <?php
         if(isset($_SESSION['upload']))
         {
             echo $_SESSION['upload']; // displaying session message
             unset($_SESSION['upload']); //removing session message
         }

    ?>

     <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Title of food">
                </td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" id="" cols="30" rows="5" placeholder="Description of the Food "></textarea>
                </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category:</td>
                <td>
                    <select name="category" >

                    <?php 
                        // Create PHP to display categories from DATABASE
                        //query to display only active categories from DATABASE

                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                        $res = mysqli_query($conn,$sql);

                        //count rows to check wether we have categories or not

                        $count  = mysqli_num_rows($res);

                        //if count is greater than 0 then we have category and we can display it.
                        if($count>0)
                        {
                            //We have categorys
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //get the details of gategory from DATABASE
                                $id = $rows['id'];
                                $title = $rows['title'];
                                ?>
                                <option value="<?php echo $id ;?>"><?php echo $title;?></option>
                                <?php

                            }


                        }
                        else
                        {
                            
                        //We do not have category 
                        ?>
                        <option value="0">No Categories Found</option>
                        <?php
                        }



                    ?>
                    
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td>
            </tr>

        </table>

     </form>
     <?php

        if(isset($_POST['submit']))
        {
           // echo "clicked";

           $title = mysqli_real_escape_string($conn,$_POST['title']);
           $description =mysqli_real_escape_string($conn, $_POST['description']);
           $price = $_POST['price'];
           $category = $_POST['category'];;
           
           //Check the radio button for feature and active is checked
      //For featured     
           if(isset($_POST['featured']))
           {
            $featured = $_POST['featured'];
           }
           else
           {
            $featured = "No";
           }
       //For active
           if(isset($_POST['active']))
           {
            $active = $_POST['active'];
           }
           else
           {
            $active = "No";
           }

           //Upload the image if selected

           if(isset($_FILES['image']['name']))
           {
            // get the details of the selected image
            $image_name = $_FILES['image']['name'];

            //check the image is selected or not and upload only if selected
            if($image_name != "")
            {
                //A. Rename the image
                $ext = end(explode('.',$image_name));

                //create new name
                $image_name = "Food_Name".rand(0000,9999).".".$ext;

                $source_path = $_FILES['image']['tmp_name'];
                
                $destination_path = "../images/food/".$image_name;

                // Upload the image
                $upload = move_uploaded_file($source_path,$destination_path);
                if($upload==false)
                {
                  //SET message
                  $_SESSION['upload'] = "<div class='fails'> Failed to Upload Image</div>"  ;

                  header("location:".SITEURL.'admin/add-food.php');

                  // Stop the process
                  die();
                }


                //B. Upload the image
            }
               
           }
           else
           {
            $image_name = ""; //setting default value as blank
           }


           //3. Insert data Into DATABASE

           $sql2 = "INSERT INTO tbl_food  SET 
           title = '$title',
           description = '$description',
           price = $price,
           image_name = '$image_name',
           category_id = $category,
           featured = '$featured',
           active = '$active'
           ";

           //execute the query
           $res2 = mysqli_query($conn,$sql2);


           if($res2 == true)
           {
            $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";

            //Redirect Page to manage-admin
             header("location:".SITEURL.'admin/manage-food.php');
              
           }
           else 
           {

            $_SESSION['add'] = "<div class='fails'>Fails to add Food</div>";

            //Redirect Page to add-admin
            header("location:".SITEURL.'admin/manage-food.php');
           }




        }
     ?>


   </div> 
   
   
</div>   

<?php include('partial/footer.php'); ?>