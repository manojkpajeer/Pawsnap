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

    if(isset($_POST['add'])){
        
        $path_banner = "assets/images/testimonial/" .time() . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES['image']['tmp_name'], "../".$path_banner)) {
            
            if(mysqli_query($conn, "INSERT INTO testmonial_master(Image, Message, Location, UserName, Status, DateCreate) 
            VALUES ('$path_banner', '$_POST[message]', '$_POST[location]', '$_POST[name]', 1, NOW())")){

                echo "<script>alert('Yay, Testimonial added..');</script>";     
            }
            else{

                echo "<script>alert('Oops, Unable to add testimonial..');</script>";
                // echo mysqli_error($conn);
            }
        } else {

            echo "<script>alert('Oops, Unable to upload image on server..');</script>";
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
                        <div class="row">
                            <div class="col-sm-12 col-lg-2 col-md-6"></div>
                            <div class="col-sm-12 col-lg-8 col-md-6">
                                <div class="card mt-4 p-4">
                                    <span class="text-center h2">Add Testimonial</span><a class="text-end" href="manage-testmonial.php">View</a>
                                    <form method="post" enctype="multipart/form-data" class="row">
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
                                        <div class="col-12 mt-3">
                                            <button class="btn btn-primary" type="submit" name="add">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-2 col-md-6"></div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    
<?php

    require_once '../assets/pages/admin-footer.php';
?>
