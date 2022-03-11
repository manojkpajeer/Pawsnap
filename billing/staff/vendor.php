<?php 
    session_start();
        
    require_once '../../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_staff_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    if (!empty($_GET['did'])) {
        
        if (mysqli_query($conn, "DELETE FROM vendor_master WHERE VM_Id = '$_GET[did]'")){
            
            echo "<script>alert('Yay, Vendor deleted successfully..');location.href='vendor.php';</script>";     
        } else {

            echo "<script>alert('Oops, Unable to delete vendor.');location.href='vendor.php';</script>";
        }
    }

    if (isset($_POST['update'])) { 

        $resGst = mysqli_query($conn, "SELECT VM_Id FROM vendor_master WHERE GSTIN = '$_POST[gst]' AND NOT VM_Id = '$_POST[sid]'");
        if(mysqli_num_rows($resGst)>0){

            echo "<script>alert('This GSTIN already in use, Kindly use different GST Number..!');</script>";
        } else {

            if(mysqli_query($conn, "UPDATE vendor_master SET FullName = '$_POST[name]' , PhoneNo = '$_POST[phone]',
                PhoneNo2 = '$_POST[phone2]', GSTIN  ='$_POST[gst]', Address = '$_POST[address]', Status = '$_POST[status]' WHERE VM_Id = '$_POST[sid]'")){

                echo "<script>alert('Yay, Vendor added successfully..');</script>";   
            }
            else{

                echo "<script>alert('Oops, Unable to add vendor..');</script>";
            }
        }
        
    }

    if (isset($_POST['add'])) { 

        if(mysqli_query($conn, "INSERT INTO vendor_master (FullName, PhoneNo, PhoneNo2, GSTIN, Address, DateCreate, Status) 
            VALUES ('$_POST[name]', '$_POST[phone]', '$_POST[phone2]', '$_POST[gst]', '$_POST[address]', NOW(), '$_POST[status]')")){

            echo "<script>alert('Yay, Vendor added successfully..');</script>";   
        }
        else{

            echo "<script>alert('Oops, Unable to add vendor..');</script>";
        }
        
    }
    ?>

    <div class="pcoded-content">
        <div class="card">
            <div class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Add Vendor</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control" required name="name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone No</label>
                                    <input type="text" class="form-control" required name="phone" pattern="[6-9]{1}[0-9]{9}" title="Phone number start with 6-9 and remaing 9 digit with 0-9" maxlength="10">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Secondary Phone No</label>
                                    <input type="text" class="form-control" name="phone2" pattern="[6-9]{1}[0-9]{9}" title="Phone number start with 6-9 and remaing 9 digit with 0-9" maxlength="10">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">GSTIN</label>
                                    <input type="text" class="form-control" required name="gst" pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" title="Enter Valid GST Number." oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" name="address" required></textarea>
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
                    <h4 style="float: left;">Manage Vendor</h4>
                    <button class="btn btn-danger pull-right btn-sm" style="float: right;" data-bs-toggle="modal" data-bs-target="#add">Add New</button>
                </div>
            </div>
            <div class="card-block">
                <div class="table-responsive dt-responsive table-sm">
                    <table id="dom-jqry" class="table table-hover table-bordered nowrap ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>GSTIN</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $resData = mysqli_query($conn, "SELECT * FROM vendor_master ORDER BY VM_Id DESC");
                        if(mysqli_num_rows($resData)>0)
                        {
                            $cnt = 1;
                            while($row = mysqli_fetch_assoc($resData))
                            {
                            ?>
                            <tr>
                                <th><?php echo $cnt; ?></th>
                                <td><?php echo $row['GSTIN']; ?></td>
                                <td><?php echo $row['FullName']; ?></td>
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
                                <td>    
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#manage<?php echo $row['VM_Id'];?>"><i class="feather icon-edit"></i></a> | 
                                    <a href="vendor.php?did=<?php echo $row['VM_Id']?>" onclick="return confirm('Are you sure to delete this record?')"><i class="feather icon-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="manage<?php echo $row['VM_Id'];?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="">Edit Vendor</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body row">
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="col-md-6">
                                                    <label class="form-label">Company Name</label>
                                                    <input type="text" class="form-control" required name="name" value="<?php echo $row['FullName'];?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Phone No</label>
                                                    <input type="text" class="form-control" required name="phone" value="<?php echo $row['PhoneNo'];?>" pattern="[6-9]{1}[0-9]{9}" title="Phone number start with 6-9 and remaing 9 digit with 0-9" maxlength="10">
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label class="form-label">Secondary Phone No</label>
                                                    <input type="text" class="form-control" name="phone2" value="<?php echo $row['PhoneNo2'];?>" pattern="[6-9]{1}[0-9]{9}" title="Phone number start with 6-9 and remaing 9 digit with 0-9" maxlength="10">
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label class="form-label">GSTIN</label>
                                                    <input type="text" class="form-control" required name="gst" value="<?php echo $row['GSTIN'];?>" pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" title="Enter Valid GST Number." oninput="this.value = this.value.toUpperCase()">
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label class="form-label">Address</label>
                                                    <textarea class="form-control" name="address" required><?php echo $row['Address'];?></textarea>
                                                </div>

                                                <input type="hidden" name="sid" value="<?php echo $row['VM_Id'];?>">

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