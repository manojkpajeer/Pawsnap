<?php 
    session_start();
        
    require_once '../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

$billno = time();
$res9 = mysqli_query($conn, "SELECT billno FROM sales WHERE sales_status = 1 ORDER BY id DESC LIMIT 1");
if(mysqli_num_rows($res9)>0){
  $row9=mysqli_fetch_assoc($res9);
  $billno = $row9['billno']+1;
}

if (isset($_POST['submit'])) {
  if (!empty($_POST['customer_id'])) {
    echo "<script>location.href='next-billing-barcode.php?billno=" . $billno . "&billdate=" . $_POST['billdate'] . "&customer_id=" . $_POST['customer_id'] . "'</script>";
  } else {
    echo "<script>alert('Oops, Kindly select valid customer..');</script>";
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
                            <h4 style="float: left;">Add Sales</h4>
                            <a href="view-sales.php" class="btn btn-danger pull-right btn-sm" style="float: right;">View Sales</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">                                
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="POST">
                                                <div class="row mt-3">
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Customer Name</label>
                                                            <input type="hidden" name="customer_id" value="" id="customer_id"/>
                                                            <input type="text" class="form-control" autocomplete="off" placeholder="Enter Customer Name" onkeyup="myFunction()" id="myInput" name="customer_name" required>
                                                            <ul class="list-group-flush mb-0 bg-light" id="myUL" style="display: none;">
                                                              <?php
                                                                $sql1 = ("SELECT BC_Id, FullName FROM  billing_customer  where Status = 1 ");
                                                                $result1 = mysqli_query($conn, $sql1);
                                                                while ($row1 = mysqli_fetch_assoc($result1)){
                                                                  ?>
                                                                  <li><a class="dropdown-item d-flex align-items-center gap-2 py-2 list-group-item list-group-item-action list-group-item-primary" href="#" onclick="setVal('<?php echo $row1['BC_Id'];?>')">
                                                                    <?php 
                                                                      echo $row1['FullName']; ?>
                                                                    </a>
                                                                  </li>
                                                                <?php
                                                                }
                                                              ?>
                                                            </ul>
                                                        </div> 
                                                    </div>
                                                    <script>
                                                      function myFunction() {
                                                          var input, filter, ul, li, a, i, txtValue;
                                                          input = document.getElementById("myInput");
                                                          filter = input.value.toUpperCase();
                                                          ul = document.getElementById("myUL");
                                                          li = ul.getElementsByTagName("li");
                                                          if(input.value!=""){
                                                              ul.style.display = "";
                                                              var flag = false;
                                                              for (i = 0; i < li.length; i++) {
                                                                  a = li[i].getElementsByTagName("a")[0];
                                                                  txtValue = a.textContent || a.innerText;
                                                                  if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                                      flag = true;
                                                                      li[i].style.display = "";
                                                                  } else {
                                                                      li[i].style.display = "none";
                                                                  }
                                                              }
                                                              if(!flag){
                                                                  document.getElementById("addnew").style.display = "block";
                                                              }
                                                          } 
                                                          else{
                                                              ul.style.display = "none";
                                                              document.getElementById("addnew").style.display = "none";
                                                          }
                                                      }

                                                      function setVal(v){
                                                        document.getElementById("customer_id").value = v ;
                                                        document.getElementById("myUL").style.display = "none";
                                                        $.ajax({
                                                            url:'customer_data.php',
                                                            method:'POST',
                                                            data:{
                                                                id:v,
                                                            },
                                                            success:function(data){
                                                                var res = $.parseJSON(data);
                                                                $('#myNumber').val(res.phone);
                                                                document.getElementById("myInput").value=res.name;
                                                            }
                                                        });
                                                      }

                                                    </script>
                                                    <div class="col-1">
                                                      <div class="form-group">
                                                          <label>&nbsp;</label>
                                                          <a href="customer.php" id="addnew" class="btn btn-danger btn-sm w-75" style="display: none;">Add</a>
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                      <div class="form-group">
                                                          <label>Phone Number </label>
                                                          <input readonly id="myNumber" class="form-control" name="customer_phone"/>
                                                      </div>
                                                    </div>
                                                    <div class="col-lg-2" >
                                                        <div class="form-group">
                                                            <label>Bill Date</label>
                                                            <input type="date" class="form-control form-control-sm" name="billdate" placeholder="Enter Bill Date" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" required >
                                                        </div>
                                                    </div> 
                                                    <div class="col-lg-2" >
                                                        <div class="form-group">
                                                            <label>Bill Number</label>
                                                            <input readonly value="<?php echo $billno; ?>" class="form-control" name="billno">
                                                        </div>
                                                    </div> 
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                          <br>
                                                            <input type="submit" name="submit" value="next" class="btn btn-danger"/>
                                                        </div>
                                                    </div>          
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