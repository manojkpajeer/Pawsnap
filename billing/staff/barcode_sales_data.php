<?php
    require_once '../../assets/config/connect.php';
    
    if (!empty($_POST['billno'])) {
        if (!empty($_POST['barcode_no'])) {
            $resbar = mysqli_query($conn, "SELECT PM_Id FROM product_master WHERE ProductCode = '$_POST[barcode_no]' AND Status = 1");
            if (mysqli_num_rows($resbar)>0) {
                $resbar = mysqli_fetch_assoc($resbar);
                $resqty = mysqli_query($conn, "SELECT quantity FROM sales_temp WHERE billno = '$_POST[billno]' AND product_id = '$resbar[PM_Id]' AND status = 0");
                if (mysqli_num_rows($resqty)>0) {
                    $rowqty = mysqli_fetch_assoc($resqty);
                    $quantity = $rowqty['quantity'] + 1 ;
                    if(mysqli_query($conn, "UPDATE sales_temp SET quantity = '$quantity' WHERE billno = '$_POST[billno]' AND product_id = '$resbar[PM_Id]' AND status = 0")) {
                        $data['status_code'] = 1;
                        $data['message'] = 'Yay, Product added successfully..';
                    } else {
                        $data['status_code'] = 0;
                        $data['message'] = 'Oops, Unable to add product..';
                    }
                } else {
                    if(mysqli_query($conn, "INSERT INTO sales_temp (product_id, billno, quantity, status) VALUES('$resbar[PM_Id]', '$_POST[billno]', 1, 0)")) {
                        $data['status_code'] = 1;
                        $data['message'] = 'Yay, Product added successfully..';
                    } else {
                        $data['status_code'] = 0;
                        $data['message'] = 'Oops, Unable to add product..';
                    }
                }
            } else {
                $data['status_code'] = 0;
                $data['message'] = 'Oops, Barcode does not exist..';
            }
        } else {
            $data['status_code'] = 0;
            $data['message'] = 'Oops, Barcode should not be empty..';
        }
    } else {
        $data['status_code'] = 0;
        $data['message'] = 'Oops, Bill number should not be empty..';
    }
    echo json_encode($data);
?>