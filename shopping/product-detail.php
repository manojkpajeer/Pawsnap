<?php

    session_start();
    
    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';

    if(isset($_POST['add_to_cart'])) {
        
        $pid = $_POST['pid'];
        $pname = $_POST['pname'];
        $pprice = $_POST['pprice'];
        $pquantity = $_POST['pquantity'];
        $pimage = $_POST['pimage'];
        $message = $_POST['message'];

        $itemArray = array(
            $pid => array(
                'prodictId' => $pid, 
                'productName' => $pname, 
                'productQuantity' => $pquantity, 
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
                        $_SESSION["cart_item"][$k]["productQuantity"] += $pquantity;
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

    if(isset($_POST['buy_now'])){
        
        if(isLogin()){

            $OrderId = time().strtoupper(uniqid());
            $customerId = $_SESSION['user_id'];
            $message = $_POST['message'];

            if(mysqli_query($conn, "INSERT INTO ecom_sales (CustomerId, OrderId, Status, DateCreate, Remarks, PaymentId) VALUES ('$customerId', '$OrderId', 'Order Initiated', NOW(), 'A new order has been initiated by customer', 0)")){

                if(mysqli_query($conn, "INSERT INTO ecom_sales_temp (OrderId, ProductId, Quantity, Status, DateCreate, Message) VALUES ('$OrderId', '$_POST[pid]', '$_POST[pquantity]', 1, NOW(), '$message')")){

                    echo "<script>location.href='order-confirm.php?source=$OrderId';</script>";
                } else {
                echo "<script type='text/javascript'>toastr.error('Unable to process your request, Kindly try after sometimes.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>"; 
                }
            } else {
                echo "<script type='text/javascript'>toastr.error('Unable to process your request, Kindly try after sometimes.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>"; 
            }
        } else {

            echo "<script type='text/javascript'>toastr.error('Kindly login to proceed.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true, onclick: function() {location.href='login.php'}})</script>"; 

        }
    }

    function isLogin(){

        if(empty($_SESSION['is_customer_login'])){
            return false;
        } else {
            return true;
        }
    }

    if(!empty($_GET['source'])){
 
        $resProduct = mysqli_query($conn, "SELECT pm.*, cm.ParentId FROM product_master pm, category_master cm WHERE pm.PM_Id = '$_GET[source]' AND pm.Status = 1 AND cm.CT_Id = pm.CategoryId");
        if(mysqli_num_rows($resProduct)>0){

            $rowProduct = mysqli_fetch_assoc($resProduct);
            ?>
                <section class="w3l-ecommerce-main">
                    <div class="ecom-contenthny w3l-ecommerce-main-inn py-5">
                        <div class="container">
                            <div class="sp-store-single-page row">
                                <div class="col-lg-5 single-right-left">
                                    <div class="flexslider1">
                                        <ul class="slides">
                                            <li data-thumb="../billing/<?php echo $rowProduct['Image']?>">
                                                <div class="thumb-image"> <img src="../billing/<?php echo $rowProduct['Image']?>" data-imagezoom="true" class="img-fluid radius-image" alt=" "> </div>
                                            </li>
                                            <li data-thumb="../billing/<?php echo $rowProduct['Image1']?>">
                                                <div class="thumb-image"> <img src="../billing/<?php echo $rowProduct['Image1']?>" data-imagezoom="true" class="img-fluid radius-image" alt=" "> </div>
                                            </li>
                                            <li data-thumb="../billing/<?php echo $rowProduct['Image2']?>">
                                                <div class="thumb-image"> <img src="../billing/<?php echo $rowProduct['Image2']?>" data-imagezoom="true" class="img-fluid radius-image" alt=" "> </div>
                                            </li>
                                            <li data-thumb="../billing/<?php echo $rowProduct['Image3']?>">
                                                <div class="thumb-image"> <img src="../billing/<?php echo $rowProduct['Image3']?>" data-imagezoom="true" class="img-fluid radius-image" alt=" "> </div>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="col-lg-7 single-right-left ps-lg-5">
                                    <h3><?php echo $rowProduct['ProductName'];?></h3>
                                    <div class="caption">
                                        <h6><span class="item_price fa fa-rupee-sign" style="float:left"><?php echo number_format($rowProduct['Price']-($rowProduct['Price'] * ($rowProduct['OnlineDiscount'] / 100)), 2);?><?php if($rowProduct['OnlineDiscount']>0){?><del><?php echo number_format($rowProduct['Price'], 2);?></del><?php } ?></span>
                                        </h6>
                                    </div>
                                    <div class="desc_single my-4">
                                        <h5>Description:</h5>
                                        <p><?php echo $rowProduct['Description'];?></p>
                                    </div>
                                    <form method="post">
                                        <?php
                                        if($rowProduct['ParentId']==3){
                                            ?>
                                            <div class="row">
                                                <div class="col-lg-8 col-sm-12">
                                                    <small class="text-danger">Enter Your message*</small>
                                                    <input type="text" class="form-control form-control-lg" required name="message"/>
                                                </div>
                                            </div>
                                            <?php
                                        } else{
                                            echo "<input type='hidden' name='message' value='N/A'>";
                                        }
                                        ?>
                                        <div class="description-apt d-grid mt-4"> 
                                            <input type="hidden" name="pid" value="<?php echo $rowProduct['PM_Id']; ?>">
                                            <input type="hidden" name="pname" value="<?php echo $rowProduct['ProductName']; ?>">
                                            <input type="hidden" name="pimage" value="<?php echo $rowProduct['Image']; ?>">
                                            <input type="hidden" name="pprice" value="<?php echo ($rowProduct['Price']-($rowProduct['Price'] * ($rowProduct['OnlineDiscount'] / 100))); ?>">
                                            <input type="hidden" name="pquantity" value="1">
                                            <button type="submit" class="shopv-cart pshopv-cart add-to-cart btn btn-style btn-primary" name="add_to_cart">
                                                Add to Cart
                                            </button>
                                        <div class="buyhny-now"> <button type="submit" name="buy_now" class="btn btn-style btn-primary">Buy Now </button></div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php
        }
    }
        ?>

    <section class="w3l-witemshny-main pb-5">
        <div class="container py-md-4">
            <?php
            $resData = mysqli_query($conn, "SELECT category_master.CategoryName, category_master.CT_Id, category_master.CategoryImage FROM category_card JOIN category_master ON category_master.CT_Id = category_card.CategoryId WHERE category_card.Status = 1 AND category_master.Status = 1 LIMIT 6");
            if(mysqli_num_rows($resData)>0){
            ?>
                    <div class="row">
                        <div class="col-xl-8 col-md-8 col-8">
                            <h3 class="title-w3l">Deals Of The Day</h3>
                        </div>
                        <div class="col-xl-4 col-md-4 col-4 text-end">
                            <a style="color: #ef233c;" href="deals-day.php">View All</a>
                        </div>
                    </div>
                    <div class="witemshny-grids row mt-lg-3">
                        <?php
                            while($rowData = mysqli_fetch_assoc($resData)) {
                                ?>
                                <div class="col-xl-2 col-md-4 col-6 product-incfhny mt-4">
                                    <div class="weitemshny-grid oposition-relative">
                                        <a href="products.php?pref=Category&source=<?php echo $rowData['CT_Id']?>" class="d-block zoom"><img src="../billing/<?php echo $rowData['CategoryImage']?>" alt="" class="img-fluid news-image"></a>
                                        <div class="witemshny-inf">
                                        </div>
                                    </div>
                                    <h4 class="gdnhy-1 mt-4"><a href="products.php?pref=Category&source=<?php echo $rowData['CT_Id']?>"><?php echo $rowData['CategoryName']?></a>
                                    </h4>
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