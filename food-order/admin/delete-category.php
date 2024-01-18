<?php



    //Include Constant File
    include('../config/constants.php');

    //Check id and image value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get the value and delete
        //echo "get value" ;
        $id = $_GET['id'] ;
        $image_name = $_GET['image_name'] ;

       //Remove the physical image file is available 
       if($image_name !="")
       {
        // Image is availaable so remove it
        $path = "../images/category/".$image_name;  
        // Remove Image
        $remove = unlink($path);
        
        // if fail to remove image then add a error Message and stop the process
        if($remove == false)
        {
          // Set tht SESSION Message
          $_SESSION['remove'] = "<div class='fails'>Fail to Remove Category Image</div>" ;
          //Redirect to Manage Category Page
          header("location:".SITEURL.'admin/manage-category.php');
          //stop the process
          die();
        }
       }

  

        //Delete data from DATABASE
        $sql = "DELETE  FROM tbl_category WHERE id=$id " ;
        
        // 3.Execute the query
        $res = mysqli_query($conn,$sql);

        // 4.check wether the query executed successfully or not
            if($res==TRUE)
            {
            // SET Success Message and Redirect
            $_SESSION['delete'] = "<div class='success'> Category Deleted Successfully </div>";
            header("location:".SITEURL.'admin/manage-category.php');
            }
            else{

                //SET Fail Message and Redirect
                $_SESSION['delete'] = "<div class='fails'> Failo to Delete Category</div>";
                header("location:".SITEURL.'admin/manage-category.php');
            }
    } 

    else 
    {
        // Redirect to Mange Category Page
        header("location:".SITEURL.'admin/manage-category.php');                                                  
    }
    
?>