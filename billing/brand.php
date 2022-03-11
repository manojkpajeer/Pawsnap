<?php 
    session_start();
        
    require_once '../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    if (!empty($_GET['did'])) {
        
        if (mysqli_query($conn, "DELETE FROM brand_master WHERE BR_Id = '$_GET[did]'")){
            
            echo "<script>alert('Yay, Brand deleted successfully..');location.href='brand.php';</script>";     
        } else {

            echo "<script>alert('Oops, Unable to delete brand.');location.href='brand.php';</script>";
        }
    }

    if (isset($_POST['update'])) { 

        $description = addslashes($_POST['description']);

        if(empty($_FILES['image']['name'])){

            if (mysqli_query($conn, "UPDATE brand_master SET BrandName = '$_POST[name]', Description = '$description', Status = '$_POST[status]' WHERE BR_Id = '$_POST[sid]'")) {

                echo "<script>alert('Yay, Brand updated successfully..');</script>";     
            } else {

                echo "<script>alert('Oops, Unable to update brand..');</script>";
            }
        } else{

            $imagePath = "images/brand/" . time() . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if(move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)){

                if (mysqli_query($conn, "UPDATE brand_master SET BrandName = '$_POST[name]', Description = '$description', Status = '$_POST[status]',
                    BrandImage = '$imagePath' WHERE BR_Id = '$_POST[sid]'")) {
    
                    echo "<script>alert('Yay, Brand updated successfully..');</script>";     
                } else {
    
                    echo "<script>alert('Oops, Unable to update brand..');</script>";
                }
            } else {

                echo "<script>alert('Oops, Unable to upload files on server..');</script>";
            }
        }
        
    }

    if (isset($_POST['add'])) { 

        $description = addslashes($_POST['description']);
        
        $imagePath = "images/brand/" . time() . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if(move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)){

            if(mysqli_query($conn, "INSERT INTO brand_master (BrandName, Description, Status, DateCreate, BrandImage) 
            VALUES ('$_POST[name]', '$description', '$_POST[status]', NOW(), '$imagePath')")){

                echo "<script>alert('Yay, Brand added successfully..');</script>";   
            }
            else{

                echo "<script>alert('Oops, Unable to add brand..');</script>";
            }
        } else {

            echo "<script>alert('Oops, Unable to upload files on server..');</script>";
        }
    }
    ?>

    <div class="pcoded-content">
        <div class="card">
            <div class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Add Brand</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Brand Name</label>
                                    <input type="text" class="form-control" required name="name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" required name="image" accept="image/*">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                                <div class="col-md-6 mt-3">
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
                    <h4 style="float: left;">Manage Brand</h4>
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
                                <th>Brand</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $resData = mysqli_query($conn, "SELECT * FROM brand_master ORDER BY BR_Id DESC");
                        if(mysqli_num_rows($resData)>0)
                        {
                            $cnt = 1;
                            while($row = mysqli_fetch_assoc($resData))
                            {
                            ?>
                            <tr>
                                <th><?php echo $cnt; ?></th>
                                <th><img src="<?php echo $row['BrandImage']?>" class="rounded" height="50" width="50"></th>
                                <td><?php echo $row['BrandName']; ?></td>
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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#manage<?php echo $row['BR_Id'];?>"><i class="feather icon-edit"></i></a> | 
                                    <a href="brand.php?did=<?php echo $row['BR_Id']?>" onclick="return confirm('Are you sure to delete this record?')"><i class="feather icon-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="manage<?php echo $row['BR_Id'];?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="">Edit Brand</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body row">
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="col-md-6">
                                                    <label class="form-label">Brand Name</label>
                                                    <input type="text" class="form-control" required name="name" value="<?php echo $row['BrandName']?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control" name="description"><?php echo $row['Description']?></textarea>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" class="form-control" name="image" accept="image/*">
                                                </div>

                                                <input type="hidden" name="sid" value="<?php echo $row['BR_Id'];?>">

                                                <div class="col-md-6 mt-3">
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