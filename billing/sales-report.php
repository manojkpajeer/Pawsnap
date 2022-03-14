<?php 
    session_start();
        
    require_once '../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    $sql= "SELECT billing_customer.FullName, billing_customer.PhoneNo, sales.billno, sales.bill_date, sales.discount FROM sales JOIN billing_customer ON billing_customer.BC_Id = sales.customer_id WHERE sales.sales_status = 1 ORDER BY sales.id DESC";
    if (isset($_POST['filter'])) {
        if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
            $sql= "SELECT billing_customer.FullName, billing_customer.PhoneNo, sales.billno, sales.bill_date, sales.discount FROM sales JOIN billing_customer ON billing_customer.BC_Id = sales.customer_id WHERE sales.sales_status = 1 AND (bill_date BETWEEN '$_POST[fromdate]' AND '$_POST[todate]') ORDER BY sales.id DESC";
        }
    } 
    ?>

    <div class="pcoded-content">
        <div class="card">
            <div class="card-header pb-0 row">
                <div class="col-5"><h4>Sales Report</h4></div>
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
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Bill No</th>
                                <th>Bill Date</th>
                                <th class="text-right">Bill Amount</th>
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
                                $grand_total = 0;
                                $res2 = mysqli_query($conn, "SELECT sales_temp.quantity, product_master.Price, product_master.Discount FROM sales_temp JOIN product_master ON product_master.PM_Id = sales_temp.product_id WHERE sales_temp.billno = '$row[billno]' AND sales_temp.status = 1");
                                if(mysqli_num_rows($res2)>0){
                                    while($row2 = mysqli_fetch_assoc($res2)){
                                        $discount_rate = $row2['Price'] * ($row2['Discount'] /100);
                                        $product_price = $row2['Price'] - $discount_rate ;
                                        $total_price = $product_price * $row2['quantity'];
                                        $grand_total += $total_price; 
                                    }
                                }
                                
                                $mdiscount = $grand_total * ($row['discount'] /100);
                                $final_total = $grand_total - $mdiscount;
                            ?>
                            <tr>
                                <td><?php echo $cnt; ?></td>
                                <td><?php echo $row['FullName']; ?></td>
                                <td><?php echo $row['PhoneNo']; ?></td>
                                <td><?php echo $row['billno']; ?></td>
                                <td><?php echo $row['bill_date']; ?></td>
                                <td class="text-right"><?php echo number_format($final_total, 2); ?></td>
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