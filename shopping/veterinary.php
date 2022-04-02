<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

?>    
    
    <section class="w3l-subscription-infhny">
        <div class="container py-md-5">
            <div class="subscription-info text-center mx-auto">
                <h3 class="title-w3l mb-2">Discover the best veterinary</h3>
                <form action="#" method="post" class="w3l-signin-form mt-4 mb-3">
                    <div class="form-input">
                        <input type="text" name="" placeholder="Enter Your Location Here" required="" style="background: url(assets/images/location.png) no-repeat scroll 5px 18px; padding-left:30px;">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="w3lteam pb-5">
        <div class="container">
            <h6 class="title-subw3hny mb-3">Our Popular Veterinary</h6>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="member">
                        <div class="pic"><img src="assets/images/groomings.jpg" class="img-fluid radius-image" alt=""></div>
                        <div class="member-info">
                            <h4>Little Paws Veterinary Clinic</h4>
                            <span><strong>Address:</strong> Charles Pinto Compound, Behind Karnataka Bank, Kulashekara, Mangaluru, Karnataka 575005</span>
                            <span><strong>Phone:</strong> 098445 48311</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="member">
                        <div class="pic"><img src="assets/images/checkup.jpg" class="img-fluid radius-image" alt=""></div>
                        <div class="member-info">
                            <h4>Dr P Manohar Upadhya</h4>
                            <span><strong>Address:</strong> 1-22/7/1, Maroli, near Sooryanarayana Temple, Mangaluru, Karnataka 575005</span>
                            <span><strong>Phone:</strong> 093 4334 5603</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="member">
                        <div class="pic"><img src="assets/images/styling.jpg" class="img-fluid radius-image" alt=""></div>
                        <div class="member-info">
                            <h4>Premchaya city veterinary unit</h4>
                            <span><strong>Address:</strong> OPP to marigudi temple, Ashok Nagar Rd, Urwa Market, Mangaluru, Karnataka 575006</span>
                            <span><strong>Phone:</strong> 092 4330 6956</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-style btn-outline-primary">View More</button>
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