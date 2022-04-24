<?php

    session_start();

    require_once '../assets/config/connect.php';
    require_once './assets/pages/header-link.php';
    require_once './assets/pages/header.php';
    require_once './assets/pages/cart.php';

    if(empty($_SESSION['is_customer_login'])){

        echo "<div class='text-center my-5'>
                <img src='assets/images/error.png' class='img-fluid' width='360'>
                <h3 class='mt-3'>Oops..<br>Kindly login to proceed. <br>Click <a href='login.php?source=book-boarding'>here</a> to login</h3>
            </div>";
    } else{

        if(isset($_POST['submit'])){

            $customerId = $_SESSION['user_id'];

            if(empty($_FILES['pimage']['name'])){

                if(mysqli_query($conn, "INSERT INTO boarding_master(OwnerName, PhoneNumber, Location, BoardingDate, Recomened, PetName, 
                    PetAge, PetHabbit, VaccinationDetails, IllnessDetails, BoardingStatus, DateCreated, UserId, BoardingRemarks)VALUES('$_POST[oname]', '$_POST[ophone]', 
                    '$_POST[olocation]', '$_POST[odate]', '$_POST[orecomend]', '$_POST[pname]', '$_POST[page]', '$_POST[phabbit]', 
                    '$_POST[pvaccine]', '$_POST[pillness]', 'Requested', NOW(), '$customerId', 'Pending admin approval')")){

                    echo "<script type='text/javascript'>toastr.success('Your request sent successfully.', 'Success!', {positionClass:'toast-bottom-right', closeButton:true, onclick: function() {location.href='view-boarding.php'}})</script>"; 

                } else{

                    echo "<script type='text/javascript'>toastr.error('Unable to process your request, Kindly try after sometimes.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>";      

                }
            }else{
                
                $image_path = "assets/images/boarding/" . time() . "." . pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION);
                if(move_uploaded_file($_FILES['pimage']['tmp_name'], "admin/".$image_path)){

                    if(mysqli_query($conn, "INSERT INTO boarding_master(OwnerName, PhoneNumber, Location, BoardingDate, Recomened, PetName, 
                        PetAge, PetHabbit, VaccinationDetails, IllnessDetails, BoardingStatus, DateCreated, PetImage, UserId, BoardingRemarks)VALUES('$_POST[oname]', '$_POST[ophone]', 
                        '$_POST[olocation]', '$_POST[odate]', '$_POST[orecomend]', '$_POST[pname]', '$_POST[page]', '$_POST[phabbit]', 
                        '$_POST[pvaccine]', '$_POST[pillness]', 'Requested', NOW(), '$image_path', '$customerId', 'Pending admin approval')")){

                        echo "<script type='text/javascript'>toastr.success('Your request sent successfully.', 'Success!', {positionClass:'toast-bottom-right', closeButton:true, onclick: function() {location.href='view-boarding.php'}})</script>"; 

                    } else{

                        echo "<script type='text/javascript'>toastr.error('Unable to process your request, Kindly try after sometimes.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>";      
                    }
                } else{

                    echo "<script type='text/javascript'>toastr.error('Unable to process your request, Kindly try after sometimes.', 'Sorry!', {positionClass:'toast-bottom-right', closeButton:true})</script>";      
                }
            }
        }

?>    
    <section class="w3l-test my-3">
        <div class="container py-lg-4 py-md-4 pt-5 pb-5">
            <h3 class="title-w3l">Book An Appointment Now!</h3>
            <div class="row">
                <div class="contact-grids">
                    <form method="post" class="signin-form row" enctype="multipart/form-data">
                        <h6 class="title-subw3hny mt-4">Owner Details</h6>
                        <div class="col-lg-6 mt-2">
                            <label class="form-lable">Your Name*:</label>
                            <input type="text" name="oname" class="contact-input" required="">
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label class="form-lable">Your Phone No*:</label>
                            <input type="text" name="ophone" title="Enter valid phone number" class="contact-input" required="" pattern="[0-9]{6,13}" maxlength="13">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Your Location*:</label>
                            <input type="text" name="olocation" class="contact-input" required="">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Boarding Date*:</label>
                            <input type="date" name="odate" value="<?php echo date('Y-m-d');?>" class="contact-input" required="" min="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Who Recommended Us*:</label>
                            <input type="text" name="orecomend" class="contact-input" required="">
                        </div>
                        <h6 class="title-subw3hny mt-2">Pet Details*</h6>
                        <div class="col-lg-6 mt-2">
                            <label class="form-lable">Pet Name*:</label>
                            <input type="text" name="pname" class="contact-input" required="">
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label class="form-lable">Pet Age*:</label>
                            <input type="text" name="page" class="contact-input" required="">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Pet Image:</label>
                            <input type="file" name="pimage"class="contact-input" accept="image/*">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Any Food Habbit*:</label>
                            <input type="text" name="phabbit" class="contact-input" required="">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Vaccination Details*:</label>
                            <input type="text" name="pvaccine" class="contact-input" required="">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-lable">Any Recent Illness*:</label>
                            <input type="text" name="pillness" class="contact-input" required="">
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