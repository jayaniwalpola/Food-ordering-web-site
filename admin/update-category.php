<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
            //check whether the id is set or not
            if(isset($_GET['id'])){
                //get the id and all other details
                //echo "Getting the data";
                $id = $_GET['id'];
                //create sql query to get all other details
                $sql = "select * from tbl_category where id=$id";

                //execute the query
                $res = mysqli_query($conn,$sql);

                //count the rows to chec whether the id is valid or not
                $count = mysqli_num_rows($res);
                 if($count == 1){
                     //get all data
                     $row = mysqli_fetch_assoc($res);
                     $title = $row['title'];
                     $current_image = $row['image_name'];
                     $featured = $row['featured'];
                     $active =$row['active'];
                 }
                 else{
                     //redirect to manage category with session message
                     $_SESSION['no-category-found']="<div class='error'>Category not found</div>";
                     header('location:'.SITEURL.'admin/manage-category.php');
                 }
            }
            else{
                //redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td>Current Image:</td>
                <td>
                    <?php
                    if($current_image != ""){
                        //display the image
                        ?>
                        <img src="<?php echo SITEURL; ?>imgs/category/<?php echo $current_image; ?>" width="100px" height="100px">
                        <?php
                    }
                    else{
                        //display message
                        echo "<div class='error'>Image not added.</div>";
                    }
                     ?>
                </td>
            </tr>
            <tr>
                <td>New Image</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Featured</td>
                <td>
                    <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes

                    <input <?php if($featured == "No"){echo "checked";} ?>  type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active</td>
                <td>
                     <input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                     <input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No">No

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden"name="id" value="<?php echo $id; ?>" >
                    <input type="submit" name="submit" class="btn-secondary" value="Update Category">
                </td>
            </tr>
        </table>
        </form>
        <?php 
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //1.get all the value form our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active =$_POST['active'];

                //2.updating new image if selected
                //check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get the image details
                    $image_name = $_FILES['image']['name'];

                    //check whether the image is available or not
                    if($image_name != ""){
                        //image available
                        //A.upload the new image
                        
                //auto rename our image
                //get the extention of our image(jpg,png,gif,etc) eg."food1.jpg"
                $ext = end(explode('.',$image_name));

                //rename the image 
                $image_name = "Food_Category_".rand(000,999).'.'.$ext;//e.g.Food_Category_834.jpg


                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../imgs/category/".$image_name;

                //finally upload the image
                $upload = move_uploaded_file($source_path,$destination_path);

                //check whether the image is uploaded or not
                // and if the image is not uploaded then we will stop the process and redirect with error message
                if($upload == false){
                    //set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload Image.</div>";
                    //Redirect to add category page
                    header('location:'.SITEURL.'/admin/manage-category.php');
                    //stop the process
                    die();
                }
                        //B.remove the current image if available
                        if($current_image != ""){
                            
                            $remove_path = "../imgs/category/".$current_image;
                            $remove = unlink($remove_path);
                            
                            //check whether the image is removed or  not
                            //if failed to remove then display message and stop thr process
                            if($remove == false)
                            {
                                //failed to remove the image
                                $_SESSION['failed-remove']="<div class='error'>Failed to remove the current image</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();//stop the process
                            }

                        }
                      

                    }
                    else{
                        $image_name = $current_image;
                    }
                }
                else{
                    $image_name = $current_image;
                }

                //3.update the database
                $sql2="UPDATE tbl_category SET
                title= '$title',
                image_name='$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
                ";
                //exucute the query
                $res = mysqli_query($conn,$sql2);

                //4.redirect to manage category with message
                //chech whether query executed or not
                if($res == true)
                {
                    //category updated
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    //failed to update category
                    $_SESSION['update'] = "<div class='error'>Failed to update category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
        ?>
        
    </div>
</div>

<?php include('partials/footer.php'); ?>