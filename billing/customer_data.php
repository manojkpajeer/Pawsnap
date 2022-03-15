<?php 
    $cid=$_POST['id'];
    require_once '../assets/config/connect.php';

    $res = mysqli_query($conn, "select PhoneNo, FullName from billing_customer where BC_Id = '$cid'");
    $result= mysqli_fetch_assoc($res);
    $data['phone'] = $result['PhoneNo'];
    $data['name'] = $result['FullName'];

    echo json_encode($data);
?>