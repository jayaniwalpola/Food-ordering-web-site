<?php

//include constant.php file here
include('../config/constants.php');

//1.get the id of admin to be deleted
 $id = $_GET['id'];

//2.create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//Execute the query
$res = mysqli_query($conn,$sql);

//check whether the query executed successfully or not
if($res == true){
    //query executed successfullu and admin deleted
   // echo "Admin Deleted";
   //create session variable to display message 
   $_SESSION['delete']= "<div class='success'>Admin Deleted Successfully</div>";
   //redirect to manage admin page
   header('location:'.SITEURL.'admin/manage-admin.php');
}
else{
    //failed to delete admin
    //echo "Failed to delete admin";
    $_SESSION['delete'] = "<div class='error'>Faild to delete admin.Try again later</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

//3.redirect to the manage admin page with message(sucess/error)

?>