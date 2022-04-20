<?php

    session_start();

    if(empty($_SESSION['is_customer_login'])){
        
        echo "<script>location.href='login.php';</script>";
    } else{

        require_once '../assets/config/connect.php';

        $orderId = $_GET['prefetch'];

        if(empty($orderId)){

            echo "<script>location.href='index.php';</script>";
        }

        $customerId = $_SESSION['user_id'];

        if(empty($customerId)){

            echo "<script>location.href='login.php';</script>";
        }


        $orderPrice = 0;
        $resOrderData = mysqli_query($conn, "SELECT product_master.Price, product_master.OnlineDiscount, ecom_sales_temp.Quantity FROM ecom_sales_temp JOIN product_master ON product_master.PM_Id = ecom_sales_temp.ProductId WHERE ecom_sales_temp.OrderId = '$orderId'");
        if(mysqli_num_rows($resOrderData)>0){

            while($rowOrderData = mysqli_fetch_assoc($resOrderData)){

                $productPrice = ($rowOrderData['Price'] - ($rowOrderData['Price'] * ($rowOrderData['OnlineDiscount'] / 100)) * $rowOrderData['Quantity']);
                $orderPrice += $productPrice;
            }

            if($orderPrice > 0){

                require '../assets/vendor-stripe/autoload.php';
                
                \Stripe\Stripe::setApiKey('sk_test_51KTpD2SEbPv1KY8xYEaPTuQlverYcY2rQDhZdAEaHlXWyqj2XRV6Qf5DKB6w5Czd0wLIfJGIJjjNunZQProeHJBI00bNjRsOdO');

                header('Content-Type: application/json');

                $SUCCESS_DOMAIN = "http://pawsnap.test/shopping/payment-success.php?success=".$orderId;
                $FAIL_DOMAIN = "http://pawsnap.test/shopping/payment-failed.php?failed=".$orderId;

                $checkout_session = \Stripe\Checkout\Session::create([
                'line_items' => [[
                    
                    'price_data' => [
                        'currency' => 'INR',
                        'product_data' => [
                            'name' => $orderId
                        ],
                        'unit_amount' => $orderPrice * 100
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                    'success_url' => $SUCCESS_DOMAIN,
                    'cancel_url' => $FAIL_DOMAIN,
                ]);

                $intent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);
                
                $transactionID = $intent->id;
                $paidAmount = $intent->amount;
                $paidAmount = ($paidAmount/100);
                $paidCurrency = $intent->currency;
                $paymentStatus = $intent->status;

                if(mysqli_query($conn, "INSERT INTO payment_master (OrderId, TransactionId, PaidCurrency, PaymentStatus, DatePaid, TotalAmount, 
                    CustomerId, PaymentMessage) VALUES ('$orderId', '$transactionID', '$paidCurrency', 'Initiated', NOW(), 
                    '$paidAmount', '$customerId', '$paymentStatus')")){

                    header("HTTP/1.1 303 See Other");
                    header("Location: " . $checkout_session->url);
                } else {

                    $message = openssl_encrypt("Oops, Its unable to place your order due to technical error. Dont worry your money is safe<br> OrderId : ".$orderId."<br> TransactionId : ".$transactionID."<br> TotalAmount : ".$paidAmount." <br>  Contact us <br>Email : pawsnap@web.com <br>Phone : 8745973495", "AES-128-ECB", "MAnoj143");
                    echo "<script>location.href='payment-error.php?pref=$message';</script>";
                }
            } else {

                echo "<script>location.href='index.php';</script>";
            }
        } else{

            echo "<script>location.href='index.php';</script>";
        }
    }

?>