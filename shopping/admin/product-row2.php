<?php
    session_start();

    if(empty($_SESSION['is_shopping_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './assets/pages/admin-link.php';
    require_once './assets/pages/admin-header.php';
    require_once '../../assets/config/connect.php';

    if (isset($_GET['did'])) {
        
        if (mysqli_query($conn, "DELETE FROM product_row WHERE PR_ID = '$_GET[did]'")){

            echo "<script>alert('Yay, Row deleted successfully..');location.href='product-row2.php';</script>";     
        } else {

            echo "<script>alert('Oops, Unable to delete row.');</script>";
        }
    }

    if (isset($_POST['update'])) { 
            
        if (mysqli_query($conn, "UPDATE product_row SET ProductId = '$_POST[category]', Status = '$_POST[status]' WHERE PR_ID = '$_POST[sid]'")) {

            echo "<script>alert('Yay, Row updated successfully..');</script>";     
        } else {

            echo "<script>alert('Oops, Unable to update row..');</script>";
        }
    }

    if(isset($_POST['add'])){
        
        if(mysqli_query($conn, "INSERT INTO product_row (ProductId, Status, DateCreate, Row) VALUES ('$_POST[category]', 1, NOW(), '2')")){

            echo "<script>alert('Yay, Row added..');</script>";     
        }
        else{

            echo "<script>alert('Oops, Unable to add row..');</script>";
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
                            <div class="col-9">
                                <h3 class="mb-3">Manage Product Row2</h1>
                            </div>
                            <div class="col-3 text-end">
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#add">Add New</button>
                            </div>
                        </div>
                        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add Product Row2</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body g-3 row">
                                            <div class="col-sm-12 col-lg-12 col-md-12 mt-3">
                                                <label class="form-label">Select Product</label>
                                                <select class="form-control" name="category" title="Please choose category" required>
                                                    <?php
                                                        $resCategory = mysqli_query($conn, "SELECT PM_Id, ProductName FROM product_master WHERE Status = 1");
                                                        if(mysqli_num_rows($resCategory)>0){

                                                            echo "<option value=''>Choose</option>";
                                                            
                                                            while($rowCategory = mysqli_fetch_assoc($resCategory)){
                                                                
                                                                echo "<option value='$rowCategory[PM_Id]'>$rowCategory[ProductName]</option>"; 
                                                            }
                                                        } else {

                                                            echo "<option value=''>Choose</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="add">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $resd6 = mysqli_query($conn, "SELECT product_row.PR_ID, product_master.ProductName, product_master.Image, product_row.ProductId, product_row.Status, product_row.DateCreate FROM product_row JOIN product_master ON product_master.PM_Id = product_row.ProductId WHERE product_row.`Row` = '2' ORDER BY product_row.PR_ID DESC");
                                        if (mysqli_num_rows($resd6) > 0) {

                                            $count = 1;
                                            while($rowd6 = mysqli_fetch_assoc($resd6)) {
                                                
                                                echo "<tr>"; 
                                                echo "<th>".$count."</th>"; 
                                                echo "<td><img src='../../billing/".$rowd6['Image']."' class='rounded-circle mr-2' width='60' height='50''></td>"; 
                                                echo "<td>".$rowd6['ProductName']."</td>"; 
                                                echo "<td>"; 
                                                if ($rowd6['Status']) {
                                                    echo "Active";
                                                } else {
                                                    echo "In-Active";
                                                }
                                                echo "</td>"; 
                                                echo "<td>".date_format(date_create($rowd6['DateCreate']), 'd M, Y') . "</td>"; 
                                                echo "<td>";
                                                ?>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal<?php echo $rowd6['PR_ID'];?>"><i class='fa fa-pen'></i></a> | 
                                                <a href="product-row2.php?did=<?php echo $rowd6['PR_ID'];?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a>
                                                <?php
                                                echo "</td>";
                                                echo "</tr>"; 

                                                $count++;

                                                ?>
                                                    <div class="modal fade" id="modal<?php echo $rowd6['PR_ID'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Product Row2</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body g-3 row">
                                                                        <div class="col-sm-12 col-lg-12 col-md-12 mt-3">
                                                                            <label class="form-label">Select Product</label>
                                                                            <select class="form-control" name="category" title="Please choose category" required>
                                                                                <?php
                                                                                    $resCategory = mysqli_query($conn, "SELECT PM_Id, ProductName FROM product_master WHERE Status = 1");
                                                                                    if(mysqli_num_rows($resCategory)>0){

                                                                                        echo "<option value=''>Choose</option>";
                                                                                        
                                                                                        while($rowCategory = mysqli_fetch_assoc($resCategory)){
                                                                                            ?>
                                                                                                <option value="<?php echo $rowCategory['PM_Id'];?>" <?php if($rowCategory['PM_Id'] == $rowd6['ProductId']){echo 'selected';}?>><?php echo $rowCategory['ProductName'];?></option>
                                                                                            <?php
                                                                                        }
                                                                                    } else {

                                                                                        echo "<option value=''>Choose</option>";
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </div>

                                                                        <input type="hidden" name="sid" value="<?php echo $rowd6['PR_ID'];?>">

                                                                        <div class="col-sm-12 col-lg-12 col-md-12 mt-3">
                                                                            <label class="form-label">Status</label>
                                                                            <select class="form-control" id="validationCustom04" name="status" title="Please choose status">
                                                                                <option value="1" <?php if($rowd6['Status']){echo 'selected';}?>>Active</option>
                                                                                <option value="0" <?php if(!$rowd6['Status']){echo 'selected';}?>>In-Active</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
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