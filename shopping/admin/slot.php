<?php
    session_start();

    if(empty($_SESSION['is_shopping_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './assets/pages/admin-link.php';
    require_once './assets/pages/admin-header.php';
    require_once '../../assets/config/connect.php';

    if (isset($_POST['update'])) {

        if (mysqli_query($conn, "UPDATE slot_master SET SlotName = '$_POST[name]', TotalSlot = '$_POST[capacity]', DateModified = NOW() WHERE SL_Id = '$_POST[sid]'")) {

            echo "<script>alert('Yay, Slot updated successfully..');</script>";     
        } else {

            echo "<script>alert('Oops, Unable to update slot..');</script>";
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
                        <h3 class="mb-3">Manage Slot</h1>
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Slot Name</th>
                                    <th>Capacity</th>
                                    <th>Status</th>
                                    <th>Created On</th>
                                    <th>Modified On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $resd6 = mysqli_query($conn, "SELECT * FROM slot_master ORDER BY SL_Id DESC");
                                if (mysqli_num_rows($resd6) > 0) {

                                    $count = 1;
                                    while($rowd6 = mysqli_fetch_assoc($resd6)) {
                                        
                                        echo "<tr>"; 
                                        echo "<th>".$count."</th>"; 
                                        echo "<td>".$rowd6['SlotName']."</td>"; 
                                        echo "<td>".$rowd6['TotalSlot']."</td>"; 
                                        echo "<td>"; 
                                        if ($rowd6['SlotStatus']) {
                                            echo "Active";
                                        } else {
                                            echo "In-Active";
                                        }
                                        echo "</td>"; 
                                        echo "<td>".date_format(date_create($rowd6['DateCreate']), 'd M, Y') . "</td>"; 
                                        echo "<td>".date_format(date_create($rowd6['DateModified']), 'd M, Y') . "</td>"; 
                                        echo "<td>";
                                        ?>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal<?php echo $rowd6['SL_Id'];?>"><i class='fa fa-pen'></i></a> |
                                        <a href="slot-data.php" ><i class="fa fa-eye"></i></a>
                                        <?php
                                        echo "</td>";
                                        echo "</tr>";

                                        $count++;

                                        ?>
                                            <div class="modal fade" id="modal<?php echo $rowd6['SL_Id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Edit Slot</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body g-3 row">
                                                                <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                                    <label class="form-label">Slot Name</label>
                                                                    <input type="text" class="form-control" required name="name" title="Please enter slot name" value="<?php echo $rowd6['SlotName'];?>">
                                                                </div>
                                                                <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                                                                    <label class="form-label">Capacity</label>
                                                                    <input type="number" class="form-control" name="capacity" title="Please enter capacity" min="1" value="<?php echo $rowd6['TotalSlot'];?>">
                                                                </div>

                                                                <input type="hidden" name="sid" value="<?php echo $rowd6['SL_Id'];?>">
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
