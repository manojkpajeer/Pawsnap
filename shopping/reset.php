<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    if(isset($_POST['reset'])){
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if($password == $confirm_password){
            $new_password = md5($password);
            if(mysqli_query($conn, "UPDATE login_master SET UserPassword = '$new_password' WHERE LM_Id = '$resData[LM_Id]'")){
                echo "<script type='text/javascript'>toastr.success('Your password updated successfully.', 'Success!', {positionClass:'toast-bottom-right', closeButton:true, onclick: function() {location.href='login.php'}})</script>"; 
            }else{
                echo "<script type='text/javascript'>toastr.error('Unable to reset your password.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>";
            }

        }else{
            echo "<script type='text/javascript'>toastr.error('The password confirmation does not match.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>";
        }
        
    }
    
    ?>
   <section class="w3l-forml-main py-3">
        <div class="form-hnyv-sec py-sm-5 py-3">
            <div class="form-wrapv">
                <?php
                    if(empty($_GET['source']) || empty($_GET['pref'])){
                        echo "<h2>Sorry, An invalid link.</h2>";
                    }else{

                        $source = $_GET['source'];
                        $pref = $_GET['pref'];
                        $resData = mysqli_query($conn, "SELECT LM_Id FROM login_master WHERE md5(UserEmail) = '$pref' AND UserPassword = '$source' AND UserRole = 'Customer'");
                        if(mysqli_num_rows($resData)>0){
                            $resData = mysqli_fetch_assoc($resData);

                            ?>
                            <h2>Reset your account</h2>
                            <form method="post">
                                <div class="form-sub-w3">
                                    <input type="password" name="password" placeholder="New Password" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number, one uppercase letter, one lowercase letter and 6 or more characters" maxlength="25"/>
                                    <div class="icon-w3">
                                        <span class="fas fa-unlock-alt" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <small class="text-danger">[At least one number, one uppercase, one lowercase letter and 6 or more characters]</small>
                                <div class="form-sub-w3 mt-3">
                                    <input type="password" name="confirm_password" placeholder="Confirm Password" required="" maxlength="25"/>
                                    <div class="icon-w3">
                                        <span class="fas fa-unlock-alt" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="submit-button text-center">
                                    <button class="btn btn-style btn-primary" name="reset">Reset Now</button>
                                </div>
                                <div class="submit-button mt-3 text-center">
                                    <p class="forgot-w3ls">Back to<a class href="login.php"> Signin</a></p>
                                </div>
                            </form>
                            <?php
                        }else{
                            echo "<h2>Sorry, Unable to process your request.</h2>";
                        }
                    }
                ?>
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