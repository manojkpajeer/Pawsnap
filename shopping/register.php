<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    if(!empty($_SESSION['is_customer_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    if (isset($_POST['register'])) {
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $name = $_POST['name'];

        $res = mysqli_query($conn, "SELECT CM_Id FROM customer_master WHERE CustomerEmail = '$email' AND Status = 1");
        if (mysqli_num_rows($res)>0) {
            echo "<script type='text/javascript'>toastr.error('An Email Id already in use, Kindly choose different email id.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>";      
        }
        else{

            if(mysqli_query($conn, "INSERT INTO customer_master(FullName, CustomerEmail, CustomerPhone, Status, DateCreate) 
                VALUES ('$name', '$email', '$phone', 1,  NOW())")){

                $password = md5($_POST['password']);

                if (mysqli_query($conn, "INSERT INTO login_master (UserEmail, UserPassword, UserRole) VALUES ('$email', '$password', 'Customer')")) {
                    echo "<script type='text/javascript'>toastr.success('You have registered successfully.', 'Success!', {positionClass:'toast-bottom-right', closeButton:true, onclick: function() {location.href='login.php'}})</script>"; 

                } else {
                    echo "<script type='text/javascript'>toastr.error('Unable to process your request, Kindly try after sometimes.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>";      
                }    
            }
            else{
                echo "<script type='text/javascript'>toastr.error('Unable to process your request, Kindly try after sometimes.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>";      
            }
        }     
    }
    
    ?>
   <section class="w3l-forml-main">
        <div class="form-hnyv-sec py-sm-5 py-3">
            <div class="form-wrapv">
                <h2>Register your account</h2>
                <form method="post">
                    <div class="form-sub-w3">
                        <input type="text" name="name" placeholder="Full Name " required="" />
                        <div class="icon-w3">
                            <span class="fas fa-user" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-sub-w3">
                        <input type="email" name="email" placeholder="Email Id " required="" />
                        <div class="icon-w3">
                            <span class="fas fa-envelope" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-sub-w3">
                        <input type="text" name="phone" placeholder="Phone No " required="" pattern="[0-9]{6,13}" title="Only numbers are accepted and it should be 6 to 13 digits in length" maxlength="13"/>
                        <div class="icon-w3">
                            <span class="fas fa-phone" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-sub-w3">
                        <input type="password" name="password" placeholder="Password" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number, one uppercase letter, one lowercase letter and 6 or more characters" maxlength="25"/>
                        <div class="icon-w3">
                            <span class="fas fa-unlock-alt" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="submit-button text-center">
                        <button class="btn btn-style btn-primary" name="register">Register Now</button>
                    </div>
                    <div class="submit-button mt-3 text-center">
                        <p class="forgot-w3ls1">Already have an account? <a class href="login.php">Signin</a></p>
                    </div>
                </form>
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