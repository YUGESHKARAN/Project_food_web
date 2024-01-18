<?php include('partials-front/menu.php');?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 

                //Create query to get category data form DATABASE 
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'  ";
                //Execute the query
                $res = mysqli_query($conn,$sql);

                //count rows to check wether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the value from DATABASE
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                
                ?>

                    <a href="<?php echo SITEURL ;?>category-foods.php?category_id=<?php echo $id;?>">
                        <div class="box-3 float-container">
                            <?php 

                            //check the image is available or not
                                if($image_name =="")
                                {
                                    //Display Message
                                    echo "<div class='fails'>Image not Available </div>";
                                }
                                else{
                                    //Image available
                                    ?>
                                    
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name ;?>" alt="Pizza" class="img-responsive img-curve">

                                    <?php
                                }
                            
                            ?>
                        

                            <h3 class="float-text text-white"><?php echo $title ;?></h3>
                        </div>
                    </a>

                <?php
                }
                }
                    else
                    {
                        //Category no available 
                        echo "<div class='fails'> Category not Available</div>";
                    }

                ?>

            

           

            

            


           

            

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php');?>