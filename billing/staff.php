<?php 
    session_start();
        
    require_once '../assets/config/connect.php';
    
    if(empty($_SESSION['is_billing_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './pages/header.php';

    if (!empty($_GET['did'])) {
        
        if (mysqli_query($conn, "DELETE staff_master, login_master FROM staff_master INNER JOIN login_master ON  staff_master.EmailId = login_master.UserEmail WHERE staff_master.ST_Id = '$_GET[did]'")){
            
            echo "<script>alert('Yay, Staff deleted successfully..');location.href='staff.php';</script>";     
        } else {

            echo "<script>alert('Oops, Unable to delete staff.');location.href='staff.php';</script>";
        }
    }

    if (isset($_POST['update'])) { 

        $address = addslashes($_POST['address']);

        if (mysqli_query($conn, "UPDATE staff_master SET FullName = '$_POST[name]', Status = '$_POST[status]',
            PhoneNo = '$_POST[phone]', Address = '$address' WHERE ST_Id = '$_POST[sid]'")) {

            echo "<script>alert('Yay, Staff updated successfully..');</script>";     
        } else {

            echo "<script>alert('Oops, Unable to update staff..');</script>";
        }
    }

    if (isset($_POST['add'])) { 

        $address = addslashes($_POST['address']);
        
        if(mysqli_query($conn, "INSERT INTO staff_master(FullName, EmailId, Status, DateCreate, PhoneNo, Address) 
            VALUES ('$_POST[name]', '$_POST[email]', '$_POST[status]', NOW(), '$_POST[phone]', '$address')")){

            $password = $_POST['password'];

            if (mysqli_query($conn, "INSERT INTO login_master (UserEmail, UserPassword, UserRole) VALUES ('$_POST[email]', '$password', 'Staff')")) {
                                        
                echo "<script>alert('Yay, Staff created successfully..');</script>";

            } else {
                
                echo "<script>alert('Oops, Unable to add staff..');</script>";
            }    
        }
        else{

            echo "<script>alert('Oops, Unable to add staff..');</script>";
        }
    }
    ?>

    <div class="pcoded-content">
        <div class="card">
            <div class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Add Staff</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" required name="name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Id</label>
                                    <input type="email" class="form-control" required name="email">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Phone No</label>
                                    <input type="text" class="form-control" required name="phone" pattern="[6-9]{1}[0-9]{9}" title="Phone number start with 6-9 and remaing 9 digit with 0-9" maxlength="10">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" required name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" maxlength="25">
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
                    <h4 style="float: left;">Manage Staff</h4>
                    <button class="btn btn-danger pull-right btn-sm" style="float: right;" data-bs-toggle="modal" data-bs-target="#add">Add New</button>
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
                                <th>Status</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        $resData = mysqli_query($conn, "SELECT * FROM staff_master ORDER BY ST_Id DESC");
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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#manage<?php echo $row['ST_Id'];?>"><i class="feather icon-edit"></i></a> | 
                                    <a href="staff.php?did=<?php echo $row['ST_Id']?>" onclick="return confirm('Are you sure to delete this record?')"><i class="feather icon-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade" id="manage<?php echo $row['ST_Id'];?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="">Edit Staff</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body row">
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="col-md-6">
                                                    <label class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" required name="name" value="<?php echo $row['FullName']; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Phone No</label>
                                                    <input type="text" class="form-control" required name="phone" pattern="[6-9]{1}[0-9]{9}" title="Phone number start with 6-9 and remaing 9 digit with 0-9" maxlength="10" value="<?php echo $row['PhoneNo']; ?>">
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label class="form-label">Address</label>
                                                    <textarea class="form-control" name="address" required><?php echo $row['Address']; ?></textarea>
                                                </div>

                                                <input type="hidden" name="sid" value="<?php echo $row['ST_Id'];?>">

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