
<?php

    session_start();

    require_once '../assets/config/connect.php';
    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Pawsnap - Stripe Payment</title>
    <link rel="icon" href="assets/images/tab_image.png">

    <style>
        body {
            background: #ddd3;
            height: 100vh;
            vertical-align: middle;
            display: flex;
            font-family: Muli;
            font-size: 14px
        }

        .card {
            margin: auto;
            width: 38%;
            max-width: 600px;
            padding: 4vh 0;
            box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-top: 3px solid #ef233c;
            border-bottom: 3px solid #ef233c;
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
            padding: 5% 8%
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
            padding: 2vh 8%;
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
            color: #ef233c
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
            background: rgb(252, 103, 49)
        }
    </style>
  </head>
  <body>

    <div class="card">
        <?php
            if(empty($_GET['success'])){
                ?>
                <div class="info">
                    <div class="row">
                        <div class="col-12"> <span id="heading"><strong class="text-danger">Error</strong> : </span><br> <span id="details">Unable to place your order. Please contact out support.</span> </div>
                    </div>
                </div>
                <?php
            } else {
                $orderId = $_GET['success'];
                
                $resPaymentData = mysqli_query($conn, "SELECT * FROM payment_master WHERE OrderId = '$orderId'");
                if(mysqli_num_rows($resPaymentData)>0){

                    $resPaymentData = mysqli_fetch_assoc($resPaymentData);

                    if(mysqli_query($conn, "UPDATE ecom_sales SET Status = 'Order Placed', PaymentId = '$resPaymentData[PM_Id]', Remarks = 'Order has been placed successfully', DeliveryStatus = 'Order Initiated' WHERE OrderId = '$orderId'")){

                        echo "<div class='title'>Your order placed successfully!</div>";
                        echo "<div class='text-end me-3'><a class='btn btn-sm btn-outline-danger' href='order.php'>View Order</a></div>";
                    } else {
                        echo "<div class='title'>Unable to place your order. Please contact out support!</div>";
                    }
                ?>
                <div class="info">
                    <div class="row">
                        <div class="col-7"> <span id="heading">Date</span><br> <span id="details"><?php echo date_format(date_create($resPaymentData['DatePaid']), 'M d, Y');?></span> </div>
                        <div class="col-5 pull-right"> <span id="heading">Order No.</span><br> <span id="details"><?php echo $orderId;?></span> </div>
                    </div>
                </div>
                <div class="pricing">
                    <div class="row">
                        <div class="col-12"> <span id="name">Transaction ID : <?php echo $resPaymentData['TransactionId']; ?></span> </div>
                    </div>
                    <div class="row">
                        <div class="col-12"> <span id="name">Transaction Status : <?php echo $resPaymentData['PaymentMessage']; ?></span> </div>
                    </div>
                </div>
                <div class="total">
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">Total : Rs.<?php echo number_format($resPaymentData['TotalAmount'], 2)."/-";?></div>
                    </div>
                </div>
                <?php   
                } else {
                    ?>
                    <div class="info">
                        <div class="row">
                            <div class="col-12"> <span id="heading"><strong class="text-danger">Error</strong> : </span><br> <span id="details">Unable to place your order.<br>Your Order Id : <?php echo $orderId;?> <br> Please contact out support.</span> </div>
                        </div>
                    </div>
                    <?php
                }             
            }
        ?>
        
        <div class="progress-track">
            <a href="index.php" class="btn btn-sm btn-danger">Home Page</a>
        </div>
        <div class="footer">
            <div class="row">
                <div class="col-10">Want any help? Please &nbsp;<a href="contact.php"> contact us</a></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
