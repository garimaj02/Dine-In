

<body>

<?php include './partials-front/menu.php'; ?>

<?php
// check whether the id is passed or not
if(isset($_GET['category_id']))
{
$category_id=$_GET['category_id'];
$sql="SELECT title FROM tbl_category WHERE id=$category_id";
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($res);
$category_title=$row['title'];
}
else
{
header('location:'.SITEURL);
}
?>
     <!-- fOOD sEARCH Section Starts Here -->
     <section class="food-search text-center">
        <div class="container">
            
           
            <h2>Foods on <a href="./categories-foods.html" class="text-white"><?php echo $category_title;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
             <?php
             $sql="SELECT* FROM tbl_food ";
             $res=mysqli_query($conn,$sql);
             $count=mysqli_num_rows($res);
             if($count>0)
             {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id=$row['id'];   
                    $title=$row['title'];
                    $price=$row['price']; 
                    $description=$row['description'];
                    $image_name=$row['image_name'];
                    ?>
                   <div class="food-menu-box">
                   <div class="food-menu-img">
                <?php
                          if($image_name=="")
                          {
                              echo "<div class='error'>Image Not Available.</div>";
                          }
                          else
                          {
                                  ?>
                                    <img src="<?php echo SITEURL;?>./images/food/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                                  <?php
                          }
                    ?>

                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price"><?php echo $price;?>
                    </p>
                    <p class="food-detail">
                        <?php echo $description;?>

                    </p>
                    <!-- <br><br><strong>500 calories</strong> -->
                    <br><br>
                    <a href="<?php echo SITEURL;?>./order.php?food-id=<?php echo $id;?>"  class="btn btn-primary">Order Now</a>
                </div>
            </div>
                    <?php
                }
             }
             else
             {
                echo "<div class='error'>Food not available.</div>";
             }
             ?>
            

            

            <div class="clearfix"></div>



        </div>


    </section>
    <!-- fOOD Menu Section Ends Here -->


</body>
</html>

<?php include './partials-front/footer.php'; ?>