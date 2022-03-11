<?php
    session_start();

    if(empty($_SESSION['is_shopping_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './assets/pages/admin-link.php';
    require_once './assets/pages/admin-header.php';
    require_once '../../assets/config/connect.php';
?>
    
        <div id="layoutSidenav">
            <?php
                require_once './assets/pages/admin-sidebar.php';
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid p-4">
                        <h2>Dashboard</h1>
                        <div class="row mt-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#" style="text-decoration: none;">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#" style="text-decoration: none;">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#" style="text-decoration: none;">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#" style="text-decoration: none;">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong>
                                            <span class="glyphicon glyphicon-th"></span>
                                            <span>Reports</span>
                                        </strong>
                                    </div>
                                    <div class="panel-body row">
                                        <div class="col-xl-3 col-md-6 my-3">
                                            <a href="customer-report.php" style="text-decoration: none;">
                                                <div class="p-2 card shadow" style="border-left: 6px solid">
                                                    Report
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xl-3 col-md-6 my-3">
                                            <a href="vendor-report.php" style="text-decoration: none;">
                                                <div class="p-2 card shadow" style="border-left: 6px solid #ffc107;">
                                                    Report
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xl-3 col-md-6 my-3">
                                            <a href="vendor-report.php" style="text-decoration: none;">
                                                <div class="p-2 card shadow" style="border-left: 6px solid #198754;">
                                                    Report
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xl-3 col-md-6 my-3">
                                            <a href="vendor-report.php" style="text-decoration: none;">
                                                <div class="p-2 card shadow" style="border-left: 6px solid #dc3545;">
                                                    Report
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-xl-6 col-md-6 p-1">
                                <div class="card p-2">
                                    <h6 class="my-2">Recent Payment</h6>
                                    <table class="table table-borderless table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Transaction Id</th>
                                                <th>Total Amount</th>
                                                <th>Paid On</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $resd6 = mysqli_query($conn, "SELECT * FROM payment_master ORDER BY PM_Id DESC LIMIT 5");
                                            if (mysqli_num_rows($resd6) > 0) {
            
                                                $count = 1;
                                                while($rowd6 = mysqli_fetch_assoc($resd6)) {
                                                    
                                                    echo "<tr>"; 
                                                    echo "<th>".$count."</th>"; 
                                                    echo "<td>".$rowd6['TransactionId']."</td>"; 
                                                    echo "<td class='text-end'>".number_format($rowd6['TotalAmount'], 2)."</td>"; 
                                                    echo "<td>".date_format(date_create($rowd6['DatePaid']), 'd M, Y') . "</td>"; 
                                                    
                                                    echo "</tr>"; 

                                                    $count++;
                                                }
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6 p-1">
                                <div class="card p-2">
                                    <h6 class="my-2">Table Name</h6>
                                    <table class="table table-borderless table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                            </tr>
                                            <tr>
                                                <td>Garrett Winters</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>63</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 p-1">
                                <div class="card p-2">
                                    <h6 class="my-2">Recent Orders</h6>
                                    <table class="table table-borderless table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>Total Amount</th>
                                                <th>Order Status</th>
                                                <th>Ordered On</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $resd6 = mysqli_query($conn, "SELECT payment_master.OrderId, payment_master.TotalAmount, ecom_sales.`Status`, ecom_sales.DateCreate, customer_master.FullName FROM ecom_sales JOIN customer_master ON customer_master.CM_Id = ecom_sales.CustomerId JOIN payment_master ON payment_master.PM_Id = ecom_sales.PaymentId WHERE ecom_sales.`Status` = 1 ORDER BY ecom_sales.ES_Id DESC LIMIT 5");
                                            if (mysqli_num_rows($resd6) > 0) {
            
                                                $count = 1;
                                                while($rowd6 = mysqli_fetch_assoc($resd6)) {
                                                    
                                                    echo "<tr>"; 
                                                    echo "<th>".$count."</th>"; 
                                                    echo "<td>".$rowd6['OrderId']."</td>"; 
                                                    echo "<td>".$rowd6['FullName']."</td>"; 
                                                    echo "<td class='text-end'>".number_format($rowd6['TotalAmount'], 2)."</td>"; 
                                                    echo "<td>";
                                                    if($rowd6['Status']) {
            
                                                        echo "<span>Placed</span>";
                                                    } else {
            
                                                        echo "<span>Failed</span>";
                                                    }
            
                                                    echo "</td>"; 
                                                    echo "<td>".date_format(date_create($rowd6['DateCreate']), 'd M, Y') . "</td>"; 
                                                    echo "</tr>"; 
            
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
                </main>
            </div>
        </div>
    
<?php

    require_once './assets/pages/admin-footer.php';
?>
