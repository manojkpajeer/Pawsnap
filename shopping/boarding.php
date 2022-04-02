<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

?>    
    
    <div class="w3l-3-grids" id="about-1">
        <div class="container py-md-5 py-2 pb-0">
            <!--/row-1-->
            <div class="w3abin-top text-center">
                <div class="title-content">
                    <h6 class="title-subw3hny mb-1">Boarding</h6>
                    <h3 class="title-w3l">The Best Boarding Service</h3>
                </div>
                <p class="mt-3">Lorem ipsum viverra feugiat. Pellen tesque libero ut justo,
                    ultrices in ligula. Semper at tempufddfel. Lorem ipsum dolor sit amet
                    elit ipsum dolor.Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
    </div>
    
    <section id="counts" class="w3lcounts pb-5">
        <div class="container pb-md-5 pb-3">
            <div class="row">
                <div class="col-lg-3 col-md-6 w3stats_info counter_grid">
                    <div class="count-box">
                        <i class="fas fa-users"></i>
                        <p class="counter">200+</p>
                        <p>Happy Clients</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-md-0 w3stats_info counter_grid">
                    <div class="count-box">
                        <i class="far fa-images"></i>
                        <p class="counter">20+</p>
                        <p>Boarding Slots</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0 w3stats_info counter_grid">
                    <div class="count-box">
                        <i class="fas fa-headset"></i>
                        <p class="counter">24/7</p>
                        <p>Hours Of Support</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0 w3stats_info counter_grid">
                    <div class="count-box">
                        <i class="fas fa-user-tie"></i>
                        <p class="counter">10+</p>
                        <p>Hard Workers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="w3l-index5 py-5">
        <div class="container py-md-3">
            <div class="w3l-project-in">
                <div class="bottom-info">
                    <div class="header-section title-content-two pe-lg-5">
                        <h6 class="title-subw3hny mb-1">Our Special Offer</h6>
                        <h3 class="title-w3l two mb-4">Get Up To 50% Off <br>Enjoy The Season Sale
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="boarding" class=" w3l-3-grids py-5">
        <div class="container py-md-5">
            <div class="title-content text-center">
                <h6 class="title-subw3hny mb-1">Get Started</h6>
                <h3 class="title-w3l mb-5">Ready to get started?</h3>
            </div>
            <div class="row">
            <div class="col-md-6 mt-md-0">
                    <div class="grids3-info position-relative">
                        <a href="book-boarding.php" class="d-block zoom"><img src="assets/images/book-image.jpg" alt="" class="img-fluid news-image"></a>
                        <div class="w3-grids3-info">
                            <h4 class="gdnhy-1"><a href="book-boarding.php">Book A Slot For Your<br>Pet</a>
                                <a class="w3item-link btn btn-style mt-4" href="book-boarding.php">
                                    Book Now <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-md-0 mt-4 grids3-info2">
                    <div class="grids3-info second position-relative">
                        <a href="view-boarding.php" class="d-block zoom"><img src="assets/images/pet-status.jpg" alt="" class="img-fluid news-image"></a>
                        <div class="w3-grids3-info second">
                            <h4 class="gdnhy-1"><a href="view-boarding.php">View Your Booking <br>Status</a>
                                <a class="w3item-link btn btn-style mt-4" href="view-boarding.php">
                                    View <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </h4>

                        </div>
                    </div>
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