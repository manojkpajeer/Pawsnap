<?php 
    session_start();
        
    require_once '../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    $sql = "SELECT product_master.PM_Id, product_master.Description, product_master.CategoryId, product_master.BrandId, product_master.ProductName, product_master.ProductCode, product_master.Image, product_master.Price, product_master.Discount, product_master.GST, product_master.`Status`, product_master.DateCreate, category_master.CategoryName, category_master.ParentId, brand_master.BrandName FROM product_master JOIN category_master ON category_master.CT_Id = product_master.CategoryId JOIN brand_master ON brand_master.BR_Id = product_master.BrandId ORDER BY product_master.PM_Id DESC";

    if (isset($_POST['filter'])) {
        if (!empty($_POST['category']) && !empty($_POST['brand'])) {
            $sql = "SELECT product_master.PM_Id, product_master.Description, product_master.CategoryId, product_master.BrandId, product_master.ProductName, product_master.ProductCode, product_master.Image, product_master.Price, product_master.Discount, product_master.GST, product_master.`Status`, product_master.DateCreate, category_master.CategoryName, category_master.ParentId, brand_master.BrandName FROM product_master JOIN category_master ON category_master.CT_Id = product_master.CategoryId JOIN brand_master ON brand_master.BR_Id = product_master.BrandId WHERE CategoryId = '$_POST[category]' AND BrandId = '$_POST[brand]' ORDER BY product_master.PM_Id DESC";
        } else if (!empty($_POST['category']) && empty($_POST['brand'])) {
            $sql = "SELECT product_master.PM_Id, product_master.Description, product_master.CategoryId, product_master.BrandId, product_master.ProductName, product_master.ProductCode, product_master.Image, product_master.Price, product_master.Discount, product_master.GST, product_master.`Status`, product_master.DateCreate, category_master.CategoryName, category_master.ParentId, brand_master.BrandName FROM product_master JOIN category_master ON category_master.CT_Id = product_master.CategoryId JOIN brand_master ON brand_master.BR_Id = product_master.BrandId WHERE CategoryId = '$_POST[category]' ORDER BY product_master.PM_Id DESC";
        } else if (empty($_POST['category']) && !empty($_POST['brand'])) {
            $sql = "SELECT product_master.PM_Id, product_master.Description, product_master.CategoryId, product_master.BrandId, product_master.ProductName, product_master.ProductCode, product_master.Image, product_master.Price, product_master.Discount, product_master.GST, product_master.`Status`, product_master.DateCreate, category_master.CategoryName, category_master.ParentId, brand_master.BrandName FROM product_master JOIN category_master ON category_master.CT_Id = product_master.CategoryId JOIN brand_master ON brand_master.BR_Id = product_master.BrandId WHERE BrandId = '$_POST[brand]' ORDER BY product_master.PM_Id DESC";
        }
    } 
    ?>

    <div class="pcoded-content">
        <div class="card">
            <div class="card-header pb-0 row">
                <div class="col-5"><h4>Product Report</h4></div>
                <div class="form-check col-7">
                    <form method="POST">
                        <strong class="float-left">Filter By</strong>
                        <label class="form-check-label float-left">Category&nbsp;</label>
                        <select name="category" class="form-control form-control-sm w-25 float-left">
                        <?php
                            $resCategpory = mysqli_query($conn, "SELECT CT_Id, CategoryName FROM category_master WHERE Status = 1");
                            if(mysqli_num_rows($resCategpory)>0){

                                echo "<option value=''>Choose</option>";
                                while($rowCategory = mysqli_fetch_assoc($resCategpory)){

                                    echo "<option value='".$rowCategory['CT_Id']."'";
                                    if (isset($_POST['category'])){
                                        if($_POST['category']==$rowCategory['CT_Id']){
                                            echo 'selected';
                                        }
                                    }
                                    echo ">".$rowCategory['CategoryName']."</option>";
                                }
                            } else {

                                echo "<option value=''>Choose</option>";
                            }
                        ?>
                        </select>
                        <label class="form-check-label float-left">Brand&nbsp;</label>
                        <select name="brand" class="form-control form-control-sm float-left w-25 mr-2">
                        <?php
                            $resCategpory = mysqli_query($conn, "SELECT BR_Id, BrandName FROM brand_master WHERE Status = 1");
                            if(mysqli_num_rows($resCategpory)>0){

                                echo "<option value=''>Choose</option>";
                                while($rowCategory = mysqli_fetch_assoc($resCategpory)){

                                    echo "<option value='".$rowCategory['BR_Id']."'";
                                    if (isset($_POST['brand'])){
                                        if($_POST['brand']==$rowCategory['BR_Id']){
                                            echo 'selected';
                                        }
                                    }
                                    echo ">".$rowCategory['BrandName']."</option>";
                                }
                            } else {

                                echo "<option value=''>Choose</option>";
                            }
                        ?>
                        </select>
                        <button name="filter" class="btn btn-sm btn-danger float-left"><i class="feather icon-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive table-sm">
                    <table id="dom-jqry" class="table table-hover table-bordered nowrap ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Parent</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Product</th>
                                <th>Code</th>
                                <th>MRP</th>
                                <th>Discount</th>
                                <th>GST</th>
                                <th>Price</th>
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
                                <td><?php if($row['ParentId']==1){echo 'Dogs';}else if($row['ParentId']==2){echo 'Cats';}else if($row['ParentId']==3){echo 'Personalise';}; ?></td>
                                <td><?php echo $row['CategoryName']; ?></td>
                                <td><?php echo $row['BrandName']; ?></td>
                                <td><?php echo $row['ProductName']; ?></td>
                                <td><?php echo $row['ProductCode']; ?></td>
                                <td><?php echo number_format($row['Price'], 2); ?></td>
                                <td><?php echo $row['Discount']; ?></td>
                                <td><?php echo $row['GST']; ?></td>
                                <td><?php echo number_format($row['Price'] - ($row['Price'] * ($row['Discount']/100)), 2); ?></td>
                               
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