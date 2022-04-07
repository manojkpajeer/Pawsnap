<?php

    session_start();

    if(empty($_SESSION['is_customer_login'])){
        
        echo "<script>alert('Oops, Kindly login to proceed..');location.href='../login.php';</script>";
    }

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    $resCountData = mysqli_query($conn, "SELECT ES_Id FROM ecom_sales WHERE CustomerId = '$_SESSION[user_id]' AND Status = 1");

    $rowCount = mysqli_num_rows($resCountData);

    $sql = "SELECT * FROM ecom_sales WHERE CustomerId = '$_SESSION[user_id]' AND Status = 1";

    $sort = 'recent';
    if(!empty($_GET['sort'])){

        $sort = $_GET['sort'];
    }

    $page = '1';
    if(!empty($_GET['page'])){

        $page = $_GET['page'];
    }

    if($sort == 'amonth') {

        // $start_date = date('Y-m-dH:i:s');
        // $end_date = date('Y-m-dH:i:s', strtotime('-1 months'));
        // $sql .= " AND DateCreate BETWEEN $start_date AND $end_date";
    } else if($sort == 'tmonth') {
        
        // $start_date = date('Y-m-dH:i:s');
        // $end_date = date('Y-m-dH:i:s', strtotime('-3 months'));
        // $sql .= " AND DateCreate BETWEEN $start_date AND $end_date";
    } else if($sort == 'smonth') {
        
        // $start_date = date('Y-m-dH:i:s');
        // $end_date = date('Y-m-dH:i:s', strtotime('-6 months'));
        // $sql .= " AND DateCreate BETWEEN $start_date AND $end_date";
    }

    $sql .= " ORDER BY ES_Id DESC";

    $maxPage = $page * 10;
    $minPage = $maxPage - 10;

    $sql .= " LIMIT $minPage, $maxPage"; 
    ?>

<section class="w3l-ecommerce-main">
    <div class="ecom-contenthny w3l-ecommerce-main-inn py-5">
        <div class="container pb-lg-5">
            <div class="ecommerce-grids row">
            <?php
                $resOrder = mysqli_query($conn, $sql);
                if(mysqli_num_rows($resOrder)>0){
                ?>
                <div class="ecommerce-right-hny col-lg-12">
                    <div class="row ecomhny-topbar">
                        <div class="col-9 ecomhny-result">
                            <h3>Your<span> Orders</span></h3>
                        </div>
                        <div class="col-3 ecomhny-topbar-ordering">
                            <div class="ecom-ordering-select d-flex">
                                <span class="fa fa-angle-down" aria-hidden="true"></span>
                                <select id="sortingSelect">
                                    <option value="recent" <?php if(!empty($_GET['sort'])){if($_GET['sort'] == 'recent'){echo 'selected';}}else{echo 'selected';}?>>Recent Order</option>
                                    <option value="amonth" <?php if(!empty($_GET['sort'])){if($_GET['sort'] == 'amonth'){echo 'selected';}}?>>Past month</option>
                                    <option value="tmonth" <?php if(!empty($_GET['sort'])){if($_GET['sort'] == 'tmonth'){echo 'selected';}}?>>Past 3 month</option>
                                    <option value="smonth" <?php if(!empty($_GET['sort'])){if($_GET['sort'] == 'smonth'){echo 'selected';}}?>>Past 6 month</option>
                                </select>
                            </div>
                        </div>
                        <script>
                            $('#sortingSelect').on('change', function() {
                                
                                var sortValue = this.value;
                                window.location.href="order.php?sort="+sortValue+"&page=<?php echo $page;?>";
                            });
                        </script>
                    </div>
                    <div class="ecom-products-grids row">
                        <?php
                            while($rowOrder = mysqli_fetch_assoc($resOrder)){
                            ?>
                        <div class="item mb-4">
                            <div class="card">
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-9 col-sm-12 col-md-9 mt-2">
                                            <a href="order-details.php?source=<?php echo $rowOrder['OrderId'];?>"><?php echo $rowOrder['OrderId'];?></a>
                                        </div>
                                        <div class="col-lg-3 col-sm-12 col-md-3 text-end">
                                            <span class=""><?php echo date_format(date_create($rowOrder['DateCreate']), 'd M, Y');?></span> 
                                            <small><?php echo date_format(date_create($rowOrder['DateCreate']), 'h:i A');?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-9 col-sm-12 col-md-9 mt-2">
                                            <strong>Order Status : </strong>
                                            <div class="progress mt-2" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar" style="<?php if($rowOrder['Remarks']=='Order Placed'){echo 'width: 25%;';}if($rowOrder['Remarks']=='Order Shipped'){echo 'width: 50%;';}if($rowOrder['Remarks']=='Order Out for delivary'){echo 'width: 75%;';}if($rowOrder['Remarks']=='Order Delivered'){echo 'width: 100%;';}?>background-color:#ef233c" aria-valuemin="0" aria-valuemax="100"><?php echo $rowOrder['Remarks'];?></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-12 col-md-3 text-end mt-2">
                                            <a href="order-details.php?source=<?php echo $rowOrder['OrderId'];?>" class="btn btn-sm btn-outline-danger">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="pagination">
                    <ul>
                        <li class="prev"><a href="order.php?sort=<?php echo $sort;?>&page=<?php if(empty($_GET['page'])){echo '1';}else{ if(($_GET['page'] - 1) > 0) {echo $_GET['page'] - 1;}else{echo '1';}}?>"><span class="fa fa-angle-double-left"></span></a></li>
                        <li class="next"><a href="order.php?sort=<?php echo $sort;?>&page=<?php if(empty($_GET['page'])){echo '1';}else{ if(($rowCount - (($_GET['page'] + 1) * 10)) >= 0) {echo $_GET['page'] + 1;}else{ echo $_GET['page'];}}?>"><span class="fa fa-angle-double-right"></span></a></li>
                    </ul>
                </div>
                <?php } else {
                    echo "<h3>There are no order to<span> show</span></h3>";
                    echo "<p>Start shopping now!</p>";
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