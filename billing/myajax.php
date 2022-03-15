<?php 
$data=$_POST['id'];
require_once '../assets/config/connect.php';
$res = mysqli_query($conn, "SELECT Price, Discount, GST FROM product_master WHERE PM_Id = '$data'");
if(mysqli_num_rows($res)>0){
    $result= mysqli_fetch_assoc($res);
    $response['Price'] = number_format($result['Price'], 2);
    $response['Discount'] = $result['Discount'];
    $response['GST'] = $result['GST'];
}
else{
    $response['Price'] = number_format(0, 2);
    $response['Discount'] = 0;
    $response['GST'] = 0;
}

echo json_encode($response);
?>