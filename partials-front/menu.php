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
        <section class="nav">
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