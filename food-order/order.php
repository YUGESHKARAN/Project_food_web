<?php include('partials-front/menu.php');?>

<?php 

  //Check whether Food ID is set or Not
  if(isset($_GET['food_id']))
  {
    //Get the Food ID and Details of the Selected Food
    $food_id = $_GET['food_id'];

    //Get the details of the selected food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

    //Execute the query 
    $res = mysqli_query($conn,$sql);

    //Count the rows
    $count = mysqli_num_rows($res);

    //Check whether the data is available or not
    if($count==1)
    {
        //We have data
        //Get the from DATABASE
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    }
    else
    {
        //Food not Available
        //Redirect to Home Page
        header('location:'.SITEURL);
    }

  }
  else
  {
    //Redirect to Home Page
    header('location:'.SITEURL);
  }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                              
                              //Check the image is avaialble or Not
                              if($image_name =="")
                              {
                                //Image Not Available
                                echo "<div class='fails'>Image Not Available.</div>";
                              }
                              else
                              {
                                //Image is Available
                                ?>
                                         
                                         <img src="<?php echo SITEURL ;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                <?php
                              }
                           
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3> <?php echo $title;?> </h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">

                        <p class="food-price">₹<?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo  $price ;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Your Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. order@canteen.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

               //Check whether the submit button is clicked or not
               if(isset($_POST['submit']))
               {
                //Get all the details from FORM

                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty; // Calculating total amount

                $order_date = date("Y-m-d h:i:sa"); //To get current date and Time

                $status = "Ordered"; //oredered, On Delivery, Delivered, Cancelled
                
                $customer_name = $_POST['full-name'];
                $customer_conatct = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                //Save the order in DATABASE

                $sql2 = "INSERT INTO tbl_order SET
                food = '$food',
                price = $price,
                qty = $qty,
                total = $total,
                order_date = '$order_date',
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_conatct',
                customer_email = '$customer_email',
                customer_adddress = '$customer_address'
                ";

                //Execute the query
                $res2 = mysqli_query($conn,$sql2);

                //Check query executed Successfully or Not
                if($res2 == TRUE)
                {
                    //Query executed and order saved
                    $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                    header('location:'.SITEURL);

                }
                else
                {
                    //Failed to Save order
                    $_SESSION['order'] = "<div class='fails text-center'>Failed to Oreder Food.</div>";
                    header('location:'.SITEURL);
                }

               }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>