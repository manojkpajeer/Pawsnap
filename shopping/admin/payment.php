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
                                <h3 class="mb-3">Manage Payment</h1>
                            </div>
                        </div>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Id</th>
                                    <th>Transaction Id</th>
                                    <th>Total Amount</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Paid On</th>
                                </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                        $resd6 = mysqli_query($conn, "SELECT * FROM payment_master ORDER BY PM_Id DESC");
                                        if (mysqli_num_rows($resd6) > 0) {
        
                                            $count = 1;
                                            while($rowd6 = mysqli_fetch_assoc($resd6)) {
                                                
                                                echo "<tr>"; 
                                                echo "<th>".$count."</th>"; 
                                                echo "<td>".$rowd6['OrderId']."</td>"; 
                                                echo "<td>".$rowd6['TransactionId']."</td>"; 
                                                echo "<td class='text-end'>".number_format($rowd6['TotalAmount'], 2)."</td>"; 
                                                echo "<td>".$rowd6['PaymentMessage']."</td>"; 
                                                echo "<td>";
                                                if($rowd6['PaymentStatus'] == 'Paid') {
        
                                                    echo $rowd6['PaymentStatus'];
                                                } else {
        
                                                    echo $rowd6['PaymentStatus'];
                                                }
        
                                                echo "</td>"; 
                                                echo "<td>".date_format(date_create($rowd6['DatePaid']), 'd M, Y') . "</td>"; 
                                                
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
