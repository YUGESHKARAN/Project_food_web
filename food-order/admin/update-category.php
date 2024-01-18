<?php include('partial/menu.php'); ?>

<div class="main-content">

    <div class="wrapper">
      
        <h1>Update Category</h1>
        <br>


     <?php 

         if(isset($_GET['id']))
         {

            //GET the details from DATABASE
            //echo "getting the data";
            $id = $_GET['id'];
            //Query to get all other details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";


            //Execute the query 
            $res = mysqli_query($conn,$sql);

            //check the wether the data is available or not
            $count = mysqli_num_rows($res);

            //check wether the number have admin data or not
            if($count==1)
            {
              //Get all the data
              $rows=mysqli_fetch_assoc($res);

              $title = $rows['title'];
              $current_image = $rows['image_name'];
              $featured = $rows['featured'];
              $active = $rows['active'];


            }
            else
            {

                //Redirect to Manage Category with SESSION Message
                $_SESSION['no-category-found'] = "<div class='fails'>Category Not Found</div>" ;
                header("location:".SITEURL.'admin/manage-category.php');
            }


         }
         else
         {

            //Redirect to Mange Category
            header("location:".SITEURL.'admin/manage-category.php');

         }
     
     ?>   








<!---Form starts--->
<form action="" method="POST" enctype = "multipart/form-data">

<table class="tbl-30">
 <tr>
     <td>Title :</td>
     <td>
         <input type="text" name="title" value="<?php echo $title ?>">
     </td>
 </tr>

 <tr>
     <td>Current Image :</td>
     <td>
         <?php 
           if($current_image != "")
           {
            //Dispaly the image
            ?>
             <img src="<?php echo SITEURL ;?>images/category/<?php echo $current_image ;?>" width="100px">

            <?php
           }
           else
           {
            //Display Message
            echo "<div class='fails'>Image Not Added</div>";

        
           }
         ?>
     </td>
 </tr>

 <tr>
     <td>New Image :</td>
     <td>
         <input type="file" name="image" >
     </td>
 </tr>

 <tr>
     <td>Featured :</td>
     <td>
         <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

         <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
     </td>
 </tr>

 <tr>
     <td>Active :</td>
     <td>
         <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

         <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
     </td>
 </tr>


 <tr>
     <td colspan="2">

        <input type="hidden" name="current_image" value="<?php echo $current_image ;?>">
        <input type="hidden" name="id" value="<?php echo $id ;?>">
         <input type="submit" name="submit" value="Update Category" class="btn-secondary">
     </td>
 </tr>

</table>
</form>
<!---Form ends--->


<?php 

if(isset($_POST['submit']))
{
    //echo "clicked";

    // 1.Get all the values form our FORM
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    // 2.Updating new image if selected

    //check the image is selected or not
    if(isset($_FILES['image']['name']))
    {
        //GET the image details
        $image_name = $_FILES['image']['name'] ;

        //A.check the image is availble or not
        if($image_name !="")
        {
          // Image availabe and replace the new image with current image

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

                  header("location:".SITEURL.'admin/manage-category.php');

                  // Stop the process
                  die();
                }

                // B.Remove current image if only available
                if($current_image != "")
                {
                    $remove_path  = "../images/category/".$current_image;

                    $remove = unlink($remove_path);

                    //check the image removed or not
                    //if failed to remove display Message and stop process
                    if($remove === false)
                    {
                        $_SESSION['failed-remove'] = "<div class='fails'>Failed to remove Image</div>";
                        header("location:".SITEURL.'admin/manage-category.php');
                        die();//stop the pocess
                    }
                }
                else
                    {
                    // image will be current image
                     $image_name = $current_image ;
                    }
                            

        }
        else
        {
         // image will be current image
         $image_name = $current_image ;
        }
    }
    else
    {
      $image_name = $current_image ;
    }


    // 3.Upadte the DATABASE
    $sql2 = "UPDATE tbl_category SET 
    title = '$title',
    image_name = '$image_name',
    featured = '$featured',
    active = '$active'
    WHERE id = $id
    ";

    //Execute the query
    $res2 = mysqli_query($conn,$sql2);

    //4.Redirect to Manage Category with Message
    //check wether executed or not

    if($res2 == true)
    {
        //Category updated
        $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
        header("location:".SITEURL.'admin/manage-category.php');

    }
    else
     {
        //Failed to Update Category
        $_SESSION['update'] = "<div class='fails'>Failed to Update Category</div>";
        header("location:".SITEURL.'admin/manage-category.php');
     }

}


?>
    </div>
</div>












<?php include('partial/footer.php'); ?>


