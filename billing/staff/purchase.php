<?php 
    session_start();
        
    require_once '../../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_staff_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    if (!empty($_GET['did'])) {
        if (mysqli_query($conn, "DELETE product_purchase, purchase_temp FROM product_purchase INNER JOIN purchase_temp ON purchase_temp.billno = product_purchase.billno WHERE product_purchase.id = '$_GET[did]'")){
            
            echo "<script>alert('Yay, Purchase deleted successfully..');location.href='purchase.php';</script>";     
        } else {

            echo "<script>alert('Oops, Unable to delete purchase.');location.href='purchase.php';</script>";
        }
    }
    ?>

    <div class="pcoded-content">
        <div class="card">
            <div class="card-header">
                <div class="col-sm-12 ">
                    <h4 style="float: left;">Manage Purchase</h4>
                    <a href="addpurchase.php" class="btn btn-danger pull-right btn-sm" style="float: right;">Add New</a>
                </div>
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive table-sm">
                    <table id="dom-jqry" class="table table-hover table-bordered nowrap ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Bill No</th>
                                <th>Company</th>
                                <th>GSTIN</th>
                                <th>Bill Date</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $resData = mysqli_query($conn, "select product_purchase.id, product_purchase.vendor_id, product_purchase.total_gst as pgst, product_purchase.total_discount as pdiscount, product_purchase.total_amount, vendor_master.PhoneNo, vendor_master.PhoneNo2, vendor_master.Address, vendor_master.FullName, vendor_master.GSTIN, product_purchase.billno, product_purchase.bill_date, product_purchase.grand_total from product_purchase join vendor_master on vendor_master.VM_Id = product_purchase.vendor_id where product_purchase.purchase_status = 1 order by product_purchase.id desc");
                        if(mysqli_num_rows($resData)>0)
                        {
                            $cnt = 1;
                            while($row = mysqli_fetch_assoc($resData))
                            {
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['billno']; ?></td>
                                <td><?php echo $row['FullName']; ?></td>
                                <td><?php echo $row['GSTIN']; ?></td>
                                <td><?php echo $row['bill_date']; ?></td>
                                <td class="text-right"><?php echo number_format($row['grand_total'], 2); ?></td>
                                <td>    
                                    <a href="viewpurchase.php?id=<?php echo $row['id']?>"><i class="feather icon-eye"></i></a> | 
                                    <a href="purchase.php?did=<?php echo $row['id']?>" onclick="return confirm('Are you sure to delete this record?')"><i class="feather icon-trash"></i></a>
                                </td>
                            </tr>
                            <?php  
                            $cnt++; 
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php

        require_once './pages/footer.php';
    ?>