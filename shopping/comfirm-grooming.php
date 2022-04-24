<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    if(empty($_GET['source'])){

        echo "<script>location.href='book-grooming.php'</script>";
    } else{
        $tokenNo = $_GET['source'];

        if(isset($_POST['submit'])){

            if(mysqli_query($conn, "UPDATE grooming_request SET UserName = '$_POST[name]', UserPhone = '$_POST[phone]', UserAddress = '$_POST[address]', 
                AppointmentDate = '$_POST[date]', GroomingStatus = 'Confirmed', Remarks = 'Pending admin approval' WHERE TokenNo = '$tokenNo'")){
                echo "<script type='text/javascript'>toastr.success('Your request has been submitted successfully.', 'Success!', {positionClass:'toast-bottom-right', closeButton:true, onclick: function() {location.href='view-request.php'}})</script>"; 

            }else {
                echo "<script type='text/javascript'>toastr.error('Unable to submit your request.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>"; 
            }
        }

?>  

<section class="w3l-ecommerce-main">
    <div class="ecom-contenthny pb-5">
        <div class="container pb-lg-5">
            <div class="ecom-contenthny-w3lcheckout privacy">
                <div class="row checkout-left mt-5">
                    <?php
                        $tottalPrice = 0;
                        $discount = 0;
                        $resData = mysqli_query($conn, "SELECT st.ServiceName, st.ServicePrice FROM service_temp sm, service_type st WHERE st.SR_Id =  sm.ServiceId AND TokenNo = '$tokenNo'");
                        if(mysqli_num_rows($resData)>0){
                        ?>
                        <div class="col-md-4 checkout-left-basket">
                            <h3>Confirm Your<span> Service</span></h3>
                            <h4 class="mt-4">In Your Basket</h4>
                            <ul>
                            <?php
                            while($rowData = mysqli_fetch_assoc($resData)){
                                $price = $rowData['ServicePrice'];
                                echo "<li>".$rowData['ServiceName']." <span>".number_format($price, 2)." </span></li>";
                                $tottalPrice += $price;
                            }
                            if($tottalPrice > 1000){
                                $discount = $tottalPrice*(10/100);
                            }
                            $actualPrice = $tottalPrice - $discount;
                            ?>
                                <li>Discount <span><?php echo number_format($discount, 2); ?></span></li>
                                <li>Rounding <span>- <?php echo number_format(($actualPrice - floor($actualPrice)), 2); ?></span></li>
                                <li class="total"><strong>Total <span><?php echo number_format(floor($actualPrice), 2); ?></span></strong></li>
                            </ul>
                        </div>
                        <div class="col-md-8 address_form_agile ps-lg-5">
                            <form method="POST" class="creditly-card-form agileinfo_form">
                                <section class="creditly-wrapper wthree, w3_agileits_wrapper">
                                    <div class="information-wrapper">
                                        <div class="first-row form-group">
                                            <div class="controls">
                                                <label class="form-lable">Appointment Date:</label>
                                                <input type="date" name="date" value="<?php echo date('Y-m-d');?>" class="contact-input" required="" min<?php echo date('Y-m-d');?>>
                                            </div>
                                            <div class="controls">
                                                <label class="form-lable">Your Name:</label>
                                                <input type="text" name="name" class="contact-input" required="" placeholder="Enter your name.">
                                            </div>
                                            <div class="controls">
                                                <label class="form-lable">Your Phone No:</label>
                                                <input type="text" name="phone" class="contact-input" required="" placeholder="Enter your phone number." pattern="[0-9]{6,13}" maxlength="13" title="Kindly enter valid phone number.">
                                            </div>
                                            <div class="form-input">
                                                <label class="form-lable">Your Address:</label>
                                                <input type="text" name="address" class="contact-input" required="" placeholder="Enter your Address.">
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="checkout-right-basket">
                                    <button class="btn btn-style btn-primary" name="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <?php
                        }else{
                            echo "<div class='text-center'>
                                    <img src='assets/images/error.png' class='img-fluid' width='360'>
                                    <h3 class='mt-3'>Oops..<br>Unable to process. <br>Click <a href='book-grooming.php'>here</a> to go back</h3>
                                </div>";
                        }
                    
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
    }
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