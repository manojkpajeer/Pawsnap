<?php 
    session_start();
        
    require_once '../../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_staff_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    $sql= "SELECT billing_customer.FullName, billing_customer.PhoneNo, sales.id as sid,  sales.billno, sales.bill_date, sales.discount FROM sales JOIN billing_customer ON billing_customer.BC_Id = sales.customer_id WHERE sales.sales_status = 1 ORDER BY sales.id DESC";
    $result=$conn->query($sql);

    if (!empty($_GET['did'])) {
        if (mysqli_query($conn, "DELETE sales, sales_temp FROM sales INNER JOIN sales_temp ON sales_temp.billno = sales.billno WHERE sales.id = '$_GET[did]'")){
            
            echo "<script>alert('Yay, Sales deleted successfully..');location.href='sales.php';</script>";     
        } else {

            echo "<script>alert('Oops, Unable to delete sales.');location.href='sales.php';</script>";
        }
    }
 
?>
<div class="pcoded-content">
    <div class="card">
        <div class="card-header">
            <div class="col-sm-12 ">
                <h4 style="float: left;">Manage Sales</h4>
                <a href="add-billing-barcode.php"><button class="btn btn-danger pull-right btn-sm" style="float: right;">Add New</button></a>
            </div>
        </div>
        <div class="card-block">
            <div class="table-responsive dt-responsive table-sm">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Bill No</th>
                            <th>Bill Date</th>
                            <th class="text-right">Bill Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if(!empty($result))
                        {
                            $cnt = 1;
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $grand_total = 0;
                                $res2 = mysqli_query($conn, "SELECT sales_temp.quantity, product_master.Price, product_master.Discount FROM sales_temp JOIN product_master ON product_master.PM_Id = sales_temp.product_id WHERE sales_temp.billno = '$row[billno]' AND sales_temp.status = 1");
                                if(mysqli_num_rows($res2)>0){
                                    while($row2 = mysqli_fetch_assoc($res2)){
                                        $discount_rate = $row2['Price'] * ($row2['Discount'] /100);
                                        $product_price = $row2['Price'] - $discount_rate ;
                                        $total_price = $product_price * $row2['quantity'];
                                        $grand_total += $total_price; 
                                    }
                                }
                                
                                $mdiscount = $grand_total * ($row['discount'] /100);
                                $final_total = $grand_total - $mdiscount;
                        ?>
                        <tr>
                            <td><?php echo $cnt; ?></td>
                            <td><?php echo $row['FullName']; ?></td>
                            <td><?php echo $row['PhoneNo']; ?></td>
                            <td><?php echo $row['billno']; ?></td>
                            <td><?php echo $row['bill_date']; ?></td>
                            <td class="text-right"><?php echo number_format($final_total, 2); ?></td>
                            <td class="text-center">    
                                <a href="view-bill.php?billno=<?php echo $row['billno']?>"><i class="feather icon-eye"></i></a> | 
                                <a href="sales.php?did=<?php echo $row['sid'] ?>" onclick="return confirm('Are you sure to delete this record?')"><i class="feather icon-trash"></i></a>
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
</div>
</div>
</div>
</div>
</div>
</div>
<?php

require_once './pages/footer.php';
?>
