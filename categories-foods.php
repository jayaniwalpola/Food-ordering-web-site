<?php include('config/constants.php'); ?>
<html>
    <head>
        <meta charset="UTF-8">
         <!-- Important to make website responsive -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="stylesheet" href="css/style.css">
        
    </head>
    <body>
        <!-- Navbar Starts -->
        <section class="nav-cat">
            <div class="logo">
                <img src="imgs/logo2.png" width="100px" height="80px">
            </div>
            <div class="links">
                <ul>
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>categories.php">Categories</a></li>
                    <li><a href="<?php echo SITEURL; ?>foods.php">Foods</a></li>
                    <li><a href="<?php echo SITEURL; ?>">Contact</a></li>
                    
                </ul>
            </div>
        </section>
        <!-- Navbar ends -->
        <?php 
            //check whether id is passed or not
            if(isset($_GET['category_id']))
            {
                //category id is set and get the id
                $category_id = $_GET['category_id'];
                //GET category title based on category id
                $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
                //execute the query
                $res = mysqli_query($conn,$sql);
                
                //get the values from database
                $row = mysqli_fetch_assoc($res);
                //get the title
                $category_title = $row['title'];
            }
            else
            {
                //category id is not passed
                //redirect to home page
                header('location:'.SITEURL);
            }
        ?>
        <!-- search bar starts -->
        <div class="food-search-food">
            <h1 class="heading">Foods on Your Search<span class="cat">"<?php echo "$category_title"; ?>"</span></h1>

        </div>
        <!-- search bar ends -->
        

        <!-- food menu starts -->
        <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                //create sql query to get food based on selected category
                $sql2="SELECT * FROM tbl_food WHERE category_id=$category_id";

                //execute the query
                $res2= mysqli_query($conn,$sql2);

                //count rows
                $count2 = mysqli_num_rows($res);

                //check whether food is available or not
                if($count2>0)
                {
                    //food is available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id= $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($image_name == "")
                                        {
                                            //image not available
                                            echo "<div class='error'>Image not Available.</div>";
                                        }
                                        else
                                        {
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
                    //food not available
                    echo "<div class='error'>Food not Available.</div>";
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