<?php include('./menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
</br/></br>

<?php 
 //get id of selected admin

 $id=$_GET['id'];
 //create sql query to get the details
 $sql="SELECT * FROM tbl_admin WHERE id=$id";

 //execute the query
 $res=mysqli_query($conn,$sql);

 //check whether is query executed or not
 if($res==true)
 {
    //check whether data is available or not
    $count=mysqli_num_rows($res);
    //check whether we have admin data or not
    if($count==1)
    {
        //echo "Admin Available";
        $row=mysqli_fetch_assoc($res);
        $full_name=$row['full_name'];
        $user_name=$row['user_name'];
    }
    else{
        header('location:'.SITEURL.'./admin/manage-admin.php');

    }
 }

?>
        <form action="" method="POST">
           <table class="tbl-30">
           <tr>
            <td>Full Name:</td>
            <td>
                <input type="text" name="full_name" value="<?php echo $full_name; ?>" >
            </td>
           </tr>

           <tr>
            <td>Username:</td>
            <td>
                <input type="text" name="user_name" value="<?php echo $user_name; ?>">
            </td>
           </tr>

           <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id;?>" >
                <input type="submit" name="submit"value="Update Admin" class="btn-secondary">
            </td>
           </tr>
           </table>
        </form>

    </div>
</div>

<?php 
//check whether the submit butoon is clicked or not
if(isset($_POST['submit']))
{
    //echo "Button Clicked";
    //echo $id = $_POST['id'];
     $full_name=$_POST['full_name'];
     $user_name=$_POST['user_name'];

     //create sql query to update admin
     $sql="UPDATE tbl_admin SET
    full_name='$full_name',
    user_name='$user_name' 
    WHERE id='$id'
     ";

     $res=mysqli_query($conn,$sql);

     if($res==true)
     {
       $_SESSION['update']="<div class='success' >Admin Upadated Successfully.</div>";
       header('location:'.SITEURL.'./admin/manage-admin.php');
     }
     else{
        $_SESSION['update']="<div class='success'>Failed To Delete Admin.</div>";
        header('location:'.SITEURL.'./admin/manage-admin.php');
     }
}

?>


<?php include('./footer.php') ?>