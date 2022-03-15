<?php 
$data=$_POST['id'];
require_once '../../assets/config/connect.php';
$res = mysqli_query($conn, "select GSTIN from vendor_master where VM_Id = '$data'");
$result= mysqli_fetch_assoc($res);
echo $result['GSTIN'];
?>