<?php include("./menu.php") ;
// include("./login.php") 
?>
<!-- Main content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1> DASHBOARD</h1>
<br><br>
      
         <?php
         if (isset($_SESSION['login'])) 
         {
             echo $_SESSION['login'];
             unset($_SESSION['login']);
         }
         ?>  

<br><br>
        <div class="col-4 text-center">
            <?php
            $sql="SELECT * FROM tbl_category";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            ?>
            <h1><?php echo $count;?></h1>
            <br />
            categories
        </div>

        <div class="col-4 text-center">
        <?php
            $sql="SELECT * FROM tbl_food";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            ?>
            <h1><?php echo $count;?></h1>
            <br />
            Foods
        </div>



        <div class="col-4 text-center">
        <?php
            $sql="SELECT * FROM tbl_order ";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res);
            ?>
            <h1><?php echo $count;?></h1>
            <br />
            Total Orders
        </div>

        <div class="col-4 text-center">
        <?php
        $sql="SELECT SUM(total) AS TOTAL FROM tbl_order WHERE status='Delivered'"; 
      
        $row=mysqli_fetch_assoc($res);
        $total_revenue=$row['total'];
        ?>
            <h1><?php echo $total_revenue;?></h1>
            <br />
            Revenue Generated
        </div>
        <div class="clearfix"></div>

    </div>
</div>
<!-- Main section ends -->

<?php include './footer.php'; ?>