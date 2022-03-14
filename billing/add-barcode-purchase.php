<?php 
    session_start();
        
    require_once '../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    if (isset($_POST['barcode_next'])) {
        $rescheck = mysqli_query($conn, "SELECT id FROM product_purchase WHERE billno = '$_POST[billno]' AND purchase_status = 1 AND vendor_id = '$_POST[vendor_id]' AND bill_date = '$_POST[billdate]' ");
        if (mysqli_num_rows($rescheck)>0) {
            echo "<script>alert('Purchase already exist..');</script>";
        } else {
            echo "<script>location.href='next-barcode-purchase.php?vendor_id=$_POST[vendor_id]&billno=$_POST[billno]&billdate=$_POST[billdate]';</script>";
        } 
    }
?>

<div class="pcoded-content">
    <div class="card">
        <div class="card-block">
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 style="float: left;">Add Purchase</h4>
                            <a href="purchase.php" class="btn btn-danger pull-right btn-sm" style="float: right;">View Purchase</a>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="panel panel-default">                                
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">                                            
                                            <form role="form" method="POST">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for=" Products">Select Vendor</label>
                                                            <select  name="vendor_id" required class="form-control form-control-sm">
                                                                <?php
                                                                    $sql1 = ("SELECT VM_Id, FullName FROM  vendor_master  where Status=1 ");
                                                                    $result1 = mysqli_query($conn, $sql1);
                                                                    echo "<option value=''>Select</option>";
                                                                    while ($row1 = mysqli_fetch_assoc($result1)){ ?>
                                                                        <option value="<?php echo $row1['VM_Id']; ?>"><?php echo $row1['FullName']; ?></option>";
                                                                        <?php 
                                                                    } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Bill Number</label>
                                                            <input class="form-control form-control-sm" name="billno" placeholder="Enter Bill Number"  required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Bill Date</label>
                                                            <input type="date" class="form-control form-control-sm" name="billdate" placeholder="Enter Bill Date" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" required >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row col-12">
                                                    <input type="submit" class="btn btn-danger px-4" name="barcode_next" value="Next"/>
                                                </div>
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php

        require_once './pages/footer.php';
    ?>