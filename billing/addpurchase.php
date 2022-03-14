<?php 
    session_start();
        
    require_once '../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    if(isset($_POST['btn']))
    {
    $res = mysqli_query($conn, "SELECT id FROM product_purchase WHERE billno = '$_POST[billno]' AND purchase_status = 1 AND vendor_id = '$_POST[vendor_id]' AND bill_date = '$_POST[billdate]'");
    if(mysqli_num_rows($res)>0){
        echo "<script>alert('This bill number already in use, Kindly use different bill number..!');</script>";
    }
    else{
        mysqli_query($conn, "DELETE FROM purchase_temp WHERE billno = '$_POST[billno]' AND vendor_id = '$_POST[vendor_id]' AND bill_date = '$_POST[billdate]' AND status = 0");
        $countq = count($_POST['product_id']);
        $insertPurchaseMaster = "INSERT INTO purchase_temp(vendor_id, product_id, billno, bill_date, quantity, discount, price, status) VALUES";
        for($i=0;$i<$countq;$i++){
            if ($i > 0) {
                $insertPurchaseMaster .= ',';
            }
            $insertPurchaseMaster .= "('".$_POST['vendor_id']."', '".$_POST['product_id'][$i]."', '".$_POST['billno']."', '".$_POST['billdate']."', '".$_POST['quantity'][$i]."', '".$_POST['discount'][$i]."', '".$_POST['rate'][$i]."', 0)";
        }
        if (mysqli_query($conn, $insertPurchaseMaster)) {
            $rescheck = mysqli_query($conn, "SELECT id FROM product_purchase WHERE billno = '$_POST[billno]' AND purchase_status = 1 AND vendor_id = '$_POST[vendor_id]' AND bill_date = '$_POST[billdate]' ");
            if (mysqli_num_rows($rescheck)>0) {
                echo "<script>alert('Purchase already exist..');</script>";
            } else {
                if (mysqli_query($conn, "INSERT INTO product_purchase (bill_date, vendor_id, billno, total_amount, grand_total, total_gst, total_discount, purchase_status) VALUES ('$_POST[billdate]', '$_POST[vendor_id]', '$_POST[billno]', '$_POST[mprice]', '$_POST[mtotal]', '$_POST[mgst]', '$_POST[mdiscount]', '1') ")) {
                if (mysqli_query($conn, "UPDATE purchase_temp SET status = 1 WHERE vendor_id = '$_POST[vendor_id]' AND billno = '$_POST[billno]' AND bill_date = '$_POST[billdate]' AND status = 0")) {
                    echo "<script>alert('Yay, Purchase added successfully..');location.href='addpurchase.php';</script>";
                } else {
                    echo "<script>alert('Oops, Unable to add purchase..');</script>";
                }
                } else {
                    echo "<script>alert('Oops, Unable to add purchase..');</script>";
                }
            }
        } else{
            echo "<script>alert('Oops, Unable to add purchase..!');</script>";
        }
    }
    }

    ?>
 <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
  </script>
  <script src=
"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
  </script>
  <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
  </script>
<script>
    $(document).ready(function () {
      var rowIdx = 0;

      $('#badd').on('click', function () {
        $('#tbody').append(`<tr id="R${++rowIdx}"><td>${rowIdx}</td><td class="pl-0 pr-0"><select  name="product_id[]" required class="form-control form-control-sm w-100">
<?php
     $sql1 = ("SELECT id, name FROM  products  where status=1 ");
     $result1 = mysqli_query($conn, $sql1);
     echo "<option value=''>Select</option>";
 while ($row1 = mysqli_fetch_assoc($result1)){ ?>
        <option value="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></option>";
      <?php } ?>

                        
?></select></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="quantity[]" placeholder="Enter Quantity" required type="number" min="1" value="1"></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="rate[]" placeholder="Enter Rate" required min="1" type="number" step="0.01"></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="discount[]" placeholder="Enter Discount" required type="number" max="100" value="0" min="0"></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="gstrate[]" placeholder="Enter GST" required type="number" max="100" value="18" min="0"></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="total[]" placeholder="Enter Total Amount" required type="number" min="1" step="0.01"></td>
      <td> <span class="badge rounded-pill bg-danger badge-md bremove"><i class="feather icon-minus"></i></span></td>
    </tr>`);
      });
  
      // jQuery button click event to remove a row.
      $('#tbody').on('click', '.bremove', function () {
          if(rowIdx>0){  
        // Getting all the rows next to the row
        // containing the clicked button
        var child = $(this).closest('tr').nextAll();
  
        // Iterating across all the rows 
        // obtained to change the index
        child.each(function () {
  
          // Getting <tr> id.
          var id = $(this).attr('id');
  
          // Getting the <p> inside the .row-index class.
          var idx = $(this).children('.row-index').children('p');
  
          // Gets the row number from <tr> id.
          var dig = parseInt(id.substring(1));
  
          // Modifying row index.
          idx.html(`Row ${dig - 1}`);
  
          // Modifying row id.
          $(this).attr('id', `R${dig - 1}`);
        });
  
        // Removing the current row.
        $(this).closest('tr').remove();
        rowIdx--;
    }
      });
    });
  </script>
  <div class="pcoded-content">
