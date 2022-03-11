<?php

    session_start();

    if(empty($_SESSION['is_customer_login'])){
        
        echo "<script>alert('Oops, Kindly login to proceed..');location.href='../login.php';</script>";
    }

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    $orderId = '';
    if(!empty($_GET['source'])){

        $orderId = $_GET['source'];
    }

    $sql = "SELECT * FROM ecom_sales WHERE OrderId = '$orderId'";
    
?>

<style>
    .card {
        margin: auto;
        width: 100%;
        max-width: 850px;
        padding: 4vh 0;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-top: 3px solid #ef233c;
        border-left: none;
        border-right: none
    }

    @media(max-width:768px) {
        .card {
            width: 90%
        }
    }

    .title {
        color: #ef233c;
        font-weight: 600;
        margin-bottom: 2vh;
        padding: 0 8%;
        font-size: initial
    }

    #details {
        font-weight: 400
    }

    .info {
        padding: 1% 8% 0% 8%
    }

    .info .col-5 {
        padding: 0
    }

    #heading {
        color: grey;
        line-height: 6vh
    }

    .pricing {
        background-color: #ddd3;
        padding:  0% 8% 0% 8%;
        font-weight: 400;
        line-height: 2.5
    }

    .pricing .col-3 {
        padding: 0
    }

    .total {
        padding: 2vh 8%;
        color: #ef233c;
        font-weight: bold
    }

    .total .col-3 {
        padding: 0
    }

    .footer {
        padding: 0 8%;
        font-size: x-small;
        color: black
    }

    .footer img {
        height: 5vh;
        opacity: 0.2
    }

    .footer a {
        color: #ef233c;
    }

    .footer .col-10,
    .col-2 {
        display: flex;
        padding: 3vh 0 0;
        align-items: center
    }

    .footer .row {
        margin: 0
    }

    #progressbar {
        margin-bottom: 3vh;
        overflow: hidden;
        color: rgb(252, 103, 49);
        padding-left: 0px;
        margin-top: 3vh
    }

    #progressbar li {
        list-style-type: none;
        font-size: x-small;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400;
        color: rgb(160, 159, 159)
    }

    #progressbar #step1:before {
        content: "";
        color: rgb(252, 103, 49);
        width: 5px;
        height: 5px;
        margin-left: 0px !important
    }

    #progressbar #step2:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-left: 32%
    }

    #progressbar #step3:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-right: 32%
    }

    #progressbar #step4:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-right: 0px !important
    }

    #progressbar li:before {
        line-height: 29px;
        display: block;
        font-size: 12px;
        background: #ddd;
        border-radius: 50%;
        margin: auto;
        z-index: -1;
        margin-bottom: 1vh
    }

    #progressbar li:after {
        content: '';
        height: 2px;
        background: #ddd;
        position: absolute;
        left: 0%;
        right: 0%;
        margin-bottom: 2vh;
        top: 1px;
        z-index: 1
    }

    .progress-track {
        padding: 0 8%
    }

    #progressbar li:nth-child(2):after {
        margin-right: auto
    }

    #progressbar li:nth-child(1):after {
        margin: auto
    }

    #progressbar li:nth-child(3):after {
        float: left;
        width: 68%
    }

    #progressbar li:nth-child(4):after {
        margin-left: auto;
        width: 132%
    }

    #progressbar li.active {
        color: black
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #ef233c
    }
</style>

