<?php include('partials/menu.php'); ?>
 
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add']))//checking whether the session is set or not
        {
            echo $_SESSION['add'];//display session message if set
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>User Name:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colldpan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>

</div>

<?php include('partials/footer.php'); ?>

<?php
 //process the value from form and save it in database

//check wheather the button is clicked or not
if(isset($_POST['submit']))
{
    //button clicked
    // echo "Button Clicked";

    //1.Get the data from form
     $full_name = $_POST['full_name'];
     $username = $_POST['username'];
     $password = md5($_POST['password']);//password encryption with md5

     //2.sql query to save the data into database
     $sql = "INSERT INTO tbl_admin SET
     full_name = '$full_name',
     username = '$username',
     password = '$password'
     ";
    //3.executing query and saving date into database
     $res = mysqli_query($conn,$sql) or die(mysqli_error());

     //4.check wheather the(Qery is executed) data is inserted or not and displat appropriate message
     if($res == TRUE)
     {
         //Data inserted
       // echo "Data inserted";
       //create a session variable to display message
       $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
       //redirect page manage admin page
       header("location:".SITEURL.'admin/manage-admin.php');
     }
     else{
         //failed to inserted
       //  echo "Data inserted failed";

       //create a session variable to display message
       $_SESSION['add'] = "<div class='error'>Faild to add admin</div>";
       //redirect page add admin page
       header("location:".SITEURL.'admin/add-admin.php');
     }
}

?>