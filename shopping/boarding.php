<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    if(empty($_SESSION['is_customer_login'])){

        echo "<script>alert('Oops, Kindly login to proceed..');location.href='../login.php';</script>";
    }

    if(isset($_POST['submit'])){

        $customerId = $_SESSION['user_id'];

        if(empty($_FILES['pimage']['name'])){

            if(mysqli_query($conn, "INSERT INTO boarding_master(OwnerName, PhoneNumber, Location, BoardingDate, Recomened, PetName, 
                PetAge, PetHabbit, VaccinationDetails, IllnessDetails, BoardingStatus, DateCreated, UserId, BoardingRemarks)VALUES('$_POST[oname]', '$_POST[ophone]', 
                '$_POST[olocation]', '$_POST[odate]', '$_POST[orecomend]', '$_POST[pname]', '$_POST[page]', '$_POST[phabbit]', 
                '$_POST[pvaccine]', '$_POST[pillness]', 'Requested', NOW(), '$customerId', 'Pending admin approval')")){

                echo "<script>location.href='view-boarding.php';</script>";
            } else{

                echo "<script>alert('Oops, Unable to process..');</script>";
            }
        }else{
            
            $image_path = "assets/images/boarding/" . time() . "." . pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION);
            if(move_uploaded_file($_FILES['pimage']['tmp_name'], "admin/".$image_path)){

                if(mysqli_query($conn, "INSERT INTO boarding_master(OwnerName, PhoneNumber, Location, BoardingDate, Recomened, PetName, 
                    PetAge, PetHabbit, VaccinationDetails, IllnessDetails, BoardingStatus, DateCreated, PetImage, UserId, BoardingRemarks)VALUES('$_POST[oname]', '$_POST[ophone]', 
                    '$_POST[olocation]', '$_POST[odate]', '$_POST[orecomend]', '$_POST[pname]', '$_POST[page]', '$_POST[phabbit]', 
                    '$_POST[pvaccine]', '$_POST[pillness]', 'Requested', NOW(), '$image_path', '$customerId', 'Pending admin approval')")){

                    echo "<script>location.href='view-boarding.php';</script>";
                } else{

                    echo "<script>alert('Oops, Unable to process your request..');</script>";
                }
            } else{

                echo "<script>alert('Oops, Unable to process your request..');</script>";
            }
        }
    }

?>    
    <section class="w3l-test my-3">
        <div class="container py-lg-4 py-md-4 pt-5 pb-5">
            <div class="row">
                <div class="col-lg-9">
                    <h3 class="title-w3l">The Best Brording service.</h3>
                </div>
                <div class="col-lg-3">
                    <h3 class="title-w3l float-end"><a class="btn btn-primary" href="view-boarding.php">Your Request</a></h3>
                </div>
            </div>
            <div class="row">
                <div class="contact-grids">
                    <form method="post" class="signin-form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 py-sm-4">
                                <h6 class="title-subw3hny">Owner Details</h6>
                                <input type="text" name="oname" placeholder="Your Name*" class="contact-input mt-3" required="">
                                <input type="text" name="ophone" placeholder="Your Phone Number*" title="Enter valid phone number" class="contact-input" required="" pattern="[0-9]{6,13}" maxlength="13">
                                <input type="text" name="olocation" placeholder="Your Location*" class="contact-input" required="">
                                <input type="date" name="odate" placeholder="Boarding Date*" value="<?php echo date('Y-m-d');?>" class="contact-input" required="" min="<?php echo date('Y-m-d'); ?>">
                                <input type="text" name="orecomend" placeholder="Who Recommended Us*" class="contact-input" required="">
                            </div>
                            <div class="col-lg-6 py-sm-4 pt-0">
                                <h6 class="title-subw3hny">Pet Details</h6>
                                <input type="text" name="pname" placeholder="Pet Name*" class="contact-input mt-3" required="">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" name="page" placeholder="Pet Age*" class="contact-input" required="">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="file" name="pimage" placeholder="Pet Image*" class="contact-input" accept="image/*">
                                    </div>
                                </div>
                                <input type="text" name="phabbit" placeholder="Any Food Habbit*" class="contact-input" required="">
                                <input type="text" name="pvaccine" placeholder="Vaccination Details*" class="contact-input" required="">
                                <input type="text" name="pillness" placeholder="Any Recent Illness*" class="contact-input" required="">
                            </div>
                        </div>
                        <div class="submit-w3l-button text-lg-right">
                                <button type="submit" class="btn btn-style btn-primary" name="submit">Submit</button>
                            </div>
                    </form>
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