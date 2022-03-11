<?php
    $message = $_GET['pref'];
    if(empty($message)){

        echo "Oops, Its unable to place your order due to technical error. Dont worry your money is safe<br> Contact us <br>Email : pawsnap@web.com <br>Phone : 8745973495";
        echo "<br><a href='index.php'>Back to home</a>";
    } else {

        echo openssl_decrypt($message, "AES-128-ECB", "MAnoj143");
        echo "<br><a href='index.php'>Back to home</a>";
    }
 
?>