<?php include './menu.php';?>

<div class='main-content'>
    <div class="wrapper">
        <h1>Upadte Food</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            // echo "creating data";
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_food WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $current_image = $row['image_name'];
            $current_category = $row['category_id'];
            $featured = $row['featured'];
            $active = $row['active'];
        } else {
            header('location:' . SITEURL . '../admin/manage-food.php');
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>


                <tr>
                    <td>Current Image:</td>
                    <td>
                        <!-- Image Will Displayed Here -->
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>../images/food/<?php echo $current_image; ?>" alt="<?php echo $title; ?>" width="150px">
                        <?php
                        } else {
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

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            //  display category from database
                            // create sql to gett all active category from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";
                            // execute
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['category_id'];
                            ?>
                                    <option value="<?php echo $category_id; ?>" <?php if ($current_category == $category_id) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $category_title; ?></option>
                                <?php
                                }
                            } else {
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
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        // check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
            // echo "Clicked";

            //    get the value from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            // for radio input type we need to check button is selected or not
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }
            // check whether the image is selected or not and set the value for image name accordingly
            //  print_r($_FILES['image']);
            //  die();
            if (isset($_FILES['image']['name'])) {
                //   upload the image
                $image_name = $_FILES['image']['name'];
                // upload image ig image is available
                if ($image_name != "") {
                    // auto rename our image
                    // get the extension of our image(jpg,png)
                    $ext = end(explode('.', $image_name));
                    // rename the image
                    $image_name = "FOOD-NAME-" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/" . $image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload message.</div>";
                        header('location:' . SITEURL . '../admin/manage-food.php');
                        die();
                    }
                    // remove current image
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;
                        $remove = unlink($remove_path);

                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                            header('location:' . SITEURL . '../admin/manage-food.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            // create sql query to insert category into database
            $sql = "UPDATE tbl_food SET
    title='$title',
    description='$description',
    price='$price',
    image_name='$image_name',
    category_id='$category',
    featured='$featured',
    active='$active'
    WHERE id =$id";

            // execute query
            $res = mysqli_query($conn, $sql);

            // check whether the query executed or not data added or not
            if ($res == true) {
                $_SESSION['update'] = "<div class='success'>Food updated successfully!</div>";
                header('location:' . SITEURL . '../admin/manage-food.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to update food.</div>";
                header('location:' . SITEURL . '../admin/manage-food.php');
            }
        }

        ?>

    </div>
</div>


<?php include './footer.php';?>