<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        <?php

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" col="30" rows="5" placeholder="Description of the Food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" >
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php 

                            //create php code to display categories from database
                            //1.create sql to get all active category from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            //executing query
                            $res = mysqli_query($conn,$sql);

                            //count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);
                            
                            //if count is greater than zero we have category if not we dont have categories
                            if($count > 0)
                            {
                                //we have category
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    //get the details of categories
                                    $id = $row['id'];
                                    $title = $row['title'];

                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                    <?php

                                }
                            }
                            else{
                                // we dont have category
                                ?>
                                <option value="0">No category Found</option>
                                <?php
                            }
                            //2.display on dropdown
                            
                            ?>
                           
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        
        //check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            //add the food to databse
            //echo "Clicked";

            //1.get the data from form
            $title = $_POST['title'];
            $description =$_POST['description'];
            $price=$_POST['price'];
            $category = $_POST['category'];
            
            //check whether radio button for featured and active are checked or not
            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }
            else
            {
                $featured = "No";//setting the default value
            }
            if(isset($_POST['active'])){
                $active= $_POST['active'];
            }
            else{
                $active="No";//default value
            }

            //2.upload the image if selected
            //check whether the select image is clicked or not and upload the image only if the image is selected
            if(isset($_FILES['image']['name'])){
                //get the details of the selected image
                $image_name = $_FILES['image']['name'];
                //chech whether the image is selected or not and upload image only if selected
                if($image_name != ""){
                    //image is selected
                    //A.rename the image
                    //get the extension of selected image (jpg,png,gif,etc.)vijay.jps
                    $ext =  end(explode('.',$image_name));//this end function only select the last part of the sentence that mean the extension of the image

                    //create new name for image
                    $image_name = "Food-Name_".rand(000,999).'.'.$ext;//new image name may be "Food-Name-654.jpg"
                    
                    //B.upload the image
                    // get the source path and the destination path

                    //source path is the current location of the image
                    $src=$_FILES['image']['tmp_name'];
                    //destination path for image to be uploaded
                    $dst = "../imgs/food/".$image_name;
                    

                    //finaly upload the food image
                    $upload = move_uploaded_file($src,$dst);


                    //check whether image uploaded or not
                    if($upload == false)
                    {
                        //failed to upload the image
                        //redirect to add food page with error message
                        $_SESSION['upload'] = "<div class='error'>Image failed to upload</div>";
                        header('loaction:'.SITEURL.'admin/add-food.php');
                        //stop the process
                        die();
                    }
                }

            }
            else{
                $image_name = "";//setting deafult value as blank
            }

            //3.insert into database
            //create sql query to save all add food
           //for numerical value we not need to pass the value insie the '' but for string values it is compulsory to add quotes ''
           $sql2 = "INSERT INTO tbl_food SET
            title='$title',
            description = '$description',
            price = $price, 
            image_name =  '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'
            ";
            //execute the query
            $res2 = mysqli_query($conn,$sql2);
            //check whether data is inserted or not
            if($res2 == TRUE){
                //data inseted successfully
                $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else{
                //failed to insert data
                $_SESSION['add'] = "<div class='error'>Failed to add food</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }

            //4.redirect with message to manage food page
        }
        {

        }

        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>