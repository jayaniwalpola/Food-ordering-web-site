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
       

    
        <!-- food menu starts -->
        <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            //display foods that are active
            $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
            //execute the query
            $res = mysqli_query($conn,$sql);
            //count rowss
            $count = mysqli_num_rows($res);
            //chech whether the food are available
            if($count>0)
            {
                //foods available
                while($row = mysqli_fetch_assoc($res))
                {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];

                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            //check image is available
                            if($image_name == "")
                            {
                                //image is not available
                                echo "<div class='error'>Image not available</div>";
                            }
                            else{
                                //image available
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
            }
            else
            {
                //foods not available
                echo "<div class='error'>Food not found.</div>";
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