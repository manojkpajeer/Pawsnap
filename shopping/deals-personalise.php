<?php

    session_start();

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
            // echo "<script>alert('Yay, Product added to your cart..');</script>"; 
        } else {
            
            if (in_array($pid, array_keys($_SESSION["cart_item"]))) {
                
                foreach($_SESSION["cart_item"] as $k => $v) {

                    if($pid == $k) {
                        if(empty($_SESSION["cart_item"][$k]["productQuantity"])) {
                            $_SESSION["cart_item"][$k]["productQuantity"] = 0;
                        }
                        $_SESSION["cart_item"][$k]["productQuantity"] += 1;

                        // echo "<script>alert('Yay, Product added to your cart..');</script>"; 
                    }
                }
            } else {
                
                $_SESSION["cart_item"] += $itemArray;
                // echo "<script>alert('Yay, Product added to your cart..');</script>"; 
            }
        }
    }
    
    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';
    
    $page = '1';
    if(!empty($_GET['page'])){

        $page = $_GET['page'];
    }

    $sql = "SELECT category_master.CategoryName, category_master.CT_Id, category_master.CategoryImage FROM personalise_card JOIN category_master ON category_master.CT_Id = personalise_card.CategoryId WHERE personalise_card.Status = 1 AND category_master.Status = 1";
    $resProducts = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($resProducts);

    $maxPage = $page * 42;
    $minPage = $maxPage - 42;

    $sql = $sql . " LIMIT $minPage, $maxPage";

?>
<section class="w3l-witemshny-main py-5">
    <div class="container">
    <?php
        $resProductRow1 = mysqli_query($conn, $sql);
        if(mysqli_num_rows($resProductRow1)>0){
            ?>
            <h3 class="title-w3l">Personalised Products</h3>
            <div class="witemshny-grids row mt-lg-3">
            <?php
                while($rowProductRow1 = mysqli_fetch_assoc($resProductRow1)){
                    ?>
                        <div class="col-xl-2 col-md-4 col-6 product-incfhny mt-4">
                            <div class="weitemshny-grid oposition-relative">
                                <a href="products.php?pref=Personalised&source=<?php echo $rowProductRow1['CT_Id']?>&sort=default&discount=0&page=1" class="d-block zoom"><img src="../billing/<?php echo $rowProductRow1['CategoryImage'];?>" alt="" class="img-fluid news-image"></a>
                                <div class="witemshny-inf">
                                </div>
                            </div>
                            <h4 class="gdnhy-1 mt-4"><a class="text-center" href="products.php?pref=Personalised&source=<?php echo $rowProductRow1['CT_Id']?>&sort=default&discount=0&page=1"><?php echo $rowProductRow1['CategoryName'];?></a>
                            </h4>
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
