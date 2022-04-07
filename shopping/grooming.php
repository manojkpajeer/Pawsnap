<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    if(isset($_POST['request'])){
        if(!empty($_SESSION['is_customer_login'])){

            $customerId = $_SESSION['user_id'];

            if(mysqli_query($conn, "INSERT INTO grooming_request (DateCreate, GroomingStatus, UserName, UserPhone, UserAddress, 
                AppointmentDate, ServiceId, Remarks, UserId) VALUES (NOW(), 'Requested', '$_POST[name]', '$_POST[phone]', '$_POST[address]', 
                '$_POST[date]', '$_POST[service]', 'Your request sent to admin.', '$customerId')")){
                echo "<script>alert('Yay, Your request has been submitted successfully.');location.href='view-request.php';</script>";
            }else {
                echo "<script>alert('Oops, Unable to submit your request.');</script>";
            }
        }else{
            echo "<script>alert('Oops, Kindly login to proceed..');</script>";
        }
    }

?>    
    
    <div class="w3l-3-grids" id="about-1">
        <div class="container py-md-5 py-2 pb-0">
            <div class="row">
                <div class="col-lg-6 my-5">
                    <div class="w3abin-top text-center">
                        <div class="title-content">
                            <h6 class="title-subw3hny mb-1">Grooming</h6>
                            <h3 class="title-w3l">The Best Grooming Service</h3>
                        </div>
                        <p class="mt-3">Lorem ipsum viverra feugiat. Pellen tesque libero ut justo,
                            ultrices in ligula. Semper at tempufddfel. Lorem ipsum dolor sit amet
                            elit ipsum dolor.Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="grids3-info position-relative">
                        <a class="d-block zoom"><img src="assets/images/grooming.jpg" alt="" class="img-fluid news-image"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="team" class="w3lteam">
        <div class="container py-md-5">
            <div class="title-content text-center">
                <h6 class="title-subw3hny mb-1">Service</h6>
                <h3 class="title-w3l mb-5">What We Do</h3>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="member">
                        <div class="pic"><img src="assets/images/groomings.jpg" class="img-fluid radius-image" alt=""></div>
                        <div class="member-info">
                            <h4>Pets Full Grooming</h4>
                            <span>There are many variations of passages of ipsum available but the majority red.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="member">
                        <div class="pic"><img src="assets/images/checkup.jpg" class="img-fluid radius-image" alt=""></div>
                        <div class="member-info">
                            <h4>Pet Spa Services</h4>
                            <span>There are many variations of passages of ipsum available but the majority red.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="member">
                        <div class="pic"><img src="assets/images/styling.jpg" class="img-fluid radius-image" alt=""></div>
                        <div class="member-info">
                            <h4>Styling Your Pet</h4>
                            <span>There are many variations of passages of ipsum available but the majority red.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="w3l-contact-2" id="contact">
        <div class="container py-lg-4 py-md-3 py-2">
            <div class="title-content text-center">
                <div class="row">
                    <div class="col-lg-11">
                        <h6 class="title-subw3hny mb-1">Booking</h6>
                        <h3 class="title-w3l mb-5">Make an Appointment!</h3>
                    </div>
                    <div class="col-lg-1">
                        <a class="title-subw3hny" href="view-request.php">Your Booking</a>
                    </div>
                </div>
            </div>

            <div class="contact-grids">
                <div class="contact-right mt-lg-4">
                    <form method="post" class="signin-form row">
                        <div class="col-lg-6">
                            <label class="form-lable">Service Type:</label>
                            <select class="contact-input" required name="service" onchange="getTotal(this)" id="service">
                                <option value="">Choose Service</option>
                                <?php
                                    $resService = mysqli_query($conn, "SELECT SR_Id, ServiceName FROM service_type WHERE ServiceStatus = 1");
                                    if(mysqli_num_rows($resService)>0){
                                        while($rowService = mysqli_fetch_assoc($resService)){
                                            echo "<option value='$rowService[SR_Id]'>$rowService[ServiceName]</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Service Price:</label>
                            <input type="text" name="total" class="contact-input" id="total" readonly value="0.00">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Appointment Date:</label>
                            <input type="date" name="date" value="<?php echo date('Y-m-d');?>" class="contact-input" required="" min<?php echo date('Y-m-d');?>>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Your Name:</label>
                            <input type="text" name="name" class="contact-input" required="" placeholder="Enter your name.">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Your Phone No:</label>
                            <input type="text" name="phone" class="contact-input" required="" placeholder="Enter your phone number." pattern="[0-9]{6,13}" maxlength="13" title="Kindly enter valid phone number.">
                        </div>
                        <div class="form-input"><label class="form-lable">Your Address:</label>
                            <textarea name="address" placeholder="Enter your address." required=""></textarea>
                        </div>
                        <div class="submit-w3l-button text-lg-right">
                            <button class="btn btn-style btn-primary" name="request">Submit request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function getTotal(sel) {
            var serviceData = sel.value;

            $.ajax({
                    url: 'assets/ajax/service-data.php',
                    method: 'POST',
                    data: {
                        serviceId: serviceData
                    },
                    success: function(data) {
                        document.getElementById("total").value = data;
                    },
                    error: function() {
                        alert('j');
                        $("#service").val(0).change();
                    }
                })
        }
    </script>

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