<?php 
    session_start();
        
    require_once '../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

$grand_total = 0;
$res1 = mysqli_query($conn, "SELECT * FROM sales WHERE billno = '$_GET[billno]' AND sales_status = 1");
if(mysqli_num_rows($res1)>0){
    $res1 = mysqli_fetch_assoc($res1);
}
else{
    echo "<script>alert('Oops, Unable to process your request..!');location.href='add-billing-barcode.php';</script>";
}

?>

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

<div class="pcoded-content">
    <div class="card">
        <div class="card-block">
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 style="float: left;">
                                <button class="btn btn-light" onclick="printDiv('printableArea')"><i class="feather icon-printer"></i></button>
                            </h4>
                            <a href="add-billing-barcode.php" class="btn btn-danger pull-right btn-sm" style="float: right;">New</a>
                        </div>
                    </div>
                    <div class="row" id="printableArea">
                        <div class="col-sm-12">
                            <div class="panel panel-default invoice" id="invoice">
                                <div class="panel-body p-3">
                                    <div class="row">
                                        <div class="col-sm-12 text-center mt-3">
                                            <h4 class="marginright">PAWS AND FUR - Invoice</h4>
                                        </div>
                                    </div>
			                        <hr>
                                    <div class="row">
                                        <div class="col-4">
                                            <?php
                                                $rescust = mysqli_query($conn, "SELECT * FROM billing_customer WHERE BC_Id = '$res1[customer_id]'");
                                                if (mysqli_num_rows($rescust) > 0) {
                                                    $rescust  = mysqli_fetch_assoc($rescust);
                                                } else {
                                                    // echo "<script>alert('Oops, Unable to process your request..!');location.href='add-billing-barcode.php';</script>";
                                                }
                                            ?>
                                            <p class="h6 w-75"><?php echo $rescust['FullName'];?></p>
                                            <p class="h6 mt-2">Phone: <?php echo $rescust['PhoneNo'];?></p>
                                            <p class="h6 mt-1">Phone2: <?php echo $rescust['SecondaryNo'];?></p>
                                            <p class="h6 mt-1">Email: <?php echo $rescust['EmailId'];?></p>
                                            <p class="h6 mt-1 pr-3">Address: <?php echo $rescust['Address'];?></p>
                                        </div>

                                        <div class="col-4">
                                            <p class="h6">Bill No: #<?php echo $res1['billno'];?></p>
                                            <p class="h6 mt-1">Date: <?php echo date('d-M-Y', strtotime($res1['bill_date']));?></p>
                                            <p class="h6 mt-1">Time: -</p>
                                        </div>

                                        <div class="col-4">
                                            <p class="h6"><b>PAWS AND FUR</b></p>
                                            <p class="h6 mt-1">Sai Harsha Square Building, </p>
                                            <p class="h6 mt-1">Dr. Shyanprasad Mukarjee,</p>
                                            <p class="h6 mt-1">Road, Koladapete,</p>
                                            <p class="h6 mt-1">Udupi - 576 101</p>
                                            <p class="h6 mt-1">Phone: 819 763 9736</p>
                                            <p class="h6 mt-1">GSTIN: 29AAZFP5847M1ZY</p>
                                        </div>

                                    </div>
                                    <div class="row table-row mt-3 mr-3">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width:5%">Sl.No</th>
                                                    <th style="width:35%">Item Description</th>
                                                    <th class="text-right" style="width:12%">Quantity</th>
                                                    <th class="text-right" style="width:12%">MRP</th>
                                                    <th class="text-right" style="width:12%">Discount</th>
                                                    <th class="text-right" style="width:12%">GST(%)</th>
                                                    <th class="text-right" style="width:12%">Rate</th>
                                                    <th class="text-right" style="width:12%">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $res2 = mysqli_query($conn, "SELECT product_master.ProductName as pname, sales_temp.quantity, product_master.Price, product_master.Discount, product_master.GST FROM sales_temp JOIN product_master ON product_master.PM_Id = sales_temp.product_id WHERE sales_temp.billno = '$_GET[billno]'");
                                                if(mysqli_num_rows($res2)>0){
                                                    $count = 1;
                                                    while($row2 = mysqli_fetch_assoc($res2)){
                                                        $discount_rate = $row2['Price'] * ($row2['Discount'] /100);
                                                        $product_price = $row2['Price'] - $discount_rate ;
                                                        $total_price = $product_price * $row2['quantity'];
                                                        $grand_total += $total_price; 
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $count; ?></td>
                                                            <td><?php echo $row2['pname']; ?></td>
                                                            <td class="text-right"><?php echo $row2['quantity']; ?></td>
                                                            <td class="text-right"><?php echo number_format($row2['Price'], 2); ?></td>
                                                            <td class="text-right"><?php echo $discount_rate; ?></td>
                                                            <td class="text-right"><?php echo $row2['GST']; ?></td>
                                                            <td class="text-right"><?php echo number_format($product_price, 2); ?></td>
                                                            <td class="text-right"><?php echo number_format($total_price, 2); ?></td>
                                                        </tr>
                                                    <?php
                                                        $count++;
                                                    }
                                                }
                                                else{
                                                    // echo "<script>alert('Oops, Items not found..!');location.href='purchase.php';</script>";
                                                }
                                            ?>			    
                                        </tbody>
                                    </table>
			                    </div>

                                <div class="row mr-3">
                                    <div class="col-6 pt-3">
                                    </div>
                                    <div class="col-6 text-right pull-right invoice-total pr-2">
                                        <p class="h6 mt-2"><b>Total : <?php echo number_format($grand_total, 2);?></b></p>
                                        <p class="h6 mt-2"><b>Discount : 
                                            <?php 
                                                $mdiscount = $grand_total * ($res1['discount'] /100);
                                                $final_total = $grand_total - $mdiscount;
                                                echo number_format($mdiscount, 2);
                                                echo "</b></p>";
                                            ?>
			                        </div>
			                    </div>
            <div class="row text-right pull-right mr-3">
                <div class="col-6"></div>
                <div class="col-6 h5"><hr><b>Grand Total: <span class="pl-3"><?php echo number_format($final_total, 2);?></span></b><hr></div>
            </div>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">*******THANK YOU*******</div>
                <div class="col-4"></div>
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