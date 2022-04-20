<?php 
    session_start();
        
    require_once '../../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_staff_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    if (!empty($_GET['did'])) {
        
        if (mysqli_query($conn, "DELETE FROM product_master WHERE PM_Id = '$_GET[did]'")){
            
            echo "<script>alert('Yay, Product deleted successfully..');location.href='product.php';</script>";     
        } else {

            echo "<script>alert('Oops, Unable to delete product.');location.href='product.php';</script>";
        }
    }

    if (isset($_POST['update'])) { 

        if(empty($_FILES['image']['name'])){
            
            $imagePath = $_POST['img'];
        } else {

            $imagePath = "images/product/" . time() . rand(1000, 9999) . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imageMove = move_uploaded_file($_FILES['image']['tmp_name'], "../" . $imagePath);
        }

        if(empty($_FILES['image1']['name'])){
            
            $imagePath1 = $_POST['img'];
        } else {

            $imagePath1 = "images/product/" . time() . rand(1000, 9999) . "." . pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);
            $imageMove1 = move_uploaded_file($_FILES['image1']['tmp_name'], "../" . $imagePath1);
        }

        if(empty($_FILES['image2']['name'])){
            
            $imagePath2 = $_POST['img'];
        } else {

            $imagePath2 = "images/product/" . time() . rand(1000, 9999) . "." . pathinfo($_FILES['image2']['name'], PATHINFO_EXTENSION);
            $imageMove2 = move_uploaded_file($_FILES['image2']['tmp_name'], "../" . $imagePath2);
        }

        if(empty($_FILES['image3']['name'])){
            
            $imagePath3 = $_POST['img'];
        } else {

            $imagePath3 = "images/product/" . time() . rand(1000, 9999) . "." . pathinfo($_FILES['image3']['name'], PATHINFO_EXTENSION);
            $imageMove3 = move_uploaded_file($_FILES['image3']['tmp_name'], "../" . $imagePath);
        }

        if(mysqli_query($conn, "UPDATE product_master SET CategoryId = '$_POST[category]', BrandId = '$_POST[brand]', 
        ProductName = '$_POST[name]', ProductCode = '$_POST[code]', Image = '$imagePath', Description = '$_POST[description]', 
        Price = '$_POST[price]', Discount = '$_POST[discount]', OnlineDiscount = '$_POST[odiscount]', GST = '$_POST[gst]', Status = '$_POST[status]', 
        Image1 = '$imagePath1', Image2 = '$imagePath2', Image3 = '$imagePath3', ProductQuantity = '$_POST[quantity]' WHERE PM_Id = '$_POST[sid]'")){

            echo "<script>alert('Yay, Product updated successfully..');</script>";
        } else {

            echo "<script>alert('Oops, Unable to update product..');</script>";
            // echo mysqli_error($conn);
        }
        
    }   

    if (isset($_POST['add'])) { 

        $bannerPath = "images/product/" . time() . rand(1000, 9999) . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imagePath1 = "images/product/" . time() . rand(1000, 9999) . "." . pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);
        $imagePath2 = "images/product/" . time() . rand(1000, 9999) . "." . pathinfo($_FILES['image2']['name'], PATHINFO_EXTENSION);
        $imagePath3 = "images/product/" . time() . rand(1000, 9999) . "." . pathinfo($_FILES['image3']['name'], PATHINFO_EXTENSION);

        $bannerMove = move_uploaded_file($_FILES['image']['tmp_name'], "../" . $bannerPath);
        $imageMove1 = move_uploaded_file($_FILES['image1']['tmp_name'], "../" . $imagePath1);
        $imageMove2 = move_uploaded_file($_FILES['image2']['tmp_name'], "../" . $imagePath2);
        $imageMove3 = move_uploaded_file($_FILES['image3']['tmp_name'], "../" . $imagePath3);

        if($bannerMove && $imageMove1 && $imageMove2 && $imageMove3){

            if(mysqli_query($conn, "INSERT INTO product_master (CategoryId, BrandId, ProductName, ProductCode, Image, 
            Description, Price, Discount, OnlineDiscount, GST, Status, DateCreate, Image1, Image2, Image3, ProductQuantity) VALUES ('$_POST[category]', 
            '$_POST[brand]', '$_POST[name]', '$_POST[code]', '$bannerPath', '$_POST[description]', '$_POST[price]', 
            '$_POST[discount]', '$_POST[odiscount]', '$_POST[gst]', '$_POST[status]', NOW(), '$imagePath1', '$imagePath2', '$imagePath3', '$_POST[quantity]')")){

                echo "<script>alert('Yay, Product added successfully..');</script>";   
            }
            else{

                echo "<script>alert('Oops, Unable to add product..');</script>";
                // echo mysqli_error($conn);
            }
        } else {

            echo "<script>alert('Oops, Unable to upload files on server..');</script>";
        }
    }
    ?>

    <div class="pcoded-content">
        <div class="card">
            <div class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Add Product</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Choose Category</label>
                                    <select  name="category" required class="form-control">
                                        <?php
                                            $resCategpory = mysqli_query($conn, "SELECT CT_Id, CategoryName FROM category_master WHERE Status = 1");
                                            if(mysqli_num_rows($resCategpory)>0){

                                                echo "<option value=''>Choose</option>";
                                                while($rowCategory = mysqli_fetch_assoc($resCategpory)){

                                                    echo "<option value='".$rowCategory['CT_Id']."'>".$rowCategory['CategoryName']."</option>";
                                                }
                                            } else {

                                                echo "<option value=''>Choose</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Choose Brand</label>
                                    <select  name="brand" required class="form-control">
                                        <?php
                                            $resCategpory = mysqli_query($conn, "SELECT BR_Id, BrandName FROM brand_master WHERE Status = 1");
                                            if(mysqli_num_rows($resCategpory)>0){

                                                echo "<option value=''>Choose</option>";
                                                while($rowCategory = mysqli_fetch_assoc($resCategpory)){

                                                    echo "<option value='".$rowCategory['BR_Id']."'>".$rowCategory['BrandName']."</option>";
                                                }
                                            } else {

                                                echo "<option value=''>Choose</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Product Code</label>
                                    <input type="text" class="form-control" required name="code">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="form-label">Product Name</label>
                                    <input type="text" class="form-control" required name="name">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="form-label">Banner Image</label>
                                    <input type="file" class="form-control" required name="image" accept="image/*">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="form-label">Image1</label>
                                    <input type="file" class="form-control" required name="image1" accept="image/*">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="form-label">Image2</label>
                                    <input type="file" class="form-control" required name="image2" accept="image/*">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="form-label">Image3</label>
                                    <input type="file" class="form-control" required name="image3" accept="image/*">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="form-label">Price</label>
                                    <input class="form-control" name="price" required min="1" type="number" step="0.01">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="form-label">Billing Disc(In %)</label>
                                    <input class="form-control" name="discount" required type="number" max="100" value="0" min="0">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="form-label">Online Disc(In %)</label>
                                    <input class="form-control" name="odiscount" required type="number" max="100" value="0" min="0">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="form-label">GST(In %)</label>
                                    <input class="form-control" name="gst" required type="number" max="100" value="18" min="0">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="form-label">Quantity</label>
                                    <input class="form-control" id="pquantity" name="quantity" required min="0" type="number" value="0">
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-control" required name="status" title="Please choose status">
                                        <option value="">Select</option>
                                        <option value="1" selected>Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-4 text-center">
                                    <button type="submit" class="btn btn-danger" name="add">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header">
                <div class="col-sm-12 ">
                    <h4 style="float: left;">Manage Product</h4>
                    <button class="btn btn-danger pull-right btn-sm" style="float: right;" data-bs-toggle="modal" data-bs-target="#add">Add New</button>
                </div>
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive table-sm">
                    <table id="dom-jqry" class="table table-hover table-bordered nowrap ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Parent</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Code</th>
                                <th>MRP</th>
                                <th>Bill Disc</th>
                                <th>Online Disc</th>
                                <th>GST</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $resData = mysqli_query($conn, "SELECT product_master.PM_Id, product_master.ProductQuantity, product_master.Description, product_master.CategoryId, product_master.BrandId, product_master.ProductName, product_master.ProductCode, product_master.Image, product_master.Price, product_master.Discount, product_master.OnlineDiscount, product_master.GST, product_master.`Status`, product_master.DateCreate, category_master.CategoryName, category_master.ParentId, brand_master.BrandName FROM product_master JOIN category_master ON category_master.CT_Id = product_master.CategoryId JOIN brand_master ON brand_master.BR_Id = product_master.BrandId ORDER BY product_master.PM_Id DESC");
                        if(mysqli_num_rows($resData)>0)
                        {
                            $cnt = 1;
                            while($row = mysqli_fetch_assoc($resData))
                            {
                            ?>
                            <tr>
                                <th><?php echo $cnt; ?></th>
                                <th><img src="../<?php echo $row['Image']?>" class="rounded" height="50" width="50"></th>
                                <td><?php if($row['ParentId']==1){echo 'Dogs';}else if($row['ParentId']==2){echo 'Cats';}else if($row['ParentId']==3){echo 'Personalise';}; ?></td>
                                <td><?php echo $row['CategoryName']; ?></td>
                                <td><?php echo $row['BrandName']; ?></td>
                                <td><?php echo $row['ProductName']; ?></td>
                                <td><?php echo $row['ProductQuantity']; ?></td>
                                <td><?php echo $row['ProductCode']; ?></td>
                                <td><?php echo number_format($row['Price'], 2); ?></td>
                                <td><?php echo $row['Discount']; ?></td>
                                <td><?php echo $row['OnlineDiscount']; ?></td>
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
                                <td>    
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#manage<?php echo $row['PM_Id'];?>"><i class="feather icon-edit"></i></a> | 
                                    <a href="product.php?did=<?php echo $row['PM_Id']?>" onclick="return confirm('Are you sure to delete this record?')"><i class="feather icon-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="manage<?php echo $row['PM_Id'];?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="">Edit Product</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body row">
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="col-md-4">
                                                    <label class="form-label">Choose Category</label>
                                                    <select  name="category" required class="form-control">
                                                        <?php
                                                            $resCategpory = mysqli_query($conn, "SELECT CT_Id, CategoryName FROM category_master WHERE Status = 1");
                                                            if(mysqli_num_rows($resCategpory)>0){

                                                                echo "<option value=''>Choose</option>";
                                                                while($rowCategory = mysqli_fetch_assoc($resCategpory)){
                                                                    ?>
                                                                    <option value="<?php echo $rowCategory['CT_Id'];?>" <?php if($row['CategoryId']==$rowCategory['CT_Id']){echo 'selected';}?>><?php echo $rowCategory['CategoryName'];?></option>
                                                                    <?php
                                                                }
                                                            } else {

                                                                echo "<option value=''>Choose</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Choose Brand</label>
                                                    <select  name="brand" required class="form-control">
                                                        <?php
                                                            $resCategpory = mysqli_query($conn, "SELECT BR_Id, BrandName FROM brand_master WHERE Status = 1");
                                                            if(mysqli_num_rows($resCategpory)>0){

                                                                echo "<option value=''>Choose</option>";
                                                                while($rowCategory = mysqli_fetch_assoc($resCategpory)){
                                                                    
                                                                    ?>
                                                                    <option value="<?php echo $rowCategory['BR_Id'];?>" <?php if($row['BrandId']==$rowCategory['BR_Id']){echo 'selected';}?>><?php echo $rowCategory['BrandName'];?></option>
                                                                    <?php
                                                                }
                                                            } else {

                                                                echo "<option value=''>Choose</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Product Code</label>
                                                    <input type="text" class="form-control" required name="code" value="<?php echo $row['ProductCode'];?>">
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="form-label">Product Name</label>
                                                    <input type="text" class="form-control" required name="name" value="<?php echo $row['ProductName'];?>">
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="form-label">Banner Image</label>
                                                    <input type="file" class="form-control" name="image" accept="image/*">
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="form-label">Image1</label>
                                                    <input type="file" class="form-control" name="image1" accept="image/*">
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="form-label">Image2</label>
                                                    <input type="file" class="form-control" name="image2" accept="image/*">
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="form-label">Image3</label>
                                                    <input type="file" class="form-control" name="image3" accept="image/*">
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="form-label">Price</label>
                                                    <input class="form-control" name="price" required min="1" type="number" step="0.01" value="<?php echo number_format($row['Price'], 2, '.', '');?>">
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="form-label">Billing Discounts(In %)</label>
                                                    <input class="form-control" name="discount" required type="number" max="100" value="<?php echo $row['Discount'];?>" min="0">
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="form-label">Online Discounts(In %)</label>
                                                    <input class="form-control" name="odiscount" required type="number" max="100" value="<?php echo $row['OnlineDiscount'];?>" min="0">
                                                </div>
                                                <div class="col-md-4 mt-3">
                                                    <label class="form-label">GST(In %)</label>
                                                    <input class="form-control" name="gst" required type="number" max="100" value="<?php echo $row['GST'];?>" min="0">
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control" name="description"><?php echo $row['Description'];?></textarea>
                                                </div>

                                                <input type="hidden" name="sid" value="<?php echo $row['PM_Id'];?>">
                                                <input type="hidden" name="img" value="<?php echo $row['Image'];?>">
                                                <input type="hidden" name="img1" value="<?php echo $row['Image1'];?>">
                                                <input type="hidden" name="img2" value="<?php echo $row['Image2'];?>">
                                                <input type="hidden" name="img3" value="<?php echo $row['Image3'];?>">
                                                <div class="col-md-3 mt-3">
                                                    <label class="form-label">Quantity</label>
                                                    <input class="form-control" id="pquantity" name="quantity" required min="0" type="number" value="<?php echo $row['ProductQuantity'];?>">
                                                </div>
                                                <div class="col-md-3 mt-3">
                                                    <label class="form-label">Status</label>
                                                    <select class="form-control" required name="status" title="Please choose status">
                                                        <option value="">Select</option>
                                                        <option value="1" <?php if($row['Status']){echo 'selected';}?>>Active</option>
                                                        <option value="0" <?php if(!$row['Status']){echo 'selected';}?>>In-Active</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mt-4 text-center">
                                                    <button type="submit" class="btn btn-danger" name="update">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
    <?php

        require_once './pages/footer.php';
    ?>