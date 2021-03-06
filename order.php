
<?php include('partials-front/menu.php'); ?>

<?php 
    //CHeck whether food id is set or not
    if(isset($_GET['food_id']))
    {
        //Get the Food id and details of the selected food
        $food_id = $_GET['food_id'];

        //Get the DEtails of the SElected Food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);
        //Count the rows
        $count = mysqli_num_rows($res);
        //CHeck whether the data is available or not
        if($count==1)
        {
            //WE Have DAta
            //GEt the Data from Database
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            //Food not Availabe
            //REdirect to Home Page
            header('location:'.SITEURL);
        }
    }
    else
    {
        //Redirect to homepage
        header('location:'.SITEURL);
    }
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">
        
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
        <!-- Email Validation with Java script  -->
        <script type="text/javascript">
  function validate(form_id, email) {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    var address = document.forms[form_id].elements[email].value;
    if(reg.test(address) == false) {
      alert('Invalid Email Address');
      return false;
    }
  }
</script>

        <form id="form_id" action="confirm.php" method="POST" class="order" onsubmit="javascript:return validate('form_id', 'email');" >
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php 
                    
                        //CHeck whether the image is available or not
                        if($image_name=="")
                        {
                            //Image not Availabe
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            //Image is Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                        }
                    
                    ?>

                    
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price">$<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                    
                </div>

            </fieldset>
            
            <fieldset >
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" id="number" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" id="email" name="email" placeholder="E.g. hi@gmail.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary"   >
            </fieldset>

            

        </form>
   

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>