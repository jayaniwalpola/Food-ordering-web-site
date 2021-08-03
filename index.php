<?php include('partials-front/menu.php'); ?>
        <!-- search bar starts -->
        <div class="food-search text-center">
            <div class="container">
               <form  action="<?php echo SITEURL; ?>food-search.php" method="POST">
                   <input type="search" name="search" placeholder="Search for Food..." required>
                   <input type="submit" name="submit" value="Search" class="btn btn-primary">
               </form>
            </div>

        </div>
        <!-- search bar ends -->
        <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        ?>
        <!-- home image fixes starts -->
        <div class="home">

        </div>
        <!-- home image fixes endss -->

        <!-- food explore starts -->
        <section class="categories">
        <div class="explore">
            <h1>Explore Foods</h1>
            <?php
            //create sql query to display categories from database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

            //execute the query
            $res = mysqli_query($conn,$sql);
            //count the rows to check whether the category available or not
            $count=mysqli_num_rows($res);

            if($count>0){
                //category available
                while($row=mysqli_fetch_assoc($res)){
                    //get the values like id,title,image name
                    $id = $row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                     <a href="<?php echo SITEURL; ?>categories-foods.php?category_id=<?php echo $id; ?>">
                         <div class="box-3 float-container">
                             <?php
                             //check whethere image is available or not
                             if($image_name =="")
                             {
                                 //display message
                                echo "<div class='error'>Image not available</div>";     
                             }else{
                                 //image name is available
                                 ?>
                                  <img src="<?php echo SITEURL; ?>imgs/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                                 <?php
                             }                       
                             ?>
                           
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>

                    <?php
                }
            }
            else{
                //category is not available
                echo "<div class='error'>Category not added.</div>";
            }
            ?>
           
            <div class="clearfix"></div>
            
         </div>

        </section>
        

        <!-- food explore ends -->
        <!-- food menu starts -->
        <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            //getting foods from database that are active and featured
            //sql query
            $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //execute query
            $res2=mysqli_query($conn,$sql2);
            
            //count rows
            $count2 = mysqli_num_rows($res2);

            //check whether food available or not in database
            if($count2>0){
                //food available
                while($row2=mysqli_fetch_assoc($res2)){
                    //get all the data 
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price=$row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>
                    <div class="food-menu-box">
                         <div class="food-menu-img">
                             <?php
                             //check whether image available or not
                             if($image_name == ""){
                                 //image  not available
                                 echo "<div class='error'>Image not available</div>";
                             }
                             else{
                                 //image  available
                                 ?>
                                  <img src="<?php echo SITEURL; ?>imgs/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsiveI img-curveI">

                                 <?php
                             }

                             ?>
                            
                        </div>
                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?></p>
                            <p class="food-detail">
                               <?php echo $description; ?>
                            </p>
                            <br>
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>


                    <?php
                }
            }else{
                //food available
                echo "<div class='error'>Food not available.</div>";
            }
            ?>

        
            
         

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a class="food-link" href="#">See All Foods</a>
        </p>
    </section>
        <!-- food menu ends -->
<?php include('partials-front/footer.php'); ?>