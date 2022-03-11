<?php

    session_start();
    
    if(!empty($_SESSION['is_customer_login'])){
        echo "<script>location.href='index.php';</script>";
    }
    
    require_once './assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    if(isset($_POST['submit'])){
        
        $resreg = mysqli_query($conn, "SELECT CM_Id FROM customer_master WHERE CustomerEmail = '$_POST[email]' AND CustomerStatus = 1");
        if (mysqli_num_rows($resreg)>0) {

            echo "<script>alert('Oops, Email ID already in use..');</script>";
        } else {

            if (mysqli_query($conn, "INSERT INTO customer_master (FirstName, CustomerEmail, CustomerStatus, DateCreate) VALUES ('$_POST[name]', '$_POST[email]',  1, NOW())")) {

                if (mysqli_query($conn, "INSERT INTO login_master (UserEmail, UserPassword, UserRole) VALUES ('$_POST[email]', '$_POST[password]', 'Customer')")) {
                    
                    echo "<script>alert('Yay, You have registered successfully..');location.href='login.php';</script>";
                } else {
                    
                    echo "<script>alert('Oops, Unable to process..');</script>";
                }
            } else {

                echo "<script>alert('Oops, Unable to process..');</script>";
            }
        }
    }
    
?>

<section class="w3l-forml-main">
    <div class="form-hnyv-sec py-sm-5 py-3">
        <div class="form-wrapv py-5 border px-3">
            <h2>Register to your account</h2>
            <form action="#" method="post">
                <div class="form-sub-w3">
                    <input type="text" name="name" placeholder="Your Name" required="" />
                    <div class="icon-w3">
                        <span class="fas fa-user" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-sub-w3">
                    <input type="email" name="email" placeholder="Email ID " required="" />
                    <div class="icon-w3">
                        <span class="fas fa-envelope" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-sub-w3">
                    <input type="password" name="password" placeholder="Password" required="" />
                    <div class="icon-w3">
                        <span class="fas fa-unlock-alt" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-sub-w3">
                    <p class="forgot-w3ls text-start">Existing User?<a class href="login.php"> Login</a></p>
                </div>
                <div class="submit-button text-center">
                    <button class="btn btn-style btn-primary" name="submit">Register Now</button>
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