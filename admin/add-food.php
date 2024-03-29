<?php include './menu.php';?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
<?php

if(isset($_SESSION['upload']))
{
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
}
?>
<br><br>
        <form action="" method="post" enctype="multipart/form-data" >
    <table class="tbl-30">
        <tr>
            <td>Title:  </td>
            <td>
                <input type="text" name="title" placeholder="title of the food">
            </td>
        </tr>

        <tr>
            <td>Description:</td>
<td>
    <textarea name="description" colspan="30" rows="5" placeholder="Description of the food.." ></textarea>
</td>

        </tr>
        <tr>
            <td>Price:  </td>
            <td>
                <input type="number" name="price">
            </td>
        </tr>
        
        <tr>
            <td>Select Image:  </td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>Category:  </td>
            <td>
            <select name="category_id">
              <?php
            //  display category from database
            // create sql to gett all active category from database
            $sql="SELECT * FROM tbl_category WHERE active='Yes' ";
            // execute
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);

            if($count>0)
            {
              while($row=mysqli_fetch_assoc($res))
              {
                $id=$row['id'];
                $title=$row['title'];
                ?>
                   <option value="1"><?php echo $id;?><?php echo $title;?></option>
                <?php
              }
            }
            else
            {
                ?>
                <option value="0">No Category Found</option>
                <?php
            }
              ?>
            <option value="1">Food</option>
            <option value="2">Snacks</option>
            </select>
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
                <input type="submit" name="submit" value="Add Food" class="btn-primary">
            </td>
        </tr>

        
    </table>
</form>
<?php
// check whether the button is clicked or not

if(isset($_POST['submit']))
{
    // btton clicked
   // echo "Button Clicked";
   
    //1.get the data from form
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category_id=$_POST['category_id'];
    // check whether 
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
}
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
    $image_name="FOOD-NAME-".rand(000,999).'.'.$ext;
    $source_path=$_FILES['image']['tmp_name'];
    $destination_path="../images/food/".$image_name;
    $upload=move_uploaded_file($source_path,$destination_path);
    if($upload==false)
    {
        $_SESSION['upload']="<div class='error'>Failed to upload image.</div>";
        header('location:'.SITEURL.'../admin/add-food.php');
        die();
    }
}

    else
    {
       $image_name="";
    }

    $sql2="INSERT INTO tbl_food 
    SET
    title='$title',
    description='$description',
    price='$price',
    image_name='$image_name',
    category_id='$category_id',
    featured='$featured',
    active='$active' 
      ";
    // execute query
    $res2=mysqli_query($conn,$sql2);

    // check whether the query executed or not data added or not
    if($res2==true)
    {
      $_SESSION['add']="<div class='success'>Food added successfully!</div>";
      header('location:'.SITEURL.'../admin/manage-food.php');
    }
    else{
        $_SESSION['add']="<div class='error'>Failed to add food.</div>";
        header('location:'.SITEURL.'../admin/add-category.php');
    }
    }
?>        

    </div>
</div>
<?php include './footer.php';?>