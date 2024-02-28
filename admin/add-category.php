<?php include './menu.php';?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
<?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if(isset($_SESSION['upload']))
{
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
?>
<br><br>
        <!-- add Category form starts -->
<form action="" method="post" enctype="multipart/form-data" >
    <table class="tbl-30">
        <tr>
            <td>Title:  </td>
            <td>
                <input type="text" name="title" placeholder="Category title">
            </td>
        </tr>

        <tr>
            <td>Select Image:</td>
<td>
    <input type="file" name="image">
</td>

        </tr>

        <tr>
            <td>Featured:</td>
            <td>
                <input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured" value="No">No
            </td>
        </tr>
        <tr>
            <td>Active:</td>
            <td>
                <input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
            </td>
</td>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Category" class="btn-primary">
            </td>
        </tr>

        
    </table>
</form>
        
        <!-- add Category form ends -->

<?php
// check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
   // echo "Clicked";

//    get the value from category form
$title = $_POST['title'];
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
    $destination_path="../images/category/".$image_name;
    $upload=move_uploaded_file($source_path,$destination_path);
    if($upload==false)
    {
        $_SESSION['upload']="<div class='error'>Failed to upload message.</div>";
        header('location:'.SITEURL.'../admin/add-category.php');
        die();
    }
}
}
    else
    {
       $image_name="";
    }

    // create sql query to insert category into database
    $sql="INSERT INTO tbl_category SET
    title='$title',
    image_name='$image_name',
    featured='$featured',
    active='$active' ";

    // execute query
    $res=mysqli_query($conn,$sql);

    // check whether the query executed or not data added or not
    if($res==true)
    {
      $_SESSION['add']="<div class='success'>Category added successfully!</div>";
      header('location:'.SITEURL.'../admin/manage-category.php');
    }
    else{
        $_SESSION['add']="<div class='error'>Failed to add Category.</div>";
        header('location:'.SITEURL.'../admin/add-category.php');
    }

}

?>

    </div>
</div>
<?php include './footer.php';?>