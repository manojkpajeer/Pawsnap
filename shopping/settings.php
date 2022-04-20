<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    $user_email = $_SESSION['user_email'];

    if(empty($user_email)){

        echo "<script>alert('Oops, Unable to process..');location.href='../login.php';</script>";
   }

    if(isset($_POST['update'])){

        $current_password = $_POST['opass'];
        $new_password = $_POST['npass'];
        $confirm_password = $_POST['cpass'];

        if($new_password == $confirm_password){

            $resPassword = mysqli_query($conn, "SELECT UserPassword FROM login_master WHERE UserEmail = '$user_email' AND UserRole = 'Customer'");

            if (mysqli_num_rows($resPassword) > 0) {

                $resPassword = mysqli_fetch_assoc($resPassword);

                if (md5($current_password) == $resPassword['UserPassword']) {

                    $ac_password = md5($new_password);
                    if (mysqli_query($conn, "UPDATE login_master SET UserPassword = '$ac_password' WHERE UserEmail = '$_SESSION[user_email]' AND UserRole = 'Customer'")) {

                        ?>
                        <div class="container">
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" id="success-alert">
                                <strong>Yay,</strong> Your password updated successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    <?php
                    } else {
                        ?>
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" id="success-alert">
                                <strong>Oops,</strong> Unable to update your password, kindly try after sometimes.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="container">
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" id="success-alert">
                            <strong>Oops,</strong> An invalid current password, Kindly enter valid password.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="container">
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" id="success-alert">
                        <strong>Oops,</strong> Unable to process your request, kindly try after sometimes.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php
            }
        }else{
            ?>
                <div class="container">
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" id="success-alert">
                        <strong>Oops,</strong> The password confirmation does not match.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php
        }
    }
    
    ?>
    
    <section class="w3l-contact-2" id="contact">
        <div class="container py-lg-4 py-md-3 py-2">
            <div class="title-content text-center">
                <h6 class="title-subw3hny mb-1">Settings</h6>
                <h3 class="title-w3l mb-5">Change Password</h3>
            </div>

            <div class="contact-grids">
                <div class="contact-right my-lg-5">
                    <form method="post" class="signin-form row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <label class="form-lable">Current Password*:</label>
                            <input type="password" name="opass" class="contact-input" required>
                            <label class="form-lable">New Password*:</label>
                            <input type="password" name="npass" class="contact-input" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" maxlength="25">
                            <small class="text-danger">[At least one number, one uppercase, one lowercase letter and 6 or more characters]</small>
                            <br>
                            <label class="form-lable mt-3">Confirm Password*:</label>
                            <input type="password" name="cpass" class="contact-input" required>
                            <div class="text-center mt-4">
                                <button class="btn btn-style btn-primary" name="update">UPDATE</button>
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
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