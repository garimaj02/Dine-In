
<?php include ("./menu.php") ?>
    <!-- Main content section starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1> Manage Admin</h1>
            <br/>
<?php 
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
if(isset($_SESSION['delete']))
{
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}

if(isset($_SESSION['update'])){
    echo $_SESSION['update'];
    unset($_SESSION['update']);
}
?>
<br/><br/>
            <!-- button to add admin -->
            <a href="./add-admin.php" class="btn-primary">Add Admin</a>
            <br/>
            <br/>
<table class="tbl-full">
    <tr>
        <th>S.N.</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Action</th>
    </tr>
    <?php
    $sql="SELECT*FROM tbl_admin";
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
        //count rows
        $count = mysqli_num_rows($res);

        $sn=1;
        if($count>0)
        {
            //we have data in dtabase
            while($rows=mysqli_fetch_assoc($res))
            {
                $id=$rows['id'];
                $full_name=$rows['full_name'];
                $user_name=$rows['user_name'];

                ?>
                 <tr>
        <td><?php echo $sn++;?></td>
        <td><?php echo $full_name;?></td>
        <td><?php echo $user_name; ?></td>
        <td>
           <a href="<?php echo SITEURL;?>./admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary"> Update Admin</a>
            <a href="<?php echo SITEURL;?> ./admin/delete-admin.php ? id=<?php echo $id;?>" class="btn" >Delete Admin</a>
        </td>
    </tr>
                <?php
            }
        }
        else{
            //we do not have data in database
        }
    }
    ?>
    
</table>
        </div>
    </div>
    <!-- Main section ends -->


   <?php include ('./footer.php') ;?>