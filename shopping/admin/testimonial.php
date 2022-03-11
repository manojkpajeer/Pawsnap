<?php
    session_start();

    if(empty($_SESSION['is_shopping_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './assets/pages/admin-link.php';
    require_once './assets/pages/admin-header.php';
    require_once '../../assets/config/connect.php';

    if (isset($_GET['did'])) {
        
        if (mysqli_query($conn, "DELETE FROM testmonial_master WHERE TM_Id = '$_GET[did]'")){

            echo "<script>alert('Yay, Testimonial deleted successfully..');location.href='testimonial.php';</script>";     
        } else {

            echo "<script>alert('Oops, Unable to delete testimonial.');</script>";
        }
    }

    if (isset($_POST['update'])) { 

        $message = addslashes($_POST['message']);

        if (!empty($_FILES['image']['name'])) {
            
            $imagePath = "assets/images/testimonial/" .time() . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {

                if (mysqli_query($conn, "UPDATE testmonial_master SET UserName = '$_POST[name]', Location = '$_POST[location]',  
                Message = '$message', Image = '$imagePath', Status = '$_POST[status]' WHERE TM_Id = '$_POST[test_id]'")) {

                    echo "<script>alert('Yay, Testimonial updated successfully..');</script>";     
                } else {

                    echo "<script>alert('Oops, Unable to update testimonial..');</script>";
                }
            
            } else { 

                echo "<script>alert('Oops, Unable to upload image on server..');</script>";
            }
        } else {

            if (mysqli_query($conn, "UPDATE testmonial_master SET UserName = '$_POST[name]', Location = '$_POST[location]',  
                Message = '$message', Status = '$_POST[status]' WHERE TM_Id = '$_POST[test_id]'")) {

                echo "<script>alert('Yay, Testimonial Event updated successfully..');</script>";     
            } else {

                echo "<script>alert('Oops, Unable to update testimonial..');</script>";
            }
        }
    }

    if(isset($_POST['add'])){

        $message = addslashes($_POST['message']);
        
        $path_banner = "assets/images/testimonial/" .time() . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $path_banner)) {
            
            if(mysqli_query($conn, "INSERT INTO testmonial_master(Image, Message, Location, UserName, Status, DateCreate) 
            VALUES ('$path_banner', '$message', '$_POST[location]', '$_POST[name]', 1, NOW())")){

                echo "<script>alert('Yay, Testimonial added..');</script>";     
            }
            else{

                echo "<script>alert('Oops, Unable to add testimonial..');</script>";
            }
        } else {

            echo "<script>alert('Oops, Unable to upload image on server..');</script>";
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
                                <h3 class="mb-3">Manage Testimonial</h1>
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
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add Testimonial</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body g-3 row">
                                            <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                <label class="form-label">User Name</label>
                                                <input type="text" class="form-control" required name="name" title="Please enter name">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                <label class="form-label">Location</label>
                                                <input type="text" class="form-control" name="location" title="Please enter location">
                                            </div>
                                            <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                <label class="form-label">Message</label>
                                                <textarea name="message" required class="form-control" title="Please enter message"></textarea>
                                            </div>
                                            <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                <label class="form-label">User Image</label>
                                                <input type="file" class="form-control" required name="image" title="Please select image" accept="image/*">
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
                                            <th>Location</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $resd6 = mysqli_query($conn, "SELECT * FROM testmonial_master ORDER BY TM_Id DESC");
                                        if (mysqli_num_rows($resd6) > 0) {

                                            $count = 1;
                                            while($rowd6 = mysqli_fetch_assoc($resd6)) {
                                                
                                                echo "<tr>"; 
                                                echo "<th>".$count."</th>"; 
                                                echo "<td><img src='".$rowd6['Image']."' class='rounded-circle mr-2' width='60' height='50''></td>"; 
                                                echo "<td>".$rowd6['UserName']."</td>"; 
                                                echo "<td>".$rowd6['Location']."</td>"; 
                                                echo "<td>".$rowd6['Message']."</td>"; 
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
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal<?php echo $rowd6['TM_Id'];?>"><i class='fa fa-pen'></i></a> | 
                                                <a href="testimonial.php?did=<?php echo $rowd6['TM_Id'];?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a>
                                                <?php
                                                echo "</td>";
                                                echo "</tr>"; 

                                                $count++;

                                                ?>
                                                    <div class="modal fade" id="modal<?php echo $rowd6['TM_Id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Testimonial</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body g-3 row">
                                                                        <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                                            <label class="form-label">User Name</label>
                                                                            <input type="text" class="form-control" required name="name" title="Please enter name" value="<?php echo $rowd6['UserName']; ?>">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                                            <label class="form-label">Location</label>
                                                                            <input type="text" class="form-control" name="location" title="Please enter location" value="<?php echo $rowd6['Location']; ?>">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-12 col-md-12 mt-3">
                                                                            <label class="form-label">Message</label>
                                                                            <textarea name="message" required class="form-control" title="Please enter message"> <?php echo $rowd6['Message']; ?></textarea>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                                            <label class="form-label">User Image</label>
                                                                            <input type="file" class="form-control" name="image" title="Please select image" accept="image/*">
                                                                        </div>

                                                                        <input type="hidden" name="test_id" value="<?php echo $rowd6['TM_Id'];?>">

                                                                        <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                                            <label class="form-label">Testimonial Status</label>
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
