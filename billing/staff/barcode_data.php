<?php
    require_once '../../assets/config/connect.php';
    
    if (!empty($_POST['vendor_id']) && !empty($_POST['billdate']) && !empty($_POST['billno'])) {
        if (!empty($_POST['barcode_no'])) {
            $resbar = mysqli_query($conn, "SELECT PM_Id FROM product_master WHERE ProductCode = '$_POST[barcode_no]' AND Status = 1");
            if (mysqli_num_rows($resbar)>0) {
                $resbar = mysqli_fetch_assoc($resbar);
                $resqty = mysqli_query($conn, "SELECT quantity FROM purchase_temp WHERE vendor_id = '$_POST[vendor_id]' AND billno = '$_POST[billno]' AND bill_date = '$_POST[billdate]' AND product_id = '$resbar[PM_Id]' AND status = 0");
                if (mysqli_num_rows($resqty)>0) {
                    $rowqty = mysqli_fetch_assoc($resqty);
                    $quantity = $rowqty['quantity'] + 1 ;
                    if(mysqli_query($conn, "UPDATE purchase_temp SET quantity = '$quantity' WHERE vendor_id = '$_POST[vendor_id]' AND billno = '$_POST[billno]' AND bill_date = '$_POST[billdate]' AND product_id = '$resbar[PM_Id]' AND status = 0")) {
                        $data['status_code'] = 1;
                        $data['message'] = 'Yay, Product added successfully..';
                    } else {
                        $data['status_code'] = 0;
                        $data['message'] = 'Oops, Unable to add product..';
                    }
                } else {
                    if(mysqli_query($conn, "INSERT INTO purchase_temp (vendor_id, product_id, billno, bill_date, quantity, discount, price, status) VALUES('$_POST[vendor_id]', '$resbar[PM_Id]', '$_POST[billno]', '$_POST[billdate]', 1, 0, '0', 0)")) {
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
        $data['status_code'] = -1;
        $data['message'] = 'Oops, Unable to process yor request..';
    }
    echo json_encode($data);
?>