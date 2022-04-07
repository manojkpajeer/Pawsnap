<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    if(empty($_SESSION['is_customer_login'])){

        echo "<script>alert('Oops, Kindly login to proceed..');location.href='boarding.php#boarding';</script>";
    }

    $customerId = $_SESSION['user_id'];

    $sql = "SELECT * FROM boarding_master WHERE UserId = '$customerId' ORDER BY BM_Id DESC";

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
<section class="w3l-blog bloghny-page">
    <div class="blog py-3" id="Newsblog">
        <div class="container pb-lg-5 py-md-4 py-2">
            <h3 class="title-w3l mb-4">Your Boarding Requests.</h3>
        <?php 
            $resBlogData = mysqli_query($conn, $sql);
            if(mysqli_num_rows($resBlogData)>0){
                ?>
                <div class="row">
                    <?php
                    while($rowBlogData = mysqli_fetch_assoc($resBlogData)){
                        ?>
                            <div class="item col-lg-3 mb-4">
                                <div class="card h-100">
                                    <div class="card-body blog-details pb-3">
                                        <div class="price-review d-flex justify-content-between mb-1 align-items-center">
                                            <p><?php echo date_format(date_create($rowBlogData['DateCreated']), 'd, M Y');?></p>
                                        </div>
                                        Pet Name:  <?php echo $rowBlogData['PetName'];?> <br>
                                        Boarding Date:  <?php echo date_format(date_create($rowBlogData['BoardingDate']), 'd, M Y');?> <br>
                                        Status: <?php echo $rowBlogData['BoardingStatus'];?><br>
                                        <small class="">Remarks: <?php echo $rowBlogData['BoardingRemarks'];?></small>
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                    ?>
                    </div>
                    <div class="pagination-wrapper mt-5 pt-lg-3">
                        <ul class="page-pagination">
                            <li><a class="next" href="view-boarding.php?page=<?php if($page>1){echo $page-1;}else{echo $page;}?>" <?php if($page<=1){echo "onclick='return false;' style='border: 1px solid #e4e6e5;color: #888;'";}else{echo "style='color: var(--primary-color);border: 1px solid var(--primary-color);'";}?>>Prev <span class="fa fa-angle-right"></span></a></li>
                            <li><a class="next" href="view-boarding.php?page=<?php echo $page+1;?>" <?php if(($rowCount/(12*$page))<1){echo "onclick='return false;' style='border: 1px solid #e4e6e5;color: #888;'";}else{echo "style='color: var(--primary-color);border: 1px solid var(--primary-color);'";}?>>Next <span class="fa fa-angle-right"></span></a></li>
                        </ul>
                    </div>
                <?php
            } else {
                echo "<h5>No booking found..</h5>";
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