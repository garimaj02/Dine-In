<?php include './menu.php' ;?>
<div class="main-content">
    <div class="wrapper" >
        <h1>Add Admin</h1>
        <br/><br/>
        <form action="" method="POST">
          <table class="tbl-30" >
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Enter Your Name" ></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="user_name" placeholder="Your username" ></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder="Enter Password
                " ></td>
            </tr>
            <tr>
                <td colspan="2" >
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary" >
                </td>
            </tr>
          </table>

        </form>
    </div>
</div>

<?php include './footer.php'?>

<?php 
//    process the value from form and save it in database
// check whether the button is clicked or not

if(isset($_POST['submit']))
{
    // btton clicked
    //echo "Button Clicked";

    //1.get the data from here
    $full_name=$_POST['full_name'];
    $username=$_POST['user_name'];
    $password=md5($_POST['password']);//password encryption with md5

    //sql query to save data into database
    $sql="INSERT INTO tbl_admin SET 
    full_name='$full_name',
    user_name='$username',
    password='$password'
    ";
   
  $res=mysqli_query($conn,$sql) ;
  // check whether the data i
  if($res==true)
  {
   // echo "data inserted";
  $_SESSION['add']='Admin Added Successfully';
  header("location:".SITEURL.'../admin/manage-admin.php');
}
else
{
    
    //echo "data Not inserted";
    $_SESSION['add']='Failed To Add Admin';
  header("location:".SITEURL.'admin/add-admin.php');
}
}
   ?>