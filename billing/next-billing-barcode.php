<?php 
    session_start();
        
    require_once '../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

$total_amount = 0;

if (isset($_GET['deletecode'])) {
    mysqli_query($conn, "DELETE FROM sales_temp WHERE product_id = '$_GET[deletecode]' AND billno = '$_GET[billno]' AND status = 0");
}


if (isset($_POST['submit'])) {
  if (isset($_POST['product_id'])) {
    $rescheck = mysqli_query($conn, "SELECT id FROM sales WHERE billno = '$_GET[billno]'");
    if (mysqli_num_rows($rescheck)>0) {
        echo "<script>alert('Bill Number already exist..');</script>";
    } else {
        if (mysqli_query($conn, "INSERT INTO sales (customer_id, billno, bill_date, discount, sales_status, paid, remark) VALUES ('$_GET[customer_id]', '$_GET[billno]', '$_GET[billdate]', '$_POST[mdiscount]', 1, '$_POST[mpaid]', '$_POST[mremark]') ")) {
          if (mysqli_query($conn, "UPDATE sales_temp set status = 1 WHERE billno = '$_GET[billno]'")) {
              echo "<script>alert('Yay, Sales added successfully..');location.href='view-bill.php?billno=".$_GET['billno']."';</script>";
          } else {
              echo "<script>alert('Oops, Unable to add sales..');</script>";
          }
        } else {
            echo "<script>alert('Oops, Unable to add sales..');</script>";
        }
    } 
  } else {
      echo "<script>alert('Oops, Kindly add product..');</script>";
  }
}
?>



