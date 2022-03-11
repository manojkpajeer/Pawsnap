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

        $resCheck = mysqli_query($conn, "SELECT CT_ID FROM category_card WHERE Status = 1 AND CategoryId = '$_POST[category]'");
        if(mysqli_num_rows($resCheck)>0){

            echo "<script>alert('Oops, Menu already exist..');</script>";
        } else {
            
            if(mysqli_query($conn, "INSERT INTO category_card(CategoryId, Status, DateCreate) VALUES ('$_POST[category]', 1, NOW())")){

                echo "<script>alert('Yay, Menu added..');</script>";     
            }
            else{

                echo "<script>alert('Oops, Unable to add menu..');</script>";
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
                        <div class="row">
                            <div class="col-sm-12 col-lg-2 col-md-6"></div>
                            <div class="col-sm-12 col-lg-8 col-md-6">
                                <div class="card mt-4 p-4">
                                    <span class="text-center h2">Add Category Card</span><a class="text-end" href="manage-category-card.php">View</a>
                                    <form method="post" enctype="multipart/form-data" class="row">
                                        <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                            <label class="form-label">Select Category</label>
                                            <select class="form-control" name="category" title="Please choose category" required>
                                                <?php
                                                    $resCategory = mysqli_query($conn, "SELECT id, name FROM categories WHERE status = 1");
                                                    if(mysqli_num_rows($resCategory)>0){

                                                        while($rowCategory = mysqli_fetch_assoc($resCategory)){
                                                            
                                                            echo "<option value='$rowCategory[id]'>$rowCategory[name]</option>"; 
                                                        }
                                                    } else {

                                                        echo "<option value=''>Choose</option>";
                                                    }
                                                ?>
                                            </select>
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
