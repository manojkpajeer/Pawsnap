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
                        <h3 class="mb-3">User Logs</h1>
                        <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Role</th>
                                            <th>Logged On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $resd6 = mysqli_query($conn, "SELECT * FROM log_master ORDER BY LO_id DESC");
                                        if (mysqli_num_rows($resd6) > 0) {

                                            $count = 1;
                                            while($rowd6 = mysqli_fetch_assoc($resd6)) {
                                                
                                                echo "<tr>"; 
                                                echo "<th>".$count."</th>"; 
                                                if ($rowd6['UserRole'] == 'Admin') {

                                                    $resUser = mysqli_query($conn, "SELECT FullName FROM admin_master WHERE AM_Id = '$rowd6[UserId]'");
                                                    if (mysqli_num_rows($resUser) > 0) {

                                                        $resUser = mysqli_fetch_assoc($resUser);
                                                        
                                                        echo "<td>".$resUser['FullName']."</td>"; 
                                                    } else {

                                                        echo "<td></td>"; 
                                                    }
                                                } else if ($rowd6['UserRole'] == 'Ajent') {
                                                    
                                                    $resUser = mysqli_query($conn, "SELECT FullName FROM ajent_master WHERE AJM_Id = '$rowd6[UserId]'");
                                                    if (mysqli_num_rows($resUser) > 0) {

                                                        $resUser = mysqli_fetch_assoc($resUser);
                                                        
                                                        echo "<td>".$resUser['FullName']."</td>"; 
                                                    } else {

                                                        echo "<td></td>"; 
                                                    }
                                                } else if ($rowd6['UserRole'] == 'Staff') {
                                                    
                                                    $resUser = mysqli_query($conn, "SELECT FullName FROM staff_master WHERE ST_Id = '$rowd6[UserId]'");
                                                    if (mysqli_num_rows($resUser) > 0) {

                                                        $resUser = mysqli_fetch_assoc($resUser);
                                                        
                                                        echo "<td>".$resUser['FullName']."</td>"; 
                                                    } else {

                                                        echo "<td></td>"; 
                                                    }
                                                } else if ($rowd6['UserRole'] == 'Customer') {
                                                    
                                                    $resUser = mysqli_query($conn, "SELECT Saluation, FirstName, LastName FROM customer_master WHERE CM_Id = '$rowd6[UserId]'");
                                                    if (mysqli_num_rows($resUser) > 0) {

                                                        $resUser = mysqli_fetch_assoc($resUser);
                                                        
                                                        echo "<td>".$resUser['Saluation']." ".$resUser['FirstName']." ".$resUser['LastName']."</td>"; 
                                                    } else {

                                                        echo "<td></td>"; 
                                                    }
                                                }
                                                
                                                echo "<td>".$rowd6['UserRole']."</td>"; 
                                                echo "<td>".date_format(date_create($rowd6['CreateDate']), 'd M, Y') . "</td>"; 
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
