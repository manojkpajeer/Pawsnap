<?php
    session_start();

    if(!isset($_SESSION['is_admin_login'])){

        echo "<script>location.href='../assets/pages/logout.php';</script>";
    }
    else{

        if(!$_SESSION['is_admin_login']){
            
            echo "<script>location.href='../assets/pages/logout.php';</script>";
        }
    }

    require_once '../assets/pages/admin-link.php';
    require_once '../assets/pages/admin-header.php';
    require_once '../assets/config/connect.php';

    if (isset($_GET['did'])) {
        
        if (mysqli_query($conn, "DELETE FROM slider_master WHERE SL_Id = '$_GET[did]'")){

            echo "<script>alert('Yay, Slider deleted successfully..');location.href='manage-slider.php';</script>";     
        } else {

            echo "<script>alert('Oops, Unable to delete slider.');</script>";
        }
    }

    if (isset($_POST['update'])) { 

        if (!empty($_FILES['image']['name'])) {
            
            $imagePath = "assets/images/slider/" .time() . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if (move_uploaded_file($_FILES['image']['tmp_name'], "../".$imagePath)) {

                if (mysqli_query($conn, "UPDATE slider_master SET Link = '$_POST[link]', Title = '$_POST[name]', SubText = '$_POST[sub_text]',  
                Text = '$_POST[text]', Image = '$imagePath', Status = '$_POST[status]' WHERE SL_ID = '$_POST[slider_id]'")) {

                    echo "<script>alert('Yay, Slider updated successfully..');</script>";     
                } else {

                    echo "<script>alert('Oops, Unable to update slider..');</script>";
                }
            
            } else { 

                echo "<script>alert('Oops, Unable to upload image on server..');</script>";
            }
        } else {

            if (mysqli_query($conn, "UPDATE slider_master SET Link = '$_POST[link]', Title = '$_POST[name]', SubText = '$_POST[sub_text]',  
                Text = '$_POST[text]', Status = '$_POST[status]' WHERE SL_ID = '$_POST[slider_id]'")) {

                echo "<script>alert('Yay, Upcoming Event updated successfully..');</script>";     
            } else {

                echo "<script>alert('Oops, Unable to update event..');</script>";
            }
        }
    }
?>
    
        <div id="layoutSidenav">
            <?php

                require_once '../assets/pages/admin-sidebar.php';
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid p-4">
                        <h3 class="mb-3">Slider</h1>
                        <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Text</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $resd6 = mysqli_query($conn, "SELECT * FROM slider_master ORDER BY SL_Id DESC");
                                        if (mysqli_num_rows($resd6) > 0) {

                                            $count = 1;
                                            while($rowd6 = mysqli_fetch_assoc($resd6)) {
                                                
                                                echo "<tr>"; 
                                                echo "<th>".$count."</th>"; 
                                                echo "<td><img src='../".$rowd6['Image']."' class='rounded-circle mr-2' width='60' height='50''></td>"; 
                                                echo "<td>".$rowd6['Title']."</td>"; 
                                                echo "<td>".$rowd6['Text']."</td>"; 
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
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal<?php echo $rowd6['SL_ID'];?>"><i class='fa fa-pen'></i></a> | 
                                                <a href="manage-slider.php?did=<?php echo $rowd6['SL_ID'];?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a>
                                                <?php
                                                echo "</td>";
                                                echo "</tr>"; 

                                                $count++;

                                                ?>
                                                    <div class="modal fade" id="modal<?php echo $rowd6['SL_ID'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo "Manage Slider";?></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body g-3 row">
                                                                        <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                                            <label class="form-label">Slider Title</label>
                                                                            <input type="text" class="form-control" required name="name" title="Please enter title" value="<?php echo $rowd6['Title'];?>">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                                            <label class="form-label">Slider Text</label>
                                                                            <input type="text" class="form-control" name="text" title="Please enter text"  value="<?php echo $rowd6['Text'];?>">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                                            <label class="form-label">Slider Sub-Text</label>
                                                                            <input type="text" class="form-control" name="sub_text" title="Please enter subtext" value="<?php echo $rowd6['SubText'];?>">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                                            <label class="form-label">Slider Link</label>
                                                                            <input type="text" class="form-control" required name="link" title="Please enter link" value="<?php echo $rowd6['Link'];?>">
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                                            <label class="form-label">Slider Image</label>
                                                                            <input type="file" class="form-control" name="image" title="Please select image" accept="image/*">
                                                                        </div>

                                                                        <input type="hidden" name="slider_id" value="<?php echo $rowd6['SL_ID'];?>">

                                                                        <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                                            <label class="form-label">Slider Status</label>
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

    require_once '../assets/pages/admin-footer.php';
?>
