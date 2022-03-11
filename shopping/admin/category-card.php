<?php
    session_start();

    if(empty($_SESSION['is_shopping_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './assets/pages/admin-link.php';
    require_once './assets/pages/admin-header.php';
    require_once '../../assets/config/connect.php';

    if (isset($_GET['did'])) {
        
        if (mysqli_query($conn, "DELETE FROM category_card WHERE CT_ID = '$_GET[did]'")){

            echo "<script>alert('Yay, Card deleted successfully..');location.href='category-card.php';</script>";     
        } else {

            echo "<script>alert('Oops, Unable to delete card.');</script>";
        }
    }

    if (isset($_POST['update'])) { 

        if (mysqli_query($conn, "UPDATE category_card SET CategoryId = '$_POST[brand]', Status = '$_POST[status]' WHERE CT_ID = '$_POST[sid]'")) {

            echo "<script>alert('Yay, Card updated successfully..');</script>";     
        } else {

            echo "<script>alert('Oops, Unable to update card..');</script>";
        }
    }

    if(isset($_POST['add'])){
        
        if(mysqli_query($conn, "INSERT INTO category_card(CategoryId, Status, DateCreate) VALUES ('$_POST[category]', 1, NOW())")){

            echo "<script>alert('Yay, Card added..');</script>";     
        }
        else{

            echo "<script>alert('Oops, Unable to add card..');</script>";
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
                                <h3 class="mb-3">Manage Category Card</h1>
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
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add Category Card</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body g-3 row">
                                            <div class="col-sm-12 col-lg-12 col-md-12 mt-3">
                                                <label class="form-label">Select Category</label>
                                                <select class="form-control" name="category" title="Please choose category" required>
                                                    <?php
                                                        $resCategory = mysqli_query($conn, "SELECT CT_Id, CategoryName FROM category_master WHERE Status = 1");
                                                        if(mysqli_num_rows($resCategory)>0){

                                                            while($rowCategory = mysqli_fetch_assoc($resCategory)){
                                                                
                                                                echo "<option value='$rowCategory[CT_Id]'>$rowCategory[CategoryName]</option>"; 
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
                                        $resd6 = mysqli_query($conn, "SELECT category_card.CT_ID, category_master.CategoryName, category_master.CategoryImage, category_card.CategoryId, category_card.Status, category_card.DateCreate FROM category_card JOIN category_master ON category_master.CT_Id = category_card.CategoryId ORDER BY category_card.CT_ID DESC");
                                        if (mysqli_num_rows($resd6) > 0) {

                                            $count = 1;
                                            while($rowd6 = mysqli_fetch_assoc($resd6)) {
                                                
                                                echo "<tr>"; 
                                                echo "<th>".$count."</th>"; 
                                                echo "<td><img src='../../billing/".$rowd6['CategoryImage']."' class='rounded-circle mr-2' width='60' height='50''></td>"; 
                                                echo "<td>".$rowd6['CategoryName']."</td>"; 
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
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal<?php echo $rowd6['CT_ID'];?>"><i class='fa fa-pen'></i></a> | 
                                                <a href="category-card.php?did=<?php echo $rowd6['CT_ID'];?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash"></i></a>
                                                <?php
                                                echo "</td>";
                                                echo "</tr>"; 

                                                $count++;

                                                ?>
                                                    <div class="modal fade" id="modal<?php echo $rowd6['CT_ID'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Category Card</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body g-3 row">
                                                                        <div class="col-sm-12 col-lg-12 col-md-12 mt-3">
                                                                            <label class="form-label">Select Category</label>
                                                                            <select class="form-control" name="brand" required>
                                                                                <?php
                                                                                    $resCategory = mysqli_query($conn, "SELECT CT_Id, CategoryName FROM category_master WHERE Status = 1");
                                                                                    if(mysqli_num_rows($resCategory)>0){

                                                                                        echo "<option value=''>Choose</option>";

                                                                                        while($rowCategory = mysqli_fetch_assoc($resCategory)){
                                                                                            
                                                                                            ?>
                                                                                                <option value="<?php echo $rowCategory['CT_Id'];?>" <?php if($rowCategory['CT_Id'] == $rowd6['CategoryId']){echo 'selected';}?>><?php echo $rowCategory['CategoryName'];?></option>
                                                                                            <?php
                                                                                        }
                                                                                    } else {

                                                                                        echo "<option value=''>Choose</option>";
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </div>

                                                                        <input type="hidden" name="sid" value="<?php echo $rowd6['CT_ID'];?>">

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
