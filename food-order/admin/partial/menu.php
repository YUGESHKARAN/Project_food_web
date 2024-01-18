
<?php 
  include('../config/constants.php');
  include('login-check.php');
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
   <!----menu section starts------>

   <div class="menu">
    <div class="wrapper">
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="manage-admin.php">ADMIN</a></li>
            <li><a href="manage-category.php">CATEGORY</a></li>
            <li><a href="manage-food.php">FOOD</a></li>
            <li><a href="manage-order.php">ORDER</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
        </ul>
    </div>
   </div>
   <!----menu section ends------>