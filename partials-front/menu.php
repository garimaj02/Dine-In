<?php include './config/constants.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESTAURENT </title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="./images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <!-- <h1 style="text-align:center; font-size:30px; padding:5px; margin:5px;">Dine-In</h1> -->

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>./categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>./foods.php">Foods</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