<div class="card">
<div class="card-block">
<form  method="post" enctype="multipart/form-data">

            <div id="page-wrapper">
                <div class="container-fluid">
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                          
                                            <form role="form">

                                                   <div class="row">
                                                    <div class="col-lg-3">
                                                    <div class="form-group">
                                                <label for=" Products">Select Vendor</label>
    <select  name="vendor_id" required class="form-control form-control-sm" onchange="getPhone(this)">
<?php
     $sql1 = ("SELECT VM_Id, FullName FROM  vendor_master  where Status=1 ");
     $result1 = mysqli_query($conn, $sql1);
     echo "<option value=''>Select</option>";
 while ($row1 = mysqli_fetch_assoc($result1)){ ?>
        <option value="<?php echo $row1['VM_Id']; ?>"><?php echo $row1['FullName']; ?></option>";
      <?php } ?>

                        
?></select></div></div>
<script type="text/javascript">
  function getPhone(valueId){
    var selectedValue = valueId.value;
    $.ajax({
      url:'vendor-data.php',
      method:'POST',
      data:{
          id:selectedValue,
      },
      success:function(data){
          $('#myGST').val(data);
      }
  });
  }
</script>

                                                <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>GSTIN</label>
                                                    <input class="form-control form-control-sm" id = "myGST" name="gst" readonly placeholder="GSTIN Number" value="<?php #echo $result['gstin']?>" required pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" title="Enter Valid GST Number." oninput="this.value = this.value.toUpperCase()">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                </div>
                                                <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>Bill Number</label>
                                                    <input class="form-control form-control-sm" name="billno" placeholder="Enter Bill Number"  required >
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                <div class="form-group">
                                                    <label>Bill Date</label>
                                                    <input type="date" class="form-control form-control-sm" name="billdate" placeholder="Enter Bill Date" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" required >
                                                    </div>
                                                </div>
                                                   </div>
                                                   <div class="row">
                                                   <div class="table-responsive ">
<table class="table table-hover table-borderless table-sm">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Product&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
      <th scope="col">Quantity</th>
      <th scope="col">Rate</th>
      <th scope="col">Disc(%)</th>
      <th scope="col">GST(%)</th>
      <th scope="col">Amount</th>
      <th scope="col"><span class="badge rounded-pill bg-primary badge-md" id="badd"><i class="feather icon-plus"></i></span></th>
    </tr>
  </thead>
  <tbody id="tbody">
  <tr>
      <th scope="row">1</th>
      <td class="pl-0 pr-0"><select  name="product_id[]" required class="form-control form-control-sm w-100">
<?php
     $sql1 = ("SELECT PM_Id, ProductName FROM  product_master  where Status=1 ");
     $result1 = mysqli_query($conn, $sql1);
     echo "<option value=''>Select</option>";
 while ($row1 = mysqli_fetch_assoc($result1)){ ?>
        <option value="<?php echo $row1['PM_Id']; ?>"><?php echo $row1['ProductName']; ?></option>";
      <?php } ?>

                        
</select></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="quantity[]" placeholder="Enter Quantity" required type="number" min="1" value="1"></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="rate[]" placeholder="Enter Rate" required min="1" type="number" step="0.01"></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="discount[]" placeholder="Enter Discount" required type="number" max="100" value="0" min="0"></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="gstrate[]" placeholder="Enter GST" required type="number" max="100" value="18" min="0"></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="total[]" placeholder="Enter Total Amount" required type="number" min="1" step="0.01"></td>
    </tr>
    
  </tbody>
</table>
</div>
                                                   </div>

                                                   <div class="row">
                                                       <div class="col-lg-9">
                                                            <label style="float: right; margin-top:10px">Total:</label>
                                                       </div>
                                                        <div class="col-lg-2">
                                                            <input class="form-control form-control-sm" id="pprice" name="mprice" placeholder="Enter Total Price" required min="1" type="number" step="0.01" oninput="calculatePrice()">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                       <div class="col-lg-9">
                                                            <label style="float: right; margin-top:10px">Discount:</label>
                                                       </div>
                                                        <div class="col-lg-2">
                                                            <input class="form-control form-control-sm" id="pprice" name="mdiscount" placeholder="Enter Discount" required min="1" type="number" step="0.01" oninput="calculatePrice()">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                       <div class="col-lg-9">
                                                            <label style="float: right; margin-top:10px">Total GST:</label>
                                                       </div>
                                                        <div class="col-lg-2">
                                                            <input class="form-control form-control-sm" id="pprice" name="mgst" placeholder="Enter Total GST" required min="1" type="number" step="0.01" oninput="calculatePrice()">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                       <div class="col-lg-9">
                                                            <label style="float: right; margin-top:10px">Grand Total:</label>
                                                       </div>
                                                        <div class="col-lg-2">
                                                            <input class="form-control form-control-sm" id="pprice" name="mtotal" placeholder="Enter Total Price" required min="1" type="number" step="0.01" oninput="calculatePrice()">
                                                        </div>
                                                    </div>

                                                    <hr class="dropdown-divider">
                                                    <button type="submit" class="btn btn-danger px-3" name="btn" style="float: right;margin-right:100px">Submit</button>
                                                    <a class="btn btn-outline-success px-3" style="float: right;margin-right:10px" href="addpurchase.php">Clear</a>
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