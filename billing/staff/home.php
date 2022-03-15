<?php 
  session_start();
    
  require_once '../../assets/config/connect.php';
  
  if(empty($_SESSION['is_billing_staff_login'])){
      echo "<script>location.href='index.php';</script>";
  }

  require_once './pages/header.php';
?>

<div class="pcoded-content">
  <div class="pcoded-inner-content">
    <div class="main-body">
      <div class="page-wrapper full-calender">
        <div class="page-body">
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card bg-c-pink update-card">
                <div class="card-block">
                  <div class="row align-items-end">
                    <div class="col-8">
                      <h4 class="text-white">
                        <?php 
                          $rescust = mysqli_query($conn, "SELECT BC_Id FROM billing_customer WHERE Status = 1");
                          echo mysqli_num_rows($rescust);
                        ?>
                      </h4>
                      <h6 class="text-white m-b-0">Customers</h6>
                    </div>
                    <div class="col-4 text-right">
                      <canvas id="update-chart-2" height="50"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-c-lite-green update-card">
                <div class="card-block">
                  <div class="row align-items-end">
                    <div class="col-8">
                      <h4 class="text-white">
                        <?php 
                          $resprod = mysqli_query($conn, "SELECT PM_Id FROM product_master WHERE status=1");
                          echo mysqli_num_rows($resprod);
                        ?>
                      </h4>
                      <h6 class="text-white m-b-0">Products</h6>
                    </div>
                    <div class="col-4 text-right">
                      <canvas id="update-chart-2" height="50"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-c-yellow update-card">
                <div class="card-block">
                  <div class="row align-items-end">
                    <div class="col-8">
                      <h4 class="text-white">
                        <?php 
                          $ressales = mysqli_query($conn, "SELECT id FROM sales WHERE sales_status=1");
                          echo mysqli_num_rows($ressales);
                        ?>
                      </h4>
                      <h6 class="text-white m-b-0">Sales</h6>
                    </div>
                    <div class="col-4 text-right">
                      <canvas id="update-chart-2" height="50"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card bg-c-green update-card">
                <div class="card-block">
                  <div class="row align-items-end">
                    <div class="col-8">
                      <h4 class="text-white">
                        <?php 
                          $rescust = mysqli_query($conn, "SELECT id FROM product_purchase WHERE purchase_status=1");
                          echo mysqli_num_rows($rescust);
                        ?>
                      </h4>
                      <h6 class="text-white m-b-0">Purchase</h6>
                    </div>
                    <div class="col-4 text-right">
                      <canvas id="update-chart-2" height="50"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-4">   
            <div class="col-md-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <strong>
                    <span>Recent Purchase</span>
                  </strong>
                </div>
                <div class="table-responsive dt-responsive px-3">
                  <table class="table table-striped nowrap table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Bill No</th>
                        <th class="text-right">Total Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $resrsale = mysqli_query($conn, "SELECT grand_total, billno, bill_date FROM product_purchase WHERE purchase_status = 1 ORDER BY id DESC LIMIT 5");
                            if (mysqli_num_rows($resrsale) > 0) {
                              $count = 1;
                              while ($rowrsale = mysqli_fetch_assoc($resrsale)) {
                                echo "<tr><th>" . $count . "</th><td>" . $rowrsale['bill_date'] . "</td><td>" . $rowrsale['billno'] . "</td><td class='text-right'>" . number_format($rowrsale['grand_total'], 2) . "</td></tr>";
                                $count++;
                              }
                            }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <strong>
                    <span>Highest Selling Products</span>
                  </strong>
                </div>
                <div class="table-responsive dt-responsive px-3">
                  <table class="table table-striped nowrap table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Total Sold</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $resrhight = mysqli_query($conn, "SELECT product_master.ProductName, SUM(sales_temp.quantity) AS sale_quantity FROM sales_temp JOIN product_master ON product_master.PM_Id = sales_temp.product_id WHERE sales_temp.status = 1 GROUP BY product_master.ProductName ORDER BY sale_quantity DESC LIMIT 5");
                            if (mysqli_num_rows($resrhight) > 0) {
                              $count = 1;
                              while ($rowhigh = mysqli_fetch_assoc($resrhight)) {
                                echo "<tr><th>" . $count . "</th><td>" . $rowhigh['ProductName'] . "</td><td>" . $rowhigh['sale_quantity'] . "</td></tr>";
                                $count++;
                              }
                            }
                        ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
          <div class="row mt-4">            
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <strong>
                    <span>Recently Added Products</span>
                  </strong>
                </div>
                <div class="table-responsive dt-responsive px-3">
                  <table class="table table-striped nowrap table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Item</th>
                        <th>Image</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            $resrproductss = mysqli_query($conn, "SELECT category_master.CategoryName AS catname, brand_master.BrandName AS bname, product_master.ProductName AS pname, product_master.Image FROM product_master JOIN category_master ON category_master.CT_Id = product_master.CategoryId JOIN brand_master ON brand_master.BR_Id = product_master.BrandId WHERE product_master.Status=1 ORDER BY product_master.PM_Id DESC LIMIT 5");
                            if (mysqli_num_rows($resrproductss) > 0) {
                              $count = 1;
                              while ($rowrproductss = mysqli_fetch_assoc($resrproductss)) {
                                echo "<tr><th>" . $count . "</th><td>" . $rowrproductss['catname'] . "</td><td>" . $rowrproductss['bname'] . "</td><td>" . $rowrproductss['pname'] . "</td><td><img class='img-avatar img-circle'  style='width:36px;height: 36px;border-radius:50%;'' src='../" . $rowrproductss['Image'] . "'></td></tr>";
                                $count++;
                              }
                            }
                        ?>
                    </tbody>
                  </table>
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
