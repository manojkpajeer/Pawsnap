<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    $sql = "SELECT * FROM blog_master WHERE Status = 1 ORDER BY BL_Id DESC";

    $resCount = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($resCount);

    $page = '1';
    if(!empty($_GET['page'])){

        $page = $_GET['page'];
    }

    $maxPage = $page * 12;
    $minPage = $maxPage - 12;

    $sql = $sql . " LIMIT $minPage, $maxPage";
    ?>
    <div class="inner-banner py-4">
        <section class="w3l-breadcrumb text-left">
            <div class="container">
                <div class="w3breadcrumb-gids">
                    <div class="w3breadcrumb-left text-left">
                        <h2 class="inner-w3-title">Our Blog</h2>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <section class="w3l-blog bloghny-page">
        <div class="blog py-3" id="Newsblog">
            <div class="container py-lg-5 py-md-4 py-2">
            <?php 
                $resBlogData = mysqli_query($conn, $sql);
                if(mysqli_num_rows($resBlogData)>0){
                    ?>
                    <div class="row">
                        <?php
                        while($rowBlogData = mysqli_fetch_assoc($resBlogData)){
                            ?>
                                <div class="item col-lg-4 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header p-0 position-relative">
                                            <a href="blog-detail.php?source=<?php echo $rowBlogData['BL_Id'];?>" class="zoom d-block">
                                                <img class="card-img-bottom d-block" src="./admin/<?php echo $rowBlogData['Image'];?>" alt="blog-img">
                                            </a>
                                        </div>
                                        <div class="card-body blog-details">
                                            <div class="price-review d-flex justify-content-between mb-1 align-items-center">
                                                <p><?php echo $rowBlogData['Tag'];?></p>
                                            </div>
                                            <a href="blog-detail.php?source=<?php echo $rowBlogData['BL_Id'];?>" class="blog-desc"><?php echo $rowBlogData['Title'];?></a>
                                        </div>
                                        <div class="card-footer">
                                            <div class="author align-items-center">
                                                <ul class="blog-meta">
                                                    <li>
                                                        <span class="meta-value">by</span><a> <?php echo $rowBlogData['PostedBy'];?></a>
                                                    </li>
                                                </ul>
                                                <div class="date">
                                                    <p><?php echo date_format(date_create($rowBlogData['CreatedDate']), 'd M, Y');?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                        ?>
                        </div>
                        <div class="pagination-wrapper mt-5 pt-lg-3">
                            <ul class="page-pagination">
                                <li><a class="next" href="blog.php?page=<?php if($page>1){echo $page-1;}else{echo $page;}?>" <?php if($page<=1){echo "onclick='return false;' style='border: 1px solid #e4e6e5;color: #888;'";}else{echo "style='color: var(--primary-color);border: 1px solid var(--primary-color);'";}?>>Prev <span class="fa fa-angle-right"></span></a></li>
                                <li><a class="next" href="blog.php?page=<?php echo $page+1;?>" <?php if(($rowCount/(12*$page))<1){echo "onclick='return false;' style='border: 1px solid #e4e6e5;color: #888;'";}else{echo "style='color: var(--primary-color);border: 1px solid var(--primary-color);'";}?>>Next <span class="fa fa-angle-right"></span></a></li>
                            </ul>
                        </div>
                    <?php
                } else {
                    echo "<h5>No blog found..</h5>";
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