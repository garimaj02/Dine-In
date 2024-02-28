<?php include './menu.php';?>

<div class='main-content'>
    <div class="wrapper">
        <h1>Upadte Category</h1>
        <br><br>
        <?php
if(isset($_GET['id']))
{
   // echo "creating data";
   $id=$_GET['id'];

   $sql="SELECT * FROM tbl_category WHERE id=$id";
   $res=mysqli_query($conn,$sql);
   $count=mysqli_num_rows($res);

   if($count==1)
   {
     $row=mysqli_fetch_assoc($res);
     $title=$row['title'];
     $current_image=$row['image_name'];
     $featured=$row['featured'];
     $active=$row['active'];
   }
   else
   {
      $_SESSION['no-category-found']="<div class='error'>Category Not Found.</div>";
      header('location:'.SITEURL.'../admin/manage-category.php');
   }
}
else{
    header('location:'.SITEURL.'../admin/manage-category.php');
}
?>
    <form action="" method="post" enctype="multipart/form-data" >
    <table class="tbl-30">
        <tr>
            <td>Title:  </td>
            <td>
                <input type="text" name="title" value="<?php echo $title;?>" placeholder="Category title">
            </td>
        </tr>
        <tr>
            <td>Current Image:</td>
<td>
    <!-- Image Will Displayed Here -->
    <?php
    if($current_image!="")
    {
        ?>
        <img src="<?php echo SITEURL;?>../images/category/<?php echo $current_image; ?>" width="150px" >
        <?php      
    }
    else
    {
        echo "<div class='error'>Image Not available.</div>";
    }
    ?>
</td>

        </tr>
        <tr>
            <td>New Image:</td>
<td>
    <input type="file" name="image">
</td>

        </tr>
        <tr>
            <td>Featured:</td>
            <td>
                <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
            </td>
        </tr>
        <tr>
            <td>Active:</td>
            <td>
                <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
            </td>


        <tr>
            <td colspan="2">
                <input type="hidden" name="current_image"value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>" >
                <input type="submit" name="submit" value="Update Category" class="btn-primary">
            </td>
        </tr>
</table>
</form>
<?php
// check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
   // echo "Clicked";

//    get the value from our form
$id=$_POST['id'];
$title = $_POST['title'];
$current_image=$_POST['current_image'];
// for radio input type we need to check button is selected or not
if(isset($_POST['featured']))
{
$featured=$_POST['featured'];
}
else{
$featured="No";
}
if(isset($_POST['active']))
{
    $active=$_POST['active'];
}
else{
    $active="No";
    }
// check whether the image is selected or not and set the value for image name accordingly
    //  print_r($_FILES['image']);
    //  die();
    if(isset($_FILES['image']['name']))
    {
    //   upload the image
    $image_name=$_FILES['image']['name'];
    // upload image ig image is available
    if($image_name!="")
    {
    // auto rename our image
    // get the extension of our image(jpg,png)
    $ext=end(explode('.',$image_name));
    // rename the image
    $image_name="FOOD_CATEGORY_".rand(000,999).'.'.$ext;
    $source_path=$_FILES['image']['tmp_name'];
    $destination_path="../images/category".$image_name;
    $upload=move_uploaded_file($source_path,$destination_path);
    if($upload==false)
    {
        $_SESSION['upload']="<div class='error'>Failed to upload message.</div>";
        header('location:'.SITEURL.'../admin/manage-category.php');
        die();
    }
    // remove current image
    if($current_image!="")
    {
    $remove_path="../images/category/".$current_image;
    $remove=unlink($remove_path);

    if($remove==false)
    {
        $_SESSION['failed-remove']="<div class='error'>Failed to remove current image</div>";
        header('location:'.SITEURL.'../admin/manage-category.php');
        die();
    }
}
}
else
{
   $image_name=$current_image;
}
}
    else
    {
       $image_name=$current_image;
    }

    // create sql query to insert category into database
    $sql="UPDATE tbl_category SET
    title='$title',
    image_name='$image_name',
    featured='$featured',
    active='$active'
    WHERE id=$id";

    // execute query
    $res=mysqli_query($conn,$sql);

    // check whether the query executed or not data added or not
    if($res==true)
    {
      $_SESSION['add']="<div class='success'>Category updated successfully!</div>";
      header('location:'.SITEURL.'../admin/manage-category.php');
    }
    else{
        $_SESSION['add']="<div class='error'>Failed to update Category.</div>";
        header('location:'.SITEURL.'../admin/manage-category.php');
    }

}

?>

    </div>
</div>


<?php include './footer.php';?>