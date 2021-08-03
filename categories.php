<?php include('partials-front/menu.php'); ?>
        <!-- search bar starts -->
        <div class="food-search text-center">
            <div class="container">
               <form  action="" method="POST">
                   <input type="search" name="search" placeholder="Search for Food..." required>
                   <input type="submit" name="submit" value="Search" class="btn btn-primary">
               </form>
            </div>

        </div>
        <!-- search bar ends -->
        

        <!-- food explore starts -->
        <section class="categories">
        <div class="explore">
            <h1>Explore Foods</h1>
            <?php
            //Display all the categories that are active
            //sql query
            $sql ="SELECT * FROM tbl_category WHERE active='Yes'";
            //execute the query
            $res = mysqli_query($conn,$sql);
            //count rows
            $count = mysqli_num_rows($res);

            //check whether categories are available
            if($count>0){
                //categories are available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get all the values
                    $id= $row['id'];
                    $title=$row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    <a href="<?php echo SITEURL; ?>categories-foods.php?category_id=<?php echo $id; ?>">
                         <div class="box-3 float-container">
                             <?php
                             if($image_name == "")
                             {
                                 //image not available
                                 echo "<div class='error'>Image not found.</div>";
                                 
                             }
                             else{
                                 //image available
                                 ?>
                                  <img src="<?php SITEURL; ?>imgs/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

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
                //categories not available
                echo "<div class='error'>Category not found.</div>";
            }
        

            ?>
          
                     

            
           
            <div class="clearfix"></div>
            
         </div>

        </section>

        <!-- food explore ends -->
       
 <?php include('partials-front/footer.php'); ?>