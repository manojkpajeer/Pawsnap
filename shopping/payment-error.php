<?php
    if(empty($_GET['pref'])){

        echo "Oops, Its unable to place your order due to technical error. Dont worry your money is safe<br> Contact us <br>Email : pawsnap@web.com <br>Phone : 8745973495";
        echo "<br><a href='index.php'>Back to home</a>";
    } else {

        $orderId = $_GET['pref'];
        echo "Its unable to place your order due to technical error. Dont worry your money is safe<br> OrderId : ".$orderId."<br>Contact us <br>Email : pawsnap@web.com <br>Phone : 8745973495";
        echo "<br><a href='index.php'>Back to home</a>";
    }
?>