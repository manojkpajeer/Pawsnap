<?php

    session_start();

    if(isset($_POST['add_cart_item'])) {

        foreach ($_SESSION["cart_item"] as $k => $v) {

            if($_POST['pid'] == $k) {
    
                if(empty($_SESSION["cart_item"][$k]["productQuantity"])) {
    
                    $_SESSION["cart_item"][$k]["productQuantity"] = 1;
                }
                
                $_SESSION["cart_item"][$k]["productQuantity"] += 1;

            }
        }
    }

    if(isset($_POST['remove_cart_item'])){

        foreach ($_SESSION["cart_item"] as $k => $v) {

            if($_POST['pid'] == $k) {
    
                if(empty($_SESSION["cart_item"][$k]["productQuantity"])) {
    
                    $_SESSION["cart_item"][$k]["productQuantity"] = 0;
                }
                else if ($_SESSION["cart_item"][$k]["productQuantity"] > 1) {
                  $_SESSION["cart_item"][$k]["productQuantity"] -= 1;
                }
            }
        }
    }

    if(isset($_POST['delete_cart_item'])){

        $prodId = $_POST['pid'];
        unset($_SESSION['cart_item'][$prodId]);
    }
    
    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    if(isset($_POST['cart_checkout'])){

        if(isLogin()){

            $OrderId = time(). strtoupper(uniqid());
            $customerId = $_SESSION['user_id'];

            if(mysqli_query($conn, "INSERT INTO ecom_sales (CustomerId, OrderId, Status, DateCreate, Remarks, PaymentId) VALUES ('$customerId', '$OrderId', 0, NOW(), 'Order Initiated', 0)")){

                $insertData = "INSERT INTO ecom_sales_temp (OrderId, ProductId, Quantity, Status, DateCreate) VALUES";
                $i = 0;

                foreach($_SESSION['cart_item'] as $item){

                    if($i > 0){
                        $insertData .= ", ";
                    }

                    $insertData .= "('$OrderId', '$item[prodictId]', '$item[productQuantity]', 1, NOW())";

                    $i++;
                }
                if(mysqli_query($conn, $insertData)){

                    unset($_SESSION['cart_item']);
                    echo "<script>location.href='order-confirm.php?source=$OrderId';</script>";
                } else {

                    echo "<script>alert('Oops, Unable to process..');</script>";
                }
            } else {

                echo "<script>alert('Oops, Unable to process..');</script>";
            }
        } else {

            echo "<script>alert('Oops, Kindly login to proceed..');location.href='../login.php';</script>";
        }
    }

    function isLogin(){

        if(empty($_SESSION['is_customer_login'])){
            return false;
        } else {
            return true;
        }
    }
    
?>

<section class="w3l-ecommerce-main">
    <div class="ecom-contenthny pb-5">
        <div class="container py-lg-5">
            <?php
                if(empty($_SESSION['cart_item'])){
                    ?>
                        <div class="ecom-contenthny-w3lcheckout privacy">
                            <h3>Chec<span>kout</span></h3>
                            <p class="mb-5">Your shopping cart <span>empty</span></p>
                        </div>
                        </div>
                    <?php
                } else {
                    ?>
                        <div class="ecom-contenthny-w3lcheckout privacy">
                            <h3>Chec<span>kout</span></h3>
                            <div class="checkout-right">
                                <p class="mb-5">Your shopping cart contains: <span><?php echo sizeof($_SESSION['cart_item']);?> Products</span></p>
                                <table class="timetable_sub">
                                    <thead>
                                        <tr>
                                            <th>SL No.</th>
                                            <th>Product</th>
                                            <th>Product Name</th>
                                            <th>Quality</th>
                                            <th>Price</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $count = 1;
                                            $paybleAmount = 0;
                                            
                                            foreach ($_SESSION['cart_item'] as $item) {
                                                $prodictId = $item['prodictId'];
                                                $productName = $item['productName'];
                                                $productQuantity = $item['productQuantity'];
                                                $productPrice = $item['productPrice'];
                                                $productImage = $item['productImage'];

                                                $paybleAmount += ($productPrice * $productQuantity);
                                                ?>
                                                    <tr class="rem1">
                                                        <form method="POST">
                                                            <td class="invert">1</td>
                                                            <td class="invert"><a href="product-detail.php?source=<?php echo $prodictId; ?>">
                                                                <a href="product-detail.php?source=<?php echo $prodictId; ?>"><img src="../billing/<?php echo $productImage; ?>" class="img-fluid radius-image" alt="" width="50" height="60"></a>
                                                            </td>
                                                            
                                                            <td class="invert"><?php echo $productName;?></td>
                                                            <td class="invert">
                                                                <div class="quantity">
                                                                    <div class="quantity-select">
                                                                        <button name="remove_cart_item" class="entry value-minus">&nbsp;</button>
                                                                        <div class="entry value"><span><?php echo $productQuantity; ?></span></div>
                                                                        <button name="add_cart_item" class="entry value-plus active">&nbsp;</button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="invert"><?php echo number_format(($productPrice * $productQuantity), 2); ?></td>
                                                            <td class="invert">
                                                                <div class="rem">
                                                                    <input type="hidden" name="pid" value="<?php echo $prodictId; ?>">
                                                                    <button class="border-0" name="delete_cart_item"><i class="text-danger far fa-window-close"></i> </button>
                                                                </div>
                                                            </td>
                                                        </form>
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row checkout-left mt-5">
                                <div class="col-md-8"></div>
                                <div class="col-md-4 checkout-left-basket ps-lg-5">
                                    <ul>
                                        <hr>
                                        <li><h6>Total <span><i class="fa fa-rupee-sign"></i> <?php echo number_format($paybleAmount, 2);?></span></h6></li>
                                    </ul>
                                    <div class="checkout-right-basket">
                                        <form method="POST">
                                            <button class="btn btn-style btn-primary" name="cart_checkout">Check Out <i class="fas fa-arrow-right ms-lg-3 ms-2"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
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