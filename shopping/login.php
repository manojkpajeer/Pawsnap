<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    if(!empty($_SESSION['is_customer_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    if (isset($_POST['login'])) {
        $password = md5($_POST['password']);
        $email = $_POST['email'];

        $res = mysqli_query($conn, "SELECT login_master.UserPassword, customer_master.CM_Id, customer_master.FullName FROM login_master JOIN customer_master ON customer_master.CustomerEmail = login_master.UserEmail WHERE login_master.UserEmail = '$email' AND customer_master.Status = 1 AND login_master.UserRole = 'Customer'");
        if (mysqli_num_rows($res)>0) {

            $row = mysqli_fetch_assoc($res);
            $ac_password = $row['UserPassword'];
            if ($password == $ac_password) {

                $_SESSION['user_id'] = $row['CM_Id'];
                $_SESSION['user_name'] = $row['FullName'];
                $_SESSION['user_role'] = 'Customer';
                $_SESSION['user_email'] = $email;
                $_SESSION['is_customer_login'] = true;

                echo "<script>location.href='index.php';</script>";
            }
            else{
                ?>
                <div class="container">
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" id="success-alert">
                        <strong>Oops,</strong> An invalid password you entered.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php   
            }            
        }
        else{  
            ?>
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" id="success-alert">
                    <strong>Oops,</strong> An email does not exist, Kindly enter valid email id.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php     
        }
    }
    
    ?>
   <section class="w3l-forml-main py-3">
        <div class="form-hnyv-sec py-sm-5 py-3">
            <div class="form-wrapv">
                <h2>Login to your account</h2>
                <form method="post">
                    <div class="form-sub-w3">
                        <input type="email" name="email" placeholder="Email Id " required="" />
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
                    <div class="form-sub-content">
                        <p class="forgot-w3ls">Lost Password?<a class href="forgot.php"> Reset</a></p>
                    </div>
                    <div class="submit-button text-center">
                        <button class="btn btn-style btn-primary" name="login">Login Now</button>
                    </div>
                    <div class="submit-button mt-3 text-center">
                        <p class="forgot-w3ls1">Don't have an account? <a class href="register.php">Signup</a></p>
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