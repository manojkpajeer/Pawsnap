<?php 
    session_start();
        
    require_once '../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    if (isset($_GET['deletecode'])) {
        if (mysqli_query($conn, "DELETE FROM purchase_temp WHERE product_id = '$_GET[deletecode]' AND vendor_id = '$_GET[vendor_id]' AND billno = '$_GET[billno]' AND bill_date = '$_GET[billdate]' AND status = 0")) {
            echo "<script>location.href='next-barcode-purchase.php?vendor_id=$_GET[vendor_id]&billno=$_GET[billno]&billdate=$_GET[billdate]';</script>";
        } else {
            echo "<script>alert('Oops, Unable to process your request..');location.href='next-barcode-purchase.php?vendor_id=$_GET[vendor_id]&billno=$_GET[billno]&billdate=$_GET[billdate]';</script>";
        }
    }
    
    if (isset($_POST['update'])) {
        if (isset($_POST['product_id'])) {
            $countq = count($_POST['product_id']);
            for($i=0;$i<$countq;$i++){
                $tdquantity = $_POST['tdquantity'][$i];
                $tdprice = $_POST['tdprice'][$i];
                $tddiscount = $_POST['tddiscount'][$i];
                $tdproduct_id = $_POST['product_id'][$i];
                mysqli_query($conn, "UPDATE purchase_temp SET quantity = '$tdquantity', price = '$tdprice', discount = '$tddiscount' WHERE product_id = '$tdproduct_id' AND vendor_id = '$_GET[vendor_id]' AND billno = '$_GET[billno]' AND bill_date = '$_GET[billdate]' AND status = 0");
                mysqli_error($conn);
            }
        }  
    }
    
    if (isset($_POST['submit'])) {
        if (isset($_POST['product_id'])) {
            if (empty($_POST['mtotal'])) {
                echo "<script>alert('Oops, Total amount should not be empty..');</script>";
            } else if (empty($_POST['mdiscount'])) {
                echo "<script>alert('Oops, Discount amount should not be empty..');</script>";
            } else if (empty($_POST['mgst'])) {
                echo "<script>alert('Oops, Discount amount should not be empty..');</script>";
            } else if (empty($_POST['mgrand'])) {
                echo "<script>alert('Oops, Discount amount should not be empty..');</script>";
            } else{
                $rescheck = mysqli_query($conn, "SELECT id FROM product_purchase WHERE billno = '$_GET[billno]' AND purchase_status = 1 AND vendor_id = '$_GET[vendor_id]' AND bill_date = '$_GET[billdate]' ");
                if (mysqli_num_rows($rescheck)>0) {
                    echo "<script>alert('Purchase already exist..');</script>";
                } else {
                    if (mysqli_query($conn, "INSERT INTO product_purchase (bill_date, vendor_id, billno, total_amount, grand_total, total_gst, total_discount, purchase_status) VALUES ('$_GET[billdate]', '$_GET[vendor_id]', '$_GET[billno]', '$_POST[mtotal]', '$_POST[mgrand]', '$_POST[mgst]', '$_POST[mdiscount]', '1') ")) {
                        if (mysqli_query($conn, "UPDATE purchase_temp SET status = 1 WHERE vendor_id = '$_GET[vendor_id]' AND billno = '$_GET[billno]' AND bill_date = '$_GET[billdate]' AND status = 0")) {
                            echo "<script>alert('Yay, Purchase added successfully..');location.href='add-barcode-purchase.php';</script>";
                        } else {
                            echo "<script>alert('Oops, Unable to add purchase..');location.href='next-barcode-purchase.php?vendor_id=$_GET[vendor_id]&billno=$_GET[billno]&billdate=$_GET[billdate]';</script>";
                        }
                    } else {
                        echo "<script>alert('Oops, Unable to add purchase..');location.href='next-barcode-purchase.php?vendor_id=$_GET[vendor_id]&billno=$_GET[billno]&billdate=$_GET[billdate]';</script>";
                    }
                } 
            }
        } else {
            echo "<script>alert('Oops, Kindly add product..');</script>";
        }
    }
    