<section class="w3l-ecommerce-main">
    <div class="ecom-contenthny w3l-ecommerce-main-inn py-5">
        <div class="container pb-lg-5">
            <div class="ecommerce-grids row">
            <?php
                $resOrder = mysqli_query($conn, $sql);
                if(mysqli_num_rows($resOrder)>0){
                    $resOrder = mysqli_fetch_assoc($resOrder);

                    $resCustomer = mysqli_query($conn, "SELECT * FROM customer_master WHERE CM_Id = '$resOrder[CustomerId]'");
                    $resCustomer = mysqli_fetch_assoc($resCustomer);
                ?>
                <div class="ecommerce-right-hny col-lg-12">
                    <div class="ecom-products-grids row">
                        <div class="card">
                            <div class="title">Purchase Reciept</div>
                            <div class="info">
                                <div class="row">
                                    <div class="col-7"> <span id="heading">Date <?php echo date_format(date_create($resOrder['DateCreate']), 'd M Y h:i A');?></span></div>
                                    <div class="col-5 pull-right"> <span id="heading">Order No. #<?php echo $resOrder['OrderId'];?></span></div>
                                </div>
                                <div class="row">
                                    <div class="col-7"> <span id="heading"><?php echo $resCustomer['FullName'];?></span><br> <span id="details"><?php echo $resCustomer['CustomerPhone'];?><br></span> <span id="heading">Address:</span><br> <span id="details"><?php echo $resCustomer['AddressLine1'];?><br><?php echo $resCustomer['AddressLine2'];?><br><?php echo $resCustomer['Landmark'];?> <?php echo $resCustomer['CustomerCity'];?><br><?php echo "Pin: ".$resCustomer['Pincode'];?><br></span></div>
                                    <div class="col-5 pull-right"> <span id="heading">Pawsnap</span><br> <span id="details">Premium Enclave</span><br>3rd Floor, Light House Hill Rd<br>Hampankatta, 575001<br>+(91) 987 999 8888</div>
                                </div>
                            </div>
                            <div class="title mt-4">Products</div>
                                <?php
                                    $resProduct = mysqli_query($conn, "SELECT ecom_sales_temp.Quantity, product_master.Price, product_master.Discount, product_master.ProductName FROM ecom_sales_temp JOIN product_master ON product_master.PM_Id = ecom_sales_temp.ProductId WHERE ecom_sales_temp.OrderId = '$resOrder[OrderId]'");
                                    if(mysqli_num_rows($resProduct)>0){
                                        
                                        echo "<div class='pricing'>";
                                        $finalPrice = 0;
                                        while($rowProduct = mysqli_fetch_assoc($resProduct)){

                                            $price = (($rowProduct['Price']-($rowProduct['Price'] * ($rowProduct['Discount'] / 100)))*$rowProduct['Quantity']);
                                            $finalPrice += $price;
                                            echo "<div class='row'>
                                                <div class='col-7'>$rowProduct[ProductName]</div>
                                                <div class='col-1 text-start'>$rowProduct[Quantity]</div>
                                                <div class='col-3 text-end'> <span id='price'>".number_format($price, 2)."</span> </div>
                                                </div>";
                                        }

                                        echo "</div>
                                            <div class='total'>
                                                <div class='row'>
                                                    <div class='col-6'></div>
                                                    <div class='col-6 text-end'><big> Rs ".number_format($finalPrice, 2)."</big></div>
                                                </div>
                                            </div>";
                                    }
                                ?>
                                
                            
                            <div class="tracking">
                                <div class="title">Tracking Order</div>
                            </div>
                            <div class="progress-track">
                                <ul id="progressbar">
                                    <li class="step0 <?php if($resOrder['Remarks']=='Order Delivered' || $resOrder['Remarks']=='Order Out for delivary' || $resOrder['Remarks']=='Order Shipped' || $resOrder['Remarks']=='Order Placed'){echo 'active';}?>" id="step1">Order Placed</li>
                                    <li class="step0 text-center <?php if($resOrder['Remarks']=='Order Delivered' || $resOrder['Remarks']=='Order Out for delivary' || $resOrder['Remarks']=='Order Shipped'){echo 'active';}?>" id="step2">Order Shipped</li>
                                    <li class="step0 text-right <?php if($resOrder['Remarks']=='Order Delivered' || $resOrder['Remarks']=='Order Out for delivary'){echo 'active';}?>" id="step3">Order Out for delivary</li>
                                    <li class="step0 text-right <?php if($resOrder['Remarks']=='Order Delivered'){echo 'active';}?>" id="step4">Order Delivered</li>
                                </ul>
                            </div>
                            <div class="footer">
                                <div class="row">
                                    <div class="col-2"></div>
                                    <div class="col-10">Want any help? Please &nbsp; contact us</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } else {
                    echo "<h3>Error! Unable to show your order</h3>";
                } ?>
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