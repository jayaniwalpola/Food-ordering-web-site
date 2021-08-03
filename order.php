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
         //check whether food id is check or not
         if(isset($_GET['food_id']))
         {
             //get the food id and details of the selected food
             $food_id=$_GET['food_id'];

             //get the details of the selected food
             $sql ="SELECT * FROM tbl_food WHERE id=$food_id";

             //execute the query
             $res=mysqli_query($conn,$sql);
             //count rows
             $count = mysqli_num_rows($res);

             //check whether the data is available or not
             if($count == 1)
             {
                 //we have data
                 //GET THE data from database
                 $row = mysqli_fetch_assoc($res);
                 $title=$row['title'];
                 $price=$row['price'];
                 $image_image=$row['image_name'];
             }
             else
             {
                 //food not available
                 //redirect to home page
                 header('location:'.SITEURL);
             }

         }
         else
         {
             //redirect to home page
             header('location:'.SITEURL);
         }
        ?>
      
        <!-- search bar starts -->
        <div class="food-search-food">
            
            <h1 class="heading">Foods <span class="cat">Order here</span></h1>

        </div>
        <!-- search bar ends -->
        <!-- food order form starts -->
        <div class="home-order"  style="background-image: url(imgs/home1.jpg); height: 150%;margin-top:-100px;">
            <div class="field" >
                <form  action="" method="POST" class="order">
                    <fieldset>
                     <legend>Selected Food</legend>
                     <div class="food-menu-img">
                         <?php
                            //check image is available or not
                            if($image_image == "")
                            {
                                //image is not avaialble
                                echo "<div class='error'>Image not available.</div>";
                            } 
                            else
                            {
                                //image available
                                ?>
                                         <img src="<?php echo SITEURL; ?>imgs/food/<?php echo $image_image; ?>" alt="chicke hawain pizza" class="img-responsive img-curve">
                                <?php
                            }
                         ?>
                               
                     </div>
                     <div class="food-menu-desc">
                         <h3><?php echo $title; ?></h3>
                         <input type="hidden" name="food" value="<?php echo $title; ?>" >

                         <p class="food-price"><?php echo $price; ?></p>
                         <input type="hidden" name="price" value="<?php echo $price; ?>">
                         <div class="order-label">Quantity</div>
                         <input type="number" name="qty" class="input-responsive" value="1" required> 
                     </div>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>Delivery Details</legend>
                        <div class="order-label">Full Name</div>
                        <input type="text" name="full-name" placeholder="E.g. Jayani Walpola" class="input-responsive" required>

                        <div class="order-label">Phone Number</div>
                        <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                        <div class="order-label">Email</div>
                        <input type="email" name="email" placeholder="E.g. jay@gmail.com" class="input-responsive" required>

                        <div class="order-label">Address</div>
                        <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                        <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                    </fieldset>

            </form>
            <?php
                //check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get all the details from the form
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty;//total = price * qty

                    $order_date = date("Y-m-d h:i:sa");//order date

                    $status = "Ordered";//ordered,on delivery and deliverd,cancelled

                    $customer_name=$_POST['full-name'];
                    $customer_contact=$_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    //save the order in databse
                    //create sql to save the data
                    $sql2 = "INSERT INTO tbl_order SET
                       food = '$food',
                       price = $price,
                       qty = $qty,
                       total= $total,
                       order_date = '$order_date',
                       status = '$status',
                       customer_name='$customer_name',
                       customer_contact = '$customer_contact',
                       customer_email = '$customer_email',
                       customer_address = '$customer_address'
                    ";

                    //execute the query
                    $res2 = mysqli_query($conn,$sql2);

                    //check whether query executed successfully or not
                    if($res2 == true)
                    {
                        //query executed and order saved
                        $_SESSION['order']="<div class='success text-center'>Food Order Placed</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //failed to save order
                        $_SESSION['order']="<div class='error text-center'>Food Ordered Failed.</div>";
                        header('location:'.SITEURL);
                    }



                }
            ?>
            
            </div>
            

        </div>
        <!-- food order form endss -->
       
 <?php include('partials-front/footer.php'); ?>