?>
<div class="pcoded-content">
    <div class="card">
        <div class="card-block">
            <div id="page-wrapper">
                <div class="container-fluid">
                    <form role="form" method="POST">
                        <div class="row">
                            <div class="col-lg-12">
                                <span style="float: left;font-size: 16px;"><?php echo "Bill No: <strong>" . $_GET['billno'] . "</strong>&nbsp;&nbsp;&nbsp;&nbsp;Bill Date :<strong>" . $_GET['billdate'] . "</strong>"?></span>
                                <a href="add-barcode-purchase.php" class="btn btn-danger pull-right btn-sm" style="float: right;">Back</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">                                
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <label>Product Code</label>
                                                            <input class="form-control" name="product_no" placeholder="Enter Product Code.." type="text" onblur="myInsertFunction(this.value)">
                                                        </div> 
                                                    </div>
                                                    <div class="col-lg-7 text-right">
                                                        <br>
                                                        <button class="btn btn-success btn-sm" name="update">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            function myInsertFunction(barcode){
                                                var barcode_no = barcode;
                                                var billno = '<?php echo $_GET['billno'];?>';
                                                var vendor_id = '<?php echo $_GET['vendor_id'];?>';
                                                var billdate = '<?php echo $_GET['billdate'];?>';
                                                
                                                $.ajax({
                                                    url: 'barcode_data.php',
                                                    method: 'POST',
                                                    data: {
                                                        barcode_no: barcode_no,
                                                        vendor_id: vendor_id,
                                                        billno: billno,
                                                        billdate: billdate,
                                                    },
                                                    success: function(data) {
                                                        var res = $.parseJSON(data);
                                                        if (res.status_code < 0) {
                                                            alert(res.message);
                                                            window.location.href='add-barcode-purchase.php';
                                                        } else if (res.status_code == 0) {
                                                            alert(res.message);
                                                        } else if (res.status_code > 0) {
                                                            location.reload();
                                                        }
                                                    
                                                    },
                                                    error: function() {
                                                        alert('Oops, Unable to process..');
                                                        window.location.href='add-barcode-purchase.php';
                                                    }
                                                })
                                            }
                                        </script>

                                        <div class="table-responsive table-sm">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Code</th>
                                                        <th scope="col">Item</th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col">Rate</th>
                                                        <th scope="col">Disc(%)</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $count = 1;
                                                        $resval = mysqli_query($conn, "SELECT product_master.PM_Id, product_master.ProductCode, product_master.ProductName, purchase_temp.quantity, purchase_temp.price, purchase_temp.discount FROM purchase_temp JOIN product_master ON product_master.PM_Id = purchase_temp.product_id WHERE purchase_temp.vendor_id = '$_GET[vendor_id]' AND purchase_temp.billno = '$_GET[billno]' AND purchase_temp.bill_date = '$_GET[billdate]' AND purchase_temp.status = 0");
                                                        while ($rowval = mysqli_fetch_assoc($resval)) {
                                                            ?>  
                                                                <tr>
                                                                    <th><?php echo $count;?></th>
                                                                    <td class="pl-1 pr-0"><input type="hidden" value="<?php echo $rowval['PM_Id'];?>" name="product_id[]"/><input class="form-control form-control-sm" value="<?php echo $rowval['ProductCode'];?>" readonly></td>
                                                                    <td class="pl-1 pr-0"><input class="form-control form-control-sm" value="<?php echo $rowval['ProductName'];?>" readonly></td>
                                                                    <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="tdquantity[]" placeholder="Enter Quantity" required type="number" min="1" value="<?php echo $rowval['quantity'];?>"></td>
                                                                    <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="tdprice[]" placeholder="Enter Rate" required min="1" type="number" step="0.01" value="<?php echo $rowval['price'];?>"></td>
                                                                    <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="tddiscount[]" placeholder="Enter Discount" required type="number" max="100" min="0" value="<?php echo $rowval['discount'];?>"></td>
                                                                    <td class="pl-1 pr-0"><input class="form-control form-control-sm" value="<?php echo number_format($rowval['quantity'] * $rowval['price'], 2);?>" readonly></td>
                                                                    <td class="text-center"><a href="next-barcode-purchase.php?vendor_id=<?php echo $_GET['vendor_id'] . "&billno=" .$_GET['billno'] . "&billdate=" . $_GET['billdate'] . "&deletecode=" . $rowval['PM_Id'];?>" class="text-danger"><i class="feather icon-trash"></i></a></td>
                                                                </tr>
                                                            <?php
                                                            $count ++;
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-lg-9">
                                                <label style="float: right; margin-top:10px">Total:</label>
                                            </div>
                                            <div class="col-lg-2">
                                                <input class="form-control form-control-sm" name="mtotal" placeholder="Total Price" min="1" type="number" step="0.01">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-9">
                                                <label style="float: right; margin-top:10px">Discount Amount:</label>
                                            </div>
                                            <div class="col-lg-2">
                                                <input class="form-control form-control-sm" name="mdiscount" placeholder="Discount Amount" type="number" min="1" step="0.01">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-9">
                                                <label style="float: right; margin-top:10px">Total GST:</label>
                                            </div>
                                            <div class="col-lg-2">
                                                <input class="form-control form-control-sm" name="mgst" placeholder="Total GST" min="1" type="number" step="0.01">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-9">
                                                <label style="float: right; margin-top:10px">Grand Total:</label>
                                            </div>
                                            <div class="col-lg-2">
                                                <input class="form-control form-control-sm" name="mgrand" placeholder="Total Price" min="1" type="number" step="0.01">
                                            </div>
                                        </div>

                                        <div class="float-right mt-4 mr-5">
                                            <button class="btn btn-danger" name="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php

    require_once './pages/footer.php';
?>