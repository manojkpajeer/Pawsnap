<?php
    session_start();

    if(!isset($_SESSION['is_admin_login'])){

        echo "<script>location.href='../assets/pages/logout.php';</script>";
    }
    else{

        if(!$_SESSION['is_admin_login']){
            
            echo "<script>location.href='../assets/pages/logout.php';</script>";
        }
    }

    require_once '../assets/pages/admin-link.php';
    require_once '../assets/pages/admin-header.php';
    require_once '../assets/config/connect.php';
?>
    
        <div id="layoutSidenav">
            <?php

                require_once '../assets/pages/admin-sidebar.php';
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid p-4">
                        <h3 class="mb-3">Sales</h1>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Unique Id</th>
                                    <th>Transaction Id</th>
                                    <th>Total Amount</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Paid On</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $resd6 = mysqli_query($conn, "SELECT * FROM payment_master ORDER BY RP_Id DESC");
                                if (mysqli_num_rows($resd6) > 0) {

                                    $count = 1;
                                    while($rowd6 = mysqli_fetch_assoc($resd6)) {
                                        
                                        echo "<tr>"; 
                                        echo "<th>".$count."</th>"; 
                                        echo "<td>".$rowd6['UniqueId']."</td>"; 
                                        echo "<td>".$rowd6['TransactionId']."</td>"; 
                                        echo "<td>".number_format($rowd6['TotalAmount'], 2)." AED</td>"; 
                                        echo "<td>".$rowd6['PaymentMessage']."</td>"; 
                                        echo "<td>";
                                        if($rowd6['PaymentStatus'] == 'Paid') {

                                            echo "<span class='badge badge-success'>".$rowd6['PaymentStatus']."</span>";
                                        } else {

                                            echo "<span class='badge badge-danger'>".$rowd6['PaymentStatus']."</span>";
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

    require_once '../assets/pages/admin-footer.php';
?>
