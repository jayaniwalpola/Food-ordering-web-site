<?php
    //include constants file
    include('../config/constants.php');
    //echo "Delete Page"
    //check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value and delete
        //echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file is available
        if($image_name != "")
        {
            //image is available.so remove it
            $path = "../imgs/category/".$image_name;
            //remove the image
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove == false)
            {
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove Category image.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }

        //Delete the data from database

        //sql query delete data from database
        $sql = "delete from tbl_category where id=$id";

        //execute the query
        $res = mysqli_query($conn,$sql);

        //check whether the data is deleted from database or not
        if($res == true)
        {
            //set success message and redirect 
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

      
    }
    else
    {
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php'); 
    }
?>