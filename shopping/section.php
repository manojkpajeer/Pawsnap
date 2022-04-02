<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    $pref = 'Dogs';
    $parentId = 1;
    if(!empty($_GET['pref'])){

        $pref = $_GET['pref'];
        
        if($pref == 'Cats'){

            $parentId = 2;
        }
    }

    $sql = "SELECT COUNT(product_master.PM_Id) AS total, category_master.CategoryName, category_master.CT_Id FROM product_master JOIN 
            category_master ON category_master.CT_Id = product_master.CategoryId WHERE category_master.Status = 1 
            AND product_master.Status = 1 AND category_master.ParentId = 1 GROUP BY category_master.CategoryName, category_master.CT_Id";
    
    if($pref == 'Cats') {

        $sql = "SELECT COUNT(product_master.PM_Id) AS total, category_master.CategoryName, category_master.CT_Id FROM product_master JOIN 
                category_master ON category_master.CT_Id = product_master.CategoryId WHERE category_master.Status = 1 
                AND product_master.Status = 1 AND category_master.ParentId = 2 GROUP BY category_master.CategoryName, category_master.CT_Id";
                
    }
    
?>

<section class="w3l-blog bloghny-page">
    <div class="blog py-5" id="Newsblog">
        <div class="container pb-lg-5 py-md-4 py-2">
            <div class="row">
                <div class="col-lg-8 bloghnypage-left">
                    <div class="row">
                        <div class="item">
                            <div class="card">
                                <div class="card-header p-0 position-relative">
                                    <a class="zoom d-block" href="<?php if($pref == 'Cats'){echo 'products.php?pref=Cats&source=18&sort=default&discount=0&page=1';}else{echo 'products.php?pref=Dogs&source=17&sort=default&discount=0&page=1';}?>">
                                        <img class="card-img-bottom d-block" src="<?php if($pref == 'Cats'){echo 'assets/images/banner_cat.jpeg';}else{echo 'assets/images/banner_dog.jpg';}?>" alt="blog-img">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item mt-3">
                            <section class="w3l-witemshny-main">
                                <div class="container">
                                    <?php
                                    $resData2 = mysqli_query($conn, "SELECT CategoryName, CT_Id, CategoryImage FROM category_master WHERE Status = 1 AND ParentId = '$parentId' LIMIT 4");
                                    if(mysqli_num_rows($resData2)>0){
                                    ?>
                                        <h3 class="title-w3l mt-5 pt-lg-4">Right Picks For You</h3>
                                        <div class="witemshny-grids row mt-lg-3">   
                                            <?php
                                                while($rowData2 = mysqli_fetch_assoc($resData2)){
                                                    ?>              
                                                    <div class="col-xl-3 col-md-4 col-6 product-incfhny mt-4">
                                                        <div class="weitemshny-grid oposition-relative">
                                                            <a href="products.php?pref=Personalised&source=<?php echo $rowData2['CT_Id']?>&sort=default&discount=0&page=1" class="d-block zoom"><img src="../billing/<?php echo $rowData2['CategoryImage'];?>" alt="" class="img-fluid news-image"></a>
                                                            <div class="witemshny-inf">
                                                            </div>
                                                        </div>
                                                        <h4 class="gdnhy-1 mt-4"><a class="text-center" href="products.php?pref=Personalised&source=<?php echo $rowData2['CT_Id']?>&sort=default&discount=0&page=1"><?php echo $rowData2['CategoryName'];?></a>
                                                        </h4>
                                                    </div>
                                                <?php
                                                }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    $resData3 = mysqli_query($conn, "SELECT brand_master.BR_Id, brand_master.BrandImage FROM brand_card JOIN brand_master ON brand_master.BR_Id = brand_card.BrandId WHERE brand_card.Status =1 AND brand_master.Status = 1 LIMIT 12");
                                    if(mysqli_num_rows($resData3)>0){
                                    ?>
                                        <h3 class="title-w3l mt-5 pt-lg-4">Deals on Brands</h3>
                                        <div class="witemshny-grids row mt-lg-3">
                                        <?php
                                            while($rowData3 = mysqli_fetch_assoc($resData3)){
                                                ?>  
                                                <div class="col-xl-2 col-md-4 col-6 product-incfhny mt-4">
                                                    <div class="weitemshny-grid oposition-relative">
                                                        <a href="brands.php?source=<?php echo $rowData3['BR_Id']?>&sort=default&discount=0&page=1" class="d-block zoom"><img src="../billing/<?php echo $rowData3['BrandImage'];?>" alt="" class="img-fluid news-image"></a>
                                                        <div class="witemshny-inf">
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 blog-w3hny-right ps-lg-5 mt-lg-0 mt-5">
                    <aside class="sidebar">
                    <?php 
                        $resPrCategory = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($resPrCategory)>0){
                            ?>  
                            <div class="sidebar-widget  mb-5">
                                <div class="sidebar-title mb-4">
                                    <h4>Categories</h4>
                                </div>
                                <ul class="blog-cat">
                                    <?php
                                        while($rowPrCategory = mysqli_fetch_assoc($resPrCategory)){
                                        ?>
                                        <li><a href="products.php?pref=<?php echo $pref;?>&source=<?php echo $rowPrCategory['CT_Id']; ?>&sort=defauls&discount=0&page=1"><span class="fas fa-angle-double-right"></span> <?php echo $rowPrCategory['CategoryName']?> <label><?php echo $rowPrCategory['total']?></label></a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                        <?php
                        }
                            $resRecent = mysqli_query($conn, "SELECT ProductName, PM_Id, Image, Price, Discount FROM product_master WHERE Status = 1 ORDER BY PM_Id DESC LIMIT 3");
                            if(mysqli_num_rows($resRecent)>0){
                        ?>

                        <div class="sidebar-widget popular-posts mb-5">
                            <div class="sidebar-title mb-4">
                                <h4>Recent Posts</h4>
                            </div>
                            <?php
                                while($rowRecent = mysqli_fetch_assoc($resRecent)){
                                ?>
                                <article class="post">
                                    <figure class="post-thumb"><img src="../billing/<?php echo $rowRecent['Image'];?>" class="radius-image img-fluid" alt="">
                                    </figure>
                                    <div class="text"><a href="product-detail.php?source=<?php echo $rowRecent['PM_Id']; ?>"><?php echo $rowRecent['ProductName'];?></a>
                                    </div>
                                    <div class="post-info text-danger mt-2"><i class='fa fa-rupee-sign'></i> <?php echo $rowRecent['Price']-($rowRecent['Price'] * ($rowRecent['Discount'] / 100));?></div>
                                </article>
                                <?php
                                }
                            ?>
                        </div>
                        <?php
                            }
                        ?>
                        
                        
                        <!-- <div class="sidebar-widget popular-tags mb-5">
                            <div class="sidebar-title mb-4">
                                <h4>Tags</h4>
                            </div>
                            <a href="#url">Sale</a>

                            <a href="#url">Fashion</a>
                            <a href="#url">Quality</a>
                            <a href="#url">Discount</a>

                            <a href="#url">Brands</a>
                            <a href="#url">Price</a>
                            <a href="#url">Quality</a>
                            <a href="#url">Marketing</a>

                        </div> -->
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