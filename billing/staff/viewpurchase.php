<?php 
    session_start();
        
    require_once '../../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_staff_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    $res = mysqli_query($conn, "select product_purchase.vendor_id, vendor_master.FullName, vendor_master.Address, vendor_master.PhoneNo, vendor_master.GSTIN, vendor_master.PhoneNo2, product_purchase.billno, product_purchase.bill_date, product_purchase.total_amount, product_purchase.total_discount as pdiscount, product_purchase.total_gst as pgst, product_purchase.grand_total from product_purchase join vendor_master on product_purchase.vendor_id = vendor_master.VM_Id where product_purchase.id = '$_GET[id]' ");
    if(mysqli_num_rows($res)>0){
        $row = mysqli_fetch_assoc($res);
    }
    else{
        echo "<script>alert('Oops, Unable to process your request..!');location.href='purchase.php';</script>";
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
<div class="pcoded-content pl-5 pr-5 pt-3">
    <button class="btn btn-light" onclick="printDiv('printableArea')"><i class="feather icon-printer"></i></button>
    <a href="purchase.php" class="btn btn-danger pull-right btn-sm" style="float: right;">Back</a>
<div class="container bootstrap snippets bootdeys" id="printableArea">
<div class="row p-2">
  <div class="col-sm-12">
	  	<div class="panel panel-default invoice" id="invoice">
		  <div class="panel-body p-3">
		    <div class="row">
				<div class="col-sm-12 text-center mt-3">
						<h4 class="marginright"><?php echo $row['FullName'];?></h4>
			    </div>

			</div>
			<hr>
			<div class="row">
				<div class="col-4">
					<p class="h6 w-75"><?php echo $row['Address'];?></p>
					<p class="h6 mt-2">Phone: <?php echo $row['PhoneNo'];?></p>
					<p class="h6 mt-1">Phone2: <?php echo $row['PhoneNo2'];?></p>
					<p class="h6 mt-1">GSTIN: <?php echo $row['GSTIN'];?></p>
				</div>

				<div class="col-4">
                    <p class="h6">Bill No: <?php echo $row['billno'];?></p>
					<p class="h6 mt-1">Date: <?php echo $row['bill_date'];?></p>
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
			          <th class="text-right" style="width:12%">Rate</th>
			          <th class="text-right" style="width:12%">Discount(%)</th>
			          <th class="text-right" style="width:12%">GST(%)</th>
			          <th class="text-right" style="width:12%">Amount</th>
			        </tr>
			      </thead>
			      <tbody>
                    <?php
                        $res1 = mysqli_query($conn, "select product_master.ProductName as pname , purchase_temp.quantity, purchase_temp.price, purchase_temp.discount from purchase_temp join product_master on purchase_temp.product_id = product_master.PM_Id where purchase_temp.billno = '$row[billno]' and purchase_temp.bill_date = '$row[bill_date]' and purchase_temp.vendor_id = '$row[vendor_id]'");
                        if(mysqli_num_rows($res1)>0){
                            $count = 1;
                            while($row1 = mysqli_fetch_assoc($res1)){
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $count; ?></td>
                                    <td><?php echo $row1['pname']; ?></td>
                                    <td class="text-right"><?php echo $row1['quantity']; ?></td>
                                    <td class="text-right"><?php echo $row1['price']; ?></td>
                                    <td class="text-right"><?php echo number_format($row1['discount'], 2); ?></td>
                                    <td class="text-right"><?php echo "18%"; ?></td>
                                    <td class="text-right"><?php echo number_format(($row1['quantity']*$row1['price']), 2); ?></td>
                                </tr>
                            <?php
                            }
                        }
                        else{
                            echo "<script>alert('Oops, Items not found..!');location.href='purchase.php';</script>";
                        }
                    ?>			    
			       </tbody>
			    </table>

			</div>

			<div class="row mr-3">
			<div class="col-6">
			</div>
			<div class="col-6 text-right pull-right invoice-total pr-2">
					  <p class="h6 mt-2"><b>Total : <?php echo number_format($row['total_amount'], 2);?></b></p>
					  <p class="h6 mt-2"><b>Discount : <?php echo number_format($row['pdiscount'], 2);?></b></p>
					  <p class="h6 mt-2"><b>Total GST : <?php echo number_format($row['pgst'], 2);?></b></p>
			</div>
			</div>
            <div class="row text-right pull-right mr-3">
                <div class="col-6"></div>
                <div class="col-6 h5"><hr><b>Grand Total: <span class="pl-3"><?php echo number_format($row['grand_total'], 2);?></span></b><hr></div>
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
</div>

<div id="#">
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