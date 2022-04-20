<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    if(isset($_POST['submit'])){
        if(mysqli_query($conn, "INSERT INTO contact_master (CustomerName, CustomerEmail, Subject, Message, Status, DateCreate, CustomerPhone) VALUES ('$_POST[name]', '$_POST[email]', '$_POST[subject]', '$_POST[message]', 1, NOW(), '$_POST[phone]')")){
            ?>
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" id="success-alert">
                    <strong>Yay,</strong> Your query submitted successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php
        }else{
            ?>
            <div class="container">
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" id="success-alert">
                    <strong>Oops,</strong> Unable to submit your query, Kindly try after sometimes.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php
        }
    }
    
?>

<section class="w3l-contact-2 pt-3 pb-5" id="contact">
    <div class="container py-lg-4 py-md-3">
        <div class="title-content text-center">
            <h6 class="title-subw3hny mb-1">Get in touch</h6>
            <h3 class="title-w3l mb-5">Contact with our support!</h3>
        </div>

        <div class="contact-grids mt-5 pt-lg-3">
            <div class="contact-left">
                <div class="row cont-details">
                    <div class="col-lg-4 col-md-6 cont-top margin-up">
                        <div class="cont-left text-center">
                            <span class="fas fa-map-marker-alt"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Office Address:</h6>
                            <p>Sai Harsha Square building, Old Post Office Rd, Thenkpete, Maruthi Veethika, Udupi, Karnataka 576101</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 cont-top margin-up ps-lg-5">
                        <div class="cont-left text-center">
                            <span class="fas fa-phone-alt"></span>
                        </div>
                        <div class="cont-right">
                            <h6>Call for help :</h6>
                            <p><a href="tel:8197639736">+91 819 763 9736</a></p>
                            <p><a href="tel:8542152222">+91 854 215 2222</a></p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 cont-top margin-up">
                        <div class="cont-left text-center">
                            <span class="far fa-envelope"></span>
                        </div>
                        <div class="cont-right">
                            <h6>
                                Mail us:</h6>
                            <p><a href="mailto:support@mail.com" class="mail">support@mail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-right mt-lg-4">
                <form method="post" class="signin-form">
                    <div class="input-grids">
                        <input type="text" name="name" placeholder="Your Name*" class="contact-input" required="">
                        <input type="email" name="email" placeholder="Your Email Id*" class="contact-input" required="">
                        <input type="text" name="phone" placeholder="Your Phone No*" required="" pattern="[0-9]{6,13}" title="Only numbers are accepted and it should be 6 to 13 digits in length" maxlength="13">
                        <input type="text" name="subject" placeholder="Subject*" class="contact-input" required="" >
                    </div>
                    <div class="form-input">
                        <textarea name="message" placeholder="Type your message here*" required=""></textarea>
                    </div>
                    <div class="submit-w3l-button text-lg-right">
                        <button class="btn btn-style btn-primary" name="submit">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="map-iframe mt-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3882.1965280206855!2d74.7492489142672!3d13.338047810341452!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbcbb4a566f089f%3A0xcb4ae33a68391411!2spaws%20and%20fur!5e0!3m2!1sen!2sin!4v1646038809784!5m2!1sen!2sin" width="100%" height="400" frameborder="0" style="border: 0px;" allowfullscreen=""></iframe>
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
            $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

        }); //]]>

    </script>

    <script src="assets/js/jquery.flexslider.js"></script>

    <script src="assets/js/imagezoom.js"></script>

    <script>
        
        $(window).load(function() {
            $('.flexslider1').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
        });

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