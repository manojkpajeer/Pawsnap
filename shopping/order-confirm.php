<?php

    session_start();

    if(empty($_SESSION['is_customer_login'])){
        
        echo "<script>alert('Oops, Unable to process..');location.href='../login.php';</script>";
    }
    
    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    $orderId = $_GET['source'];

    if(empty($orderId)){

        echo "<script>alert('Oops, Unable to process..');location.href='index.php';</script>";
    }

    $customerId = $_SESSION['user_id'];

    if(empty($customerId)){

        echo "<script>alert('Oops, Unable to process..');location.href='../login.php';</script>";
   }

    if(isset($_POST['make_payment'])){

        if(mysqli_query($conn, "UPDATE customer_master SET FullName = '$_POST[name]', CustomerPhone = '$_POST[number]', AddressLine1 = '$_POST[address1]', AddressLine2 = '$_POST[address2]', Landmark = '$_POST[landmark]', Pincode = '$_POST[pincode]', CustomerCity = '$_POST[city]' WHERE CM_Id = '$customerId'")){

            echo "<script>location.href='make-payment.php?prefetch=$orderId';</script>";
        } else {

            echo "<script>alert('Oops, Unable to process..');</script>";
        }
    }
    
?>

<section class="w3l-ecommerce-main">
    <div class="ecom-contenthny pb-5">
        <div class="container pb-lg-5">
            <div class="ecom-contenthny-w3lcheckout privacy">
        
                <div class="row checkout-left mt-5">
                    <div class="col-md-4 checkout-left-basket">
                        
                        <h3>Confirm Your<span> Order</span></h3>
                        <h4 class="mt-4">Continue to basket</h4>
                        <ul>
                            <?php
                                $tottalPrice = 0;
                                $resData = mysqli_query($conn, "SELECT product_master.ProductName, product_master.Price, product_master.Discount, ecom_sales_temp.Quantity FROM ecom_sales JOIN ecom_sales_temp ON ecom_sales_temp.OrderId = ecom_sales.OrderId  JOIN product_master ON product_master.PM_Id = ecom_sales_temp.ProductId WHERE ecom_sales_temp.OrderId = '$orderId' AND ecom_sales.OrderId = '$orderId' AND ecom_sales.Status = 0 AND ecom_sales.Remarks = 'Order Initiated'");
                                if(mysqli_num_rows($resData)>0){

                                    while($rowData = mysqli_fetch_assoc($resData)){

                                        $productPrice = ($rowData['Price'] - ($rowData['Price'] * ($rowData['Discount'] / 100)) * $rowData['Quantity']);
                                        echo "<li>".$rowData['ProductName']." (".$rowData['Quantity'].") <span>".number_format($productPrice, 2)." </span></li>";
                                        $tottalPrice += $productPrice;
                                    }
                                } else {

                                    echo "<script>alert('Oops, Unable to process..');location.href='index.php';</script>";
                                }
                            ?>
                            <li><strong>Total</strong> <span><?php echo number_format($tottalPrice, 2); ?></span></li>
                        </ul>
                    </div>
                    <div class="col-md-8 address_form_agile ps-lg-5">
                        <h4>Your Delivery Address</h4>
                        <form method="POST" class="creditly-card-form agileinfo_form mt-4">
                            <section class="creditly-wrapper wthree, w3_agileits_wrapper">
                                <div class="information-wrapper">
                                    <div class="first-row form-group">
                                        <?php
                                            $resAddress = mysqli_query($conn, "SELECT * FROM  customer_master WHERE CM_Id = '$customerId'");
                                            if(mysqli_num_rows($resAddress)>0){
                                                $rowAddress = mysqli_fetch_assoc($resAddress);
                                                ?>
                                                    <div class="controls">
                                                        <label class="form-lable">Your Name*:</label>
                                                        <input class="form-control" type="text" name="name" value="<?php if(!empty($rowAddress['FullName'])){echo $rowAddress['FullName'];}?>" required>
                                                    </div>
                                                    <div class="controls">
                                                        <label class="form-lable">Your Phone No*:</label>
                                                        <input class="form-control" type="text" name="number" value="<?php if(!empty($rowAddress['CustomerPhone'])){echo $rowAddress['CustomerPhone'];}?>" required="" pattern="[0-9]{6,13}" title="Only numbers are accepted and it should be 6 to 13 digits in length" maxlength="13">
                                                    </div>
                                                    <div class="controls">
                                                    <label class="form-lable">Address Line 1*:</label>
                                                        <input class="form-control" type="text" name="address1" value="<?php if(!empty($rowAddress['AddressLine1'])){echo $rowAddress['AddressLine1'];}?>" required>
                                                    </div>
                                                    <div class="controls">
                                                    <label class="form-lable">Address Line 2*:</label>
                                                        <input class="form-control" type="text" name="address2" value="<?php if(!empty($rowAddress['AddressLine2'])){echo $rowAddress['AddressLine2'];}?>" required>
                                                    </div>
                                                    <div class="controls">
                                                    <label class="form-lable">Landmark*:</label>
                                                        <input class="form-control" type="text" name="landmark" value="<?php if(!empty($rowAddress['Landmark'])){echo $rowAddress['Landmark'];}?>" required>
                                                    </div>
                                                    <div class="controls">
                                                    <label class="form-lable">Town/City*:</label>
                                                        <input class="form-control" type="text" name="city" value="<?php if(!empty($rowAddress['CustomerCity'])){echo $rowAddress['CustomerCity'];}?>" required>
                                                    </div>
                                                    <div class="controls">
                                                    <label class="form-lable">Pincode*:</label>
                                                        <input class="form-control" type="text" name="pincode" value="<?php if(!empty($rowAddress['Pincode'])){echo $rowAddress['Pincode'];}?>" required maxlength="6" pattern="[0-9]{6}" title="PIN Code should be 6 digits in length">
                                                    </div>
                                                <?php
                                            } else {
                                                
                                                echo "<script>alert('Oops, Unable to process..');location.href='../login.php';</script>";
                                            }
                                            ?>
                                    </div>
                                </div>
                            </section>
                            <div class="checkout-right-basket">
                                <button class="btn btn-style btn-primary" name="make_payment">Make a Payment <i class="fas fa-arrow-right ms-lg-3 ms-2"></i></button>
                            </div>
                        </form>
                    </div>
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