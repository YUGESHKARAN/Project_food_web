<?php include('../config/constants.php');?>

<html>
    <head>
        <title>Login -Food Oreder system </title>
        <link rel="stylesheet" href="../css/admin.css"></link>
    </head>

    <body>
        
    <div class="login">
        <h1 class="center">Login</h1>
        <br>
        <?php
           if(isset($_SESSION['login']))
           {
              echo $_SESSION['login']; // displaying session message
              unset($_SESSION['login']); //removing session message
           }

           if(isset($_SESSION['no-login-message']))
           {
              echo $_SESSION['no-login-message']; // displaying session message
              unset($_SESSION['no-login-message']); //removing session message
           }
        
        ?>
        
        <!---------Login FORM starts------>

        <form action="" method="POST" class="center">
        <br>
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username">
            <br>
            <br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter Password">
              <br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
        </form>
        <br>
        
        <!---------Login FORM ends------>

        <p class="center">Created by : <a href="localhost/phpmyadmin/">Click here</a> </p>
    </div>
    </body>
</html>

<?php

//action needs to take after submission of form


    if(isset($_POST['submit'])){
        

    // 1.To get data from FORM
     //$username=$_POST['username'];
     $username= mysqli_real_escape_string($conn, $_POST['username']);

     $raw_password=md5($_POST['password']);
     $password=mysqli_real_escape_string($conn,$raw_password);

     // 2.To check wether the username and password exits or not

     $sql = "SELECT * FROM tbl_admin WHERE user_name='$username' AND password='$password' ";

     // 3.Execute the query
     $res = mysqli_query($conn,$sql);
     
     // 4.Count rows to check wether the user exists or not 
     $count = mysqli_num_rows($res);

     if($count==1)
     {
        //User available and Login success
        $_SESSION['login'] = "<div class='success ceneter'> Login Successfully. </div>" ;
        $_SESSION['user'] = $username; //To check wether the user is logged in or not and logout will unset it 

        //Redirect to HOME (index.php page) page 
        header("location:".SITEURL.'admin/');
     }

     else{
       // User not available and login Fails
       $_SESSION['login'] = "<div class='fails center'>Username or Password did not match. </div>" ;

        //Redirect to HOME (index.php page) page 
        header("location:".SITEURL.'admin/login.php');
        
     }





    }


    
?>
