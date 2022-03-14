<?php 
    session_start();
        
    require_once '../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    $sql = "SELECT * FROM billing_customer ORDER BY BC_Id DESC";

    if (isset($_POST['filter'])) {
        if ($_POST['customer_status'] != 'All') {
            $sql= "SELECT * FROM billing_customer WHERE Status = '$_POST[customer_status]' ORDER BY BC_Id DESC";
        } 
    }
    ?>

    <div class="pcoded-content">
        <div class="card">
            <div class="card-header pb-0 row">
                <div class="col-6"><h4>Customer Report</h4></div>
                <div class="form-check col-6">
                    <form method="POST" class="float-right">
                        <strong class="mr-5">Filter By</strong>
                        <input type="radio" name="customer_status" class="form-check-input"  value="All" <?php if (isset($_POST['filter']) && $_POST['customer_status'] == 'All') { echo "checked"; } else { echo "checked"; }?>/>
                        <label class="form-check-label pl-0 mr-5">All</label>
                        <input type="radio" name="customer_status" class="form-check-input" value="1" <?php if (isset($_POST['filter']) && $_POST['customer_status'] == '1') { echo "checked"; }?>/>
                        <label class="form-check-label pl-0 mr-5">Active</label>
                        <input type="radio" name="customer_status" class="form-check-input" value="0" <?php if (isset($_POST['filter']) && $_POST['customer_status'] == '0') { echo "checked"; }?>/>
                        <label class="form-check-label pl-0 mr-3">In-Active</label>
                        <button name="filter" class="btn btn-sm btn-danger" style="height: 25px;"><i class="feather icon-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive table-sm">
                    <table id="dom-jqry" class="table table-hover table-bordered nowrap ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Created On</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $resData = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($resData)>0)
                        {
                            $cnt = 1;
                            while($row = mysqli_fetch_assoc($resData))
                            {
                            ?>
                            <tr>
                                <th><?php echo $cnt; ?></th>
                                <td><?php echo $row['FullName']; ?></td>
                                <td><?php echo $row['EmailId']; ?></td>
                                <td><?php echo $row['PhoneNo']; ?></td>
                                <td><?php echo $row['Address']; ?></td>
                                <td>
                                    <?php 
                                        if($row['Status']==1){
                                            echo "Active";  
                                        }else{ 
                                            echo "In-Active"; 
                                        }
                                    ?>
                                </td>
                                <td><?php echo date_format(date_create($row['DateCreate']), 'd M, Y');?></td>
                            </tr>

                            <?php  
                            $cnt++; 
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <button onclick="printData()" class="btn-danger" style="position:fixed;width:40px;height:40px;bottom:40px;right:40px;border-radius:50px;text-align:center;">
        <i class="feather icon-printer"></i>
    </button>
    <script>
        function printData() {
            var divToPrint=document.getElementById("dom-jqry");
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
    </script>
    <?php

        require_once './pages/footer.php';
    ?>