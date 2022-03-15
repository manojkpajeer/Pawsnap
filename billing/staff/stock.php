<?php 
    session_start();
        
    require_once '../../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_staff_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    $sql= "select category_master.CategoryName as cname, brand_master.BrandName as bname, product_master.PM_Id AS pid, product_master.ProductName, product_master.ProductCode from product_master join category_master on category_master.CT_Id = product_master.CategoryId join brand_master on brand_master.BR_Id = product_master.BrandId order by product_master.PM_Id desc";

    ?>

    <div class="pcoded-content">
        <div class="card">
            <div class="card-header">
                <div class="col-sm-12 ">
                    <h4 style="float: left;">Stocks</h4>
                    <a href="addpurchase.php"><button class="btn btn-danger pull-right btn-sm" style="float: right;">Purchase</button></a>
                </div>
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive table-sm">
                    <table id="dom-jqry" class="table table-hover table-bordered nowrap ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Product Code</th>
                                <th>Product</th>
                                <th>Quantity</th>
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
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['cname']; ?></td>
                                    <td><?php echo $row['bname']; ?></td>
                                    <td><?php echo $row['ProductCode']; ?></td>
                                    <td><?php echo $row['ProductName']; ?></td>
                                    <td><?php $res1 = mysqli_query($conn, "select sum(quantity) as total_quantity from purchase_temp where product_id = '$row[pid]' AND status = 1");
                                        $row1 = mysqli_fetch_assoc($res1);

                                        $res2 = mysqli_query($conn, "select sum(quantity) as sale_quantity from sales_temp where product_id = '$row[pid]' AND status = 1");
                                        $row2 = mysqli_fetch_assoc($res2);

                                        echo number_format($row1['total_quantity']-$row2['sale_quantity']);
                                        ?>
                                    </td>
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