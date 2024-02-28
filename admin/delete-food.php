<?php
include '../config/constants.php';
 //echo "Delete Page";
//  check whether the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    // echo "Get VALUE aND dELETE.";
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    if($image_name!="")
    {
        $path="../images/food/".$image_name;
        $remove=unlink($path);

        if($remove==false)
        {
            $_SESSION['upload']="<div class='error'>Failed To Remove food Image.</div>";
            header('location:'.SITEURL.'../admin/manage-food.php');
            die();
        }
    }
    $sql="DELETE FROM tbl_food WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
      $_SESSION['delete']="<div class='success'>Food Deleted Successfully.</div>";
      header('location:'.SITEURL.'../admin/manage-food.php');
    }
    else
    {
        $_SESSION['delete']="<div class='error'>Failed To Delete Food.</div>";
        header('location:'.SITEURL.'../admin/manage-food.php');

}
}
else
{
    $_SESSION['unauthorized']="<div class='error'>Unauthorized Access.</div>";
    header('location:'.SITEURL.'../admin/manage-food.php');

}
?>