<?php

    session_start();

    if(empty($_SESSION['is_customer_login'])){
        
        echo "<div style='text-align:center;margin-top:50px;'>
                <img src='assets/images/tab_icon.png'/>
                <h3 style='text-align:center;'>Oops..<br>Something went wrong<br><br>Relogin <a href='login.php'>Login</a></h3>
            </div>";
    } else{

        require_once '../assets/config/connect.php';

        if(empty($_GET['prefetch'])){

            echo "<div style='text-align:center;margin-top:50px;'>
                <img src='assets/images/tab_icon.png'/>
                <h3 style='text-align:center;'>Oops..<br>Something went wrong<br><br>Back To Home <a href='index.php'>Login</a></h3>
            </div>";
        }else{
            
            $orderId = $_GET['prefetch'];

            $customerId = $_SESSION['user_id'];

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

                    if(mysqli_query($conn, "INSERT INTO payment_masters (OrderId, TransactionId, PaidCurrency, PaymentStatus, DatePaid, TotalAmount, 
                        CustomerId, PaymentMessage) VALUES ('$orderId', '$transactionID', '$paidCurrency', 'Initiated', NOW(), 
                        '$paidAmount', '$customerId', '$paymentStatus')")){

                        header("HTTP/1.1 303 See Other");
                        header("Location: " . $checkout_session->url);
                    } else {
                        header('Location: payment-error.php?pref='.$orderId);
                    }
                } else {

                    echo "<div style='text-align:center;margin-top:50px;'>
                            <img src='assets/images/tab_icon.png'/>
                            <h3 style='text-align:center;'>Oops..<br>Something went wrong<br><br>Back To Home <a href='index.php'>Login</a></h3>
                        </div>";
                }
            } else{

                echo "<div style='text-align:center;margin-top:50px;'>
                        <img src='assets/images/tab_icon.png'/>
                        <h3 style='text-align:center;'>Oops..<br>Something went wrong<br><br>Back To Home <a href='index.php'>Login</a></h3>
                    </div>";
            }
        }
    }

?>