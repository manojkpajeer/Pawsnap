<?php 
    session_start();
        
    require_once '../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    $sql= "select product_purchase.total_amount, product_purchase.total_discount, product_purchase.total_gst, vendor_master.FullName, vendor_master.GSTIN, product_purchase.billno, product_purchase.bill_date, product_purchase.grand_total from product_purchase join vendor_master on vendor_master.VM_Id = product_purchase.vendor_id where product_purchase.purchase_status = 1 order by product_purchase.id desc";

    if (isset($_POST['filter'])) {
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $sql= "select product_purchase.total_amount, product_purchase.total_discount, product_purchase.total_gst, vendor_master.FullName, vendor_master.GSTIN, product_purchase.billno, product_purchase.bill_date, product_purchase.grand_total from product_purchase join vendor_master on vendor_master.VM_Id = product_purchase.vendor_id where product_purchase.purchase_status = 1 AND (bill_date BETWEEN '$_POST[fromdate]' AND '$_POST[todate]') order by product_purchase.id desc";
        }
    } 
    ?>

    <div class="pcoded-content">
        <div class="card">
            <div class="card-header pb-0 row">
                <div class="col-5"><h4>Purchase Report</h4></div>
                <div class="form-check col-7">
                    <form method="POST">
                        <strong class="float-left">Filter By</strong>
                        <label class="form-check-label float-left">From&nbsp;</label>
                        <input type="date" name="fromdate" class="form-control form-control-sm w-25 mr-2 float-left" required max="<?php echo date('Y-m-d');?>" value="<?php if(isset($_POST['fromdate'])) { echo $_POST['fromdate'];}?>"/>
                        <label class="form-check-label float-left">To&nbsp;</label>
                        <input type="date" name="todate" class="form-control form-control-sm w-25 mr-2 float-left" required max="<?php echo date('Y-m-d');?>" value="<?php if(isset($_POST['todate'])) { echo $_POST['todate'];} else { echo date('Y-m-d');}?>"/>
                        <button name="filter" class="btn btn-sm btn-danger float-left"><i class="feather icon-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive table-sm">
                    <table id="dom-jqry" class="table table-hover table-bordered nowrap ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Company</th>
                                <th>GSTIN</th>
                                <th>Bill No</th>
                                <th>Bill Date</th>
                                <th>Total Amount</th>
                                <th>Total Discount</th>
                                <th>Total GST</th>
                                <th>Gross Total</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $resData = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($resData)>0)
                        {
                            $cnt = 1;
                            while($row = mysqli_fetch_assoc($resData))
                            {
                            ?>
                            <tr>
                                <th><?php echo $cnt; ?></th>
                                <td><?php echo $row['FullName']; ?></td>
                                <td><?php echo $row['GSTIN']; ?></td>
                                <td><?php echo $row['billno']; ?></td>
                                <td><?php echo $row['bill_date']; ?></td>
                                <td class="text-right"><?php echo number_format($row['total_amount'], 2); ?></td>
                                <td class="text-right"><?php echo number_format($row['total_discount'], 2); ?></td>
                                <td class="text-right"><?php echo number_format($row['total_gst'], 2); ?></td>
                                <td class="text-right"><?php echo number_format($row['grand_total'], 2); ?></td>
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
    <button onclick="printData()" class="btn-danger" style="position:fixed;width:40px;height:40px;bottom:40px;right:40px;border-radius:50px;text-align:center;">
        <i class="feather icon-printer"></i>
    </button>
    <script>
        function printData() {
            var divToPrint=document.getElementById("dom-jqry");
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
    </script>
    <?php

        require_once './pages/footer.php';
    ?>