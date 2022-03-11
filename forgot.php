<?php
    
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\SMTP;
    // use PHPMailer\PHPMailer\Exception;

    // require './assets/vendor/autoload.php';

    // $mail = new PHPMailer(true);

    // session_start();
    
    // if(!empty($_SESSION['is_customer_login'])){
    //     echo "<script>location.href='index.php';</script>";
    // }
    
    // require_once './assets/config/connect.php';
    // require_once './assets/pages/header-link.php';
    // require_once './assets/pages/header.php';
    // require_once './assets/pages/cart.php';

    // if (isset($_POST['reset'])) {
    //     $email = $_POST['emailId'];

    //     $res = mysqli_query($conn, "SELECT login_master.UserPassword, customer_master.FirstName FROM login_master JOIN customer_master ON customer_master.CustomerEmail = login_master.UserEmail WHERE login_master.UserEmail = '$email' AND customer_master.CustomerStatus = 1");
    //     if (mysqli_num_rows($res)>0) {

    //         $row = mysqli_fetch_assoc($res); 
    //         $customerName = $row['FirstName'];

    //         try {                   
    //             $mail->isSMTP();                                           
    //             $mail->Host       = 'smtp.zoho.com';                    
    //             $mail->SMTPAuth   = true;                                  
    //             $mail->Username   = 'support@dxbtickets.com';                    
    //             $mail->Password   = 'Sujipri@28';                               
    //             $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
    //             $mail->Port       = 465;                                  
            
    //             $mail->setFrom('support@dxbtickets.com', "DXB Tickets");
    //             $mail->addAddress($email, $customerName);
                
    //             // $mail->addAttachment('mailer-image/image.jpg', 'recovery.jpg');
            
    //             $mail->IsHTML(true);
    //             $mail->Subject = "Password reset email - Pawsnap";
    //             $mail->Body = 'hi ' . $customerName . "<br>We received a request to reset the passowrd for your account.<br> Your password is <strong>" . $row['UserPassword'] . "</strong><br>We recomend that you keep your password safe and do not share with anyone. <br>Thank You<br><strong>Team Pawsnap</strong>";
            
    //             if ($mail->send()) {

    //                 showAlert('Yay, We sent an email to recover your password..');
    //             } else {

    //                 showAlert('Oops, Unable to process your request ..');
    //             }
    //         } catch (Exception $e) {

    //             showAlert("Oops, Unable to process your request..");  
    //         }
    //     }
    //     else{

    //         showAlert("Oops, Email does not exist on inactive..");  
    //     }
    // }
    
    function showAlert($msg){
        ?>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
                <div class="toast-header">
                    <i class="fa fa-paw text-danger"></i>
                    <strong class="me-auto ms-1">Pawsnap</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <h6 class="text-dark"><?php echo $msg; ?></h6>
                </div>
            </div>
        </div>
        <script>
            var toastLiveExample = document.getElementById('liveToast')
            $(document).ready(function() {
                var toast = new bootstrap.Toast(toastLiveExample)
                toast.show()
            });
        </script> 
        <?php
    }
?>

<section class="w3l-forml-main">
    <div class="form-hnyv-sec py-sm-5 py-3">
        <div class="form-wrapv py-5 border px-3">
            <h2>Reset your account</h2>
            <form action="#" method="post">
                <div class="form-sub-w3">
                    <input type="email" name="emailId" placeholder="Email ID " required="" />
                    <div class="icon-w3">
                        <span class="fas fa-envelope" aria-hidden="true"></span>
                    </div>
                </div>
                <div class="form-sub-w3">
                    <p class="forgot-w3ls text-start">Remember Password?<a class href="login.php"> Login</a></p>
                </div>
                <div class="submit-button text-center">
                    <button class="btn btn-style btn-primary" name="reset">Reset Now</button>
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