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
        <!-- search bar starts -->
        <div class="food-search-food">
            <?php 
                //get the search keyword
                $search = $_POST['search'];
            ?>
            <h1 class="heading">Foods on Your Search<span class="cat">"<?php echo $search; ?>"</span></h1>

        </div>
        <!-- search bar ends -->
         <!-- food menu starts -->
         <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                //sql query to food based on search keyword
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //execute the query
                $res = mysqli_query($conn,$sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check whether food available or not
                if($count>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                    //check whether image name is available or not
                                    if($image_name == ""){
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