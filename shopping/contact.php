<?php

    session_start();

    if(empty($_SESSION['is_customer_login'])){
        
        echo "<script>alert('Oops, Kindly login to proceed..');location.href='../login.php';</script>";
    }

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    $orderId = '';
    if(!empty($_GET['source'])){

        $orderId = $_GET['source'];
    }

    $sql = "SELECT * FROM ecom_sales WHERE OrderId = '$orderId'";
    
?>

<style>
    .card {
        margin: auto;
        width: 100%;
        max-width: 850px;
        padding: 4vh 0;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-top: 3px solid rgb(252, 103, 49);
        border-left: none;
        border-right: none
    }

    @media(max-width:768px) {
        .card {
            width: 90%
        }
    }

    .title {
        color: rgb(252, 103, 49);
        font-weight: 600;
        margin-bottom: 2vh;
        padding: 0 8%;
        font-size: initial
    }

    #details {
        font-weight: 400
    }

    .info {
        padding: 1% 8% 0% 8%
    }

    .info .col-5 {
        padding: 0
    }

    #heading {
        color: grey;
        line-height: 6vh
    }

    .pricing {
        background-color: #ddd3;
        padding:  0% 8% 0% 8%;
        font-weight: 400;
        line-height: 2.5
    }

    .pricing .col-3 {
        padding: 0
    }

    .total {
        padding: 2vh 8%;
        color: rgb(252, 103, 49);
        font-weight: bold
    }

    .total .col-3 {
        padding: 0
    }

    .footer {
        padding: 0 8%;
        font-size: x-small;
        color: black
    }

    .footer img {
        height: 5vh;
        opacity: 0.2
    }

    .footer a {
        color: rgb(252, 103, 49)
    }

    .footer .col-10,
    .col-2 {
        display: flex;
        padding: 3vh 0 0;
        align-items: center
    }

    .footer .row {
        margin: 0
    }

    #progressbar {
        margin-bottom: 3vh;
        overflow: hidden;
        color: rgb(252, 103, 49);
        padding-left: 0px;
        margin-top: 3vh
    }

    #progressbar li {
        list-style-type: none;
        font-size: x-small;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400;
        color: rgb(160, 159, 159)
    }

    #progressbar #step1:before {
        content: "";
        color: rgb(252, 103, 49);
        width: 5px;
        height: 5px;
        margin-left: 0px !important
    }

    #progressbar #step2:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-left: 32%
    }

    #progressbar #step3:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-right: 32%
    }

    #progressbar #step4:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-right: 0px !important
    }

    #progressbar li:before {
        line-height: 29px;
        display: block;
        font-size: 12px;
        background: #ddd;
        border-radius: 50%;
        margin: auto;
        z-index: -1;
        margin-bottom: 1vh
    }

    #progressbar li:after {
        content: '';
        height: 2px;
        background: #ddd;
        position: absolute;
        left: 0%;
        right: 0%;
        margin-bottom: 2vh;
        top: 1px;
        z-index: 1
    }

    .progress-track {
        padding: 0 8%
    }

    #progressbar li:nth-child(2):after {
        margin-right: auto
    }

    #progressbar li:nth-child(1):after {
        margin: auto
    }

    #progressbar li:nth-child(3):after {
        float: left;
        width: 68%
    }

    #progressbar li:nth-child(4):after {
        margin-left: auto;
        width: 132%
    }

    #progressbar li.active {
        color: black
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: rgb(252, 103, 49)
    }
</style>

<section class="w3l-contact-2 py-5" id="contact">
    <div class="container py-lg-4 py-md-3 py-2">
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
                            <p><a href="">+91 819 763 9736</a></p>
                            <p><a href="">+91 854 215 2222</a></p>
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
                            <p><a href="mailto:contact@mail.com" class="mail">contact@mail.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-right mt-lg-4">
                <form action="https://sendmail.w3layouts.com/submitForm" method="post" class="signin-form">
                    <div class="input-grids">
                        <input type="text" name="w3lName" id="w3lName" placeholder="Your Name*" class="contact-input" required="">
                        <input type="email" name="w3lSender" id="w3lSender" placeholder="Your Email*" class="contact-input" required="">
                        <input type="text" name="w3lPhone" id="w3lPhone" placeholder="Enter your Phone Number *" required="">
                        <input type="text" name="w3lSubect" id="w3lSubect" placeholder="Subject*" class="contact-input" required="">
                    </div>
                    <div class="form-input">
                        <textarea name="w3lMessage" id="w3lMessage" placeholder="Type your message here*" required=""></textarea>
                    </div>
                    <div class="submit-w3l-button text-lg-right">
                        <button class="btn btn-style btn-primary">Send Message</button>
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