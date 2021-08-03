<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login-Food order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br><br>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset( $_SESSION['login']);
                }
                if(isset(  $_SESSION['no-login-message'])){
                    echo   $_SESSION['no-login-message'];
                    unset(  $_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            <!-- login form starts here -->
            <form action="" method="POST" class="text-center">
                Username:<br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password:<br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form><br>
            <!-- login form ends here -->
            <p class="text-center" >Created By - <a href="www.jayani.com">Jayani Walpola</a></p>
        </div>

    </body>
</html>

<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    //process for login
    //1.get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //2.sql to check whether the user with username and passwrod exist or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //3.execute the query
    $res = mysqli_query($conn,$sql);

    //4.count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if($count == 1){
        //user available and login sucess
        $_SESSION['login'] = "<div class='success'>Login Successful</div>";
        $_SESSION['user'] = $username;//to check user is login or not and logout will unset it
        //redirect to home page/dashboard
        header('location:'.SITEURL.'admin/');

    }else{
        //user not available and login faild
        $_SESSION['login'] = "<div class='error text-center'>Username and password did not match</div>";
        //redirect to home page/dashboard
        header('location:'.SITEURL.'admin/login.php');
    }
}
?>