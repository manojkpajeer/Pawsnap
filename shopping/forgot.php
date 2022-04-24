<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../assets/vendor/autoload.php';

    $mail = new PHPMailer(true);

    if(isset($_POST['reset'])){
        $email_id = $_POST['email'];
        $key = md5($email_id);

        $res = mysqli_query($conn, "SELECT login_master.UserPassword, customer_master.FullName  FROM login_master JOIN customer_master ON customer_master.CustomerEmail = login_master.UserEmail WHERE login_master.UserEmail = '$email_id' AND customer_master.Status = 1");
        if (mysqli_num_rows($res)>0) {

            $row = mysqli_fetch_assoc($res); 
            $userName = $row['FullName'];
            $source = $row['UserPassword'];
            $app_name = "Paws Fur And Tail";
            $subject = "Password reset confirmation - " . $app_name;
            $link = "http://pawsnap.test/shopping/reset.php?source=".$source."&pref=".$key;
            $bodyMessage="Hi " . $userName . ",<br>There was recently a request to reset the password on your account.Please click the link below to set a new password:<br><a href='".$link."'>Click here</a> to reset your password.<br>If you don't want to reset your password, just ignore this message.<br><br>Thank you<br>The ".$app_name." Team";

            try {                   
                $mail->isSMTP();                                           
                $mail->Host       = 'smtp.gmail.com';                    
                $mail->SMTPAuth   = true;                                  
                $mail->Username   = 'project.head1994@gmail.com';                    
                $mail->Password   = 'MAnoj143@@';                               
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
                $mail->Port       = 465;                                  
            
                $mail->setFrom('project.head1994@gmail.com', $app_name);
                $mail->addAddress($email_id, $userName);
            
                $mail->IsHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $bodyMessage;
            
                if ($mail->send()) {
                    echo "<script type='text/javascript'>toastr.success('We have sent an email to recover your password, Kindly check your email.', 'Success!', {positionClass:'toast-bottom-right', closeButton:true})</script>";
                } else {
                    echo "<script type='text/javascript'>toastr.error('Unable to process your request, Kindly try after sometimes.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>";
                }
            } catch (Exception $e) {
                echo "<script type='text/javascript'>toastr.error('Unable to process your request, Kindly try after sometimes.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>";
            }
        }else{
            echo "<script type='text/javascript'>toastr.error('An email does not exist, Kindly enter valid email id.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>";
        }
    }
    
    ?>
   <section class="w3l-forml-main py-3">
        <div class="form-hnyv-sec py-sm-5 py-3">
            <div class="form-wrapv">
                <h2>Reset your account</h2>
                <form method="post">
                    <div class="form-sub-w3">
                        <input type="email" name="email" placeholder="Email Id " required="" />
                        <div class="icon-w3">
                            <span class="fas fa-envelope" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="submit-button text-center">
                        <button class="btn btn-style btn-primary" name="reset">Reset Now</button>
                    </div>
                    <div class="submit-button mt-3 text-center">
                        <p class="forgot-w3ls">Remember Your Password?<a class href="login.php"> Signin</a></p>
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