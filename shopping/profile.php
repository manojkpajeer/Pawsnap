<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    $customerId = $_SESSION['user_id'];

    if(empty($customerId)){

        echo "<script>alert('Oops, Unable to process..');location.href='../login.php';</script>";
   }

    if(isset($_POST['update'])){
        
        if(mysqli_query($conn, "UPDATE customer_master SET FullName = '$_POST[name]', CustomerPhone = '$_POST[number]', AddressLine1 = '$_POST[address1]', AddressLine2 = '$_POST[address2]', Landmark = '$_POST[landmark]', Pincode = '$_POST[pincode]', CustomerCity = '$_POST[city]' WHERE CM_Id = '$customerId'")){

            echo "<script>alert('Yay, Profile updated successfully..');</script>";
        } else {

            echo "<script>alert('Oops, Unable to process..');</script>";
        }
    }

    $resCustomer = mysqli_query($conn, "SELECT * FROM  customer_master WHERE CM_Id = '$customerId'");
    if(mysqli_num_rows($resCustomer)>0){

        $resCustomer = mysqli_fetch_assoc($resCustomer);
    }else{

        echo "<script>alert('Oops, Unable to process..');location.href='../login.php';</script>";
    }

    ?>
    
    <section class="w3l-contact-2" id="contact">
        <div class="container py-lg-4 py-md-3 py-2">
            <div class="title-content text-center">
                <h6 class="title-subw3hny mb-1">Profile</h6>
                <h3 class="title-w3l mb-5">Update Profile Details</h3>
            </div>

            <div class="contact-grids">
                <div class="contact-right my-lg-5">
                    <form method="post" class="signin-form row">
                        <h6 class="title-subw3hny mb-2">Personal Details</h6>
                        <div class="col-lg-6">
                            <label class="form-lable">Your Name*:</label>
                            <input type="text" name="name" class="contact-input" required="" value="<?php if(!empty($resCustomer['FullName'])){echo $resCustomer['FullName'];}?>">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Your Phone No*:</label>
                            <input type="text" name="number" class="contact-input" required="" pattern="[0-9]{6,13}" title="Only numbers are accepted and it should be 6 to 13 digits in length" maxlength="13" value="<?php if(!empty($resCustomer['CustomerPhone'])){echo $resCustomer['CustomerPhone'];}?>">
                        </div>
                        <h6 class="title-subw3hny mb-2">Other Details</h6>
                        <div class="col-lg-6">
                            <label class="form-lable">Address Line 1*:</label>
                            <input class="form-control" type="text" name="address1" required value="<?php if(!empty($resCustomer['AddressLine1'])){echo $resCustomer['AddressLine1'];}?>">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Address Line 2*:</label>
                            <input class="form-control" type="text" name="address2" required value="<?php if(!empty($resCustomer['AddressLine2'])){echo $resCustomer['AddressLine2'];}?>">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Landmark*:</label>
                            <input class="form-control" type="text" name="landmark" required value="<?php if(!empty($resCustomer['Landmark'])){echo $resCustomer['Landmark'];}?>">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Town/City*:</label>
                            <input class="form-control" type="text" name="city" required value="<?php if(!empty($resCustomer['Pincode'])){echo $resCustomer['Pincode'];}?>">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Pincode*:</label>
                            <input class="form-control" type="text" name="pincode" required maxlength="6" pattern="[0-9]{6}" title="PIN Code should be 6 digits in length" value="<?php if(!empty($resCustomer['CustomerCity'])){echo $resCustomer['CustomerCity'];}?>">
                        </div>
                        <div class="text-center mt-3">
                            <button class="btn btn-style btn-primary" name="update">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php
        require_once './assets/pages/footer.php';
    ?>

    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/theme-change.js"></script>

    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/js/jquery-ui.js"></script>
    <script>
        //<![CDATA[ 
        $(window).load(function() {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 9000,
                values: [50, 6000],
                slide: function(event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });

        }); //]]>

    </script>
    
    <script>
        $(window).on("scroll", function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 80) {
                $("#site-header").addClass("nav-fixed");
            } else {
                $("#site-header").removeClass("nav-fixed");
            }
        });

        $(".navbar-toggler").on("click", function() {
            $("header").toggleClass("active");
        });
        $(document).on("ready", function() {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
            $(window).on("resize", function() {
                if ($(window).width() > 991) {
                    $("header").removeClass("active");
                }
            });
        });

    </script>
    
    <script>
        $(function() {
            $('.navbar-toggler').click(function() {
                $('body').toggleClass('noscroll');
            })
        });

    </script>
    
    <script src="assets/js/bootstrap.min.js"></script>

    <script>
        $(function() {
            $('.top_shopv_cart').click(function() {
                $('body').toggleClass('sbmincart-showing');
            })

            $('.sbmincart-closer').click(function() {
                $('body').toggleClass('sbmincart-showing');
            })
        });
    </script>
</body>

</html>