<div class="pcoded-content pb-5">
  <form class="form-valide" method="POST" name="userform" enctype="multipart/form-data">
      <div class="row p-2">
        <div class="col-lg-5">
            <div class="form-group">
                <input class="form-control" autocomplete="off" name="product_no" placeholder="Enter Product Code.." type="text" onblur="myInsertFunction(this.value)">
            </div> 
        </div>
        <div class="col-lg-5">
          <strong class="text-danger" id="alert_container" style="font-size: 18px;"></strong>
        </div>
        <div class="col-2"><strong style="font-size: 15px;"><?php echo "Bill NO : " . $_GET['billno'];?></strong></div>
      </div>

      <script>
            function myInsertFunction(barcode){
                var barcode_no = barcode;
                var billno = '<?php echo $_GET['billno']; ?>';
                
                $.ajax({
                    url: 'barcode_sales_data.php',
                    method: 'POST',
                    data: {
                        barcode_no: barcode_no,
                        billno: billno,
                    },
                    success: function(data) {
                        var res = $.parseJSON(data);
                        if (res.status_code == 0) {
                          document.getElementById("alert_container").innerHTML = res.message;
                          setTimeout(function(){
                              document.getElementById("alert_container").innerHTML = '';
                          }, 2000);
                        } else if (res.status_code == 1) {
                          location.reload();
                        }
                    
                    },
                    error: function() {
                        document.getElementById("alert_container").innerHTML = 'Oops, Unknown error..';
                          setTimeout(function(){
                              document.getElementById("alert_container").innerHTML = '';
                          }, 2000);
                    }
                })
            }
        </script>

        <div class="table-responsive table-sm p-2">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Item</th>
                        <th scope="col">MRP</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Disc(%)</th>
                        <th scope="col">GST(%)</th>
                        <th class="text-right">Amount</th>
                        <th class="text-right">Total</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $count = 1;
                        $resval = mysqli_query($conn, "SELECT product_master.PM_Id, product_master.ProductCode, product_master.ProductName, product_master.GST, product_master.Discount, product_master.price, sales_temp.quantity FROM sales_temp JOIN product_master ON product_master.PM_Id = sales_temp.product_id WHERE sales_temp.billno = '$_GET[billno]' ");
                        while ($rowval = mysqli_fetch_assoc($resval)) {
                            $payblePrice = $rowval['price']-($rowval['price'] * ($rowval['Discount'] / 100));
                            $totalPayble = $payblePrice * $rowval['quantity'];
                            $total_amount += $totalPayble ;
                            ?>  
                                <tr>
                                    <th><?php echo $count;?></th>
                                    <td class="pl-1 pr-0"><input  type="hidden" value="<?php echo $rowval['PM_Id'];?>" name="product_id[]"/><?php echo $rowval['ProductCode'];?></td>
                                    <td class="pl-1 pr-0"><?php echo $rowval['ProductName'];?></td>
                                    <td class="pl-1 pr-0"><?php echo $rowval['price'];?></td>
                                    <td class="pl-1 pr-0"><input class="form-control form-control-sm w-25" name="tdquantity[]" placeholder="Enter Quantity" required value="<?php echo $rowval['quantity'];?>" type="number" min="1" onkeyup="calculatereTotalPrice('<?php echo $rowval['PM_Id'];?>', this)"></td>
                                    <td class="pl-1 pr-0"><?php echo $rowval['Discount'];?></td>
                                    <td class="pl-1 pr-0"><?php echo $rowval['GST'];?></td>
                                    <td class="pl-1 pr-0 text-right"><?php echo number_format($payblePrice, 2);?></td>
                                    <td class="pl-1 pr-0 text-right"><?php echo number_format($totalPayble, 2);?></td>
                                    <td class="text-center"><a href="next-billing-barcode.php?billno=<?php echo $_GET['billno']; ?>&billdate=<?php echo $_GET['billdate']; ?>&customer_id=<?php echo $_GET['customer_id']; ?>&deletecode=<?php echo $rowval['PM_Id'];?>" class="text-danger"><i class="feather icon-trash"></i></a></td>
                                </tr>
                            <?php
                            $count ++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <script>
          function calculatereTotalPrice(id, qty){
            var product_id = id ;
            var quantity = qty.value ;
            var billno = '<?php echo $_GET['billno']; ?>';
            $.ajax({
                url: 'update-quantity.php',
                method: 'POST',
                data: {
                  product_id: product_id,
                  quantity: quantity,
                    billno: billno
                },
                success: function(data) {
                    var res = $.parseJSON(data);
                    if (res.status_code == 0) {
                        document.getElementById("alert_container").innerHTML = res.message;
                        setTimeout(function(){
                            document.getElementById("alert_container").innerHTML = '';
                        }, 2000);
                    } else if (res.status_code == 1) {
                        location.reload();
                    }             
                },
                error: function() {
                    document.getElementById("alert_container").innerHTML = 'Oops, Unknown error..';
                    setTimeout(function(){
                        document.getElementById("alert_container").innerHTML = '';
                    }, 2000);
                }
            })         
          }
        </script>


      <div class="row">
        <div class="col-lg-9">
          <label style="float: right; margin-top:10px">Total:</label>
        </div>
        <div class="col-lg-2">
          <input class="form-control form-control-sm text-right" id="subtotal" name="mprice" readonly value="<?php echo $total_amount;?>"/>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-9">
            <label style="float: right; margin-top:10px">Discount(%):</label>
        </div>
        <div class="col-lg-2">
            <input class="form-control form-control-sm  text-right" id="adddisc" name="mdiscount" placeholder="Enter Discount" required max="100" min=0 type="number" value="0">
        </div>
      </div>

      <div class="row">
          <div class="col-lg-9">
              <label style="float: right; margin-top:10px">Grand Total:</label>
          </div>
          <div class="col-lg-2">
              <input class="form-control form-control-sm text-right" id="gtotal" name="mtotal" readonly value="<?php echo $total_amount;?>">
          </div>
      </div>

      <div class="row">
          <div class="col-lg-1">
              <label style="float: right; margin-top:10px">Remark:</label>
          </div>
          <div class="col-lg-4">
          <input type="text" name="mremark" id="remark" class="form-control" placeholder="Enter Remark" value="">
          </div>
          <div class="col-lg-3">
              <label class="text-danger" style="font-size:16px;">Pending : </label> <span style="font-size: 18px;" id="pending_text">0.00</span>
          </div>
          <div class="col-lg-1">
              <label style="float: right; margin-top:10px">Paid:</label>
          </div>
          <div class="col-lg-2">
              <input class="form-control form-control-sm text-right" id="paid" name="mpaid" placeholder="Paid Price" required value="<?php echo $total_amount;?>">
          </div>
      </div>
      <button type="submit" class="btn btn-danger px-3 btn-sm mt-3" name="submit" style="float: right;margin-right:100px">Submit</button>
      <a class="btn btn-outline-success px-3 btn-sm mt-3" style="float: right;margin-right:10px" href="add-billing-barcode.php">New</a>
    </form>
</div>
</div>
</div>
</div>
</div>
</div>
<?php

require_once './pages/footer.php';
?>
<script type="text/javascript">

$(document).ready(function() {

     
     $('tbody.mydiv').on("keyup",'input[name^="quantity"]',function(event){
          var currentRow=$(this).closest('.subdiv');
          var quantity =currentRow.find('input[name^="quantity"]').val();
          //alert(quantity);
          var unitprice=currentRow.find('input[name^="rate"]').val();
         //alert(unitprice);
        
          var total = Number(quantity) * Number(unitprice);
          var total=+currentRow.find('input[name^="total"]').val(total);
         // $('#subtotal').val(total);
         var sum = 0;
        $('.total').each(function() {
            if($(this).val()!='')
            {
              sum = sum  + parseFloat($(this).val());
            }
            
        });

        var sub = $('#subtotal').val(sum.toFixed(2));
        
        var final_disc = $('#adddisc').val();
        var final_tot = $('#subtotal').val();
        var tval = final_tot - final_tot * (final_disc/100)
        $('#gtotal').val(tval.toFixed(2));
        
      //   if($('#paid').val()>0){
      //   var final_paid = $('#paid').val();
      //   var final_tot = $('#gtotal').val();
      //   var tval1 = final_tot - final_paid
      //   $('#pending').val(tval1.toFixed(2));
      // }
      // else{
        $('#paid').val(tval1.toFixed(2));
      // }
});

});



 $('tbody.mydiv').on("change",'select[name^="select_services"]',function(event){
  var currentRow=$(this).closest('.subdiv');
  var drop_services= $(this).val();
  $.ajax({
      type : "POST",
      url  : 'myajax.php',
      data : {id:drop_services },
      success: function(data){
        currentRow.find('input[name^="quantity"]').val(1);
        var res= jQuery.parseJSON(data);
        currentRow.find('input[name^="rate"]').val(res.price);
        currentRow.find('input[name^="discount"]').val(res.discount);
        currentRow.find('input[name^="gstrate"]').val(res.gst);
        var tval = res.price - res.price * (res.discount/100)
        currentRow.find('input[name^="total"]').val(tval.toFixed(2));
        var sum = 0;
        $('.total').each(function() {
            if($(this).val()!='')
            {
              sum = sum  + parseFloat($(this).val());
            }
            
        });

        var sub = $('#subtotal').val(sum.toFixed(2));
        var tot_commi = 0;
        var final_disc = $('#adddisc').val();
        var final_tot = $('#subtotal').val();
        var tval1 = final_tot - final_tot * (final_disc/100)
        $('#gtotal').val(tval1.toFixed(2));

        // if($('#paid').val()>0){
        //   var final_paid = $('#paid').val();
        //   var final_tot = $('#gtotal').val();
        //   var tval1 = final_tot - final_paid
        //   $('#pending').val(tval1.toFixed(2));
        // }
        // else{
          $('#paid').val(tval1.toFixed(2));
        // }
        }
    });
});


$('#adddisc').on("keyup",function() {
  var final_disc = parseFloat($('#adddisc').val());
  if (final_disc >= 0 && final_disc < 100){
    var final_tot = parseFloat('<?php echo $total_amount; ?>');
    var tval1 = (final_tot - (final_tot * (final_disc/100)));
    $('#gtotal').val(tval1);
    $('#paid').val(tval1);
  } else {
    $('#adddisc').val('0');
  }
  

  // if($('#paid').val()>0){
  //   var final_paid = $('#paid').val();
  //   var final_tot = $('#gtotal').val();
  //   var tval1 = final_tot - final_paid
  //   $('#pending').val(tval1.toFixed(2));
  // }
  // else{
    
  // }
  });

  $('#paid').on("keyup",function() {
  var final_tot = parseFloat($('#gtotal').val());
  var final_paid = $('#paid').val();
  var tval1 = final_tot - final_paid
  $('#pending_text').text(tval1.toFixed(2));
  });
        
</script>


<script>
    $(document).ready(function () {
      var rowIdx = 1;
      $('#badd').on('click', function () {
        $('tbody.mydiv').append(`<tr id="R${++rowIdx}" class="subdiv"><td>${rowIdx}</td><td class="pl-0 pr-0"><select  name="select_services[]" required class="form-control form-control-sm w-100 select_services" onchange="getPrice(this)">
<?php
     $sql1 = ("SELECT PM_Id, ProductName FROM  product_master  where Status=1 ");
     $result1 = mysqli_query($conn, $sql1);
     echo "<option value=''>Select</option>";
 while ($row1 = mysqli_fetch_assoc($result1)){ ?>
        <option value="<?php echo $row1['PM_Id']; ?>"><?php echo $row1['ProductName']; ?></option>";
      <?php } ?>

                        
?></select></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="quantity[]" placeholder="Enter Quantity" required type="number" min="1" id="quantitya" value="1"></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="rate[]" readonly  id="ratea"></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="discount[]" readonly id="discounta"></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm" name="gstrate[]" readonly id="gsta"></td>
      <td class="pl-1 pr-0"><input class="form-control form-control-sm total" name="total[]" readonly id="total"></td>
      <td> <span class="badge rounded-pill bg-danger badge-md bremove"><i class="feather icon-minus"></i></span></td>
    </tr>`);
      });
  
      // jQuery button click event to remove a row.
      $('tbody.mydiv').on('click', '.bremove', function () {
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
    var sum = 0;
        $('.total').each(function() {
            if($(this).val()!='')
            {
              sum = sum  + parseFloat($(this).val());
            }
            
        });

        var sub = $('#subtotal').val(sum.toFixed(2));
      });
    });
  </script>

