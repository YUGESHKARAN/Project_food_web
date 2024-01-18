<?php include('partial/menu.php'); ?>


<?php

   //Check the ID set or not
   if(isset($_GET['id']))
   {
    //GET all the Deatails
    $id = $_GET['id'];
    //sql query to get the details of selected food

    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

    //Execute the query
    $res2 = mysqli_query($conn,$sql2);

    //Get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);

    //Get the individual value of selected food

    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
   }
   else
   {
    //Redirect to Manage Food
    header('location:'.SITEURL.'admin/manage-food.php');
   }

?>

<div class="main-content">

   <div class="wrapper flex">
     <h1> Update Food</h1>
     <br>

     <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">


        <tr>
            <td>Title:</td>
            <td>
                <input type="text" name="title" value="<?php echo $title;?>">
            </td>
        </tr>

        <tr>
            <td>Description:</td>
            <td>
                <textarea name="description" id="" cols="30" rows="5"><?php echo $description ;?></textarea>
            </td>
        </tr>

        <tr>
            <td>Price:</td>
            <td>
                <input type="number" name="price" value="<?php echo $price ;?>">
            </td>
        </tr>

        <tr>
            <td>Current Image:</td>
            <td>
                <?php 
                   if($current_image == "")
                   {
                    //Image not available
                    echo "<div class='fails'>Image Not Available</div>";
                   }
                   else
                   {
                    //Image Available
                    ?>
                     <img src="<?php echo SITEURL ;?>images/food/<?php echo $current_image ;?>" alt="" width="100px">
                 
                    <?php
                   }
                ?>
            </td>
        </tr>

        <tr>
            <td>Select New Image:</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>Category:</td>
            <td>
                <select name="category" >
                 <?php
                  //Query to get active categories 
                  $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                  //Execute the query
                  $res = mysqli_query($conn,$sql);
                  //Count Rows

                  $count = mysqli_num_rows($res);

                  //check wether category available or not
                  if($count>0)
                  {
                    //AVAILABLE
                    while($row=mysqli_fetch_assoc($res))
                    {
                      $category_title = $row['title'];
                      $category_id = $row['id'];  

                      ?>
                        <option <?php if($current_category == $category_id){ echo "selected";} ;?> value="<?php echo $category_id ;?>"><?php echo $category_title ;?></option>
                      <?php
                    }
                  }
                  else
                  {
                    //Category not available
                    echo "<option value='0'>Category Not Available.</option>";
                  }
                 ?>


                    <option value="0">Test Category</option>
                </select>
            </td>
        </tr>

        <tr>
            <td>Featured:</td>
            <td>
                <input  <?php if($featured == "Yes"){ echo "checked ";} ;?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured == "No") { echo "checked ";} ;?> type="radio" name="featured" value="No">No
            </td>
        </tr>

        <tr>
            <td>Active:</td>
            <td>
                <input <?php if($active == "Yes"){ echo "checked ";} ;?> type="radio" name="active" value="Yes">Yes
                <input <?php if($active == "No"){ echo "checked ";} ;?> type="radio" name="active" value="No">No
            </td>
        </tr>

        <tr>
            <td>
                <input type="hidden" name="id" value="<?php echo $id ;?>">
                <input type="hidden" name="current_image" value="<?php echo  $current_image;?>">

                <input type="submit" name="submit" value="Update Food" class="btn-secondary">
            </td>
        </tr>



        </table>
     </form>

     <?php

        if(isset($_POST['submit']))
        {
            //echo "Button Clicked" ;

            //1.To get all the details from the form
            $id = $_POST['id'];
            $title = mysqli_real_escape_string($conn,$_POST['title']);
            $description =mysqli_real_escape_string($conn, $_POST['description']);
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2.Upload the image if Selected

            //check whether the Upload button is clicked or not
            if(isset($_FILES['image']['name'])) 
            {
               //Upload button clicked
               $image_name = $_FILES['image']['name'];

               //Check whether the file is available or not
              if($image_name !="")
              {
                //Image available 
                //A.Uploading new image

                //Rename the image
                $ext = end(explode('.', $image_name)); //Gets the extension of the image

                $image_name = "Food-Name-".rand(0000,9999).'.'.$ext;

                //Get the soource path and destination path
                $src_path = $_FILES['image']['tmp_name']; //source path
                $dest_path = "../images/food/".$image_name; //destination path

                //Upload the image
                $upload = move_uploaded_file($src_path, $dest_path);

                // Check whether the image is uploaded or not
                if($upload==false)
                {
                    //Failed to Upload
                    $_SESSION['upload'] = "<div class='fails'>Failed to upload new image</div>";
                    //Redirect to manage food page
                    header('location:'.SITEURL.'admin/manage-food.php');
                    //stop the process
                    die();
                }
                

                //3.Remove the image if new image is uploaded and current image is exists 
                //B.Remove current image if available
                 if($current_image!="")
                {
                   //Current image available
                   //Remove the image
                   $remove_path = "../images/food/".$current_image;
                   $remove = unlink($remove_path);

                   //check whether the image is removed or not
                   if($remove == false)
                   {
                    //Fails to remove current image
                    $_SESSION['remove-failed'] = "<div class='fails'>Failed to Remove Current image.</div>";
                    //Redirect to Manage Food
                    header('location:'.SITEURL.'admin/manage-food.php');
                    //stop the process
                    die();
                   }
                 }
                else
                {
                   $image_name = $current_image; 
                }


            }
            else
            {
                $image_name = $current_image;
            }

            }
            else
            {
               $image_name = $current_image; 
            }

            

            //4. Update the food in DATABASE 

            $sql3 = "UPDATE tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = '$category',
            featured  = '$featured',
            active = '$active'
            WHERE id=$id
            ";
             

             //Execute the SQL query


             $res3 = mysqli_query($conn,$sql3);

             //Check whether the query is executed or not

             if($res3 == TRUE)
             {
                //Query executed and food updated
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');

             }
             else
             {
                //Failed to update food
                $_SESSION['update'] = "<div class='fails'>Fail to Update Food.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
               
             }

            
        }

     ?>
   </div>

</div>


<?php include('partial/footer.php'); ?>