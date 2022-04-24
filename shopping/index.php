<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/slider.php';

    if(isset($_POST['add_to_cart'])) {
        
        $pid = $_POST['pid'];
        $pname = $_POST['pname'];
        $pprice = $_POST['pprice'];
        $pimage = $_POST['pimage'];
        $message = $_POST['message'];

        $itemArray = array(
            $pid => array(
                'prodictId' => $pid, 
                'productName' => $pname, 
                'productQuantity' => 1, 
                'productPrice' => $pprice,
                'productImage' => $pimage,
                'productMessage' => $message
            )
        );
        

        if (empty($_SESSION["cart_item"])) {
            
            $_SESSION["cart_item"] = $itemArray;
            echo "<script type='text/javascript'>toastr.success('Product added to cart.', 'Success!', {positionClass:'toast-bottom-right', closeButton:true, onclick: function() {location.href='checkout.php'}})</script>"; 
        } else {
            
            if (in_array($pid, array_keys($_SESSION["cart_item"]))) {
                
                foreach($_SESSION["cart_item"] as $k => $v) {

                    if($pid == $k) {
                        if(empty($_SESSION["cart_item"][$k]["productQuantity"])) {
                            $_SESSION["cart_item"][$k]["productQuantity"] = 0;
                        }
                        $_SESSION["cart_item"][$k]["productQuantity"] += 1;

                        echo "<script type='text/javascript'>toastr.success('Product added to cart.', 'Success!', {positionClass:'toast-bottom-right', closeButton:true, onclick: function() {location.href='checkout.php'}})</script>"; 

                    }
                }
            } else {
                
                $_SESSION["cart_item"] += $itemArray;
                
                echo "<script type='text/javascript'>toastr.success('Product added to cart.', 'Success!', {positionClass:'toast-bottom-right', closeButton:true, onclick: function() {location.href='checkout.php'}})</script>"; 

            }
        }
    }
    
    require_once './assets/pages/cart.php';

    ?>
    <section class="w3free-ship text-center py-md-5 py-4">
        <h2>Walk a mile with your pet <i class="fas fa-dog ms-lg-3"></i></h2>
    </section>
    
    <div class=" w3l-3-grids py-5" id="grids-3">
        <div class="container py-md-4">
            <div class="row">
                <div class="col-md-6 mt-md-0">
                    <div class="grids3-info position-relative">
                        <a href="section.php?pref=Dogs" class="d-block zoom"><img src="assets/images/dog-food.jpg" alt="" class="img-fluid news-image"></a>
                        <div class="w3-grids3-info">
                            <h4 class="gdnhy-1"><a href="section.php?pref=Dogs">Best in <br>Dogs</a>
                                <a class="w3item-link btn btn-style mt-4" href="section.php?pref=Dogs">
                                    Shop Now <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-md-0 mt-4 grids3-info2">
                    <div class="grids3-info second position-relative">
                        <a href="section.php?pref=Cats" class="d-block zoom"><img src="assets/images/cat-food.jpeg" alt="" class="img-fluid news-image"></a>
                        <div class="w3-grids3-info second">
                            <h4 class="gdnhy-1"><a href="section.php?pref=Cats">Best in <br>Cats</a>
                                <a class="w3item-link btn btn-style mt-4" href="section.php?pref=Cats">
                                    Shop Now <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="w3l-witemshny-main py-5">
        <div class="container py-md-4">
            <?php
            $resData = mysqli_query($conn, "SELECT category_master.CategoryName, category_master.CT_Id, category_master.CategoryImage FROM category_card JOIN category_master ON category_master.CT_Id = category_card.CategoryId WHERE category_card.Status = 1 AND category_master.Status = 1 LIMIT 6");
            if(mysqli_num_rows($resData)>0){
            ?>
                    <h3 class="title-w3l">Deals Of The Day</h3>
                    <div class="witemshny-grids row mt-lg-3">
                        <?php
                            while($rowData = mysqli_fetch_assoc($resData)) {
                                ?>
                                <div class="col-xl-2 col-md-4 col-6 product-incfhny mt-4">
                                    <div class="weitemshny-grid oposition-relative">
                                        <a href="products.php?pref=Category&source=<?php echo $rowData['CT_Id']?>&sort=default&discount=0&page=1" class="d-block zoom"><img src="../billing/<?php echo $rowData['CategoryImage']?>" alt="" class="img-fluid news-image"></a>
                                        <div class="witemshny-inf">
                                        </div>
                                    </div>
                                    <h4 class="gdnhy-1 mt-4"><a class="text-center" href="products.php?pref=Category&source=<?php echo $rowData['CT_Id']?>&sort=default&discount=0&page=1"><?php echo $rowData['CategoryName']?></a>
                                    </h4>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
            <?php
            }

            $resData2 = mysqli_query($conn, "SELECT category_master.CategoryName, category_master.CT_Id, category_master.CategoryImage FROM personalise_card JOIN category_master ON category_master.CT_Id = personalise_card.CategoryId WHERE personalise_card.Status = 1 AND category_master.Status = 1 LIMIT 6");
            if(mysqli_num_rows($resData2)>0){
            ?>
                
                <div class="row">
                    <div class="col-xl-8 col-md-8 col-8 mt-5 pt-lg-4">
                        <h3 class="title-w3l">Personalised Products</h3>
                    </div>
                    <div class="col-xl-4 col-md-4 col-4 text-end mt-5 pt-lg-4">
                        <a style="color: #ef233c;" href="deals-personalise.php">View All</a>
                    </div>
                </div>
                <div class="witemshny-grids row mt-lg-3">   
                    <?php
                        while($rowData2 = mysqli_fetch_assoc($resData2)){
                            ?>              
                            <div class="col-xl-2 col-md-4 col-6 product-incfhny mt-4">
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

            $resData3 = mysqli_query($conn, "SELECT brand_master.BR_Id, brand_master.BrandImage FROM brand_card JOIN brand_master ON brand_master.BR_Id = brand_card.BrandId WHERE brand_card.Status = 1 AND brand_master.Status = 1 LIMIT 6");
            if(mysqli_num_rows($resData3)>0){
            ?>
            
                <div class="row">
                    <div class="col-xl-8 col-md-8 col-8 mt-5 pt-lg-4">
                        <h3 class="title-w3l">Deals on Brands</h3>
                    </div>
                    <div class="col-xl-4 col-md-4 col-4 text-end mt-5 pt-lg-4">
                        <a style="color: #ef233c;" href="deals-brand.php">View All</a>
                    </div>
                </div>
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

    <section class="w3l-index5 py-5" id="video">
        <div class="new-block py-5">
            <div class="container">
                <div class="video-info">
                    <div class="title-content text-center">
                        <h3 class="title-w3l two mb-5">Pre-Fall Collection,That mid-summer<br> craving for fall styles?</h3>
                    </div>
                </div>
                <div class="history-info py-lg-5 align-self pt-0">
                    <div class="position-relative mt-lg-3 py-5 pt-lg-0">
                        <a href="#small-dialog" class="popup-with-zoom-anim play-view text-center position-absolute">
                            <span class="video-play-icon">
                                <span class="fa fa-play"></span>
                            </span>
                        </a>
                        <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                            <iframe src="https://player.vimeo.com/video/145014989" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w3l-ecommerce-main">
        <div class="ecom-contenthny py-5">
            <?php
                $resProductRow1 = mysqli_query($conn, "SELECT category_master.ParentId, product_master.ProductName, product_master.PM_Id, product_master.Image, product_master.Price, product_master.OnlineDiscount FROM product_row JOIN product_master ON product_master.PM_Id = product_row.ProductId JOIN category_master ON category_master.CT_Id = product_master.CategoryId WHERE product_row.Status =1 AND product_row.Row = '2' AND product_master.Status = 1 LIMIT 12");
                if(mysqli_num_rows($resProductRow1)>0){
                    ?>
                        <div class="container pb-lg-5">
                            <div class="row">
                                <div class="col-xl-8 col-md-8 col-8">
                                    <h3 class="title-w3l">Top Picks For You</h3>
                                    <p>Handpicked Favourites just for you</p>
                                </div>
                                <div class="col-xl-4 col-md-4 col-4 text-end">
                                    <a style="color: #ef233c;" href="top-first.php">View All</a>
                                </div>
                            </div>
                            <div class="ecom-products-grids row mt-lg-4 mt-3">
                                <?php
                                    while($rowProductRow1 = mysqli_fetch_assoc($resProductRow1)){
                                        $productPrice1 = ($rowProductRow1['Price']-($rowProductRow1['Price'] * ($rowProductRow1['OnlineDiscount'] / 100)));
                                        ?>
                                            <div class="col-lg-3 col-6 product-incfhny mt-4">
                                                <div class="product-grid2 shopv">
                                                    <div class="product-image2">
                                                        <a href="product-detail.php?source=<?php echo $rowProductRow1['PM_Id']; ?>">
                                                            <img class="pic-1 img-fluid radius-image" src="../billing/<?php echo $rowProductRow1['Image']?>">
                                                            <img class="pic-2 img-fluid radius-image" src="../billing/<?php echo $rowProductRow1['Image']?>">
                                                        </a>
                                                        <ul class="social">
                                                            <li><a href="product-detail.php?source=<?php echo $rowProductRow1['PM_Id']; ?>" data-tip="Quick View"><span class="fa fa-eye"></span></a></li>
                                                            <li><a href="checkout.php" data-tip="Add to Cart"><span class="fa fa-shopping-bag"></span></a></li>
                                                        </ul>
                                                        <div class="shopv single-item">
                                                            <form method="post">
                                                                <input type="hidden" name="pid" value="<?php echo $rowProductRow1['PM_Id']; ?>">
                                                                <input type="hidden" name="pname" value="<?php echo $rowProductRow1['ProductName']; ?>">
                                                                <input type="hidden" name="pimage" value="<?php echo $rowProductRow1['Image']; ?>">
                                                                <input type="hidden" name="pprice" value="<?php echo $productPrice1; ?>">
                                                                <input type="hidden" name="message" value="N/A">
                                                                <button <?php if($rowProductRow1['ParentId']==3){echo "type='button' data-bs-toggle='modal' data-bs-target='#product".$rowProductRow1['PM_Id']."'";}?> class="shopv-cart pshopv-cart add-to-cart" name="add_to_cart">
                                                                    Add to Cart
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3 class="title"><a href="product-detail.php?source=<?php echo $rowProductRow1['PM_Id']; ?>"><?php echo $rowProductRow1['ProductName']; ?></a></h3>
                                                        <span class="price"><?php if($rowProductRow1['OnlineDiscount']>0){?><del><i class="fa fa-rupee-sign"></i><?php echo number_format($rowProductRow1['Price'], 2); ?></del><?php } ?> <i class='fa fa-rupee-sign'></i> <?php echo number_format($productPrice1, 2);?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="modal fade" id="product<?php echo $rowProductRow1['PM_Id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $rowProductRow1['ProductName']; ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <small class="text-danger">Enter Your message*</small>
                                                                <input type="text" class="form-control form-control-lg" required name="message"/>
                                                                <input type="hidden" name="pid" value="<?php echo $rowProductRow1['PM_Id']; ?>">
                                                                <input type="hidden" name="pname" value="<?php echo $rowProductRow1['ProductName']; ?>">
                                                                <input type="hidden" name="pimage" value="<?php echo $rowProductRow1['Image']; ?>">
                                                                <input type="hidden" name="pprice" value="<?php echo $productPrice1; ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" name="add_to_cart">Add To Cart</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>  
                    <?php
                }

                $resProductRow2 = mysqli_query($conn, "SELECT category_master.ParentId, product_master.ProductName, product_master.PM_Id, product_master.Image, product_master.Price, product_master.OnlineDiscount FROM product_row JOIN product_master ON product_master.PM_Id = product_row.ProductId JOIN category_master ON category_master.CT_Id = product_master.CategoryId WHERE product_row.Status =1 AND product_row.Row = '2' AND product_master.Status = 1 LIMIT 12");
                if(mysqli_num_rows($resProductRow2)>0){
                    ?>
                        <div class="container pb-lg-5">
                            <div class="row">
                                <div class="col-xl-8 col-md-8 col-8">
                                    <h3 class="title-w3l">Our Popular products</h3>
                                    <p>Handpicked Favourites just for you</p>
                                </div>
                                <div class="col-xl-4 col-md-4 col-4 text-end">
                                    <a style="color: #ef233c;" href="top-second.php">View All</a>
                                </div>
                            </div>
                            <div class="ecom-products-grids row mt-lg-4 mt-3">
                                <?php
                                    while($rowProductRow2 = mysqli_fetch_assoc($resProductRow2)){
                                        $productPrice = ($rowProductRow2['Price']-($rowProductRow2['Price'] * ($rowProductRow2['OnlineDiscount'] / 100)));
                                        ?>
                                            <div class="col-lg-3 col-6 product-incfhny mt-4">
                                                <div class="product-grid2 shopv">
                                                    <div class="product-image2">
                                                        <a href="product-detail.php?source=<?php echo $rowProductRow2['PM_Id']; ?>">
                                                            <img class="pic-1 img-fluid radius-image" src="../billing/<?php echo $rowProductRow2['Image']?>">
                                                            <img class="pic-2 img-fluid radius-image" src="../billing/<?php echo $rowProductRow2['Image']?>">
                                                        </a>
                                                        <ul class="social">
                                                            <li><a href="product-detail.php?source=<?php echo $rowProductRow2['PM_Id']; ?>" data-tip="Quick View"><span class="fa fa-eye"></span></a></li>
                                                            <li><a href="checkout.php" data-tip="Add to Cart"><span class="fa fa-shopping-bag"></span></a></li>
                                                        </ul>
                                                        <div class="shopv single-item">
                                                            <form method="post">
                                                                <input type="hidden" name="pid" value="<?php echo $rowProductRow2['PM_Id']; ?>">
                                                                <input type="hidden" name="pname" value="<?php echo $rowProductRow2['ProductName']; ?>">
                                                                <input type="hidden" name="pimage" value="<?php echo $rowProductRow2['Image']; ?>">
                                                                <input type="hidden" name="pprice" value="<?php echo $productPrice; ?>">
                                                                <input type="hidden" name="message" value="N/A">
                                                                <button <?php if($rowProductRow2['ParentId']==3){echo "type='button' data-bs-toggle='modal' data-bs-target='#product".$rowProductRow2['PM_Id']."'";}?> class="shopv-cart pshopv-cart add-to-cart" name="add_to_cart">
                                                                    Add to Cart
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <h3 class="title"><a href="product-detail.php?source=<?php echo $rowProductRow2['PM_Id']; ?>"><?php echo $rowProductRow2['ProductName']; ?></a></h3>
                                                        <span class="price"><?php if($rowProductRow2['OnlineDiscount']>0){?><del><i class="fa fa-rupee-sign"></i><?php echo number_format($rowProductRow2['Price'], 2); ?></del><?php } ?> <i class='fa fa-rupee-sign'></i> <?php echo number_format($productPrice, 2);?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="modal fade" id="product<?php echo $rowProductRow2['PM_Id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form method="POST">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $rowProductRow2['ProductName']; ?></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <small class="text-danger">Enter Your message*</small>
                                                                <input type="text" class="form-control form-control-lg" required name="message"/>
                                                                <input type="hidden" name="pid" value="<?php echo $rowProductRow2['PM_Id']; ?>">
                                                                <input type="hidden" name="pname" value="<?php echo $rowProductRow2['ProductName']; ?>">
                                                                <input type="hidden" name="pimage" value="<?php echo $rowProductRow2['Image']; ?>">
                                                                <input type="hidden" name="pprice" value="<?php echo $productPrice; ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button class="btn btn-primary" name="add_to_cart">Add To Cart</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>  
                    <?php
                }
            ?>
        </div>
    </section>

<?php
    
    require_once './assets/pages/testimonials.php';
    // require_once './assets/pages/newsletter.php';
    require_once './assets/pages/footer.php';
?>

<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/theme-change.js"></script>

<script src="assets/js/owl.carousel.js"></script>

<script>
    $(document).ready(function() {
        $('.owl-one').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            responsiveClass: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplaySpeed: 1000,
            autoplayHoverPause: false,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                667: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })
    })

</script>

<script>
    $(document).ready(function() {
        $("#owl-demo2").owlCarousel({
            loop: true,
            nav: false,
            margin: 50,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                736: {
                    items: 1,
                    nav: false
                },
                991: {
                    items: 2,
                    margin: 30,
                    nav: false
                },
                1080: {
                    items: 2,
                    nav: false
                }
            }
        })
    })

</script>

<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script>
    $(document).ready(function() {
        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',

            fixedContentPos: false,
            fixedBgPos: true,

            overflowY: 'auto',

            closeBtnInside: true,
            preloader: false,

            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });

        $('.popup-with-move-anim').magnificPopup({
            type: 'inline',

            fixedContentPos: false,
            fixedBgPos: true,

            overflowY: 'auto',

            closeBtnInside: true,
            preloader: false,

            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-slide-bottom'
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
