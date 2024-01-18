<?php include('partial/menu.php'); ?>


<!---------main content starts----->
<div class="main-content">

   <div class="wrapper flex">
   <h1>Dashboard</h1>

   <?php
           if(isset($_SESSION['login']))
           {
              echo $_SESSION['login']; // displaying session message
              unset($_SESSION['login']); //removing session message
           }
        
        ?>
   
    <div class="col-4 center">

        <?php
        //Get the data from DATABASE
        $sql = "SELECT * FROM tbl_category";

        //Execute query
        $res = mysqli_query($conn,$sql);

        //Count the rows
        $count = mysqli_num_rows($res);
        ?>

        <h2><?php echo $count;?></h2>
        Categories
    </div>
    <div class="col-4 center">

       <?php
            //Get the data from DATABASE
            $sql2 = "SELECT * FROM tbl_food";

            //Execute query
            $res2 = mysqli_query($conn,$sql2);

            //Count the rows
            $count2 = mysqli_num_rows($res2);
        ?>
        <h2><?php echo $count2;?></h2>
        Foods
    </div>

    <div class="col-4 center">

         <?php
            //Get the data from DATABASE
            $sql3 = "SELECT * FROM tbl_order";

            //Execute query
            $res3 = mysqli_query($conn,$sql3);

            //Count the rows
            $count3 = mysqli_num_rows($res3);
         ?>
        <h2><?php echo $count3;?></h2>
        Total Orders
    </div>

    <div class="col-4 center">

       <?php 
         // Create sql query to get Total Revenue Generated
         //Aggregate function in sql
         $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status= 'Delivered'";

         //Execute the query
         $res4 = mysqli_query($conn,$sql4);

         //Get the value
         $row4 = mysqli_fetch_assoc($res4);

         //Get the total revenue
         $total_revenue = $row4['Total'];
       ?>
        <h2> ₹ <?php echo $total_revenue;?></h2>
        Revenue Generated
    </div>

  <div class="clearfix"></div>
    
   </div>

</div>

<!---------main content ends----->

<?php include('partial/footer.php'); ?>

