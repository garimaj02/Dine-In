<?php include('../config/constants.php');?>

<html>
    <head>
        <title>Login food order system</title>
         <link rel="stylesheet" href="./admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>
<?php
if(isset($_SESSION['login']))
{
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}

if(isset($_SESSION['no-login-message']))
{
    echo   $_SESSION['no-login-message'];
    unset(  $_SESSION['no-login-message']);
}
?>
<br><br>

            <!-- login form starts here  -->
             <form action="" method="post" class="text-center" >
             username:<br>
             <input type="text" name="user_name" placeholder="Enter Username"><br><br>
             password:<br>
             <input type="password" name="password" placeholder="Enter Password" ><br><br>
             <input type="submit" name="submit" value="Login" class="btn" ><br><br>
             </form>


            <!-- login form ends here -->
            <p class="text-center">Created By - <a href="garimajoshi804@gmail.com" >Garima Joshi</a> </p>

        </div>
    </body>
</html>

<?php 
// check whether the submmit button is clicked or not
if(isset($_POST['submit']))
{
    // get the data from login form
    $user_name = mysqli_real_escape_string($conn,$_POST['user_name']);
    $password= md5($_POST['password']);

    // sql to check whether the user name or password exist or not
    $sql="SELECT*FROM  tbl_admin WHERE user_name='$user_name' AND password='$password'";

    // // execute the query
    $res = mysqli_query($conn,$sql);

    // // count rows to check whether the user exist or not
    $count = mysqli_num_rows($res);

    if($count==1)
    {
      $_SESSION['login']="<div class='success'>Login Successful!</div>";
      $_SESSION['user']=$user_name;
      header('location:'.SITEURL.'./admin/');
    }
    else
    {
        $_SESSION['login']="<div class='error' class='text-center'>Username or password didn't match.</div>";
        header('location:'.SITEURL.'../admin/login.php');
    }
}
?>