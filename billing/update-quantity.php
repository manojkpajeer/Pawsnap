<?php
    require_once '../assets/config/connect.php';
    
    if (!empty($_POST['billno'])) {
        if (!empty($_POST['product_id'])) {
            if (!empty($_POST['quantity']) && $_POST['quantity'] > 0) {
                if(mysqli_query($conn, "UPDATE sales_temp SET quantity = '$_POST[quantity]' WHERE billno = '$_POST[billno]' AND product_id = '$_POST[product_id]' ")) {
                    $data['status_code'] = 1;
                    $data['message'] = 'Yay, Product updated successfully..';
                } else {
                    $data['status_code'] = 0;
                    $data['message'] = 'Oops, Unable to update product..';
                }
            }
            else {
                $data['status_code'] = 1;
                $data['message'] = 'Oops, An invalid Quantity..';
            }
        } else {
            $data['status_code'] = 0;
            $data['message'] = 'Oops, Unable to process, Kindly romove & re-scan this product..';
        }
    } else {
        $data['status_code'] = 0;
        $data['message'] = 'Oops, Bill number should not be empty..';
    }
    echo json_encode($data);
?>