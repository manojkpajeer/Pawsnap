<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    if(empty($_SESSION['is_customer_login'])){

        echo "<div class='text-center my-5'>
                <img src='assets/images/error.png' class='img-fluid' width='360'>
                <h3 class='mt-3'>Oops..<br>Kindly login to proceed. <br>Click <a href='login.php?source=book-grooming'>here</a> to login</h3>
            </div>";
    } else{

        if(isset($_POST['submit'])){
            if(empty($_POST['serviceType'])){
                echo "<script type='text/javascript'>toastr.error('Kindly choose service to proceed.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>"; 
            }else{
                
                $customerId = $_SESSION['user_id'];
                $TokenNo = time(). strtoupper(uniqid());

                if(mysqli_query($conn, "INSERT INTO grooming_request (DateCreate, GroomingStatus, Remarks, UserId, TokenNo) VALUES 
                    (NOW(), 'Initiated', 'Request initiated by user', '$customerId', '$TokenNo')")){

                    $serviceType = $_POST['serviceType'];  
                    $sql = "insert into service_temp(TokenNo, ServiceId, DateCreate, Status) values ";  

                    $i = 0;
                    foreach($serviceType as $type)  
                    { 
                        if ($i > 0) {
                            $sql .= ",";
                        }
                        $sql .= "('$TokenNo', '$type', NOW(), 1)";
                        $i++;
                    }  
                    
                    if(mysqli_query($conn, $sql)){
                        echo "<script>location.href='comfirm-grooming.php?source=$TokenNo';</script>";
                    } else{
                        echo "<script type='text/javascript'>toastr.error('Unable to process your request, Kindly try after sometimes.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>"; 
                    }
                }else{
                    echo "<script type='text/javascript'>toastr.error('Unable to process your request, Kindly try after sometimes.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>"; 
                }
            }
        }

?>  

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    label {
        width: 100%;
        font-size: 1rem;
    }

    .card-input-element+.card:hover {
        cursor: pointer;
    }

    .card-input-element:checked+.card {
        border: 1px solid #ff0000;
        -webkit-transition: border .3s;
        -o-transition: border .3s;
        transition: border .3s;
    }

    .card-input-element:checked+.card::after {
        content: '\e5ca';
        color: #ff0000;
        font-family: 'Material Icons';
        font-size: 24px;
        -webkit-animation-name: fadeInCheckbox;
        animation-name: fadeInCheckbox;
        -webkit-animation-duration: .5s;
        animation-duration: .5s;
        -webkit-animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

@-webkit-keyframes fadeInCheckbox {
  from {
    opacity: 0;
    -webkit-transform: rotateZ(-20deg);
  }
  to {
    opacity: 1;
    -webkit-transform: rotateZ(0deg);
  }
}

@keyframes fadeInCheckbox {
  from {
    opacity: 0;
    transform: rotateZ(-20deg);
  }
  to {
    opacity: 1;
    transform: rotateZ(0deg);
  }
}
</style>  
    <section class="w3l-test">
        <div class="container py-lg-4 py-md-4 pt-5 pb-5">
        <?php
            $resService = mysqli_query($conn, "SELECT SR_Id, ServiceName, ServiceDescription, ServicePrice FROM service_type WHERE ServiceStatus = 1");
            if(mysqli_num_rows($resService)>0){
                ?>
                <h3 class="title-w3l">Choose Service!</h3>
                <div class="row">
                    <div class="contact-grids">
                        <form method="POST" class="signin-form row" name="myForm">
                            <?php
                                while($rowService = mysqli_fetch_assoc($resService)){
                                ?>
                                    <div class="col-lg-4 mt-5">
                                        <label>
                                            <input type="checkbox" name="serviceType[]" value="<?php echo $rowService['SR_Id'];?>" class="card-input-element d-none">
                                            <div class="card bg-light d-flex flex-row justify-content-between align-items-center">
                                                <div class="member card-body text-center">
                                                    <div class="pic"><img src="assets/images/error.png" class="img-fluid radius-image" alt="Service"></div>
                                                    <div class="member-info mt-3">
                                                        <h5><?php echo $rowService['ServiceName'];?></h5>
                                                        <span><?php echo $rowService['ServiceDescription'];?></span>
                                                        <a class="btn btn-outline-primary mt-3">Rs. <?php echo number_format($rowService['ServicePrice'], 2);?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                            <?php 
                                } 
                                ?>
                            <div class="submit-w3l-button text-lg-right mt-5">
                                <button type="submit" class="btn btn-style btn-primary" name="submit">Next  <i class="fas fa-arrow-right ms-lg-3 ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
            }else{
                echo "<div class='text-center'>
                    <img src='assets/images/error.png' class='img-fluid' width='360'>
                    <h3 class='mt-3'>Oops..<br>Unable to process.</h3>
                </div>";
            }
            ?>
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