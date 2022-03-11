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

    $source = '0';
    if(!empty($_GET['source'])){

        $source = $_GET['source'];
    }

    $sort = 'default';
    if(!empty($_GET['sort'])){

        $sort = $_GET['sort'];
    }

    $discount = '0';
    if(!empty($_GET['discount'])){

        $discount = $_GET['discount'];
    }

    $page = '1';
    if(!empty($_GET['page'])){

        $page = $_GET['page'];
    }

    $sql = "SELECT COUNT(product_master.PM_Id) AS total, category_master.CategoryName, category_master.CT_Id FROM product_master JOIN 
            category_master ON category_master.CT_Id = product_master.CategoryId WHERE category_master.Status = 1 
            AND product_master.Status = 1 GROUP BY category_master.CategoryName, category_master.CT_Id";


    $sql2 = "SELECT * FROM product_master WHERE CategoryId = '$source' AND Discount >= '$discount' ";

    if($sort == 'low') {
        
        $sql2 .= " ORDER BY product_master.Price ASC";
    } else if($sort == 'high') {
        
        $sql2 .= " ORDER BY product_master.Price DESC";
    }

    $maxPage = $page * 25;
    $minPage = $maxPage - 25;

    $sql3 = $sql2 . " LIMIT $minPage, $maxPage";

    $resProducts = mysqli_query($conn, $sql2);
    $rowCount = mysqli_num_rows($resProducts);
    
    ?>
    <section class="w3l-ecommerce-main">
        <div class="ecom-contenthny w3l-ecommerce-main-inn pb-5">
            <div class="container py-lg-5">
                <div class="ecommerce-grids row">
                    <div class="ecommerce-left-hny col-lg-4">
                        <aside class="pe-lg-4">
                            <div class="sider-bar">                               
                                <div class="single-gd mb-5">
                                    <h4>Discount </h4>
                                    <div classes="box-hny" id="discountForm">
                                        <label class="containerhny-checkbox">All Discount
                                            <input class="form-check-input" type="radio" name="discount" value="0" <?php if(empty($_GET['discount'])){echo 'checked';}?>>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containerhny-checkbox">15% or More
                                            <input class="form-check-input" type="radio" name="discount" value="15" <?php if(!empty($_GET['discount'])){if($_GET['discount']==15){echo 'checked';}}?>>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containerhny-checkbox">25% or More
                                            <input class="form-check-input" type="radio" name="discount" value="25" <?php if(!empty($_GET['discount'])){if($_GET['discount']==25){echo 'checked';}}?>>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containerhny-checkbox">35% or More
                                            <input class="form-check-input" type="radio" name="discount" value="35" <?php if(!empty($_GET['discount'])){if($_GET['discount']==35){echo 'checked';}}?>>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="containerhny-checkbox">50% or More
                                            <input class="form-check-input" type="radio" name="discount" value="50" <?php if(!empty($_GET['discount'])){if($_GET['discount']==50){echo 'checked';}}?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>

                                <script>
                                    $('#discountForm input').on('change', function() {

                                        var discountValue = $('input[name=discount]:checked', '#discountForm').val();
                                        window.location.href="products.php?pref=<?php echo $pref;?>&source=<?php echo $source;?>&sort=<?php echo $sort;?>&discount="+discountValue+"&page=<?php echo $page;?>";
                                    });
                                </script>
                                
                                <?php
                                    $resRecent = mysqli_query($conn, "SELECT ProductName, PM_Id, Image, Price, Discount FROM product_master WHERE Status = 1 ORDER BY PM_Id DESC LIMIT 3");
                                    if(mysqli_num_rows($resRecent)>0){
                                        ?>
                                        <div class="single-gd mb-5 border-0">
                                            <h4>Recent Products</h4>
                                            <?php
                                                while($rowRecent = mysqli_fetch_assoc($resRecent)){
                                                    ?>
                                                    <div class="row special-sec1 mt-4">
                                                        <div class="col-4 img-deals">
                                                            <a href="product-detail.php?source=<?php echo $rowRecent['PM_Id']; ?>"><img src="../billing/<?php echo $rowRecent['Image'];?>" class="img-fluid radius-image" alt=""></a>
                                                        </div>
                                                        <div class="col-8 img-deal1">
                                                            <h5 class="post-title mb-2">
                                                                <a href="product-detail.php?source=<?php echo $rowRecent['PM_Id']; ?>"><?php echo $rowRecent['ProductName'];?></a>
                                                            </h5>
                                                            <a href="product-detail.php?source=<?php echo $rowRecent['PM_Id']; ?>" class="price-right"><i class='fa fa-rupee-sign'></i> <?php echo $rowRecent['Price']-($rowRecent['Price'] * ($rowRecent['Discount'] / 100));?></a>
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
                        </aside>
                    </div>
                    <div class="ecommerce-right-hny col-lg-8">
                        <div class="row ecomhny-topbar">
                            <div class="col-6 ecomhny-result">
                                <h4 class="ecomhny-result-count"> Showing Results</h4>
                            </div>
                            <div class="col-6 ecomhny-topbar-ordering">

                                <div class="ecom-ordering-select d-flex">
                                    <span class="fa fa-angle-down" aria-hidden="true"></span>
                                    <select id="sortingSelect">
                                        <option value="default" <?php if(!empty($_GET['sort'])){if($_GET['sort'] == 'default'){echo 'selected';}}else{echo 'selected';}?>>Default Sorting</option>
                                        <option value="low" <?php if(!empty($_GET['sort'])){if($_GET['sort'] == 'low'){echo 'selected';}}?>>Sort by Price: low to high</option>
                                        <option value="high" <?php if(!empty($_GET['sort'])){if($_GET['sort'] == 'high'){echo 'selected';}}?>>Sort by Price: high to low</option>
                                    </select>
                                </div>
                            </div>

                            <script>
                                $('#sortingSelect').on('change', function() {
                                    
                                    var sortValue = this.value;
                                    window.location.href="products.php?pref=<?php echo $pref;?>&source=<?php echo $source;?>&sort="+sortValue+"&discount=<?php echo $discount;?>&page=<?php echo $page;?>";
                                });
                            </script>

                        </div>

                            <?php
    
                                $resViewProduct = mysqli_query($conn, $sql3);
                                if (mysqli_num_rows($resViewProduct)>0){
                                    ?>
                                        <div class="ecom-products-grids row">
                                    <?php
                                    while ($rowViewProduct = mysqli_fetch_assoc($resViewProduct)){
                                    ?>
                                        <div class="col-lg-4 col-6 product-incfhny mt-4">
                                            <div class="product-grid2">
                                                <div class="product-image2">
                                                    <a href="product-detail.php?source=<?php echo $rowViewProduct['PM_Id']; ?>">
                                                        <img class="pic-1 img-fluid radius-image" src="../billing/<?php echo $rowViewProduct['Image'];?>">
                                                        <img class="pic-2 img-fluid radius-image" src="../billing/<?php echo $rowViewProduct['Image'];?>">
                                                    </a>
                                                    <ul class="social">
                                                        <li><a href="product-detail.php?source=<?php echo $rowViewProduct['PM_Id']; ?>" data-tip="Quick View"><span class="fa fa-eye"></span></a></li>
                                                        <li><a href="checkout.php" data-tip="Add to Cart"><span class="fa fa-shopping-bag"></span></a></li>
                                                    </ul>
                                                    <div class="shopv single-item">
                                                        <form action="#" method="post">
                                                            <input type="hidden" name="pid" value="<?php echo $rowViewProduct['PM_Id']; ?>">
                                                            <input type="hidden" name="pname" value="<?php echo $rowViewProduct['ProductName']; ?>">
                                                            <input type="hidden" name="pimage" value="<?php echo $rowViewProduct['Image']; ?>">
                                                            <input type="hidden" name="pprice" value="<?php echo ($rowViewProduct['Price']-($rowViewProduct['Price'] * ($rowViewProduct['Discount'] / 100))); ?>">
                                                            <button type="submit" class="shopv-cart pshopv-cart add-to-cart" name="add_to_cart">
                                                                Add to Cart
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3 class="title"><a href="product-detail.php?source=<?php echo $rowViewProduct['PM_Id']; ?>"><?php echo $rowViewProduct['ProductName']; ?></a></h3>
                                                    <span class="price"><del><i class="fa fa-rupee-sign"></i><?php echo number_format($rowViewProduct['Price'], 2); ?></del> <i class='fa fa-rupee-sign'></i> <?php echo number_format($rowViewProduct['Price']-($rowViewProduct['Price'] * ($rowViewProduct['Discount'] / 100)), 2);?></span>
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
                        <div class="pagination">
                            <ul>
                                <li class="prev"><a href="products.php?pref=<?php echo $pref;?>&source=<?php echo $source; ?>&sort=<?php echo $sort;?>&discount=<?php echo $discount;?>&page=1"><span class="fa fa-angle-double-left"></span></a></li>
                                <?php
                                
                                    $forCount = ceil($rowCount / 25);    
                                    for($i=1;$i<=$forCount;$i++){
                                        ?>
                                            <li><a href="products.php?pref=<?php echo $pref;?>&source=<?php echo $source; ?>&sort=<?php echo $sort;?>&discount=<?php echo $discount;?>&page=<?php echo $i;?>" class="<?php if($page == $i){echo 'active';}?>"><?php echo $i;?></a></li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php
    require_once './assets/pages/footer.php';
?>
<!-- Template JavaScript -->
<script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/theme-change.js"></script>
    <!-- price range (top products) -->
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
    <!-- //price range (top products) -->
    <!-- MENU-JS -->
    <script>
        $(window).on("scroll", function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 80) {
                $("#site-header").addClass("nav-fixed");
            } else {
                $("#site-header").removeClass("nav-fixed");
            }
        });

        //Main navigation Active Class Add Remove
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
    <!-- //MENU-JS -->

    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function() {
            $('.navbar-toggler').click(function() {
                $('body').toggleClass('noscroll');
            })
        });

    </script>
    <!-- //disable body scroll which navbar is in active -->

    <!-- //bootstrap -->
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