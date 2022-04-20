<?php

    session_start();
    
    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';

    if(isset($_POST['add_to_cart'])) {
        
        $pid = $_POST['pid'];
        $pname = $_POST['pname'];
        $pprice = $_POST['pprice'];
        $pimage = $_POST['pimage'];

        $itemArray = array(
            $pid => array(
                'prodictId' => $pid, 
                'productName' => $pname, 
                'productQuantity' => 1, 
                'productPrice' => $pprice,
                'productImage' => $pimage
            )
        );
        

        if (empty($_SESSION["cart_item"])) {
            
            $_SESSION["cart_item"] = $itemArray;
            ?>
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" id="success-alert">
                    <strong>Yay,</strong> Product added to your cart, Click <a href="checkout.php">here</a> to view.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php
        } else {
            
            if (in_array($pid, array_keys($_SESSION["cart_item"]))) {
                
                foreach($_SESSION["cart_item"] as $k => $v) {

                    if($pid == $k) {
                        if(empty($_SESSION["cart_item"][$k]["productQuantity"])) {
                            $_SESSION["cart_item"][$k]["productQuantity"] = 0;
                        }
                        $_SESSION["cart_item"][$k]["productQuantity"] += 1;

                        ?>
                        <div class="container">
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" id="success-alert">
                                <strong>Yay,</strong> Product added to your cart, Click <a href="checkout.php">here</a> to view.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    <?php
                    }
                }
            } else {
                
                $_SESSION["cart_item"] += $itemArray;
                ?>
                <div class="container">
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" id="success-alert">
                        <strong>Yay,</strong> Product added to your cart, Click <a href="checkout.php">here</a> to view.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php
            }
        }
    }
    
    require_once './assets/pages/cart.php';
    
    $page = '1';
    if(!empty($_GET['page'])){

        $page = $_GET['page'];
    }

    $sql = "SELECT product_master.ProductName, product_master.PM_Id, product_master.Image, product_master.Price, product_master.OnlineDiscount FROM product_row JOIN product_master ON product_master.PM_Id = product_row.ProductId WHERE product_row.Status =1 AND product_row.Row = '2' AND product_master.Status = 1";
    $resProducts = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($resProducts);

    $maxPage = $page * 40;
    $minPage = $maxPage - 40;

    $sql = $sql . " LIMIT $minPage, $maxPage";

?>
<section class="w3l-ecommerce-main">
    <div class="ecom-contenthny py-3">
        <?php
            $resProductRow1 = mysqli_query($conn, $sql);
            if(mysqli_num_rows($resProductRow1)>0){
                ?>
                    <div class="container">
                        <h3 class="title-w3l">Our Popular products</h3>
                        <p>Handpicked Favourites just for you</p>
                        <div class="ecom-products-grids row mt-lg-4 mt-3">
                            <?php
                                while($rowProductRow1 = mysqli_fetch_assoc($resProductRow1)){
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
                                                        <form action="#" method="POST">
                                                            <input type="hidden" name="pid" value="<?php echo $rowProductRow1['PM_Id']; ?>">
                                                            <input type="hidden" name="pname" value="<?php echo $rowProductRow1['ProductName']; ?>">
                                                            <input type="hidden" name="pimage" value="<?php echo $rowProductRow1['Image']; ?>">
                                                            <input type="hidden" name="pprice" value="<?php echo ($rowProductRow1['Price']-($rowProductRow1['Price'] * ($rowProductRow1['OnlineDiscount'] / 100))); ?>">
                                                            <button type="submit" class="shopv-cart pshopv-cart add-to-cart" name="add_to_cart">
                                                                Add to Cart
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3 class="title"><a href="product-detail.php?source=<?php echo $rowProductRow1['PM_Id']; ?>"><?php echo $rowProductRow1['ProductName']; ?></a></h3>
                                                    <span class="price"><?php if($rowProductRow1['OnlineDiscount']>0){?><del><i class="fa fa-rupee-sign"></i> <?php echo number_format($rowProductRow1['Price'], 2); ?></del><?php } ?> <i class='fa fa-rupee-sign'></i> <?php echo number_format($rowProductRow1['Price']-($rowProductRow1['Price'] * ($rowProductRow1['OnlineDiscount'] / 100)), 2);?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                            
                        </div>
                        <div class="pagination-wrapper mt-5 pt-lg-3">
                            <ul class="page-pagination">
                                <li><a class="mx-2" href="result.php?searchitem=<?php echo $searchText; ?>&page=1"><span class="fa fa-angle-double-left"></span></a></li>
                                <?php
                                    $forCount = ceil($rowCount / 40);    
                                    for($i=1;$i<=$forCount;$i++){
                                ?>
                                    <li><a class="btn <?php if($page == $i){echo 'btn-primary';}?>" href="result.php?searchitem=<?php echo $searchText; ?>&page=<?php echo $i;?>"><?php echo $i;?></a></li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                <?php
            }
        ?>
    </div>
</section>
                               
<?php
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
