<?php

//Include constants.php for SITEURL
    include('../config/constants.php');

// 1. Destroy SESSION
session_destroy(); //Unset $_SESSION['user]

// 2.Redirect to Login Page
header("location:".SITEURL.'admin/login.php');


?>