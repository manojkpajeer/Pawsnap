<?php
    require_once '../../../assets/config/connect.php';

    $serviceId = $_POST['serviceId'];

    $resService = mysqli_query($conn, "SELECT ServicePrice FROM service_type WHERE SR_Id = '$serviceId'");
    if(mysqli_num_rows($resService)>0){
        $resService = mysqli_fetch_assoc($resService);
        echo number_format($resService['ServicePrice'], 2);
    }else{
        echo "0.00";
    }
?>