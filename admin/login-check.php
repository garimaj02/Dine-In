<?php
// Autherization
// check whether the user is logged in or not
if(!isset($_SESSION['user']))
{
   $_SESSION['no-login-message']="<div class='error' class='text-center'>Please login to access Admin Panel.</div>";

   header('location:'.SITEURL.'../admin/login.php');
}
?>