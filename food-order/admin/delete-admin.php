<?php 


 include('../config/constants.php');

//get the id of delete admin

       $id = $_GET['id'] ;

// 2.Create sql query to deleted admin

$sql = "DELETE FROM tbl_admin WHERE id=$id " ;

// 3.Execute the query
 
$res = mysqli_query($conn,$sql);

// 4.check wether the query executed successfully or not

if($res==TRUE)
{
    //admin deleted successfully
   //echo "admin deleted successfully" ;
   $_SESSION['del'] = "<div class='success'> Admin Deleted Successfully </div>";
   header("location:".SITEURL.'admin/manage-admin.php');
}
else
{
    // admin not deleted successfully
    //echo "admin not deleted successfully" ;
    $_SESSION['del'] = "<div class='fails'>Admin not Deleted Successfully </div>";
    header("location:".SITEURL.'admin/delete-admin.php');
}

// 3.Redirect to manage admin page with message 



?>