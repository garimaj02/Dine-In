<?php

//include constants.php file here
include('../config/constants.php');

//1. get the ID of admin to be deleted
echo $id=$_GET['id'];
//2. create sql query to delete admin
$sql="DELETE FROM tbl_admin WHERE id = $id";

$res=mysqli_query($conn,$sql);

//chech whether the query executed successfully or not
if($res==true)
{
   // echo "Admin deleted";
   //create session variable to display mes
   $_SESSION['delete']="<div class='success'>Admin deleted successfully!</div>";
   header('location:'.SITEURL.'../admin/manage-admin.php');
}
else{
    //echo "Failed to delete admin";
    $_SESSION['delete']="<div class='error'>Failed to delete admin. Try again later</div>";
    header('location:'.SITEURL.'../admin/manage-admin.php');
}
//3. redirect to manage admin page with message(success/error)

?>