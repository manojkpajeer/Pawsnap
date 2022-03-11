<?php
    if (isset($_POST['newsLetter'])) {
        $emailNews = $_POST['emailIDS'];

        $resNews = mysqli_query($conn, "SELECT EmailID FROM news_letter WHERE EmailID = '$emailNews'");
        if (mysqli_num_rows($resNews) > 0) {
            
            showAlert("Oops, You are already subscribed..");   
        } else {

            if (mysqli_query($conn, "INSERT INTO news_letter (EmailID, Status, DateCreate) VALUES ('$emailNews', 1, NOW())")) {
                
                showAlert("Yay, You have subscribed successfully..");   
            } else {
                
                showAlert("Oops, Unable to process..");   
            }
        }
        
    }

    function showAlert($msg){
        ?>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fa fa-paw"></i>
                        <strong class="me-auto ms-1">Pawsnap</strong>
                        <h6 class="my-2 text-light"><?php echo $msg; ?></h6>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>    
            </div>
        </div>
        <script>
            var toastLiveExample = document.getElementById('liveToast')
            $(document).ready(function() {
                var toast = new bootstrap.Toast(toastLiveExample)
                toast.show()
            });
        </script> 
        <?php
    }
?>

<section class="w3l-subscription-infhny py-5">
    <div class="container py-md-5">
        <div class="subscription-info text-center mx-auto">
            <h3 class="title-w3l mb-2 text-start">Get On The List</h3>
            <p class="text-start">Subscribe to our newsletter & stay updated</p>

            <form method="post" class="w3l-signin-form mt-4 mb-3">
                <div class="forms-gds">
                    <div class="form-input">
                        <input type="email" name="emailIDS" placeholder="Your email here" required="">
                    </div>
                    <div class="form-input"><button class="btn btn-style btn-primary" name="newsLetter">Subscribe</button></div>
                </div>
            </form>
        </div>
    </div>
</section>