<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    if(!empty($_GET['source'])){

        $source = $_GET['source'];
    } else{
        echo "<script>alert('Oops, Unable to process..');location.href='blog.php';</script>";
    }

    $resPost = mysqli_query($conn, "SELECT * FROM blog_master WHERE BL_Id = '$source'");
    if(mysqli_num_rows($resPost)>0){
        $resPost = mysqli_fetch_assoc($resPost);
    }else{
        echo "<script>alert('Oops, Unable to process..');location.href='blog.php';</script>";
    }

    ?>    
    <section class="w3l-blog bloghny-page">
        <div class="blog pb-5" id="Newsblog">
            <div class="container py-lg-5 py-md-4 py-2">
                <div class="row">
                    <div class="col-lg-8 bloghnypage-left blog-single-post">
                        <div class="single-post-image mb-4">
                            <img src="./admin/<?php echo $resPost['Image'];?>" class="img-fluid w-100 radius-image" alt="blog-post-image">
                        </div>
                        <div class="blo-singl mb-3">
                            <div class="author align-items-center">
                                <ul class="blog-meta">
                                    <li>
                                        <span class="meta-value fas fa-user"></span><a href="#admin"> by <?php echo $resPost['PostedBy'];?></a>
                                    </li>
                                </ul>
                                <div class="date">
                                    <p><span class="far fa-clock"></span> <?php echo date_format(date_create($resPost['CreatedDate']), 'd M, Y');?></p>
                                </div>
                            </div>
                        </div>
                        <div class="single-post-content">
                            <h3 class="post-content-title mb-3">  <?php echo $resPost['Title'];?></h3>

                            <p class="mb-4"><?php echo $resPost['Description'];?></p>
                        </div>
                    </div>
                    <div class="col-lg-4 blog-w3hny-right ps-lg-5 mt-lg-0 mt-5">
                        <aside class="sidebar">
                            <div class="sidebar-widget popular-posts mb-5">
                                <?php
                                    $resRecentPost = mysqli_query($conn, "SELECT Image, Title, CreatedDate, BL_Id FROM blog_master WHERE Status = 1 AND NOT BL_Id = '$source' ORDER BY BL_Id DESC LIMIT 4");
                                    if(mysqli_num_rows($resRecentPost)>0){
                                        ?>
                                        <div class="sidebar-title mb-4">
                                            <h4>Recent Posts</h4>
                                        </div>
                                    <?php
                                        while($rowRecentPost = mysqli_fetch_assoc($resRecentPost)){
                                            ?>
                                            <article class="post">
                                                <figure class="post-thumb"><img src="./admin/<?php echo $rowRecentPost['Image'];?>" class="radius-image img-fluid" alt="">
                                                </figure>
                                                <div class="text"><a href="blog-detail.php?source=<?php echo $rowRecentPost['BL_Id'];?>"><?php echo substr($rowRecentPost['Title'], 0, 30) . "..";?></a>
                                                </div>
                                                <div class="post-info"><?php echo date_format(date_create($rowRecentPost['CreatedDate']), 'd M, Y');?></div>
                                            </article>
                                            <?php
                                        }
                                    }
                                ?>
                            </div>
                        </aside>
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