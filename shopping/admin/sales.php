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
                        <div class="row">
                            <div class="col-12">
                                <h3 class="mb-3">Manage Sales</h1>
                            </div>
                        </div>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>Transaction ID</th>
                                    <th>Customer Name</th>
                                    <th>Total Amount</th>
                                    <th>Order Status</th>
                                    <th>Ordered On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                        $resd6 = mysqli_query($conn, "SELECT payment_master.TransactionId, payment_master.TotalAmount, ecom_sales.OrderId, ecom_sales.`Status`, ecom_sales.DateCreate, customer_master.FullName FROM ecom_sales JOIN customer_master ON customer_master.CM_Id = ecom_sales.CustomerId JOIN payment_master ON payment_master.PM_Id = ecom_sales.PaymentId WHERE ecom_sales.`Status` = 1 ORDER BY ecom_sales.ES_Id DESC");
                                        if (mysqli_num_rows($resd6) > 0) {
        
                                            $count = 1;
                                            while($rowd6 = mysqli_fetch_assoc($resd6)) {
                                                
                                                echo "<tr>"; 
                                                echo "<th>".$count."</th>"; 
                                                echo "<td>".$rowd6['OrderId']."</td>"; 
                                                echo "<td>".$rowd6['TransactionId']."</td>"; 
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
                                                echo "<td><a href='sales-detail.php?source=$rowd6[OrderId]'><i class='fa fa-eye'></i></a></td>";
                                                echo "</tr>"; 
        
                                                $count++;
                                            }
                                        }
                                    ?>
                                    </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    
<?php

    require_once './assets/pages/admin-footer.php';
?>
