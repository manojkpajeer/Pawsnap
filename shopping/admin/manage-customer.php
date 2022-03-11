<?php
    session_start();

    if(empty($_SESSION['is_shopping_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './assets/pages/admin-link.php';
    require_once './assets/pages/admin-header.php';
    require_once '../../assets/config/connect.php';

    if (isset($_GET['did'])) {
        
        if (mysqli_query($conn, "DELETE customer_master, login_master FROM customer_master INNER JOIN login_master ON  customer_master.CustomerEmail = login_master.UserEmail WHERE customer_master.CM_Id = '$_GET[did]'")){

            echo "<script>alert('Yay, Customer deleted successfully..');location.href='manage-customer.php';</script>";     
        } else {

            echo "<script>alert('Oops, Unable to delete customer.');</script>";
            // echo mysqli_error($conn);
        }
    }

    if (isset($_GET['iid'])) {
        
        if (mysqli_query($conn, "UPDATE customer_master SET Status = 0 WHERE CM_Id = '" . $_GET['iid'] . "'")){

            echo "<script>alert('Yay, Customer In-Actived successfully..');location.href='manage-customer.php';</script>";     
        } else {

            echo "<script>alert('Oops, Unable to inactive customer.');</script>";
        }
    }

    if (isset($_GET['aid'])) {
        
        if (mysqli_query($conn, "UPDATE customer_master SET Status = 1 WHERE CM_Id = '" . $_GET['aid'] . "'")){

            echo "<script>alert('Yay, Customer Actived successfully..');location.href='manage-customer.php';</script>";     
        } else {

            echo "<script>alert('Oops, Unable to active customer.');</script>";
        }
    }
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
                                <h3 class="mb-3">Manage Customer</h1>
                            </div>
                        </div>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Email Id</th>
                                    <th>Phone No</th>
                                    <th>Date Create</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                                    <tbody>
                                    <?php
                                        $resd6 = mysqli_query($conn, "SELECT * FROM customer_master ORDER BY CM_Id DESC");
                                        if (mysqli_num_rows($resd6) > 0) {

                                            $count = 1;
                                            while($rowd6 = mysqli_fetch_assoc($resd6)) {
                                                
                                                echo "<tr>"; 
                                                echo "<th>".$count."</th>"; 
                                                echo "<td>".$rowd6['FullName']."</td>"; 
                                                echo "<td>".$rowd6['CustomerEmail']."</td>"; 
                                                echo "<td>".$rowd6['CustomerPhone']."</td>"; 
                                                echo "<td>".date_format(date_create($rowd6['DateCreate']), 'd M, Y') . "</td>"; 
                                                echo "<td>"; 
                                                if ($rowd6['Status']) {
                                                    echo "Active";
                                                } else {
                                                    echo "In-Active";
                                                }
                                                echo "</td>"; 
                                                echo "<td>";
                                                ?>
                                                <a href="manage-customer.php?did=<?php echo $rowd6['CM_Id'];?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a>
                                                <?php
                                                if ($rowd6['Status']) {

                                                    echo " | <a href='manage-customer.php?iid=$rowd6[CM_Id]'><i class='fa fa-user'></i></a></td>";
                                                } else {

                                                    echo " | <a href='manage-customer.php?aid=$rowd6[CM_Id]'><i class='fa fa-user'></i></a></td>";
                                                }
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
